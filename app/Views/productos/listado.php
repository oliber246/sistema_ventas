<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body>
    <?= view('menu'); ?>
    <div class="container mt-5">
        

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Inventario de Productos</h1>
            <a href="<?= base_url('productos/nuevo'); ?>" class="btn btn-primary">
                + Agregar Nuevo Producto
            </a>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover" id="miTabla">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($productos)): ?>
                            <?php foreach ($productos as $prod): ?>
                                <tr>
                                    <td><?= $prod['id']; ?></td>
                                    <td><?= $prod['nombre']; ?></td>
                                    <td>S/ <?= $prod['precio']; ?></td>
                                    <td><?= $prod['stock']; ?></td>
                                    <td>
                                        <a href="<?= base_url('productos/editar/' . $prod['id']); ?>"
                                            class="btn btn-warning btn-sm">Editar</a>
                                        <a href="<?= base_url('productos/borrar/' . $prod['id']); ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de eliminar este producto?');">
                                            Borrar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#miTabla').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
                }
            });
        });
    </script>
</body>

</html>