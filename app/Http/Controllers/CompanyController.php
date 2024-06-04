<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller implements HasMiddleware
{
    public function __construct(
        private Company $company
    ) {}

    public static function middleware(): array
    {
        return [
            'userIsAuthenticate',
            new Middleware('checkPermission:read-company', only: ['index']),
            new Middleware('checkPermission:create-company', only: ['create', 'store']),
            new Middleware('checkPermission:update-company', only: ['update']),
        ];
    }

    public function index(Request $request)
    {
        $company = $this->company;
        if ($request->has('filter')) {
            $company = $company->where('cnpj', '=', $request->input('filter'))
            ->orWhere('name', 'like', '%'.$request->input('filter').'%');
        }
        return view('company.index-company', [
            'companies' => $this->company->paginate(20)
        ]);
    }

    public function create(Request $request)
    {
        $companiesDealer = DB::connection('dealernet')
        ->table('GrupoRoma_DealernetWF.dbo.Empresa as emp')
        ->join('GrupoRoma_DealernetWF.dbo.Pessoa as p', 'p.Pessoa_Codigo', '=', 'emp.Empresa_PessoaCod')
        ->select(
            'emp.Empresa_Codigo as dealernet_company_id',
            'emp.Empresa_Nome as name',
            'emp.Empresa_NomeFantasia as trade_name',
            'emp.Empresa_Ativo as active',
            'p.Pessoa_DocIdentificador as cnpj'
        );
        if ($request->has('filter')) {
            $companiesDealer = $companiesDealer
            ->where('p.Pessoa_DocIdentificador', '=', $request->input('filter'))
            ->orWhere('emp.Empresa_Nome', 'like', '%'.$request->input('filter').'%');
        }
        return view('company.create-company', [
            'companiesDealer' => $companiesDealer->paginate(20),
            'filter' => $request->input('filter')
        ]);
    }

    public function store(Request $request)
    {
        if (empty($request->id)) {
            return redirect()->route('company.create');
        }
        $parametersUrl = [];
        preg_match('/page=(\d+)&?/', url()->previous(), $page);
        if (count($page) > 1) {
            $parametersUrl['page'] = $page[1];
        }
        preg_match('/filter=(.+)&?/', url()->previous(), $filter);
        if (count($filter) > 1) {
            $parametersUrl['filter'] = $filter[1];
        }
        if ($this->company->where('dealernet_company_id', '=', $request->id)->first()) {
            return redirect()->route('company.create', $parametersUrl)
            ->with('message', [
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
            return redirect()->route('company.create',$parametersUrl)
            ->with('message', [
                'type' => 'success',
                'message'=> 'Empresa importada'
            ]);
        }

        return redirect()->route('company.create',$parametersUrl)
        ->with('message', [
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

        $parametersUrl = [];
        preg_match('/page=(\d+)&?/', url()->previous(), $page);
        if (count($page) > 1 ) {
            $parametersUrl['page'] = $page[1];
        }
        preg_match('/filter=(.+)&?/', url()->previous(), $filter);
        if (count($filter) > 1) {
            $parametersUrl['filter'] = $filter[1];
        }
        if (empty($company) || empty($companyDealer)) {
            return redirect()->route('company.create', $parametersUrl)
            ->with('message', [
                'type' => 'danger',
                'message' => 'Dados da empresa não encontrado para atualizar'
            ]);
        }

        $company->update((array)$companyDealer[0]);
        return redirect()->route('company.create', $parametersUrl)
        ->with('message', [
            'type' => 'success',
            'message' => 'Empresa atualizada com sucesso'
        ]);
    }
}
