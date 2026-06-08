@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-primary bg-opacity-10 p-3 rounded" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-users fs-5" style="color: #0066ff;"></i>
                </div>
                <div>
                    <h2 class="mb-0 fw-bold">Gestión de Clientes</h2>
                    <p class="text-muted mb-0">Administra el directorio de clientes de TecnoSoluciones S.A.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clienteModal" onclick="resetForm()">
                <i class="fas fa-plus me-2"></i>Nuevo Cliente
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-users" style="color: #0066ff;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">TOTAL CLIENTES</p>
                            <h5 class="mb-0 fw-bold">{{ $totalClientes ?? '12' }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="p-3 rounded me-3" style="width: 50px; height: 50px; background-color: #FFF3CD; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-building" style="color: #FF9800;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">EMPRESAS</p>
                            <h5 class="mb-0 fw-bold">{{ $totalEmpresas ?? '6' }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="p-3 rounded me-3" style="width: 50px; height: 50px; background-color: #E0F7FA; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user-circle" style="color: #0097A7;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">P. NATURALES</p>
                            <h5 class="mb-0 fw-bold">{{ $totalPersonas ?? '6' }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <!-- Search -->
            <div class="input-group mb-4">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Buscar por nombre, código, tipo o email...">
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="fw-600" style="color: #666;">ID</th>
                            <th class="fw-600" style="color: #666;">TIPO</th>
                            <th class="fw-600" style="color: #666;">CÓDIGO</th>
                            <th class="fw-600" style="color: #666;">NOMBRE</th>
                            <th class="fw-600" style="color: #666;">EMAIL</th>
                            <th class="fw-600" style="color: #666;">TELÉFONO</th>
                            <th class="fw-600 text-center" style="color: #666;">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientes ?? [] as $cliente)
                        <tr>
                            <td>
                                <span class="badge bg-light text-primary" style="font-weight: 600;">
                                    #{{ str_pad($cliente->id ?? 1, 3, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td>
                                @if(($cliente->tipo ?? 'empresa') === 'empresa')
                                    <span class="badge" style="background-color: #FFF3CD; color: #FF9800;">
                                        <i class="fas fa-building me-1"></i>Empresa
                                    </span>
                                @else
                                    <span class="badge" style="background-color: #E0F7FA; color: #0097A7;">
                                        <i class="fas fa-user-circle me-1"></i>P. Natural
                                    </span>
                                @endif
                            </td>
                            <td>{{ $cliente->codigo ?? '12345678' }}</td>
                            <td>{{ $cliente->nombre ?? 'Nombre Cliente' }}</td>
                            <td>
                                <small class="text-muted">{{ $cliente->email ?? 'correo@empresa.com' }}</small>
                            </td>
                            <td>{{ $cliente->telefono ?? '+51 987 654 321' }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-primary" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-warning" title="Editar" data-bs-toggle="modal" data-bs-target="#clienteModal" onclick="editarCliente({{ $cliente->id ?? 1 }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar" onclick="eliminarCliente({{ $cliente->id ?? 1 }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <p class="text-muted mb-0">No hay clientes registrados</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav class="mt-4">
                <ul class="pagination justify-content-end mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Modal Nuevo/Editar Cliente -->
<div class="modal fade" id="clienteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header border-bottom">
                <div>
                    <h5 class="modal-title fw-bold mb-0">Nuevo Cliente</h5>
                    <small class="text-muted">Complete el formulario para registrar un nuevo cliente</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="clienteForm">
                    @csrf
                    
                    <!-- Información del Cliente -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label fw-bold mb-0">Información del Cliente</label>
                            <button type="button" class="btn btn-sm btn-light text-primary" style="font-size: 12px;">Registro Nuevo</button>
                        </div>
                        <p class="text-muted small mb-3">Los campos marcados son obligatorios</p>

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
                                    <input type="text" class="form-control" name="codigo" placeholder="Ej: 12345678" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label small mb-1">Teléfono</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-phone text-muted"></i>
                                    </span>
                                    <input type="tel" class="form-control" name="telefono" placeholder="Ej: +51 987 654 321">
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
                                <input type="text" class="form-control" name="nombre" placeholder="Ej: Juan Carlos Pérez García" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label small mb-1">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="fas fa-envelope text-muted"></i>
                                </span>
                                <input type="email" class="form-control" name="email" placeholder="Ej: contacto@empresa.com" required>
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="mb-3">
                            <label class="form-label small mb-1">Dirección</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="fas fa-map-marker-alt text-muted"></i>
                                </span>
                                <input type="text" class="form-control" name="direccion" placeholder="Ej: Av. Javier Prado 1234, Lima">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" onclick="guardarCliente()">
                    <i class="fas fa-save me-2"></i>Guardar Cliente
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-600 {
        font-weight: 600;
    }
    
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .btn-outline-primary:hover, .btn-outline-warning:hover, .btn-outline-danger:hover {
        transform: scale(1.05);
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
    // Manejo de tipos de cliente
    document.querySelectorAll('.tipo-cliente-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.tipo-cliente-btn').forEach(b => b.classList.remove('active', 'btn-primary'));
            document.querySelectorAll('.tipo-cliente-btn').forEach(b => b.classList.add('btn-outline-primary'));
            
            this.classList.remove('btn-outline-primary');
            this.classList.add('btn-primary', 'active');
            
            document.getElementById('tipo_cliente').value = this.dataset.tipo;
        });
    });

    function resetForm() {
        document.getElementById('clienteForm').reset();
        document.getElementById('tipo_cliente').value = 'empresa';
        document.querySelector('[data-tipo="empresa"]').classList.add('active', 'btn-primary');
        document.querySelector('[data-tipo="empresa"]').classList.remove('btn-outline-primary');
        document.querySelector('[data-tipo="natural"]').classList.remove('active', 'btn-primary');
        document.querySelector('[data-tipo="natural"]').classList.add('btn-outline-primary');
    }

    function guardarCliente() {
        const form = document.getElementById('clienteForm');
        // Aquí iría la lógica de envío del formulario
        console.log('Guardando cliente...');
        // form.submit();
    }

    function editarCliente(id) {
        // Aquí iría la lógica para cargar datos del cliente
        console.log('Editando cliente:', id);
    }

    function eliminarCliente(id) {
        if (confirm('¿Está seguro de que desea eliminar este cliente?')) {
            console.log('Eliminando cliente:', id);
        }
    }
</script>
@endsection
