@extends('default.layout')
@section('content')
<div class="container">
   <div class="card">
      <div class="card-header">
         <center>
            <h2>Upload de Arquivo</h2>
         </center>
      </div>
      <div class="card-body">
         <form action="{{ route('invoicing.processFileB2B') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="invoicing_file">Escolha um arquivo:</label>
            <input type="file" class="form-control" id="invoicing_file" name="invoicing_file">
            @error('invoicing_file')
            {{ $message }}
            @enderror
            <br><br>
            <button type="submit" class="btn btnOrange">Enviar</button>
         </form>
      </div>
   </div>
</div>
@endsection