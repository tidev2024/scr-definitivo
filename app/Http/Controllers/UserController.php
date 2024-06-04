<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Company;
use App\Models\Department;
use App\Models\Permission;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
    public function __construct(
        private User $user,
        private Company $company,
        private Department $department,
        private Position $position,
        private Permission $permission
    ) {}

    public static function middleware(): array
    {
        return [
            'userIsAuthenticate',
            new Middleware('checkPermission:read-user', only: ['index']),
            new Middleware('checkPermission:create-user', only: ['create', 'store']),
            new Middleware('checkPermission:update-user', only: ['edit', 'update']),
        ];
    }

    public function index(Request $request)
    {
        $user = $this->user;
        if ($request->has('filter')) {
            $user->where('name', 'like', '%'.$request->input('filter').'%')
            ->orWhere('cpf', '=', '%'.$request->input('filter').'%');
        }
        return view('user.index-user', [
            'users' => $user->paginate(20)
        ]);
    }

    public function create()
    {
        return view('user.create-user', [
            'positions' => $this->position->all(),
            'departments' => $this->department->all(),
            'companies' => $this->company->all(),
            'permissions' => $this->permission->groupByMenu()
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        $createdUser = $this->user->create($request->validated());
        $createdUser->permissions()->attach($request->validated('permission_id'));
        return redirect()->route('user.index')->with('message', [
            'type' => 'success',
            'message' => 'Usuário criado'
        ]);
    }

    public function edit(string $id)
    {
        $user = $this->user->with('permissions')->find($id);
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
            'positions' => $this->position->all(),
            'permissions' => $this->permission->groupByMenu()
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
        $user->permissions()->sync($request->validated('permission_id'));
        return redirect()->route('user.index')->with('message', [
            'type' => 'success',
            'message' => 'Usuário atualizado'
        ]);
    }
}
