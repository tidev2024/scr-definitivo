<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::resource('login', LoginController::class)->only(['index', 'store']);
Route::delete('/logout', [LoginController::class, 'destroy'])->name('logout');
