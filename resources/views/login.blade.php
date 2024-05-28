@extends('default.layout')

@section('content')
<div class="container-fluid" id="loginContainer">
    <div class="row no-gutters h-100" id="dynamicBackground" style="background-image: url('/images/grupoRoma1.jpg'); background-size: cover;">
        <div class="col-md-6 d-none d-md-flex align-items-center">
        </div>
        <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-center customForm">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-9 mx-auto">
                        <h3 class="text-center">LOGIN</h3>
                        <form method="POST" action="{{ route('login.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control menuShadow" id="email" name="email" placeholder="email@exemplo.com">
                                @error('email')
                                    <div class="alert alert-danger customAlert" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control menuShadow" id="password" name="password" placeholder="">
                                @error('password')
                                    <div class="alert alert-danger customAlert" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <br>
                            @if (session()->has('message'))
                                <div class="alert customAlert alert-{{ session('message')['type'] }}" role="alert">
                                    {{ session('message')['message'] }}
                                </div>
                            @endif
                            <button type="submit" class="btn btn-block menuShadow" id="loginButton">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection