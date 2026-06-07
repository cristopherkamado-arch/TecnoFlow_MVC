<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecnoFlow MVC - @yield('title', 'Dashboard')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #0066ff;
            --secondary-color: #0052cc;
        }

        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-brand i {
            color: var(--primary-color);
            font-size: 24px;
        }

        .sidebar {
            background: white;
            min-height: calc(100vh - 70px);
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: 70px;
            left: 0;
            width: 250px;
            overflow-y: auto;
            z-index: 100;
        }

        .sidebar .nav-link {
            color: #666;
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
            color: var(--primary-color);
        }

        .sidebar .nav-link:hover {
            background-color: rgba(0, 102, 255, 0.1);
            color: var(--primary-color);
        }

        .sidebar .nav-link.active {
            background-color: rgba(0, 102, 255, 0.15);
            color: var(--primary-color);
            font-weight: 600;
        }

        .main-content {
            margin-left: 250px;
            margin-top: 70px;
            padding: 30px;
        }

        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #003d99 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 102, 255, 0.3);
        }

        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                transition: width 0.3s ease;
            }

            .sidebar.show {
                width: 250px;
            }

            .main-content {
                margin-left: 0;
            }

            .navbar-toggler {
                border: none;
            }
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-bolt"></i>
                <span class="fw-bold">TecnoFlow MVC</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="ms-auto d-flex align-items-center gap-3">
                    <div class="user-avatar" title="Perfil">
                        {{ substr(Auth::user()->name ?? 'User', 0, 1) }}
                    </div>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="sidebar">
        <nav class="nav flex-column mt-2">
            <a class="nav-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>

            <a class="nav-link @if(request()->routeIs('clientes.*')) active @endif" href="{{ route('clientes.index') }}">
                <i class="fas fa-users"></i>
                <span>Clientes</span>
            </a>

            <a class="nav-link @if(request()->routeIs('proyectos.*')) active @endif" href="{{ route('proyectos.index') }}">
                <i class="fas fa-folder-open"></i>
                <span>Proyectos</span>
            </a>

            <a class="nav-link @if(request()->routeIs('reportes.*')) active @endif" href="{{ route('reportes.index') ?? '#' }}">
                <i class="fas fa-file-pdf"></i>
                <span>Reportes</span>
            </a>

            <hr class="my-3">

            <div class="px-3 py-2">
                <small class="text-muted">USUARIO</small>
                <p class="mb-0 mt-2 fw-500">{{ Auth::user()->name ?? 'Usuario' }}</p>
                <small class="text-muted">{{ Auth::user()->email ?? 'correo@empresa.com' }}</small>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Alertas -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($message = Session::get('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>{{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($message = Session::get('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle me-2"></i>{{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Contenido dinámico -->
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts personalizados -->
    <script>
        // Cerrar alertas después de 5 segundos
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // Toggle sidebar en móvil
        const navbarToggler = document.querySelector('.navbar-toggler');
        const sidebar = document.querySelector('.sidebar');
        if (navbarToggler) {
            navbarToggler.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        }
    </script>

    @yield('scripts')
</body>
</html>
