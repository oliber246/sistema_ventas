<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historial de Ventas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <?= view('menu'); ?>

    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Historial de Ventas</h1>
            <a href="<?= base_url('ventas'); ?>" class="btn btn-primary">
                <i class="bi bi-cart-plus-fill me-1"></i> Nueva Venta
            </a>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover w-100" id="tablaVentas">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Fecha y Hora</th>
                                <th>Cliente</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ventas as $v): ?>
                                <tr>
                                    <td><?= $v['id']; ?></td>
                                    <td><?= $v['fecha']; ?></td>
                                    <td><?= $v['cliente']; ?></td>
                                    <td class="fw-bold text-success">S/ <?= number_format($v['total'], 2); ?></td>
                                    <td class="text-nowrap">
                                        <button class="btn btn-danger btn-sm" title="Descargar PDF">
                                            <i class="bi bi-file-earmark-pdf-fill"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tablaVentas').DataTable({
                order: [[0, 'desc']],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay ventas registradas",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Ventas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Ventas",
                    "infoFiltered": "(Filtrado de _MAX_ total ventas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Ventas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>
</body>

</html>