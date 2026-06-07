@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-light p-2 rounded" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-file-pdf fs-5" style="color: #0066ff;"></i>
                </div>
                <div>
                    <h2 class="mb-0 fw-bold">Reportes</h2>
                    <p class="text-muted mb-0">Genera y descarga los reportes del sistema en PDF</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports Grid -->
    <div class="row g-4">
        <!-- Reporte de Clientes -->
        <div class="col-12 col-md-6">
            <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <div class="card-body text-center p-5">
                    <div class="mb-4" style="width: 100px; height: 100px; background: linear-gradient(135deg, rgba(0, 102, 255, 0.1) 0%, rgba(0, 102, 255, 0.05) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="fas fa-users fs-1" style="color: #0066ff;"></i>
                    </div>
                    <h5 class="card-title fw-bold mb-3">Reporte de Clientes</h5>
                    <p class="text-muted card-text mb-4">Listado completo de clientes registrados con su tipo, código, contacto y dirección.</p>
                    <a href="{{ route('reports.clients') }}" class="btn btn-primary w-100" style="background: linear-gradient(135deg, #0066ff 0%, #0052cc 100%); border: none; padding: 12px; font-weight: 600;">
                        <i class="fas fa-download me-2"></i>Generar PDF
                    </a>
                </div>
            </div>
        </div>

        <!-- Reporte de Proyectos -->
        <div class="col-12 col-md-6">
            <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <div class="card-body text-center p-5">
                    <div class="mb-4" style="width: 100px; height: 100px; background: linear-gradient(135deg, rgba(0, 102, 255, 0.1) 0%, rgba(0, 102, 255, 0.05) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="fas fa-folder fs-1" style="color: #0066ff;"></i>
                    </div>
                    <h5 class="card-title fw-bold mb-3">Reporte de Proyectos</h5>
                    <p class="text-muted card-text mb-4">Listado completo de proyectos con su estado, cliente asociado, fechas de inicio y entrega.</p>
                    <a href="{{ route('reports.projects') }}" class="btn btn-primary w-100" style="background: linear-gradient(135deg, #0066ff 0%, #0052cc 100%); border: none; padding: 12px; font-weight: 600;">
                        <i class="fas fa-download me-2"></i>Generar PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1) !important;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 102, 255, 0.3);
    }
</style>
@endsection
