<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('position.store') }}" method="post">
        @csrf
        <label for="name">Cargo </label>
        <input type="text" name="name" id="name">
        <button type="submit">Enviar</button>
        @error('name')
            {{ $message }}
        @enderror
    </form>
</body>
</html>