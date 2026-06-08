@extends('layouts.app')

@section('title', 'Gestión de Clientes')

@section('content')

{{-- Encabezado --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-2">
        <div class="metric-icon" style="background-color: #EBF3FF;">
            <i class="fa-solid fa-users" style="color: #0D6EFD;"></i>
        </div>
        <div>
            <h5 class="mb-0" style="font-weight: 500; color: #343A40;">Gestión de Clientes</h5>
            <small class="text-muted">Administra el directorio de clientes de TecnoSoluciones S.A.</small>
        </div>
    </div>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="fa-solid fa-plus"></i> Nuevo Cliente
    </a>
</div>

{{-- Tarjetas de métricas --}}
<div class="row g-3 mb-4">

    {{-- Total Clientes --}}
    <div class="col-12 col-sm-4">
        <div class="metric-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="metric-label">Total Clientes</p>
                    <p class="metric-value">{{ $totalClientes }}</p>
                </div>
                <div class="metric-icon" style="background-color: #EBF3FF;">
                    <i class="fa-solid fa-users" style="color: #0D6EFD;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Empresas --}}
    <div class="col-12 col-sm-4">
        <div class="metric-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="metric-label">Empresas</p>
                    <p class="metric-value">{{ $totalEmpresas }}</p>
                </div>
                <div class="metric-icon" style="background-color: #FFF3CD;">
                    <i class="fa-solid fa-building" style="color: #F9A825;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Personas Naturales --}}
    <div class="col-12 col-sm-4">
        <div class="metric-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="metric-label">P. Naturales</p>
                    <p class="metric-value">{{ $totalPersonas }}</p>
                </div>
                <div class="metric-icon" style="background-color: #E0F7FA;">
                    <i class="fa-solid fa-user-circle" style="color: #0097A7;"></i>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Tabla de clientes --}}
<div class="table-card">

    {{-- Barra de búsqueda --}}
    <div class="mb-4">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
                <i class="fa-solid fa-magnifying-glass text-muted"></i>
            </span>
            <input type="text" id="buscador" class="form-control border-start-0"
                placeholder="Buscar por nombre, código, tipo o email...">
        </div>
    </div>

    {{-- Tabla --}}
    <table class="table table-borderless mb-0" id="tablaClientes">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>
                    @if($cliente->tipo_cliente === 'empresa')
                        <span class="badge" style="background-color: #FFF3CD; color: #856404;">
                            <i class="fa-solid fa-building me-1"></i> Empresa
                        </span>
                    @else
                        <span class="badge" style="background-color: #E0F7FA; color: #0097A7;">
                            <i class="fa-solid fa-user me-1"></i> P. Natural
                        </span>
                    @endif
                </td>
                <td>{{ $cliente->codigo }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td><small class="text-muted">{{ $cliente->email }}</small></td>
                <td>{{ $cliente->telefono ?? '—' }}</td>
                <td class="text-center">
                    <a href="{{ route('clientes.show', $cliente->id) }}"
                        class="btn btn-info btn-sm me-1">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="{{ route('clientes.edit', $cliente->id) }}"
                        class="btn btn-warning btn-sm me-1">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    <form action="{{ route('clientes.destroy', $cliente->id) }}"
                        method="POST" class="d-inline"
                        onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    <i class="fa-solid fa-users me-2"></i>No hay clientes registrados aún.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Paginación --}}
    <div class="d-flex align-items-center justify-content-between mt-3">
        <small class="text-muted">
            Mostrando {{ $clientes->firstItem() ?? 0 }} a {{ $clientes->lastItem() ?? 0 }}
            de {{ $clientes->total() }} clientes
        </small>
        <div>
            {{ $clientes->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>

{{-- Script de búsqueda en tiempo real --}}
<script>
    const buscador = document.getElementById('buscador');
    const filas = document.querySelectorAll('#tablaClientes tbody tr');

    buscador.addEventListener('input', function() {
        const texto = this.value.toLowerCase();

        filas.forEach(fila => {
            const tipo    = fila.cells[1]?.textContent.toLowerCase() ?? '';
            const codigo  = fila.cells[2]?.textContent.toLowerCase() ?? '';
            const nombre  = fila.cells[3]?.textContent.toLowerCase() ?? '';
            const email   = fila.cells[4]?.textContent.toLowerCase() ?? '';

            const coincide = tipo.includes(texto) ||
                            codigo.includes(texto) ||
                            nombre.includes(texto) ||
                            email.includes(texto);

            fila.style.display = coincide ? '' : 'none';
        });
    });
</script>

@endsection