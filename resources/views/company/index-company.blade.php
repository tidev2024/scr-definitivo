@extends('default.layout')
@section('content')
<div class="container">
   <div>
      <div class="card">
         <div class="card-header cardHeader">
            <div class="row">
               <div class="form-group col-md-6">
                  <h2>Empresas</h2>
               </div>
               <div class="form-group col-md-6 ms-auto">
                  <form action="{{ route('company.index') }}" method="GET">
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
                     <th>ID</th>
                     <th>Nome</th>
                     <th>Situação</th>
                     <th>CNPJ</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($companies as $company)
                  <tr>
                     <td>{{ $company->dealernet_company_id }}</td>
                     <td>{{ $company->name }}</td>
                     <td>
                        {!! !empty($company->active) 
                        ? '<i class="fa-solid fa-check" style="color:green;"></i>' 
                        : '<i class="fa-solid fa-xmark" style="color:red;"></i>' !!}
                     </td>
                     <td>{{ $company->cnpj }}</td>
                  </tr>
                  @endforeach
               </tbody>              
            </table>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="col-md-6">
            <div class="button-container">
               <a class="btn  btnOrange opacityOnHover" href="{{ route('company.create') }}">Importar</a>
            </div>
         </div>
         <div class="col-md-6 ">
            <div>
               {{ $companies->appends(['filter' => request('filter')])->links() }}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection