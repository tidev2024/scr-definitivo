<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
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

Route::resource('departamentos', DepartmentController::class)
->except(['show'])
->parameters(['departamentos' => 'department'])
->names([
    'index' => 'department.index',
    'create' => 'department.create',
    'store' => 'department.store',
    'update' => 'department.update',
    'destroy' => 'department.destroy',
    'edit' => 'department.edit'
])->where(['department' => '[0-9]+']);

Route::resource('cargos', PositionController::class)
->except(['show'])
->parameters(['cargos' => 'position'])
->names([
    'index' => 'position.index',
    'create' => 'position.create',
    'store' => 'position.store',
    'update' => 'position.update',
    'destroy' => 'position.destroy',
    'edit' => 'position.edit'
])->where(['position' => '[0-9]+']);

Route::resource('usuarios', UserController::class)
->except(['show', 'destroy'])
->parameters(['usuarios' => 'user'])
->names([
    'index' => 'user.index',
    'create' => 'user.create',
    'store' => 'user.store',
    'update' => 'user.update',
    'edit' => 'user.edit'
])->where(['user' => '[0-9]+']);