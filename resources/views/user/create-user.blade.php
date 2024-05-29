<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('user.store') }}" method="post">
        @csrf
        <input type="text" name="name" id="name" placeholder="name" value="{{ old('name') }}">
        @error('name')
            {{ $message }}
        @enderror
        <input type="text" name="cpf" id="cpf" placeholder="cpf" value="{{ old('cpf') }}">
        @error('cpf')
            {{ $message }}
        @enderror
        <input type="password" name="password" id="password" placeholder="password" >
        @error('password')
            {{ $message }}
        @enderror
        <input type="text" name="email" id="email" placeholder="email" value="{{ old('email') }}">
        @error('email')
            {{ $message }}
        @enderror
        <input type="checkbox" name="active" id="active" placeholder="active" value="1" {{ old('active') ? 'checked' : '' }}>
        <input type="checkbox" name="master" id="master" placeholder="master" value="1" {{ old('master') ? 'checked' : '' }}>
        <select name="company_id" id="company_id">
            <option value="">Seleciona uma empresa</option>
            @foreach ($companies as $company)
                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
            @endforeach
        </select>
        @error('company_id')
            {{ $message }}
        @enderror
        <select name="department_id" id="department_id">
            <option value="">Seleciona um departamento</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
            @endforeach
        </select>
        @error('department_id')
            {{ $message }}
        @enderror
        <select name="position_id" id="position_id">
            <option value="">Seleciona um cargo</option>
            @foreach ($positions as $position)
                <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
            @endforeach
        </select>
        @error('position_id')
            {{ $message }}
        @enderror
        <button type="submit">Enviar</button>
    </form>
</body>
</html>