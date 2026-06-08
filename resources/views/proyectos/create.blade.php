@extends('layouts.app')

@section('title', 'Nuevo Proyecto')

@section('content')

{{-- Encabezado --}}
<div class="d-flex align-items-center gap-2 mb-1">
    <div class="metric-icon" style="background-color: #EBF3FF;">
        <i class="fa-solid fa-folder-open" style="color: #0D6EFD;"></i>
    </div>
    <h5 class="mb-0" style="font-weight: 500; color: #343A40;">Nuevo Proyecto</h5>
</div>
<p class="text-muted mb-4" style="font-size: 0.88rem;">
    Complete el formulario para crear un nuevo proyecto en el sistema.
</p>

{{-- Formulario --}}
<div class="table-card">
    <form action="{{ route('proyectos.store') }}" method="POST">
        @csrf

        {{-- Nombre del Proyecto --}}
        <div class="mb-4">
            <label class="form-label fw-500">
                <i class="fa-solid fa-folder me-1" style="color: #0D6EFD;"></i> Nombre del Proyecto
            </label>
            <input type="text" name="nombre"
                class="form-control @error('nombre') is-invalid @enderror"
                placeholder="Ingrese el nombre del proyecto"
                value="{{ old('nombre') }}">
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Descripción --}}
        <div class="mb-4">
            <label class="form-label fw-500">
                <i class="fa-solid fa-file-lines me-1" style="color: #0D6EFD;"></i> Descripción
            </label>
            <textarea name="descripcion" rows="4"
                class="form-control @error('descripcion') is-invalid @enderror"
                placeholder="Describa los objetivos y alcance del proyecto">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Estado y Cliente Asociado --}}
        <div class="row g-3 mb-4">

            {{-- Estado --}}
            <div class="col-12 col-md-6">
                <label class="form-label fw-500">
                    <i class="fa-solid fa-circle-check me-1" style="color: #0D6EFD;"></i> Estado
                </label>
                <select name="estado"
                        class="form-select @error('estado') is-invalid @enderror">
                    <option value="">Seleccione un estado</option>
                    <option value="pendiente" {{ old('estado') === 'pendiente' ? 'selected' : '' }}>
                        Pendiente
                    </option>
                    <option value="en progreso" {{ old('estado') === 'en progreso' ? 'selected' : '' }}>
                        En Progreso
                    </option>
                    <option value="completado" {{ old('estado') === 'completado' ? 'selected' : '' }}>
                        Completado
                    </option>
                </select>
                @error('estado')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Cliente Asociado --}}
            <div class="col-12 col-md-6">
                <label class="form-label fw-500">
                    <i class="fa-solid fa-user me-1" style="color: #0D6EFD;"></i> Cliente Asociado
                </label>
                <select name="cliente_id"
                        class="form-select @error('cliente_id') is-invalid @enderror">
                    <option value="">Seleccione un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}"
                            {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('cliente_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        {{-- Fecha de Inicio y Fecha de Fin --}}
        <div class="row g-3 mb-4">

            {{-- Fecha de Inicio --}}
            <div class="col-12 col-md-6">
                <label class="form-label fw-500">
                    <i class="fa-solid fa-calendar me-1" style="color: #0D6EFD;"></i> Fecha de Inicio
                </label>
                <input type="date" name="fecha_inicio"
                        class="form-control @error('fecha_inicio') is-invalid @enderror"
                        value="{{ old('fecha_inicio') }}">
                @error('fecha_inicio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Fecha de Fin --}}
            <div class="col-12 col-md-6">
                <label class="form-label fw-500">
                    <i class="fa-solid fa-calendar-check me-1" style="color: #0D6EFD;"></i> Fecha de Fin
                </label>
                <input type="date" name="fecha_fin"
                        class="form-control @error('fecha_fin') is-invalid @enderror"
                        value="{{ old('fecha_fin') }}">
                @error('fecha_fin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        {{-- Botones --}}
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('proyectos.index') }}" class="btn btn-secondary d-flex align-items-center gap-2">
                <i class="fa-solid fa-xmark"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Guardar
            </button>
        </div>

    </form>
</div>

@endsection