@extends('layouts.app')

@section('title', 'Panel de control')

@section('content')

{{-- Tarjetas de métricas --}}
<div class="row g-3 mb-4">

    {{-- Total de Clientes --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="metric-label">Total de Clientes</p>
                    <p class="metric-value">{{ $totalClientes }}</p>
                    <p class="metric-trend text-success">
                        <i class="fa-solid fa-arrow-trend-up me-1"></i>+{{ $clientesEsteMes }} este mes
                    </p>
                </div>
                <div class="metric-icon" style="background-color: #EBF3FF;">
                    <i class="fa-solid fa-users" style="color: #0D6EFD;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Total de Proyectos --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="metric-label">Total de Proyectos</p>
                    <p class="metric-value">{{ $totalProyectos }}</p>
                    <p class="metric-trend text-success">
                        <i class="fa-solid fa-arrow-trend-up me-1"></i>+{{ $proyectosEsteMes }} este mes
                    </p>
                </div>
                <div class="metric-icon" style="background-color: #E8F5E9;">
                    <i class="fa-solid fa-folder-open" style="color: #2E7D32;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Proyectos en Progreso --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="metric-label">Proyectos en Progreso</p>
                    <p class="metric-value">{{ $proyectosEnProgreso }}</p>
                    <p class="metric-trend text-danger">
                        <i class="fa-solid fa-arrow-trend-down me-1"></i>-3% vs mes anterior
                    </p>
                </div>
                <div class="metric-icon" style="background-color: #FFF8E1;">
                    <i class="fa-solid fa-clock" style="color: #F9A825;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Proyectos Completados --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="metric-label">Proyectos Completados</p>
                    <p class="metric-value">{{ $proyectosCompletados }}</p>
                    <p class="metric-trend text-success">
                        <i class="fa-solid fa-arrow-trend-up me-1"></i>+{{ $completadosEsteMes }} este mes
                    </p>
                </div>
                <div class="metric-icon" style="background-color: #E8F5E9;">
                    <i class="fa-solid fa-circle-check" style="color: #2E7D32;"></i>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Sección principal: Proyectos recientes + Últimos clientes --}}
<div class="row g-3">

    {{-- Proyectos recientes --}}
    <div class="col-12 col-xl-8">
        <div class="table-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h6 class="mb-0" style="font-weight: 500; color: #343A40;">Proyectos recientes</h6>
                    <small class="text-muted">Últimas actualizaciones</small>
                </div>
                <a href="{{ route('proyectos.index') }}"
                    style="font-size: 0.85rem; color: #0D6EFD; text-decoration: none;">Ver todos →
                </a>
            </div>
            <table class="table table-borderless mb-0">
                <thead>
                    <tr>
                        <th>Proyecto</th>
                        <th>Cliente</th>
                        <th>Estado</th>
                        <th>Entrega</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($proyectosRecientes as $proyecto)
                    <tr>
                        <td>{{ $proyecto->nombre }}</td>
                        <td>{{ $proyecto->cliente->nombre }}</td>
                        <td>
                            @if($proyecto->estado === 'pendiente')
                                <span class="badge-pendiente">Pendiente</span>
                            @elseif($proyecto->estado === 'en progreso')
                                <span class="badge-progreso">En Progreso</span>
                            @else
                                <span class="badge-completado">Completado</span>
                            @endif
                        </td>
                        <td>{{ $proyecto->fecha_fin ? \Carbon\Carbon::parse($proyecto->fecha_fin)->format('d M Y') : '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">
                            <i class="fa-solid fa-folder-open me-2"></i>No hay proyectos registrados aún.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Últimos clientes --}}
    <div class="col-12 col-xl-4">
        <div class="table-card h-100">
            <div class="mb-3">
                <h6 class="mb-0" style="font-weight: 500; color: #343A40;">Últimos clientes</h6>
                <small class="text-muted">Registros recientes</small>
            </div>
            <div class="d-flex flex-column gap-3">
                @forelse($ultimosClientes as $cliente)
                @php
                    $colores = ['#0D6EFD', '#2E7D32', '#F9A825', '#D32F2F'];
                    $color = $colores[$loop->index % 4];
                    $bgBadge = $cliente->tipo_cliente === 'persona' ? 'background-color: #CFE2FF; color: #084298;' : 'background-color: #D1E7DD; color: #0A3622;';
                    $labelTipo = $cliente->tipo_cliente === 'persona' ? 'Persona' : 'Empresa';
                @endphp
                <div class="d-flex align-items-center gap-3">
                    <div class="client-avatar avatar-color-{{ $loop->index % 4 }}">
                        {{ strtoupper(substr($cliente->nombre, 0, 2)) }}
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-0 client-name">
                            {{ $cliente->nombre }}
                        </p>
                        <span class="badge-tipo {{ $cliente->tipo_cliente === 'persona' ? 'badge-persona' : 'badge-empresa' }}">
                            {{ $labelTipo }}
                        </span>
                    </div>
                    <small class="text-muted">
                        {{ \Carbon\Carbon::parse($cliente->created_at)->format('d M') }}
                    </small>
                </div>
                @empty
                <p class="text-center text-muted py-3">
                    <i class="fa-solid fa-users me-2"></i>No hay clientes registrados aún.
                </p>
                @endforelse
            </div>
        </div>
    </div>

</div>

@endsection