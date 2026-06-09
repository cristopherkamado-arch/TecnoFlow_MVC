@extends('layouts.app')

@section('title', 'Nuevo Usuario')

@section('content')

{{-- Encabezado --}}
<div class="d-flex align-items-center gap-2 mb-1">
    <div class="metric-icon" style="background-color: #EBF3FF;">
        <i class="fa-solid fa-user-gear" style="color: #0D6EFD;"></i>
    </div>
    <h5 class="mb-0" style="font-weight: 500; color: #343A40;">Nuevo Usuario</h5>
</div>
<p class="text-muted mb-4" style="font-size: 0.88rem;">
    Complete el formulario para registrar un nuevo usuario en el sistema.
</p>

{{-- Formulario --}}
<div class="table-card">

    {{-- Título de la tarjeta --}}
    <div class="mb-1">
        <h6 class="mb-0" style="font-weight: 500; color: #343A40;">Información del Usuario</h6>
        <small class="text-muted">Los campos marcados son obligatorios</small>
    </div>
    <hr>

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf

        {{-- Nombre completo --}}
        <div class="mb-3">
            <label class="form-label fw-500">
                <i class="fa-solid fa-user me-1" style="color: #0D6EFD;"></i> Nombre Completo
            </label>
            <input type="text" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Ej: Juan Carlos Pérez"
                   value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email y Rol --}}
        <div class="row g-3 mb-3">

            {{-- Email --}}
            <div class="col-12 col-md-6">
                <label class="form-label fw-500">
                    <i class="fa-solid fa-envelope me-1" style="color: #0D6EFD;"></i> Correo Electrónico
                </label>
                <input type="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="Ej: usuario@tecnoflow.com"
                       value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Rol --}}
            <div class="col-12 col-md-6">
                <label class="form-label fw-500">
                    <i class="fa-solid fa-shield me-1" style="color: #0D6EFD;"></i> Rol
                </label>
                <select name="role"
                        class="form-select @error('role') is-invalid @enderror">
                    <option value="">Seleccione un rol</option>
                    <option value="employee" {{ old('role') === 'employee' ? 'selected' : '' }}>
                        Empleado
                    </option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                        Administrador
                    </option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        {{-- Contraseña y Confirmar contraseña --}}
        <div class="row g-3 mb-4">

            {{-- Contraseña --}}
            <div class="col-12 col-md-6">
                <label class="form-label fw-500">
                    <i class="fa-solid fa-lock me-1" style="color: #0D6EFD;"></i> Contraseña
                </label>
                <input type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Mínimo 8 caracteres">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirmar contraseña --}}
            <div class="col-12 col-md-6">
                <label class="form-label fw-500">
                    <i class="fa-solid fa-lock me-1" style="color: #0D6EFD;"></i> Confirmar Contraseña
                </label>
                <input type="password" name="password_confirmation"
                       class="form-control"
                       placeholder="Repita la contraseña">
            </div>

        </div>

        {{-- Botones --}}
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary d-flex align-items-center gap-2">
                <i class="fa-solid fa-xmark"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Guardar Usuario
            </button>
        </div>

    </form>
</div>

@endsection