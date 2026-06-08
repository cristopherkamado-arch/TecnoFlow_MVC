@extends('layouts.app')

@section('title', 'Reportes')

@section('content')

{{-- Encabezado --}}
<div class="d-flex align-items-center gap-2 mb-1">
    <div class="metric-icon" style="background-color: #EBF3FF;">
        <i class="fa-solid fa-file-lines" style="color: #0D6EFD;"></i>
    </div>
    <h5 class="mb-0" style="font-weight: 500; color: #343A40;">Reportes</h5>
</div>
<p class="text-muted mb-4" style="font-size: 0.88rem;">
    Genera y descarga los reportes del sistema en PDF.
</p>

{{-- Tarjetas de reportes --}}
<div class="row g-4">

    {{-- Reporte de Clientes --}}
    <div class="col-12 col-md-6">
        <div class="table-card h-100 d-flex flex-column align-items-center text-center">
            <div class="mb-3" style="width: 80px; height: 80px; background-color: #EBF3FF;
                border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-users" style="color: #0D6EFD; font-size: 2rem;"></i>
            </div>
            <h6 class="mb-2" style="font-weight: 500; color: #343A40;">Reporte de Clientes</h6>
            <p class="text-muted mb-4" style="font-size: 0.88rem;">
                Listado completo de clientes registrados con su tipo, código, contacto y dirección.
            </p>
            <div class="mt-auto w-100">
                <a href="{{ route('reportes.clientes') }}"
                    class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                    <i class="fa-solid fa-download"></i> Generar PDF
                </a>
            </div>
        </div>
    </div>

    {{-- Reporte de Proyectos --}}
    <div class="col-12 col-md-6">
        <div class="table-card h-100 d-flex flex-column align-items-center text-center">
            <div class="mb-3" style="width: 80px; height: 80px; background-color: #EBF3FF;
                border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-folder-open" style="color: #0D6EFD; font-size: 2rem;"></i>
            </div>
            <h6 class="mb-2" style="font-weight: 500; color: #343A40;">Reporte de Proyectos</h6>
            <p class="text-muted mb-4" style="font-size: 0.88rem;">
                Listado completo de proyectos con su estado, cliente asociado, fechas de inicio y entrega.
            </p>
            <div class="mt-auto w-100">
                <a href="{{ route('reportes.proyectos') }}"
                    class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                    <i class="fa-solid fa-download"></i> Generar PDF
                </a>
            </div>
        </div>
    </div>

</div>

@endsection