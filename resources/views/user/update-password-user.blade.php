@extends('default.layout')
@section('content')


<div class="container">
     <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body backgroundWhite" style="">
                    <form action="{{ route('user.storeUpdatedPassword') }}" method="post">
                        @csrf
                        <label for="password">Senha atual:</label>
                        <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror">
                        @error('password')
                           <div class="invalid-feedback">
                                {{ $message }}
                          </div>
                          @enderror
                        
                        <label for="new_password">Nova senha:</label>
                        <input type="password" name="new_password" id="new_password" class="form-control  @error('new_password') is-invalid @enderror">
                          @error('new_password')
                           <div class="invalid-feedback">
                                {{ $message }}
                          </div>
                          @enderror
                          
                          <label for="new_password_confirmation">Confirmar nova senha:</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control  @error('new_password_confirmation') is-invalid @enderror">
                          @error('new_password_confirmation')
                           <div class="invalid-feedback">
                                {{ $message }}
                          </div>
                          @enderror

                          @if (session()->has('message'))
                          <div class="alert alert-{{ session('message.type') }} mt-3" role="alert">
                              {{ session('message.message') }}
                          </div>
                          @endif
                        <div class="d-grid gap-2 col-6 mx-auto mt-4">
                            <button type="submit" class="btn btnWhite">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection