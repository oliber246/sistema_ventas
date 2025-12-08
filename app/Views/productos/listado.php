<?= $this->extend('layout/main'); ?>

<?= $this->section('contenido'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Inventario de Productos</h1>

    <div class="btn-group">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bi bi-download me-1"></i> Exportar
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="<?= base_url('reportes/pdf'); ?>">
                        <i class="bi bi-file-earmark-pdf-fill text-danger me-2"></i>Descargar PDF
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="<?= base_url('reportes/excel'); ?>">
                        <i class="bi bi-file-earmark-excel-fill text-success me-2"></i>Excel (.xlsx)
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="<?= base_url('reportes/csv'); ?>">
                        <i class="bi bi-filetype-csv text-primary me-2"></i>Archivo CSV
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item" target="_blank" href="<?= base_url('reportes/html'); ?>">
                        <i class="bi bi-printer-fill me-2"></i>Versión para Imprimir
                    </a>
                </li>
            </ul>
        </div>

        <a href="<?= base_url('productos/nuevo'); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle-fill me-1"></i> Nuevo Producto
        </a>
    </div>
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
                <?php foreach ($productos as $prod): ?>
                    <tr>
                        <td><?= $prod['id']; ?></td>
                        <td><?= $prod['nombre']; ?></td>
                        <td>S/ <?= $prod['precio']; ?></td>
                        <td><?= $prod['stock']; ?></td>
                        <td>
                            <a href="<?= base_url('productos/editar/' . $prod['id']); ?>" class="btn btn-warning btn-sm"
                                title="Editar este producto">
                                Editar
                            </a>
                            <a href="<?= base_url('productos/borrar/' . $prod['id']); ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Estás seguro de eliminar este producto?');"
                                title="Eliminar permanentemente">
                                Borrar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>
<script>
    $(document).ready(function () {
        // Ya no necesitas poner el 'language', se carga solo.
        $('#miTabla').DataTable();
    });
</script>
<?= $this->endSection(); ?>