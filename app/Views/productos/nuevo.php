<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuevo Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    
    <div class="container mt-5" style="max-width: 600px;">
        <h2 class="mb-4">Registrar Nuevo Producto</h2>
        
        <div class="card shadow">
            <div class="card-body">
                <form action="<?= base_url('productos/guardar'); ?>" method="post">
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio (S/)</label>
                        <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock (Cantidad)</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Guardar Producto</button>
                        <a href="<?= base_url('productos'); ?>" class="btn btn-secondary">Cancelar</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

  </body>
</html>