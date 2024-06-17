@extends('default.layout')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Cadastro de percentual de comissão VD</h2>
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('percentCommission.store') }}">
                @csrf
                <div class="col-sm-4">
                  <label>Percentual de: </label>
                </div>
                <div class="col-sm-4">
                  <label>Percentual até: </label>
                </div>
                <div class="col-sm-4">
                  <label>Porcentagem do vendedor: </label>
                </div>

                @if($total_itens != 0)
                  @foreach ($percentageDirectSalesCommission as $percent)

                    <div class="col-sm-4" id="percent_to_{{ $loop->index }}">
                      <input type="text" class="form-control" name="percent_to_{{ $loop->index }}" value="{{ $percent->percent_to }}">
                    </div>
                    <div class="col-sm-4" id="percent_from_{{ $loop->index }}">
                      <input type="text" class="form-control" name="percent_from_{{ $loop->index }}" value="{{ $percent->percent_from }}">
                    </div>
                    <div class="col-sm-3" id="seller_percentage_{{ $loop->index }}">
                      <input type="text" class="form-control" name="seller_percentage_{{ $loop->index }}" value="{{ $percent->seller_percentage }}">
                    </div>
                    <div class="col-sm-1" id="remove_button_{{ $loop->index }}">
                      <button type="button" class="btn btn-primary" data-row="{{ $loop->index }}">
                        <i class="fa-solid fa-xmark"></i>
                      </button>
                    </div>
                  @endforeach
                @else
                    <div class="col-sm-4" id="percent_to_{{ $total_itens }}">
                      <input type="text" class="form-control" name="percent_to_{{ $total_itens }}">
                    </div>
                    <div class="col-sm-4" id="percent_from_{{ $total_itens }}">
                      <input type="text" class="form-control" name="percent_from_{{ $total_itens }}">
                    </div>
                    <div class="col-sm-3" id="seller_percentage_{{ $total_itens }}">
                      <input type="text" class="form-control" name="seller_percentage_{{ $total_itens }}">
                    </div>
                    <div class="col-sm-1" id="remove_button_{{ $total_itens }}">
                      <button type="button" class="btn btn-primary" data-row="{{ $total_itens }}">
                        <i class="fa-solid fa-xmark"></i>
                      </button>
                    </div>
                @endif


                <div class="col-sm-2">
                  <button type="button" class="btn btn-primary" id="add_row" data-row-number="{{ $total_itens }}">
                    <i class="fa-solid fa-plus"></i>
                    Percentual
                  </button>
                </div>
                <div class="col-sm-1">
                  <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
 </div>
 <script src="{{ asset('js/create-percentage-direct-sale-commission.js') }}"></script>
@endsection