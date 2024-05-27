<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::resource('login', LoginController::class)->only(['index', 'store']);
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::resource('empresas', CompanyController::class)
->except(['show', 'edit'])
->parameters(['empresas' => 'company'])
->names([
    'index' => 'company.index',
    'create' => 'company.create',
    'store' => 'company.store',
    'update' => 'company.update',
    'destroy' => 'company.destroy'
])->where(['company' => '[0-9]+']);
