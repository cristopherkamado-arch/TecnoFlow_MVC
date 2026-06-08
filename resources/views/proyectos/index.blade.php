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
                        class="btn btn-info btn-sm me-1">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="{{ route('proyectos.edit', $proyecto->id) }}"
                        class="btn btn-warning btn-sm me-1">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    <form action="{{ route('proyectos.destroy', $proyecto->id) }}"
                        method="POST" class="d-inline"
                        onsubmit="return confirm('¿Estás seguro de eliminar este proyecto?')">
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

{{-- Script de búsqueda y filtro en tiempo real --}}
<script>
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
</script>

@endsection