@extends('default.layout')

@section('content')

<div>
    <h1>{{ auth()->user()->name }}</h1>
    <p>Email: {{ auth()->user()->email }}</p>
    
    <pre>{{ auth()->user() }}</pre>
</div>

@endsection
