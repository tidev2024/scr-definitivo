@extends('default.layout')
@section('content')
<div class="container">
   <div class="card">
      <div class="card-header cardTableHeader">
         <div class="row">
            <div class="form-group col-md-6">
               <h2>Usuários</h2>
            </div>
            <div class="form-group col-md-6 ms-auto">
               <form action="{{ route('user.index') }}" method="GET">
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
                  <th>Nome</th>
                  <th>Email</th>
                  <th>CPF</th>
                  <th>Master</th>
                  <th>Editar</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($users as $user)
               <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->cpf }}</td>
                  <td>{{ $user->master ? "Sim" : "Não" }}</td>
                  <td>
                     <form  action="{{ route('user.edit', $user->id) }}">
                        <button class="btn" type="submit"><i class="fas fa-edit"></i></button>
                     </form>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
   {{ $users->links() }}
   <br>
   <div class="button-container">
      <a class="btn btnOrange" href="{{ route('user.create') }}">Criar</a>
   </div>
</div>
</div>
@endsection