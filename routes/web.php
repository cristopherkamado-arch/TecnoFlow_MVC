<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProyectoController;

// Ruta principal → redirige al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación (no requieren login)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas (requieren login)
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // CRUD de Clientes
    Route::resource('clientes', ClienteController::class);

    // CRUD de Proyectos
    Route::resource('proyectos', ProyectoController::class);

    // Reportes
    Route::get('/reportes', function () {
        return view('reportes');
    })->name('reportes');

});
