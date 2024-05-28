@extends('default.layout')

@section('content')

@foreach($companies as $company)
    <p>{{ $company }}</p>
@endforeach

@endsection