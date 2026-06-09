<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>TecnoFlow MVC - {{ $title ?? 'Panel de control' }}</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    {{-- Google Fonts - Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Estilos personalizados --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    {{-- SIDEBAR --}}
    <nav id="sidebar">
        <div class="sidebar-brand">
            <h5><i class="fa-solid fa-bolt me-1"></i> TecnoFlow MVC</h5>
            <small>TecnoSoluciones S.A.</small>
        </div>

        <p class="sidebar-label">MENÚ PRINCIPAL</p>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('clientes.index') }}"
                    class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i> Clientes
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('proyectos.index') }}"
                    class="nav-link {{ request()->routeIs('proyectos.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-folder-open"></i> Proyectos
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reportes') }}"
                class="nav-link {{ request()->routeIs('reportes') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-pdf"></i> Reportes
                </a>
            </li>
            @if(Auth::user()->role === 'admin')
            <li class="nav-item">
                <a href="{{ route('usuarios.index') }}"
                class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-gear"></i> Usuarios
                </a>
            </li>
            @endif
        </ul>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent">
                    <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
                </button>
            </form>
        </div>
    </nav>

    {{-- NAVBAR --}}
    <div id="navbar">
        <h6 class="navbar-title">{{ $title ?? 'Panel de control' }}</h6>
        <div class="navbar-right">
            <button class="btn-notification">
                <i class="fa-solid fa-bell"></i>
                <span class="notification-dot"></span>
            </button>
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div>
                <p class="user-name">{{ Auth::user()->name }}</p>
                <p class="user-role">{{ Auth::user()->role === 'admin' ? 'Administrador' : 'Empleado' }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
                </button>
            </form>
        </div>
    </div>

    {{-- CONTENIDO PRINCIPAL --}}
    <div id="main-content">
        {{-- Alerta de éxito --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Alerta de error --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <i class="fa-solid fa-circle-xmark me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Contenido de cada vista --}}
        @yield('content')
    </div>

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>