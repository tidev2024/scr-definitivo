@extends('default.layout')

@section('content')
<div class="container mt-5">
   <div class="card mt-4">
      <div class="card-header text-center">
         <h2>Informações do Usuário</h2>
      </div>
      <div class="card-body">
         <div class="user-details">
            <p><strong>Nome:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>CPF:</strong> {{ auth()->user()->cpf }}</p>
            <p><strong>Cargo:</strong> {{ auth()->user()->position->name }}</p>
            <p><strong>Departamento:</strong> {{ auth()->user()->department->name }}</p>
            <p><strong>Data de Criação:</strong> {{ auth()->user()->created_at ?? '28/06/2024' }}</p>
         </div>
      </div>
   </div>
   @if (session()->has('message'))
      <div class="overlay">
         <div class="alert-wrapper alertMessage show">
               <div class="alert alert-{{ session('message.type') }} alert-dismissible fade show" role="alert">
                  {{ session('message.message') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
         </div>
      </div>
   @endif
</div>
@endsection
