<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct(
        private Position $position
    ) {}

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
