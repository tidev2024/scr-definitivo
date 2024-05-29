<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Company;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(
        private User $user,
        private Company $company,
        private Department $department,
        private Position $position
    ) {}

    public function index()
    {
        return view('user.index-user', [
            'user' => $this->user->paginate(20)
        ]);
    }

    public function create()
    {
        return view('user.create-user', [
            'positions' => $this->position->all(),
            'departments' => $this->department->all(),
            'companies' => $this->company->all(),
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        $this->user->create($request->validated());
        return redirect()->route('user.index')->with('message', [
            'type' => 'success',
            'message' => 'Usuário criado'
        ]);
    }

    public function edit(string $id)
    {
        $user = $this->user->find($id);
        if (empty($user)) {
            return redirect()->route('user.index')->with('message', [
                'type' => 'danger',
                'message' => 'Usuário não encontrado'
            ]);
        }
        return view('user.edit-user', [
            'user' => $user,
            'companies' => $this->company->all(),
            'departments' => $this->department->all(),
            'positions' => $this->position->all()
        ]);
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        $user = $this->user->find($id);
        if (empty($user)) {
            return redirect()->route('user.index')->with('message', [
                'type' => 'danger',
                'message' => 'Usuário não encontrado'
            ]);
        }
        $user->update($request->validated());
        return redirect()->route('user.index')->with('message', [
            'type' => 'success',
            'message' => 'Usuário atualizado'
        ]);
    }
}
