@extends('default.layout')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Cadastrar Usuário</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control @error('cpf') is-invalid @enderror" name="cpf" id="cpf" placeholder="CPF" value="{{ old('cpf') }}">
                                @error('cpf')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <input type="checkbox" class="form-check-input" name="active" id="active" value="1" {{ old('active') ? 'checked' : '' }}>
                            <label class="form-check-label" for="active">Ativo</label>
                        </div>

                        <div class="form-group col-md-6">
                            <input type="checkbox" class="form-check-input" name="master" id="master" value="1" {{ old('master') ? 'checked' : '' }}>
                            <label class="form-check-label" for="master">Master</label>
                        </div>
                      </div>
  
                        <div class="form-group mb-3">
                            <label for="company_id">Company</label>
                            <select class="form-control @error('company_id') is-invalid @enderror" name="company_id" id="company_id">
                                <option value="">Selecione uma empresa</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="department_id">Department</label>
                            <select class="form-control @error('department_id') is-invalid @enderror" name="department_id" id="department_id">
                                <option value="">Selecione um departamento</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="position_id">Position</label>
                            <select class="form-control @error('position_id') is-invalid @enderror" name="position_id" id="position_id">
                                <option value="">Posição</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                                @endforeach
                            </select>
                            @error('position_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <center><h2>Permissões</h2></center>

                        @foreach ($permissions as $menu => $permissionValues)
                            <h5>{{ $menu }}</h5>
                            @foreach ($permissionValues as $id => $value)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="permission_id[]" value="{{ $id }}">
                                    <label class="form-check-label">{{ $value }}</label>
                                </div>
                            @endforeach
                        @endforeach

                        <button type="submit" class="btn btn-primary mt-3">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
