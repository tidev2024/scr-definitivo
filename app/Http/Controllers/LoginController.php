<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(
        private User $user
    ) {}

    public function index()
    {
        if (!empty(session('user'))) {
            return redirect()->route('home');
        }
        return view('login');
    }

    public function store(LoginStoreRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $user = $this->user->select([
                'id', 'name', 'email', 'company_id', 'department_id', 'position_id'
            ])->where('email', '=', $request->email)->first()->toArray();
            session(['user' => $user]);
            return redirect()->route('home');
        }
        return redirect()->route('login.index')->with('message', [
            'type' => 'danger',
            'message' => 'Email e/ou senha incorretos!'
        ]);
    }

    public function destroy()
    {
        session()->forget('user');
        return redirect()->route('login.index');
    }
}
