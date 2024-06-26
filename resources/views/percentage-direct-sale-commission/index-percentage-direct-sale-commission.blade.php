@extends('default.layout')

@section('content')
<div class="container">
    <div class="card">
    <div class="card-header cardTableHeader">
    <h1 class="text-center">Porcentagens de Comissão de Vendas Diretas</h1>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">De (%)</th>
                    <th scope="col">Até (%)</th>
                    <th scope="col">Porcentagem do Vendedor (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($percentageDirectSalesCommission as $percent)
                    <tr>
                        <td>{{ $percent->percent_from }}</td>
                        <td>{{ $percent->percent_to }}</td>
                        <td>{{ $percent->seller_percentage }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="button-container">
            <a class="btn btnOrange" href="{{ route('percentCommission.create') }}">Editar</a>
         </div>
</div>
</div>
</div>
@endsection
