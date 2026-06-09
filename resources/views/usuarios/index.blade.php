@extends('layouts.app')

@section('title', 'Gestión de Usuarios')

@section('content')

{{-- Encabezado --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-2">
        <div class="metric-icon" style="background-color: #EBF3FF;">
            <i class="fa-solid fa-user-gear" style="color: #0D6EFD;"></i>
        </div>
        <div>
            <h5 class="mb-0" style="font-weight: 500; color: #343A40;">Gestión de Usuarios</h5>
            <small class="text-muted">Administra los usuarios del sistema.</small>
        </div>
    </div>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="fa-solid fa-plus"></i> Nuevo Usuario
    </a>
</div>

{{-- Tarjetas de métricas --}}
<div class="row g-3 mb-4">

    {{-- Total Usuarios --}}
    <div class="col-12 col-sm-4">
        <div class="metric-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="metric-label">Total Usuarios</p>
                    <p class="metric-value">{{ $totalUsuarios }}</p>
                </div>
                <div class="metric-icon" style="background-color: #EBF3FF;">
                    <i class="fa-solid fa-users" style="color: #0D6EFD;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Administradores --}}
    <div class="col-12 col-sm-4">
        <div class="metric-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="metric-label">Administradores</p>
                    <p class="metric-value">{{ $totalAdmins }}</p>
                </div>
                <div class="metric-icon" style="background-color: #F8D7DA;">
                    <i class="fa-solid fa-user-shield" style="color: #D32F2F;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Empleados --}}
    <div class="col-12 col-sm-4">
        <div class="metric-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="metric-label">Empleados</p>
                    <p class="metric-value">{{ $totalEmpleados }}</p>
                </div>
                <div class="metric-icon" style="background-color: #D1E7DD;">
                    <i class="fa-solid fa-user-tie" style="color: #2E7D32;"></i>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Tabla de usuarios --}}
<div class="table-card">

    {{-- Barra de búsqueda --}}
    <div class="mb-4">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
                <i class="fa-solid fa-magnifying-glass text-muted"></i>
            </span>
            <input type="text" id="buscador" class="form-control border-start-0"
                placeholder="Buscar por nombre o email...">
        </div>
    </div>

    {{-- Tabla --}}
    <table class="table table-borderless mb-0" id="tablaUsuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Registrado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div class="{{ $usuario->role === 'admin' ? 'avatar-admin' : 'avatar-empleado' }}">
                            {{ strtoupper(substr($usuario->name, 0, 2)) }}
                        </div>
                        {{ $usuario->name }}
                    </div>
                </td>
                <td><small class="text-muted">{{ $usuario->email }}</small></td>
                <td>
                    @if($usuario->role === 'admin')
                        <span class="badge bg-danger">Administrador</span>
                    @else
                        <span class="badge bg-success">Empleado</span>
                    @endif
                </td>
                <td>
                    <small class="text-muted">
                        {{ \Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y') }}
                    </small>
                </td>
                <td class="text-center">
                    @if($usuario->role !== 'admin' && $usuario->id !== Auth::id())
                        <button type="button"
                                class="btn btn-outline-danger btn-sm btn-eliminar"
                                data-id="{{ $usuario->id }}"
                                data-nombre="{{ $usuario->name }}"
                                data-tipo="usuario">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    @else
                        <span class="text-muted" style="font-size: 0.8rem;">—</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-4">
                    <i class="fa-solid fa-users me-2"></i>No hay usuarios registrados aún.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

{{-- Modal de confirmación de eliminación --}}
<div class="modal fade" id="modalEliminar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-body text-center p-4">
                <div class="mb-3" style="width: 60px; height: 60px; background-color: #FFEBEE;
                    border-radius: 50%; display: flex; align-items: center;
                    justify-content: center; margin: 0 auto;">
                    <i class="fa-solid fa-trash" style="color: #D32F2F; font-size: 1.5rem;"></i>
                </div>
                <h5 class="mb-1" style="font-weight: 500; color: #343A40;">
                    Confirmar eliminación
                </h5>
                <p class="text-muted mb-1" style="font-size: 0.88rem;">
                    ¿Estás seguro de que deseas eliminar este usuario?
                </p>
                <p class="mb-0" style="font-size: 0.88rem;">
                    <strong id="nombreEliminar"></strong>
                </p>
                <p class="text-muted mt-2" style="font-size: 0.8rem;">
                    Esta acción no se puede deshacer.
                </p>
            </div>
            <div class="modal-footer border-0 justify-content-center gap-2 pb-4">
                <button type="button" class="btn btn-secondary d-flex align-items-center gap-2"
                        data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i> Cancelar
                </button>
                <form id="formEliminar" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger d-flex align-items-center gap-2">
                        <i class="fa-solid fa-trash"></i> Sí, eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script de búsqueda y eliminación --}}
<script>
    // Búsqueda en tiempo real
    const buscador = document.getElementById('buscador');
    const filas = document.querySelectorAll('#tablaUsuarios tbody tr');

    buscador.addEventListener('input', function() {
        const texto = this.value.toLowerCase();

        filas.forEach(fila => {
            const nombre = fila.cells[1]?.textContent.toLowerCase() ?? '';
            const email  = fila.cells[2]?.textContent.toLowerCase() ?? '';

            const coincide = nombre.includes(texto) || email.includes(texto);
            fila.style.display = coincide ? '' : 'none';
        });
    });

    // Manejo de botones eliminar
    document.querySelectorAll('.btn-eliminar').forEach(btn => {
        btn.addEventListener('click', function() {
            const id     = this.dataset.id;
            const nombre = this.dataset.nombre;
            document.getElementById('nombreEliminar').textContent = nombre;
            document.getElementById('formEliminar').action = '/usuarios/' + id;
            const modal = new bootstrap.Modal(document.getElementById('modalEliminar'));
            modal.show();
        });
    });
</script>

@endsection