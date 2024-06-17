@extends('default.layout')
@section('content')
<div class="container mt-5">
   <div class="row justify-content-center">
      <div class="col-md-6">
         <div class="card">
            <div class="card-body backgroundWhite" style="">
               <form action="{{ route('position.store') }}" method="post">
                  @csrf
                  <label for="name">Cargo:</label>
                  <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"  placeholder="">
                  @error('name')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                  @enderror
                  <div class="d-grid gap-2 col-6 mx-auto mt-4">
                     <button type="submit" class="btn btnWhite">Gravar</button>
                  </div>
               </form>
            </div>
         </div>
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
@endsection