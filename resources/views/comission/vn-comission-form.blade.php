@extends('default.layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Relatório Veículo Novo</h4>
                </div>
                 <div class="card-body">
                    <form action=" {{ route('comission.VNComissionReport') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="from">De: </label>
                                <input type="date" class="form-control @error('from') is-invalid @enderror" name="from" id="from" placeholder="" value="{{ old('from') }}">
                                @error('from')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="to">Até: </label>
                                <input type="date" class="form-control @error('to') is-invalid @enderror" name="to" id="to" value="{{ old('to') }}">
                                @error('to')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btnOrange w-100">Gerar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection