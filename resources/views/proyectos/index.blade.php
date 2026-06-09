@extends('layouts.app')

@section('title', 'Gestión de Proyectos')

@section('content')

{{-- Encabezado --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-2">
        <div class="metric-icon" style="background-color: #EBF3FF;">
            <i class="fa-solid fa-folder-open" style="color: #0D6EFD;"></i>
        </div>
        <h5 class="mb-0" style="font-weight: 500; color: #343A40;">Gestión de Proyectos</h5>
    </div>
    <a href="{{ route('proyectos.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-2">
        <i class="fa-solid fa-plus"></i> Nuevo Proyecto
    </a>
</div>

{{-- Tarjetas de métricas --}}
<div class="row g-3 mb-4">

    {{-- Total Proyectos --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="metric-label">Total Proyectos</p>
                    <p class="metric-value">{{ $totalProyectos }}</p>
                </div>
                <div class="metric-icon" style="background-color: #EBF3FF;">
                    <i class="fa-solid fa-folder-open" style="color: #0D6EFD;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Pendientes --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="metric-label">Pendientes</p>
                    <p class="metric-value">{{ $totalPendientes }}</p>
                </div>
                <div class="metric-icon" style="background-color: #FFF3CD;">
                    <i class="fa-solid fa-clock" style="color: #F9A825;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- En Progreso --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="metric-label">En Progreso</p>
                    <p class="metric-value">{{ $totalEnProgreso }}</p>
                </div>
                <div class="metric-icon" style="background-color: #CFE2FF;">
                    <i class="fa-solid fa-spinner" style="color: #084298;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Completados --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="metric-label">Completados</p>
                    <p class="metric-value">{{ $totalCompletados }}</p>
                </div>
                <div class="metric-icon" style="background-color: #D1E7DD;">
                    <i class="fa-solid fa-circle-check" style="color: #2E7D32;"></i>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Tabla de proyectos --}}
<div class="table-card">

    {{-- Barra de búsqueda y filtro --}}
    <div class="d-flex gap-3 mb-4">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
                <i class="fa-solid fa-magnifying-glass text-muted"></i>
            </span>
            <input type="text" id="buscador" class="form-control border-start-0"
                placeholder="Buscar proyectos...">
        </div>
        <select id="filtroEstado" class="form-select" style="width: 160px; flex-shrink: 0;">
            <option value="">Todos</option>
            <option value="pendiente">Pendiente</option>
            <option value="en progreso">En Progreso</option>
            <option value="completado">Completado</option>
        </select>
    </div>

    {{-- Tabla --}}
    <table class="table table-borderless mb-0" id="tablaProyectos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cliente</th>
                <th>Estado</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proyectos as $proyecto)
            <tr>
                <td>{{ $proyecto->id }}</td>
                <td>{{ $proyecto->nombre }}</td>
                <td>{{ $proyecto->cliente->nombre }}</td>
                <td>
                    @if($proyecto->estado === 'pendiente')
                        <span class="badge bg-warning text-dark">Pendiente</span>
                    @elseif($proyecto->estado === 'en progreso')
                        <span class="badge bg-primary">En Progreso</span>
                    @else
                        <span class="badge bg-success">Completado</span>
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('d/m/Y') }}</td>
                <td>{{ $proyecto->fecha_fin ? \Carbon\Carbon::parse($proyecto->fecha_fin)->format('d/m/Y') : '—' }}</td>
                <td class="text-center">
                    <a href="{{ route('proyectos.show', $proyecto->id) }}"
                        class="btn btn-outline-info btn-sm me-1">
                            <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="{{ route('proyectos.edit', $proyecto->id) }}"
                        class="btn btn-outline-warning btn-sm me-1">
                            <i class="fa-solid fa-pen"></i>
                    </a>
                    @if(Auth::user()->role === 'admin')
                    <button type="button" class="btn btn-outline-danger btn-sm btn-eliminar"
                        data-id="{{ $proyecto->id }}"
                        data-nombre="{{ $proyecto->nombre }}"
                            data-tipo="proyecto">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    <i class="fa-solid fa-folder-open me-2"></i>No hay proyectos registrados aún.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Paginación --}}
    <div class="d-flex align-items-center justify-content-between mt-3">
        <small class="text-muted">
            Mostrando {{ $proyectos->firstItem() ?? 0 }} a {{ $proyectos->lastItem() ?? 0 }}
            de {{ $proyectos->total() }} proyectos
        </small>
        <div>
            {{ $proyectos->links('pagination::bootstrap-5') }}
        </div>
    </div>

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
                    ¿Estás seguro de que deseas eliminar este proyecto?
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

{{-- Script de búsqueda, filtro y eliminación --}}
<script>
    // Búsqueda y filtro en tiempo real
    const buscador = document.getElementById('buscador');
    const filtroEstado = document.getElementById('filtroEstado');
    const filas = document.querySelectorAll('#tablaProyectos tbody tr');

    function filtrar() {
        const texto = buscador.value.toLowerCase();
        const estado = filtroEstado.value.toLowerCase();

        filas.forEach(fila => {
            const nombre = fila.cells[1]?.textContent.toLowerCase() ?? '';
            const cliente = fila.cells[2]?.textContent.toLowerCase() ?? '';
            const estadoFila = fila.cells[3]?.textContent.toLowerCase() ?? '';

            const coincideTexto = nombre.includes(texto) || cliente.includes(texto);
            const coincideEstado = estado === '' || estadoFila.includes(estado);

            fila.style.display = coincideTexto && coincideEstado ? '' : 'none';
        });
    }

    buscador.addEventListener('input', filtrar);
    filtroEstado.addEventListener('change', filtrar);

    // Manejo de botones eliminar
    document.querySelectorAll('.btn-eliminar').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const nombre = this.dataset.nombre;
            const tipo = this.dataset.tipo;
            confirmarEliminar(id, nombre, tipo);
        });
    });

    // Función para mostrar modal de confirmación
    function confirmarEliminar(id, nombre, tipo) {
        document.getElementById('nombreEliminar').textContent = nombre;
        document.getElementById('formEliminar').action = '/' + tipo + 's/' + id;
        const modal = new bootstrap.Modal(document.getElementById('modalEliminar'));
        modal.show();
    }
</script>

@endsection