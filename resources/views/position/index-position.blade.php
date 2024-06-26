@extends('default.layout')
@section('content')
<div class="container">
   <div class="card">
      <div class="card-header cardTableHeader">
         <div class="row">
            <div class="form-group col-md-6">
               <h2>Cargos</h2>
            </div>
            <div class="form-group col-md-6 ms-auto">
               <form action="{{ route('position.index') }}" method="GET">
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
                  <th>Editar</th>
                  <th>Excluir</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($positions as $position)
               <tr>
                  <td>{{ $position->name }}</td>
                  <td>
                     <form  action="{{ route('position.edit', $position->id) }}">
                        <button class="btn" type="submit"><i class="fas fa-edit"></i></button>
                     </form>
                  </td>
                  <td>
                     <form class="delete-form" action="{{ route('position.destroy', $position->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn delete-btn" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $position->id }}"><i class="fa-solid fa-trash"></i></button>
                     </form>
                  </td>
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
            <a class="btn  btnOrange" href="{{ route('position.create') }}">Criar</a>
         </div>
      </div>
      <div class="col-md-6 ">
         <div>
            {{ $positions->appends(['filter' => request('filter')])->links() }}
         </div>
      </div>
   </div>
</div>

@if (session()->has('message'))
    <div class="overlay">
        <div class="alert-wrapper alertMessage show">
            <div class="alert alert-{{ session('message.type') }} alert-dismissible fade show" role="alert">
                {{ session('message.message') }}
                @if (session()->has('message.names'))
                  <br>
                  @foreach (session('message.names') as $name)
                     {{$loop->last ? "$name." : "$name,"}}
                  @endforeach
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif


<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="deleteModalLabel">Confirmação de Deleção</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
               Tem certeza de que deseja deletar este Cargo?
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
               <button type="button" class="btn btnOrange" id="confirmDelete">Deletar</button>
           </div>
       </div>
   </div>
</div>
@endsection