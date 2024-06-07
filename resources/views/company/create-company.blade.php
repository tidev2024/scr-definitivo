@extends('default.layout')
@section('content')
<div class="container">
   @if (session('message'))
   <div class="overlay">
      <div class="alert-wrapper alertMessage show">
         <div class="alert alert-{{ session('message.type') }} alert-dismissible fade show" role="alert">
            {{ session('message.message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      </div>
   </div>
   @endif
   <div>
      <div class="card">
         <div class="card-header cardTableHeader">
            <div class="row">
               <div class="form-group col-md-6">
                  <h2>Importar Empresas</h2>
               </div>
               <div class="form-group col-md-6 ms-auto">
                  <form action="{{ route('company.create') }}" method="GET">
                     <div class="input-group mt-1">
                        <input type="text" class="form-control" id="filter" name="filter" value="{{ $filter ?? '' }}">
                        <button class="btn searchButton" type="submit">Pesquisar</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="card-body">
            <table class="table table-striped table-hover">
               <thead class="table-light">
                  <tr>
                     <th>Código Dealernet</th>
                     <th>Nome</th>
                     <th>Nome Fantasia</th>
                     <th>CNPJ</th>
                     <th>Situação</th>
                     <th>Ações</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($companiesDealer as $company)
                  <tr>
                     <td>{{ $company->dealernet_company_id }}</td>
                     <td>{{ $company->name }}</td>
                     <td>{{ $company->trade_name }}</td>
                     <td>{{ $company->cnpj }}</td>
                     <td>{{ $company->active == 1 ? 'Ativo' : 'Inativo' }}</td>
                     <td>
                        <form action="{{ route('company.store') }}" method="post" style="display: inline;">
                           @csrf
                           <input type="hidden" name="id" value="{{ $company->dealernet_company_id }}">
                           <button type="submit" class="btn btn-secondary btnGrey" title="Importa esta empresa para o sistema."><b>Importar</b></button>
                        </form>
                        <form action="{{ route('company.update', $company->dealernet_company_id) }}" method="post" style="display: inline;">
                           @csrf
                           @method('put')
                           <input type="hidden" name="cnpj" value="{{ $company->cnpj }}">
                           <button type="submit" class="btn btn-dark btnWhite" title="Atualiza os dados da empresa se já existentes no sistema."><b>Atualizar</b></button>
                        </form>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
      <div class="row">
         <div class="form-group col-md-12 ms-auto">
            <div>
               {{ $companiesDealer->appends(['filter' => request('filter')])->links() }}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection