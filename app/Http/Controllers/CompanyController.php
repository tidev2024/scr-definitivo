<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function __construct(
        private Company $company
    ) {}

    public function index()
    {
        return view('company.index-company', [
            'companies' => $this->company->all()
        ]);
    }

    public function create()
    {
        $companiesDealer = DB::connection('dealernet')
        ->select('SELECT
        Empresa_Codigo as dealernet_company_id,
        Empresa_Nome as name,
        Empresa_NomeFantasia as trade_name,
        Empresa_Ativo as active,
        Pessoa_DocIdentificador as cnpj
        from GrupoRoma_DealernetWF..Empresa emp
        join GrupoRoma_DealernetWF..Pessoa p on p.Pessoa_Codigo = emp.Empresa_PessoaCod');
        return view('company.create-company', [
            'companiesDealer' => $companiesDealer
        ]);
    }

    public function store(Request $request)
    {
        if (empty($request->id)) {
            return redirect()->route('company.create');
        }
        if ($this->company->where('dealernet_company_id', '=', $request->id)->first()) {
            return redirect()->route('company.create')->with('message', [
                'type' => 'warning',
                'message' => 'Empresa já existe na base de dados'
            ]);
        }
        $companyDealer = DB::connection('dealernet')
        ->select('SELECT
        Empresa_Codigo as dealernet_company_id,
        Empresa_Nome as name,
        Empresa_NomeFantasia as trade_name,
        Empresa_Ativo as active,
        Pessoa_DocIdentificador as cnpj
        from GrupoRoma_DealernetWF..Empresa emp
        join GrupoRoma_DealernetWF..Pessoa p on p.Pessoa_Codigo = emp.Empresa_PessoaCod
        where Empresa_Codigo = :id', ['id' => $request->id]);
        if (!empty($companyDealer)) {
            $this->company->create((array)$companyDealer[0]);
            return redirect()->route('company.create')->with('message', [
                'type' => 'success',
                'message'=> 'Empresa importada'
            ]);
        }
        return redirect()->route('company.create')->with('message', [
            'type' => 'danger',
            'message'=> 'Empresa não encontrada na base da Dealernet'
        ]);
    }

    public function update(Request $request, string $id)
    {
        $companyDealer = DB::connection('dealernet')
        ->select('SELECT
        Empresa_Codigo as dealernet_company_id,
        Empresa_Nome as name,
        Empresa_NomeFantasia as trade_name,
        Empresa_Ativo as active,
        Pessoa_DocIdentificador as cnpj
        from GrupoRoma_DealernetWF..Empresa emp
        join GrupoRoma_DealernetWF..Pessoa p on p.Pessoa_Codigo = emp.Empresa_PessoaCod
        where Empresa_Codigo = :id or Pessoa_DocIdentificador = :cnpj',
        ['id' => $id, 'cnpj' => $request->cnpj]);
        $company = $this->company->where('dealernet_company_id', '=', $id)
        ->orWhere('cnpj', '=', $request->cnpj)->first();
        if (empty($company) || empty($companyDealer)) {
            return redirect()->route('company.create')->with('message', [
                'type' => 'danger',
                'message' => 'Dados da empresa não encontrado para atualizar'
            ]);
        }
        $company->update((array)$companyDealer[0]);
        return redirect()->route('company.create')->with('message', [
            'type' => 'success',
            'message' => 'Empresa atualizada com sucesso'
        ]);
    }
}
