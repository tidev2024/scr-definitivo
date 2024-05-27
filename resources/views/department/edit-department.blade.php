<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('department.update', $department->id) }}" method="post">
        @csrf
        @method('put')
        <input type="hidden" name="id" id="id" value="{{ $department->id }}">
        <input type="text" name="name" id="name" value="{{ $department->name }}">
        <button type="submit">Atualizar</button>
        @error('name')
            {{  $message }}
        @enderror
    </form>
</body>
</html>