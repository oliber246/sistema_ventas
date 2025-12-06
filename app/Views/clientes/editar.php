<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?= view('menu'); ?>
        <div class="card shadow col-md-6 mx-auto">
            <div class="card-header bg-warning">Editar Cliente</div>
            <div class="card-body">
                <form action="<?= base_url('clientes/actualizar'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $cliente['id']; ?>">
                    <div class="mb-3">
                        <label>Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control" value="<?= $cliente['nombre']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="<?= $cliente['telefono']; ?>">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $cliente['email']; ?>">
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>