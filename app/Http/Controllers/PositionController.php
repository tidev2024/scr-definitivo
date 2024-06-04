<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PositionController extends Controller implements HasMiddleware
{
    public function __construct(
        private Position $position
    ) {}

    public static function middleware(): array
    {
        return [
            'userIsAuthenticate',
            new Middleware('checkPermission:read-position', only: ['index']),
            new Middleware('checkPermission:create-position', only: ['create', 'store']),
            new Middleware('checkPermission:update-position', only: ['edit', 'update']),
            new Middleware('checkPermission:delete-position', only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $position = $this->position;
        if ($request->has('filter')) {
            $position->where('name', 'like', '%'.$request->input('filter').'%');
        }
        return view('position.index-position', [
            'positions' => $position->paginate(20)
        ]);
    }

    public function create()
    {
        return view('position.create-position');
    }

    public function store(StorePositionRequest $request)
    {
        $this->position->create($request->validated());
        return redirect()->route('position.create')->with('message', [
            'type' => 'success',
            'message' => 'Cargo criado'
        ]);
    }

    public function edit(string $id)
    {
        $position = $this->position->find($id);
        if (empty($position)) {
            return redirect()->route('position.index')->with('message', [
                'type' => 'danger',
                'message' => 'Cargo não encontrado'
            ]);
        }
        return view('position.edit-postion', [
            'position' => $position
        ]);
    }

    public function update(UpdatePositionRequest $request, string $id)
    {
        $position = $this->position->find($id);
        if (empty($position)) {
            return redirect()->route('position.index')->with('message', [
                'type' => 'danger',
                'message' => 'Cargo não encontrado'
            ]);
        }
        $position->update($request->validated());
        return redirect()->route('position.index')->with('message', [
            'type' => 'success',
            'message' => 'Cargo atualizado'
        ]);
    }

    public function destroy(string $id)
    {
        $position = $this->position->find($id);
        if (empty($position)) {
            return redirect()->route('position.index')->with('message', [
                'type' => 'danger',
                'message' => 'Cargo não encontrado'
            ]);
        }
        $position->delete();
        return redirect()->route('position.index')->with('message', [
            'type' => 'success',
            'message' => 'Cargo removido'
        ]);
    }
}
