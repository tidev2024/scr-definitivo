<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DepartmentController extends Controller implements HasMiddleware
{
    public function __construct(
        private Department $department
    ) {}

    public static function middleware(): array
    {
        return [
            'userIsAuthenticate',
            new Middleware('checkPermission:read-department', only: ['index']),
            new Middleware('checkPermission:create-department', only: ['create', 'store']),
            new Middleware('checkPermission:update-department', only: ['edit', 'update']),
            new Middleware('checkPermission:delete-department', only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $department = $this->department;
        if ($request->has('filter')) {
            $department = $department->where('name', 'like', '%'.$request->input('filter').'%');
        }
        return view('department.index-department', [
            'departments' => $department->paginate(20)
        ]);
    }

    public function create()
    {
        return view('department.create-department');
    }

    public function store(DepartmentStoreRequest $request)
    {
        $this->department->create($request->validated());
        return redirect()->route('department.create')->with('message', [
            'type' => 'success',
            'message' => 'Departamento criado'
        ]);
    }

    public function edit(string $id)
    {
        $department = $this->department->find($id);
        if (empty($department)) {
            return redirect()->route('department.index')->with('message', [
                'type' => 'danger',
                'message' => 'Departamento não encontrado'
            ]);
        }
        return view('department.edit-department', ['department' => $department]);
    }

    public function update(DepartmentUpdateRequest $request, string $id)
    {
        $department = $this->department->find($id);
        if (empty($department)) {
            return redirect()->route('department.index')->with('message', [
                'type' => 'danger',
                'message' => 'Departamento não encontrado'
            ]);
        }
        $department->update($request->validated());
        return redirect()->route('department.index')->with('message', [
            'type' => 'success',
            'message' => 'Departamento atualizado'
        ]);
    }

    public function destroy(string $id)
    {
        $department = $this->department->find($id);
        if (empty($department)) {
            return redirect()->route('department.index')->with('message', [
                'type' => 'danger',
                'message' => 'Departamento não encontrado'
            ]);
        }
        try {
            $department->delete();
        } catch (Exception $e) {
            return redirect()->route('department.index')->with('message', [
                'type' => 'warning',
                'message' => 'Existem usuários vinculados a esse departamento não é possível excluir',
                'names' => $department->users->pluck('name')
            ]);
        }
        return redirect()->route('department.index')->with('message', [
            'type' => 'success',
            'message' => 'Departamento removido'
        ]);
    }
}
