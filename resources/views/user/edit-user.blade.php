@extends('default.layout')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Usuário</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $user->id }}">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $user->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                         <div class="form-group col-md-6">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control @error('cpf') is-invalid @enderror" name="cpf" id="cpf" value="{{ $user->cpf }}">
                            @error('cpf')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ $user->email }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="department_id">Departamento</label>
                            <select class="form-control @error('department_id') is-invalid @enderror" name="department_id" id="department_id">
                                <option value="">Selecione um departamento</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="position_id">Cargo</label>
                            <select class="form-control @error('position_id') is-invalid @enderror" name="position_id" id="position_id">
                                <option value="">Selecione um cargo</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}" {{ $user->position_id == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                                @endforeach
                            </select>
                            @error('position_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row mb-3 mt-3">
                            <div class="form-group col-md-6">
                                <input type="checkbox" class="form-check-input" name="active" id="active" value="1" {{ $user->active ? 'checked' : '' }}>
                                <label class="form-check-label" for="active">Ativo</label>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="checkbox" class="form-check-input" name="master" id="master" value="1" {{ $user->master ? 'checked' : '' }}>
                                <label class="form-check-label" for="master">Master</label>
                            </div>
                        </div>
                        <a href="{{ route('user.resetPassword', $user->id) }}">
                            Resetar Senha
                            <i class="fa-solid fa-lock"></i>
                        </a>
                        <center><h2>Permissões</h2></center>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                @foreach ($permissions as $menu => $permissionValues)
                                    <button class="nav-link {{ ($loop->index == 0) ? 'active' : '' }}" id="nav-{{ $menu }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $menu }}" type="button" role="tab" aria-controls="nav-{{ $menu }}" aria-selected="{{ ($loop->index == 0) ? 'true' : 'false' }}">{{ $menu }}</button>
                                @endforeach
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            @foreach ($permissions as $menu => $permissionValues)
                                <div class="tab-pane fade {{ ($loop->index == 0) ? 'active show' : '' }}" id="nav-{{ $menu }}" role="tabpanel" aria-labelledby="nav-{{ $menu }}-tab" tabindex="{{ $loop->index }}">
                                    @foreach ($permissionValues as $id => $value)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="permission_id[]" @checked($user->permissions->contains('id', $id)) value="{{ $id }}">
                                            <label class="form-check-label">{{ $value }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btnOrange">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
