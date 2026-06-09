<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecnoFlow MVC - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('path/to/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        .login-card {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 15px;
            width: 100%;
            max-width: 450px;
        }

        .card-body {
            padding: 60px 40px;
        }

        .logo-box {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #0066ff 0%, #0052cc 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 40px;
        }

        .brand-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 5px;
        }

        .brand-subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 25px;
        }

        .welcome-msg {
            font-size: 15px;
            color: #666;
            margin-bottom: 35px;
            line-height: 1.6;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #0066ff;
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 255, 0.25);
        }

        .form-control::placeholder {
            color: #999;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .form-check-label {
            color: #666;
            font-size: 13px;
            user-select: none;
            margin-bottom: 0;
        }

        .form-check-input {
            accent-color: #0066ff;
            width: 18px;
            height: 18px;
            cursor: pointer;
            margin-top: 0.3rem;
        }

        .forgot-password {
            color: #0066ff;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: #0052cc;
            text-decoration: none;
        }

        .btn-login {
            background: linear-gradient(135deg, #0066ff 0%, #0052cc 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            margin-top: 15px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 102, 255, 0.3);
            background: linear-gradient(135deg, #0052cc 0%, #003d99 100%);
            color: white;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .footer-text {
            font-size: 12px;
            color: #999;
            margin-top: 40px;
            margin-bottom: 0;
        }

        .alert-danger {
            font-size: 14px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .is-invalid:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        @media (max-width: 576px) {
            .card-body {
                padding: 40px 25px;
            }

            .brand-title {
                font-size: 24px;
            }

            .logo-box {
                width: 70px;
                height: 70px;
                font-size: 35px;
            }

            .form-control {
                font-size: 16px;
                padding: 10px 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <div class="card login-card">
                    <div class="card-body text-center">
                        <div class="logo-box"><i class="bi bi-lightning-fill"></i></div>
                        
                        <h1 class="brand-title">TecnoFlow MVC</h1>
                        <p class="brand-subtitle">TecnoSoluciones S.A.</p>
                        <p class="welcome-msg">Bienvenido, inicia sesión para continuar</p>

                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->first('email') ?: 'Error en las credenciales' }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="{{ route('login.post') }}" method="POST" novalidate>
                            @csrf

                            <div class="mb-4 text-start">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input 
                                    type="email" 
                                    class="form-control @if($errors->has('email')) is-invalid @endif" 
                                    id="email"
                                    name="email" 
                                    placeholder="correo@empresa.com"
                                    value="{{ old('email', '') }}"
                                    required
                                    autocomplete="email"
                                >
                                @if($errors->has('email'))
                                <small class="text-danger d-block mt-2">{{ $errors->first('email') }}</small>
                                @endif
                            </div>

                            <div class="mb-4 text-start">
                                <label for="password" class="form-label">Contraseña</label>
                                <input 
                                    type="password" 
                                    class="form-control @if($errors->has('password')) is-invalid @endif" 
                                    id="password"
                                    name="password" 
                                    placeholder="••••••••"
                                    required
                                    autocomplete="current-password"
                                >
                                @if($errors->has('password'))
                                <small class="text-danger d-block mt-2">{{ $errors->first('password') }}</small>
                                @endif
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        id="remember" 
                                        name="remember" 
                                        value="1"
                                    >
                                    <label class="form-check-label" for="remember">
                                        Recordarme
                                    </label>
                                </div>
                                <a href="#" style="pointer-events: none; color: #6C757D;">¿Olvidaste tu contraseña?</a>
                            </div>

                            <button type="submit" class="btn btn-primary btn-login w-100">Iniciar sesión</button>
                        </form>

                        <p class="footer-text">© 2026 TecnoSoluciones S.A. — Todos los derechos reservados</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
