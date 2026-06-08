@extends('layouts.app')

@section('title', 'Detalle del Proyecto')

@section('content')

{{-- Encabezado --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-2">
        <div class="metric-icon" style="background-color: #EBF3FF;">
            <i class="fa-solid fa-folder-open" style="color: #0D6EFD;"></i>
        </div>
        <h5 class="mb-0" style="font-weight: 500; color: #343A40;">Detalle del Proyecto</h5>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('proyectos.edit', $proyecto->id) }}"
            class="btn btn-warning d-flex align-items-center gap-2">
            <i class="fa-solid fa-pen-to-square"></i> Editar
        </a>
        <a href="{{ route('proyectos.index') }}"
            class="btn btn-secondary d-flex align-items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Volver
        </a>
    </div>
</div>

{{-- Tarjeta: Información del Proyecto --}}
<div class="table-card mb-4">
    <h6 class="mb-3" style="font-weight: 500; color: #343A40;">
        Información del Proyecto
    </h6>
    <hr class="mt-0">

    <div class="row g-4">

        {{-- Nombre del Proyecto --}}
        <div class="col-12 col-md-6">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-folder me-1" style="color: #0D6EFD;"></i> Nombre del Proyecto
            </p>
            <p class="mb-0" style="font-weight: 500; color: #343A40;">
                {{ $proyecto->nombre }}
            </p>
        </div>

        {{-- Estado --}}
        <div class="col-12 col-md-6">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-circle-check me-1" style="color: #0D6EFD;"></i> Estado
            </p>
            @if($proyecto->estado === 'pendiente')
                <span class="badge bg-warning text-dark">Pendiente</span>
            @elseif($proyecto->estado === 'en progreso')
                <span class="badge bg-primary">En Progreso</span>
            @else
                <span class="badge bg-success">Completado</span>
            @endif
        </div>

        {{-- Descripción --}}
        <div class="col-12">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-file-lines me-1" style="color: #0D6EFD;"></i> Descripción
            </p>
            <p class="mb-0" style="color: #343A40;">
                {{ $proyecto->descripcion ?? '—' }}
            </p>
        </div>

        {{-- Fecha de Inicio --}}
        <div class="col-12 col-md-6">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-calendar me-1" style="color: #0D6EFD;"></i> Fecha de Inicio
            </p>
            <p class="mb-0" style="font-weight: 500; color: #343A40;">
                {{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->translatedFormat('d \d\e F, Y') }}
            </p>
        </div>

        {{-- Fecha de Fin --}}
        <div class="col-12 col-md-6">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-calendar-check me-1" style="color: #0D6EFD;"></i> Fecha de Fin
            </p>
            <p class="mb-0" style="font-weight: 500; color: #343A40;">
                {{ $proyecto->fecha_fin ? \Carbon\Carbon::parse($proyecto->fecha_fin)->translatedFormat('d \d\e F, Y') : '—' }}
            </p>
        </div>

    </div>
</div>

{{-- Tarjeta: Cliente Asociado --}}
<div class="table-card">
    <h6 class="mb-3" style="font-weight: 500; color: #343A40;">
        Cliente Asociado
    </h6>
    <hr class="mt-0">

    <div class="row g-4">

        {{-- Nombre del Cliente --}}
        <div class="col-12 col-md-6">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-user me-1" style="color: #0D6EFD;"></i> Nombre del Cliente
            </p>
            <p class="mb-0" style="font-weight: 500; color: #343A40;">
                {{ $proyecto->cliente->nombre }}
            </p>
        </div>

        {{-- Tipo de Cliente --}}
        <div class="col-12 col-md-6">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-id-card me-1" style="color: #0D6EFD;"></i> Tipo de Cliente
            </p>
            @if($proyecto->cliente->tipo_cliente === 'persona')
                <span class="badge bg-primary">Persona</span>
            @else
                <span class="badge bg-success">Empresa</span>
            @endif
        </div>

        {{-- DNI o RUC --}}
        <div class="col-12 col-md-6">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-address-card me-1" style="color: #0D6EFD;"></i>
                {{ $proyecto->cliente->tipo_cliente === 'persona' ? 'DNI' : 'RUC' }}
            </p>
            <p class="mb-0" style="font-weight: 500; color: #343A40;">
                {{ $proyecto->cliente->codigo }}
            </p>
        </div>

        {{-- Email --}}
        <div class="col-12 col-md-6">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-envelope me-1" style="color: #0D6EFD;"></i> Email
            </p>
            <p class="mb-0" style="font-weight: 500; color: #343A40;">
                {{ $proyecto->cliente->email }}
            </p>
        </div>

        {{-- Teléfono --}}
        <div class="col-12 col-md-6">
            <p class="mb-1" style="font-size: 0.8rem; color: #6C757D;">
                <i class="fa-solid fa-phone me-1" style="color: #0D6EFD;"></i> Teléfono
            </p>
            <p class="mb-0" style="font-weight: 500; color: #343A40;">
                {{ $proyecto->cliente->telefono ?? '—' }}
            </p>
        </div>

    </div>
</div>

@endsection