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
    Route::get('/reportes', [App\Http\Controllers\ReporteController::class, 'index'])->name('reportes');
    
    // Reportes PDF
    Route::get('/reportes/clientes', [App\Http\Controllers\ReporteController::class, 'clientes'])->name('reportes.clientes');
    Route::get('/reportes/proyectos', [App\Http\Controllers\ReporteController::class, 'proyectos'])->name('reportes.proyectos');

    // Usuarios
    Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store');
    Route::delete('/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuarios.destroy');
});
