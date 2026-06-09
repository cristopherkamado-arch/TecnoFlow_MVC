<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecnoFlow MVC - Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            color: white;
        }

        .brand-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
        }

        .brand-subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 35px;
            line-height: 1.6;
        }

        .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
        }

        .form-control:focus {
            border-color: #0066ff;
            background-color: white;
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

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
            font-size: 18px;
            border: none;
            background: none;
        }

        .password-toggle:hover {
            color: #0066ff;
        }

        .input-group {
            position: relative;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0066ff 0%, #0052cc 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 102, 255, 0.3);
            background: linear-gradient(135deg, #0052cc 0%, #003d99 100%);
            color: white;
            border: none;
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: #ddd;
            border: 1px solid #ccc;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            color: #333;
        }

        .btn-secondary:hover {
            background: #ccc;
            color: #333;
            transform: translateY(-2px);
            border-color: #bbb;
        }

        .btn-group-custom {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-group-custom .btn {
            flex: 1;
        }

        .back-link {
            color: #0066ff;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .back-link:hover {
            color: #0052cc;
            text-decoration: none;
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

        .alert-success {
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

        #passwordSection {
            display: none;
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
                        
                        <h1 class="brand-title">Recuperar contraseña</h1>
                        <p class="brand-subtitle">Ingresa y confirma tu nueva contraseña para restablecer el acceso a tu cuenta.</p>

                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="{{ route('password.update') }}" method="POST" novalidate id="resetForm">
                            @csrf

                            <div class="mb-4 text-start" id="emailSection">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <div class="input-group">
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
                                </div>
                                @if($errors->has('email'))
                                <small class="text-danger d-block mt-2">{{ $errors->first('email') }}</small>
                                @endif
                            </div>

                            <div id="passwordSection">
                                <div class="mb-4 text-start">
                                    <label for="password" class="form-label">Nueva contraseña</label>
                                    <div class="input-group">
                                        <input 
                                            type="password" 
                                            class="form-control @if($errors->has('password')) is-invalid @endif" 
                                            id="password"
                                            name="password" 
                                            placeholder="Ingresa tu nueva contraseña"
                                        >
                                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @if($errors->has('password'))
                                    <small class="text-danger d-block mt-2">{{ $errors->first('password') }}</small>
                                    @endif
                                </div>

                                <div class="mb-4 text-start">
                                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                                    <div class="input-group">
                                        <input 
                                            type="password" 
                                            class="form-control @if($errors->has('password_confirmation')) is-invalid @endif" 
                                            id="password_confirmation"
                                            name="password_confirmation" 
                                            placeholder="Confirma tu nueva contraseña"
                                        >
                                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @if($errors->has('password_confirmation'))
                                    <small class="text-danger d-block mt-2">{{ $errors->first('password_confirmation') }}</small>
                                    @endif
                                </div>

                                <div class="btn-group-custom">
                                    <a href="{{ route('login') }}" class="btn btn-secondary d-flex align-items-center justify-content-center gap-2">
                                        <i class="bi bi-x"></i> Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center gap-2">
                                        <i class="bi bi-check-circle"></i> Guardar contraseña
                                    </button>
                                </div>
                            </div>

                            <div id="buttonSection" class="mb-0">
                                <button type="button" class="btn btn-primary w-100" onclick="verificarEmail()">
                                    <i class="bi bi-envelope me-2"></i> Continuar
                                </button>
                                <div class="mt-3 text-center">
                                    <a href="{{ route('login') }}" class="back-link">
                                        <i class="bi bi-arrow-left"></i> Volver al login
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <p class="footer-text text-center">© 2026 TecnoSoluciones S.A. - Todos los derechos reservados</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function verificarEmail() {
            const email = document.getElementById('email').value;

            if (!email) {
                alert('Por favor, ingresa tu correo electrónico');
                return;
            }

            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                alert('Por favor, ingresa un correo válido');
                return;
            }

            // Envía petición AJAX para verificar el email
            fetch('{{ route("password.verify") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Oculta sección de email y muestra sección de contraseña
                    document.getElementById('emailSection').style.display = 'none';
                    document.getElementById('buttonSection').style.display = 'none';
                    document.getElementById('passwordSection').style.display = 'block';
                    
                    // Habilita los campos de contraseña
                    document.getElementById('password').required = true;
                    document.getElementById('password_confirmation').required = true;
                } else {
                    alert(data.message || 'El correo no está registrado en el sistema');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al verificar el correo');
            });
        }

        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const btn = field.nextElementSibling;
            
            if (field.type === 'password') {
                field.type = 'text';
                btn.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                field.type = 'password';
                btn.innerHTML = '<i class="bi bi-eye"></i>';
            }
        }

        // Validación de contraseñas coincidentes
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmation = document.getElementById('password_confirmation').value;
            
            if (password && confirmation && password !== confirmation) {
                e.preventDefault();
                alert('Las contraseñas no coinciden. Por favor, verifica e intenta nuevamente.');
                return false;
            }
        });
    </script>
</body>
</html>
