<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controllers\HasMiddleware;

class HomeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'userIsAuthenticate',
        ];
    }

    public function index()
    {
        return view('home');
    }
}
