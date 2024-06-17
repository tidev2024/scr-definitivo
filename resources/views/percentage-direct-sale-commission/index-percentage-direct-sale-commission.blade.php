@extends('default.layout')
@section('content')
    <h1>Index</h1>
    @foreach ($percentageDirectSalesCommission as $percent)
        <div>{{ $percent->percent_to }} -- {{ $percent->percent_from }} -- {{ $percent->seller_percentage }}</div>
    @endforeach
@endsection