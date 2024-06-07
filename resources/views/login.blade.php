@extends('default.layout')

@section('content')
<div class="loginScreen d-flex align-items-center justify-content-center vh-100">
    <div class="loginCard card p-5 shadow-sm">
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="{{ asset('images/logoGrupoRoma.png') }}" alt="Logo Grupo Roma" class="img-fluid login-img">
            </div>
            <form method="POST" action="{{ route('login.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@romagroup.com.br" value="{{ old('email') }}">
                    @error('email')
                        <div class="alert alert-danger customAlert mt-3" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                        <div class="alert alert-danger customAlert mt-3" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @if (session()->has('message'))
                    <div class="alert customAlert alert-{{ session('message.type') }} mt-3" role="alert">
                        {{ session('message.message') }}
                    </div>
                @endif
                <button type="submit" class="btn btnOrange w-100 mt-3">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
