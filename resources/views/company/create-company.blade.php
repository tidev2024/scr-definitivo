@extends('default.layout')

@section('content')
    <table class="customTable">
        <thead>
          <tr>
            <th scope="col">Codigo Dealernet</th>
            <th scope="col">Nome</th>
            <th scope="col">Nome Fantasia</th>
            <th scope="col">Cnpj</th>
            <th scope="col">Ativo</th>
            <th scope="col">Importar</th>
            <th scope="col">Atualizar</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($companiesDealer as $company)
                <tr>
                    <td>{{ $company->dealernet_company_id }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->trade_name }}</td>
                    <td>{{ $company->cnpj }}</td>
                    <td>{{ $company->active }}</td>
                    <td>
                        <form action="{{ route('company.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $company->dealernet_company_id }}">
                            <button type="submit">Importar</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('company.update', $company->dealernet_company_id) }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="cnpj" value="{{ $company->cnpj }}">
                            <button type="submit">Atualizar</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
      </table>
      {{ $companiesDealer->links() }}
@endsection