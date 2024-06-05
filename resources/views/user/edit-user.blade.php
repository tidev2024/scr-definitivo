@extends('default.layout')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit User</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $user->id }}">

                        <div class="row">
                            <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{ $user->name }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                
                         <div class="form-group col-md-6">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control @error('cpf') is-invalid @enderror" name="cpf" id="cpf" placeholder="CPF" value="{{ $user->cpf }}">
                            @error('cpf')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ $user->email }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="checkbox" class="form-check-input" name="active" id="active" value="1" {{ $user->active ? 'checked' : '' }}>
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="checkbox" class="form-check-input" name="master" id="master" value="1" {{ $user->master ? 'checked' : '' }}>
                            <label class="form-check-label" for="master">Master</label>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <select class="form-control @error('company_id') is-invalid @enderror" name="company_id" id="company_id">
                                <option value="">Select a company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ $user->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="department_id">Department</label>
                            <select class="form-control @error('department_id') is-invalid @enderror" name="department_id" id="department_id">
                                <option value="">Select a department</option>
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
                            <label for="position_id">Position</label>
                            <select class="form-control @error('position_id') is-invalid @enderror" name="position_id" id="position_id">
                                <option value="">Select a position</option>
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
                        <div class="form-group">
                            <h2>Permissions</h2>
                            @foreach ($permissions as $menu => $permissionValues)
                                <h5>{{ $menu }}</h5>
                                @foreach ($permissionValues as $id => $value)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="permission_id[]" value="{{ $id }}" {{ $user->permissions->contains('id', $id) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $value }}</label>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
