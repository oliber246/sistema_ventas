<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso - BitGlobal Systems</title>

    <link rel="icon" href="<?= base_url('images/favicon.png'); ?>" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        /* 1. ANIMACIÓN DE FONDO (CSS3 PURO) */
        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* 2. ANIMACIÓN DE ENTRADA (Fade In Up) */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 40px, 0);
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(-45deg, #002c5f, #0d47a1, #1976d2, #001233);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            /* Fondo en movimiento */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        /* 3. TARJETA DE LOGIN (Estilo Minimalista) */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 3rem 2.5rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out;
            /* Animación de entrada */
        }

        /* Barra decorativa superior */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #0d47a1, #42a5f5);
        }

        .brand-logo {
            width: 100px;
            /* Ajusta el tamaño del logo */
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .brand-logo:hover {
            transform: scale(1.05);
            /* Pequeño zoom al pasar el mouse */
        }

        .login-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 2rem;
        }

        /* 4. INPUTS PERSONALIZADOS */
        .form-floating>.form-control {
            border-radius: 10px;
            border: 1px solid #eee;
            background-color: #f8f9fa;
            transition: all 0.3s;
        }

        .form-floating>.form-control:focus {
            background-color: #fff;
            border-color: #1976d2;
            box-shadow: 0 0 0 4px rgba(25, 118, 210, 0.1);
        }

        .form-floating>label {
            color: #aaa;
        }

        /* 5. BOTÓN CON GRADIENTE */
        .btn-gradient {
            background: linear-gradient(45deg, #0d47a1, #1976d2);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(13, 71, 161, 0.3);
        }

        .btn-gradient:hover {
            background: linear-gradient(45deg, #1565c0, #42a5f5);
            transform: translateY(-2px);
            /* Efecto de elevación */
            box-shadow: 0 6px 20px rgba(13, 71, 161, 0.4);
            color: white;
        }

        /* Ojito de contraseña */
        .password-toggle {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
            z-index: 10;
        }

        /* Enlace de ayuda */
        .forgot-link {
            color: #1976d2;
            font-size: 0.85rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #0d47a1;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-card">

        <img src="<?= base_url('images/favicon.png'); ?>" alt="BitGlobal Logo" class="brand-logo">

        <h3 class="login-title">Bienvenido</h3>
        <p class="login-subtitle">Ingresa tus credenciales para continuar</p>

        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-danger py-2" style="font-size: 0.9rem; border-radius: 10px;">
                <i class="bi bi-exclamation-circle me-1"></i> <?= session()->getFlashdata('mensaje'); ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login/acceder'); ?>" method="post">

            <div class="form-floating mb-3">
                <input type="text" name="usuario" class="form-control" id="floatingInput" placeholder="Usuario" required
                    autofocus>
                <label for="floatingInput"><i class="bi bi-person me-2"></i>Usuario</label>
            </div>

            <div class="form-floating mb-4 position-relative">
                <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Contraseña"
                    required>
                <label for="passwordInput"><i class="bi bi-lock me-2"></i>Contraseña</label>

                <i class="bi bi-eye-slash password-toggle" id="togglePassword"></i>
            </div>

            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-gradient">
                    INGRESAR
                </button>
            </div>

            
        </form>

        <div class="mt-4 text-muted" style="font-size: 0.75rem;">
            &copy; <?= date('Y'); ?> BitGlobal Systems
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#passwordInput');

        togglePassword.addEventListener('click', function () {
            // Cambiar tipo
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Cambiar icono
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>