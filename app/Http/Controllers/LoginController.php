<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginStoreRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('userIsAuthenticate', only: ['destroy']),
        ];
    }

    public function index()
    {
        if (Auth::user()) {
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
