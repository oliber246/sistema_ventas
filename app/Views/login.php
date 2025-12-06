<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión - Sistema de Ventas</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background-color: #f0f2f5; /* Color de fondo suave tipo Facebook */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            background-color: #fff;
            padding: 2.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); /* Sombra suave y elegante */
            width: 100%;
            max-width: 400px;
        }
        .login-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #1c1e21;
        }
        .form-control {
            padding: 0.8rem 1rem;
            font-size: 1rem;
            border-radius: 6px;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
        }
        .btn-primary {
            font-size: 1.2rem;
            font-weight: 600;
            padding: 0.7rem;
            border-radius: 6px;
        }
        .input-group-text {
            background-color: #fff;
            border-left: none;
            cursor: pointer;
        }
        /* Ajuste para que el borde del input se vea bien con el icono */
        #passwordInput {
            border-right: none;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h1 class="login-title">Sistema de Ventas</h1>

        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-danger text-center shadow-sm">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?= session()->getFlashdata('mensaje'); ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login/acceder'); ?>" method="post">
            
            <div class="mb-4">
                <input type="text" name="usuario" class="form-control" placeholder="Nombre de usuario" required autofocus>
            </div>

            <div class="mb-4">
                <div class="input-group">
                    <input type="password" name="password" id="passwordInput" class="form-control" placeholder="Contraseña" required>
                    <span class="input-group-text border-start-0" id="togglePassword">
                        <i class="bi bi-eye-slash" id="toggleIcon"></i>
                    </span>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </div>
        </form>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#passwordInput');
        const toggleIcon = document.querySelector('#toggleIcon');

        togglePassword.addEventListener('click', function () {
            // 1. Cambiar el tipo de input (password <-> text)
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // 2. Cambiar el ícono (Ojo abierto <-> Ojo tachado)
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>