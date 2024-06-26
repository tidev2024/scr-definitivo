<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadB2BFileRequest;
use App\Models\ImportData;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class InvoicingController extends Controller implements HasMiddleware
{
    public function __construct(
        private ImportData $importData
    ) {}

    public static function middleware(): array
    {
        return [
            'userIsAuthenticate',
            // new Middleware('checkPermission:read-department', only: ['index'])
        ];
    }

    public function uploadFileB2B()
    {
        return view('invoicing.upload-file-b2b');
    }

    public function processFileB2B(UploadB2BFileRequest $request)
    {
        ini_set('memory_limit','-1');

        ini_set('max_execution_time',30000);

        // validating successful upload
        if (!$request->file('invoicing_file')->isValid()) {
            return  redirect()->route('invoicing.uploadFileB2B')->with('message', [
                'type' => 'danger',
                'message' => 'Ocorreu um erro ao enviar arquivo'
            ]);
        }
        $file = $request->file('invoicing_file');
        $filePath = $file->getRealPath();
        $records = [];
        // Reading all the file and save in variable
        if (($handle = fopen($filePath, 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ';'); // Read the first line (header)
            while (($row = fgetcsv($handle, 1000, ';')) !== false) {
                if (empty($row[6])) {
                    $records[] = $row;
                }
            }
            fclose($handle);
        }
        // Processing data
        $comissaoVendas = [];
        // VENDEDOR, CHASSI, NF MONTADORA, VALOR COMISSAO, CLIENTE
        foreach($records as $record) {
            $chassiSerie = $record[5];
            $impostoRenda = str_replace(',', '.', str_replace('.', '', $record[9]));
            $NFMotadora = $record[7];
            $valorComissao = str_replace(',', '.', str_replace('.', '', $record[11]));
            $data = DB::connection('dealernet')
                ->select('SELECT
                        top 1
                        nf.NotaFiscal_Codigo,
                        vendedor.Usuario_Nome as vendedor,
                        v.Veiculo_Chassi as chassi,
                        cliente.Pessoa_Nome as cliente
                        from NotaFiscal nf
                        join NotaFiscalItem nfi on nfi.NotaFiscal_Codigo = nf.NotaFiscal_Codigo
                        join Veiculo v on v.Veiculo_Codigo = nfi.NotaFiscalItem_VeiculoCod
                        join Pessoa cliente on cliente.Pessoa_Codigo = nf.NotaFiscal_PessoaCod
                        left join Usuario vendedor on vendedor.Usuario_Codigo = nf.NotaFiscal_UsuCodVendedor
                        where v.Veiculo_ChassiSerie = :chassiSerie
                        order by nf.NotaFiscal_Codigo desc',
                ['chassiSerie' => $chassiSerie]);
            if (empty($data)) {
                continue;
            }
            $informacaoVenda = $data[0];
            try {
                $this->importData->create(['chassi' => $informacaoVenda->chassi, 'commission_value' => $valorComissao, 'income_tax' => $impostoRenda]);
            } catch (UniqueConstraintViolationException $th) {
                //throw $th;
            }
            if (empty($informacaoVenda->vendedor)) {
                $comissaoVendas['indefinido'][] = [
                    'chassi' => $informacaoVenda->chassi,
                    'cliente' => $informacaoVenda->cliente,
                    'nf_montadora' => $NFMotadora,
                    'valor_comissao' => $valorComissao,
                    'income_tax' => $impostoRenda,
                ];
            } else {
                $comissaoVendas[$informacaoVenda->vendedor][] = [
                    'chassi' => $informacaoVenda->chassi,
                    'cliente' => $informacaoVenda->cliente,
                    'nf_montadora' => $NFMotadora,
                    'valor_comissao' => $valorComissao,
                    'income_tax' => $impostoRenda,
                ];
            }
        }
        // CONTINUAR TRATAMENTO DO ARQUIVO
        return redirect()->route('invoicing.uploadFileB2B');
    }
}

