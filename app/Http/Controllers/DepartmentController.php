<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function __construct(
        private Department $department
    ) {}

    public function index()
    {
        return view('department.index-department', [
            'departments' => $this->department->all()
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
        $department->delete();
        return redirect()->route('department.index')->with('message', [
            'type' => 'success',
            'message' => 'Departamento removido'
        ]);
    }
}