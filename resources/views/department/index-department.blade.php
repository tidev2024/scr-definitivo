@extends('default.layout')

@section('content')
<div class="container">
    <div>
        <form action="{{ route('department.index') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="filter" name="filter" value="{{ $filter ?? '' }}">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Pesquisar</button>
             </div>
        </form>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Departamento</th>
                    <th>Editar</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                <tr>
                    <td>{{ $department->name  }}</td>
                    <td><form  action="{{ route('department.edit', $department->id) }}">
                           <button class="btn" type="submit"><i class="fas fa-edit"></i></button>
                    </form></td>

                    <td><form  action="{{ route('department.destroy', $department->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn" type="submit"><i class="fa-solid fa-trash"></i></button>
                    </form></td>

                </tr>
                @endforeach
            </tbody>
        </table>
</div>
<br>
<div class="button-container">
    <a class="btn  btnWhite opacityOnHover" href="{{ route('department.create') }}">Criar</a>
</div>
<div class="pagination justify-content-center">
    {{ $departments->appends(['filter' => request('filter')])->links() }}
</div>
</div>
@endsection