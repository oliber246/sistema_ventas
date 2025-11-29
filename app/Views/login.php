<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistema de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .card-login { width: 400px; }
    </style>
  </head>
  <body>
    
    <div class="card card-login shadow">
        <div class="card-body p-5">
            <h3 class="text-center mb-4">Iniciar Sesión</h3>
            
            <?php if(session()->getFlashdata('mensaje')): ?>
                <div class="alert alert-danger text-center">
                    <?= session()->getFlashdata('mensaje'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login/acceder'); ?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="usuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>
            </form>
        </div>
    </div>

  </body>
</html>