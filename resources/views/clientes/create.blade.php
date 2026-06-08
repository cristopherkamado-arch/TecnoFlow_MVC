@extends('layouts.app')

@section('title', 'Nuevo Cliente')

@section('content')

{{-- Encabezado --}}
<div class="d-flex align-items-center gap-2 mb-1">
    <div class="metric-icon" style="background-color: #EBF3FF;">
        <i class="fa-solid fa-users" style="color: #0D6EFD;"></i>
    </div>
    <h5 class="mb-0" style="font-weight: 500; color: #343A40;">Nuevo Cliente</h5>
</div>
<p class="text-muted mb-4" style="font-size: 0.88rem;">
    Complete el formulario para registrar un nuevo cliente.
</p>

{{-- Formulario --}}
<div class="table-card">

    {{-- Título de la tarjeta --}}
    <div class="d-flex align-items-center justify-content-between mb-1">
        <div>
            <h6 class="mb-0" style="font-weight: 500; color: #343A40;">Información del Cliente</h6>
            <small class="text-muted">Los campos marcados son obligatorios</small>
        </div>
        <button type="button" class="btn btn-sm btn-light text-primary" onclick="resetForm()">
            Registro Nuevo
        </button>
    </div>
    <hr>

    <form action="{{ route('clientes.store') }}" method="POST" id="clienteForm">
        @csrf

        {{-- Tipo de Cliente --}}
        <div class="mb-4">
            <label class="form-label fw-500">Tipo de Cliente</label>
            <div class="row g-2">
                <div class="col-6">
                    <button type="button" id="btnPersona"
                            class="btn w-100 btn-primary d-flex align-items-center justify-content-center gap-2"
                            onclick="seleccionarTipo('persona')">
                        <i class="fa-solid fa-user"></i> Persona Natural
                    </button>
                </div>
                <div class="col-6">
                    <button type="button" id="btnEmpresa"
                            class="btn w-100 btn-outline-secondary d-flex align-items-center justify-content-center gap-2"
                            onclick="seleccionarTipo('empresa')">
                        <i class="fa-solid fa-building"></i> Empresa
                    </button>
                </div>
            </div>
            <input type="hidden" name="tipo_cliente" id="tipo_cliente" value="persona">
            @error('tipo_cliente')
                <div class="text-danger mt-1" style="font-size: 0.85rem;">{{ $message }}</div>
            @enderror
        </div>

        {{-- DNI/RUC y Teléfono --}}
        <div class="row g-3 mb-3">

            {{-- DNI o RUC --}}
            <div class="col-12 col-md-6">
                <label class="form-label fw-500" id="labelCodigo">
                    <i class="fa-solid fa-address-card me-1" style="color: #0D6EFD;"></i> DNI
                </label>
                <input type="text" name="codigo" id="codigo"
                    class="form-control @error('codigo') is-invalid @enderror"
                    placeholder="Ej: 12345678"
                    value="{{ old('codigo') }}">
                @error('codigo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Teléfono --}}
            <div class="col-12 col-md-6">
                <label class="form-label fw-500">
                    <i class="fa-solid fa-phone me-1" style="color: #0D6EFD;"></i> Teléfono
                </label>
                <input type="text" name="telefono"
                    class="form-control @error('telefono') is-invalid @enderror"
                    placeholder="Ej: +51 987 654 321"
                    value="{{ old('telefono') }}">
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        {{-- Nombre Completo --}}
        <div class="mb-3">
            <label class="form-label fw-500">
                <i class="fa-solid fa-user me-1" style="color: #0D6EFD;"></i> Nombre Completo
            </label>
            <input type="text" name="nombre"
                class="form-control @error('nombre') is-invalid @enderror"
                placeholder="Ej: Juan Carlos Pérez García"
                value="{{ old('nombre') }}">
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Correo Electrónico y Dirección --}}
        <div class="row g-3 mb-4">

            {{-- Email --}}
            <div class="col-12 col-md-6">
                <label class="form-label fw-500">
                    <i class="fa-solid fa-envelope me-1" style="color: #0D6EFD;"></i> Correo Electrónico
                </label>
                <input type="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Ej: contacto@empresa.com"
                    value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Dirección --}}
            <div class="col-12 col-md-6">
                <label class="form-label fw-500">
                    <i class="fa-solid fa-location-dot me-1" style="color: #0D6EFD;"></i> Dirección
                </label>
                <input type="text" name="direccion"
                    class="form-control @error('direccion') is-invalid @enderror"
                    placeholder="Ej: Av. Javier Prado 1234, Lima"
                    value="{{ old('direccion') }}">
                @error('direccion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        {{-- Botones --}}
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary d-flex align-items-center gap-2">
                <i class="fa-solid fa-xmark"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Guardar Cliente
            </button>
        </div>

    </form>
</div>

{{-- Script para manejo de tipo de cliente --}}
<script>
    function seleccionarTipo(tipo) {
        document.getElementById('tipo_cliente').value = tipo;

        if (tipo === 'persona') {
            document.getElementById('btnPersona').classList.remove('btn-outline-secondary');
            document.getElementById('btnPersona').classList.add('btn-primary');
            document.getElementById('btnEmpresa').classList.remove('btn-primary');
            document.getElementById('btnEmpresa').classList.add('btn-outline-secondary');
            document.getElementById('labelCodigo').innerHTML = '<i class="fa-solid fa-address-card me-1" style="color: #0D6EFD;"></i> DNI';
            document.getElementById('codigo').placeholder = 'Ej: 12345678';
        } else {
            document.getElementById('btnEmpresa').classList.remove('btn-outline-secondary');
            document.getElementById('btnEmpresa').classList.add('btn-primary');
            document.getElementById('btnPersona').classList.remove('btn-primary');
            document.getElementById('btnPersona').classList.add('btn-outline-secondary');
            document.getElementById('labelCodigo').innerHTML = '<i class="fa-solid fa-address-card me-1" style="color: #0D6EFD;"></i> RUC';
            document.getElementById('codigo').placeholder = 'Ej: 20512345678';
        }
    }

    function resetForm() {
        document.getElementById('clienteForm').reset();
        seleccionarTipo('persona');
    }
</script>

@endsection