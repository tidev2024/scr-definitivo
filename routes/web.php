<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InvoicingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PercentageDirectSalesCommissionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::resource('login', LoginController::class)->only(['index', 'store']);
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');

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

Route::get('/usuarios/{user}/resetar-senha', [UserController::class, 'resetPassword'])
->where(['user' => '[0-9]+'])->name('user.resetPassword');
Route::get('/usuarios/alterar-senha', [UserController::class, 'updatePassword'])
->name('user.updatePassword');
Route::post('/usuarios/alterar-senha', [UserController::class, 'storeUpdatedPassword'])
->name('user.storeUpdatedPassword');

Route::resource('percentual-comissao-vd', PercentageDirectSalesCommissionController::class)
->only(['index', 'create', 'store'])
->names([
    'index' => 'percentCommission.index',
    'create' => 'percentCommission.create',
    'store' => 'percentCommission.store'
]);

Route::get('/faturamento/upload-arquivo-b2b', [InvoicingController::class, 'uploadFileB2B'])
->name('invoicing.uploadFileB2B');

Route::post('/faturamento/upload-arquivo-b2b', [InvoicingController::class, 'processFileB2B'])
->name('invoicing.processFileB2B');

Route::fallback(function () {
    return redirect()->route('login.index');
});
