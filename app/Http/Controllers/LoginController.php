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
            return redirect()->route('home');
        }
        return redirect()->route('login.index')->with('message', [
            'type' => 'danger',
            'message' => 'Email e/ou senha incorretos!'
        ]);
    }

    public function destroy()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login.index');
    }
}
