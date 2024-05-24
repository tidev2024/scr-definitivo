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
        return redirect()->route('login.store')->with('message', [
            'type' => 'danger',
            'message' => 'Email ou senha incorretos'
        ]);
    }

    public function destroy()
    {
        session()->flush();
        return redirect()->route('home');
    }
}
