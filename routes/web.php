<?php

use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserReporteController;
use App\Models\User;
use Spatie\Permission\Models\Permission;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:web',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/mantenimiento-roles', function () {
        return Inertia::render('Roles', [
            'roles' => Role::with('permissions')->get()
        ]);
    })->name('roles');

    Route::get('/mantenimiento-usuarios', function () {
        return Inertia::render('Usuarios',[
            'users' => User::with('roles')->get()
        ]);
    })->name('usuarios');

    Route::resource('roles', RoleController::class);
    Route::resource('usuario', UserController::class);

    Route::get('/reporte-formulario', [UserReporteController::class, 'index']);


});
