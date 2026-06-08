@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header con Botones -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold mb-0">Detalle del Cliente</h2>
                <div class="gap-2 d-flex">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#clienteModal">
                        <i class="fas fa-edit me-2"></i>Editar
                    </button>
                    <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Información Principal -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Columna Izquierda -->
                        <div class="col-md-6">
                            <!-- Tipo de Cliente -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-shield-alt" style="color: #0066ff;"></i>
                                    <p class="mb-0 text-muted small">Tipo de Cliente</p>
                                </div>
                                <span class="badge bg-primary p-2">
                                    {{ $cliente->tipo === 'empresa' ? 'Empresa' : 'Persona Natural' }}
                                </span>
                            </div>

                            <!-- Nombre/Razón Social -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-user-circle" style="color: #0066ff;"></i>
                                    <p class="mb-0 text-muted small">Nombre / Razón Social</p>
                                </div>
                                <h5 class="fw-bold mb-0">{{ $cliente->nombre }}</h5>
                            </div>

                            <!-- Teléfono -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-phone" style="color: #0066ff;"></i>
                                    <p class="mb-0 text-muted small">Teléfono</p>
                                </div>
                                <h5 class="fw-bold mb-0">{{ $cliente->telefono }}</h5>
                            </div>
                        </div>

                        <!-- Columna Derecha -->
                        <div class="col-md-6">
                            <!-- Código/RUC -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-folder" style="color: #0066ff;"></i>
                                    <p class="mb-0 text-muted small">Código</p>
                                </div>
                                <h5 class="fw-bold mb-0">{{ $cliente->codigo }}</h5>
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-envelope" style="color: #0066ff;"></i>
                                    <p class="mb-0 text-muted small">Correo Electrónico</p>
                                </div>
                                <a href="mailto:{{ $cliente->email }}" class="text-primary fw-bold text-decoration-none">
                                    {{ $cliente->email }}
                                </a>
                            </div>

                            <!-- Dirección -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-map-marker-alt" style="color: #0066ff;"></i>
                                    <p class="mb-0 text-muted small">Dirección</p>
                                </div>
                                <p class="mb-0 fw-bold">{{ $cliente->direccion }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Proyectos Asociados -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom p-4">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-folder-open" style="color: #0066ff; font-size: 20px;"></i>
                        <h5 class="mb-0 fw-bold">Proyectos Asociados</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="fw-600" style="color: #666;">Nombre</th>
                                    <th class="fw-600" style="color: #666;">Estado</th>
                                    <th class="fw-600" style="color: #666;">Fecha Inicio</th>
                                    <th class="fw-600 text-center" style="color: #666;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cliente->proyectos ?? [] as $proyecto)
                                <tr>
                                    <td class="fw-500">{{ $proyecto->nombre }}</td>
                                    <td>
                                        @switch($proyecto->estado)
                                            @case('en_progreso')
                                                <span class="badge bg-primary">En Progreso</span>
                                                @break
                                            @case('completado')
                                                <span class="badge bg-success">Completado</span>
                                                @break
                                            @case('en_revision')
                                                <span class="badge bg-warning">En Revisión</span>
                                                @break
                                            @case('pendiente')
                                                <span class="badge bg-danger">Pendiente</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ $proyecto->estado }}</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <i class="fas fa-calendar-alt text-muted me-1"></i>
                                        {{ $proyecto->fecha_inicio }}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary" title="Ver Detalles">
                                            Ver Detalles
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <p class="text-muted mb-0">No hay proyectos asociados a este cliente</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Cliente -->
<div class="modal fade" id="clienteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header border-bottom">
                <div>
                    <h5 class="modal-title fw-bold mb-0">Editar Cliente</h5>
                    <small class="text-muted">Modifica los datos del cliente</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="clienteForm">
                    @csrf
                    @method('PUT')
                    
                    <!-- Tipo de Cliente -->
                    <div class="row mb-3">
                        <div class="col-6">
                            <button type="button" class="btn w-100 btn-outline-primary tipo-cliente-btn" data-tipo="natural">
                                <i class="fas fa-user me-2"></i>Persona Natural
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn w-100 btn-primary tipo-cliente-btn" data-tipo="empresa">
                                <i class="fas fa-building me-2"></i>Empresa
                            </button>
                        </div>
                    </div>
                    <input type="hidden" id="tipo_cliente" name="tipo" value="empresa">

                    <!-- DNI/RUC -->
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label small mb-1">DNI/RUC</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="fas fa-id-card text-muted"></i>
                                </span>
                                <input type="text" class="form-control" name="codigo" value="{{ $cliente->codigo }}" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label small mb-1">Teléfono</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="fas fa-phone text-muted"></i>
                                </span>
                                <input type="tel" class="form-control" name="telefono" value="{{ $cliente->telefono }}">
                            </div>
                        </div>
                    </div>

                    <!-- Nombre Completo -->
                    <div class="mb-3">
                        <label class="form-label small mb-1">Nombre Completo</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="fas fa-user text-muted"></i>
                            </span>
                            <input type="text" class="form-control" name="nombre" value="{{ $cliente->nombre }}" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label small mb-1">Correo Electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="fas fa-envelope text-muted"></i>
                            </span>
                            <input type="email" class="form-control" name="email" value="{{ $cliente->email }}" required>
                        </div>
                    </div>

                    <!-- Dirección -->
                    <div class="mb-3">
                        <label class="form-label small mb-1">Dirección</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="fas fa-map-marker-alt text-muted"></i>
                            </span>
                            <input type="text" class="form-control" name="direccion" value="{{ $cliente->direccion }}">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" onclick="guardarCliente()">
                    <i class="fas fa-save me-2"></i>Guardar Cambios
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-600 {
        font-weight: 600;
    }
    
    .fw-500 {
        font-weight: 500;
    }
    
    .tipo-cliente-btn {
        transition: all 0.3s ease;
        border: 2px solid #ddd;
    }
    
    .tipo-cliente-btn.active {
        border-color: #0066ff;
        background-color: #0066ff;
        color: white;
    }
</style>

<script>
    document.querySelectorAll('.tipo-cliente-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.tipo-cliente-btn').forEach(b => b.classList.remove('active', 'btn-primary'));
            document.querySelectorAll('.tipo-cliente-btn').forEach(b => b.classList.add('btn-outline-primary'));
            
            this.classList.remove('btn-outline-primary');
            this.classList.add('btn-primary', 'active');
            
            document.getElementById('tipo_cliente').value = this.dataset.tipo;
        });
    });

    function guardarCliente() {
        const form = document.getElementById('clienteForm');
        console.log('Guardando cambios...');
        // form.submit();
    }
</script>
@endsection
