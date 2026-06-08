<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Métricas principales
        $totalClientes        = Cliente::count();
        $totalProyectos       = Proyecto::count();
        $proyectosEnProgreso  = Proyecto::where('estado', 'en progreso')->count();
        $proyectosCompletados = Proyecto::where('estado', 'completado')->count();

        // Clientes e proyectos registrados este mes
        $clientesEsteMes     = Cliente::whereMonth('created_at', now()->month)
                                        ->whereYear('created_at', now()->year)
                                        ->count();
        $proyectosEsteMes    = Proyecto::whereMonth('created_at', now()->month)
                                        ->whereYear('created_at', now()->year)
                                        ->count();
        $completadosEsteMes  = Proyecto::where('estado', 'completado')
                                        ->whereMonth('updated_at', now()->month)
                                        ->whereYear('updated_at', now()->year)
                                        ->count();

        // Últimos 4 proyectos registrados con su cliente
        $proyectosRecientes  = Proyecto::with('cliente')
                                        ->latest()
                                        ->take(4)
                                        ->get();

        // Últimos 4 clientes registrados
        $ultimosClientes     = Cliente::latest()
                                        ->take(4)
                                        ->get();

        return view('dashboard', compact(
            'totalClientes',
            'totalProyectos',
            'proyectosEnProgreso',
            'proyectosCompletados',
            'clientesEsteMes',
            'proyectosEsteMes',
            'completadosEsteMes',
            'proyectosRecientes',
            'ultimosClientes'
        ));
    }
}
