@extends('layouts.app')

@section('title', 'Detalle del Cliente')

@section('content')

{{-- Encabezado --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-2">
        <div class="metric-icon" style="background-color: #EBF3FF;">
            <i class="fa-solid fa-users" style="color: #0D6EFD;"></i>
        </div>
        <h5 class="mb-0" style="font-weight: 500; color: #343A40;">Detalle del Cliente</h5>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('clientes.edit', $cliente->id) }}"
            class="btn btn-warning d-flex align-items-center gap-2">
            <i class="fa-solid fa-pen-to-square"></i> Editar
        </a>
        <a href="{{ route('clientes.index') }}"
            class="btn btn-secondary d-flex align-items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Volver
        </a>
    </div>
</div>

{{-- Tarjeta: Información del Cliente --}}
<div class="table-card mb-4">
    <div class="row g-4">

        {{-- Tipo de Cliente --}}
        <div class="col-12 col-md-6">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-tag me-1" style="color: #0D6EFD;"></i> Tipo de Cliente
            </p>
            @if($cliente->tipo_cliente === 'persona')
                <span class="badge bg-primary">Persona Natural</span>
            @else
                <span class="badge bg-warning text-dark">Empresa</span>
            @endif
        </div>

        {{-- Código DNI o RUC --}}
        <div class="col-12 col-md-6">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-address-card me-1" style="color: #0D6EFD;"></i> Código
            </p>
            <p class="mb-0" style="font-weight: 500; color: #343A40;">
                {{ $cliente->tipo_cliente === 'persona' ? 'DNI' : 'RUC' }} {{ $cliente->codigo }}
            </p>
        </div>

        {{-- Nombre Completo o Razón Social --}}
        <div class="col-12 col-md-6">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-user me-1" style="color: #0D6EFD;"></i>
                {{ $cliente->tipo_cliente === 'persona' ? 'Nombre Completo' : 'Razón Social' }}
            </p>
            <p class="mb-0" style="font-weight: 500; color: #343A40;">
                {{ $cliente->nombre }}
            </p>
        </div>

        {{-- Correo Electrónico --}}
        <div class="col-12 col-md-6">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-envelope me-1" style="color: #0D6EFD;"></i> Correo Electrónico
            </p>
            <p class="mb-0" style="font-weight: 500; color: #343A40;">
                {{ $cliente->email }}
            </p>
        </div>

        {{-- Teléfono --}}
        <div class="col-12 col-md-6">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-phone me-1" style="color: #0D6EFD;"></i> Teléfono
            </p>
            <p class="mb-0" style="font-weight: 500; color: #343A40;">
                {{ $cliente->telefono ?? '—' }}
            </p>
        </div>

        {{-- Dirección --}}
        <div class="col-12 col-md-6">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-location-dot me-1" style="color: #0D6EFD;"></i> Dirección
            </p>
            <p class="mb-0" style="font-weight: 500; color: #343A40;">
                {{ $cliente->direccion ?? '—' }}
            </p>
        </div>

    </div>
</div>

{{-- Tarjeta: Proyectos Asociados --}}
<div class="table-card">
    <div class="d-flex align-items-center gap-2 mb-3">
        <i class="fa-solid fa-folder-open" style="color: #0D6EFD;"></i>
        <h6 class="mb-0" style="font-weight: 500; color: #343A40;">Proyectos Asociados</h6>
    </div>
    <hr class="mt-0">

    <table class="table table-borderless mb-0">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Fecha Inicio</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cliente->proyectos as $proyecto)
            <tr>
                <td>{{ $proyecto->nombre }}</td>
                <td>
                    @if($proyecto->estado === 'pendiente')
                        <span class="badge bg-warning text-dark">Pendiente</span>
                    @elseif($proyecto->estado === 'en progreso')
                        <span class="badge bg-primary">En Progreso</span>
                    @else
                        <span class="badge bg-success">Completado</span>
                    @endif
                </td>
                <td>
                    <i class="fa-solid fa-calendar me-1" style="color: #0D6EFD;"></i>
                    {{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('d/m/Y') }}
                </td>
                <td class="text-center">
                    <a href="{{ route('proyectos.show', $proyecto->id) }}"
                        class="btn btn-primary btn-sm">
                        Ver Detalles
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted py-4">
                    <i class="fa-solid fa-folder-open me-2"></i>Este cliente no tiene proyectos asociados aún.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection