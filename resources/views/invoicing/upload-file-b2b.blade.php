<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Upload de Arquivo</h2>
    <form action="{{ route('invoicing.processFileB2B') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="invoicing_file">Escolha um arquivo:</label>
        <input type="file" id="invoicing_file" name="invoicing_file">
        @error('invoicing_file')
            {{ $message }}
        @enderror
        <br><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>