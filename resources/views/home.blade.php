@extends('default.layout')
@section('content')
@if (session()->has('message'))
    <div class="overlay">
        <div class="alert-wrapper alertMessage show">
            <div class="alert alert-{{ session('message.type') }} alert-dismissible fade show" role="alert">
                {{ session('message.message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif
@endsection