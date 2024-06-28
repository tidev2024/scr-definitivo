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
            <form class="formLoadingIcon" action="{{ route('invoicing.processFileB2B') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="invoicing_file">Escolha o arquivo CSV:</label>
                <input type="file" class="form-control" id="invoicing_file" name="invoicing_file" accept=".csv">
                @error('invoicing_file')
                <div class="alert alert-danger customAlert mt-3" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <br><br>
                <button type="submit" class="btn btnOrange">Enviar</button>
            </form>
        </div>
    </div>
    <div class="loadingIcon" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="alert alert-warning text-center" role="alert">
            <p class="fw-bold">Aguarde!</p>
            <img class="loadingGif" src="{{ asset('images/loading.gif') }}" alt="Loading..." style="width: 50px;">
        </div>
    </div>
</div>
@endsection