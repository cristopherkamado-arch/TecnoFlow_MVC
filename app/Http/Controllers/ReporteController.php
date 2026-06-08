<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index()
    {
        return view('reportes');
    }

    public function clientes()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $pdf = Pdf::loadView('pdf.reporte_clientes', compact('clientes'));
        $pdf->setPaper('A4', 'landscape');
        $nombre = 'reporte_clientes_' . now()->format('Y_m_d_H_i_s') . '.pdf';
        return $pdf->download($nombre);
    }

    public function proyectos()
    {
        $proyectos = Proyecto::with('cliente')->orderBy('nombre')->get();
        $pdf = Pdf::loadView('pdf.reporte_proyectos', compact('proyectos'));
        $pdf->setPaper('A4', 'landscape');
        $nombre = 'reporte_proyectos_' . now()->format('Y_m_d_H_i_s') . '.pdf';
        return $pdf->download($nombre);
    }
}
