<?= $this->extend('layout/main'); ?>

<?= $this->section('contenido'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Historial de Ventas</h1>
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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $v): ?>
                        <tr>
                            <td><?= $v['id']; ?></td>
                            <td><?= $v['fecha']; ?></td>
                            <td><?= $v['cliente']; ?></td>
                            <td class="fw-bold text-success">S/ <?= number_format($v['total'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>
<script>
    $(document).ready(function () {
        $('#tablaVentas').DataTable({
            // Aquí solo ponemos lo "especial" de esta tabla.
            // Lo demás (idioma español) ya se carga solo desde el main.php
            order: [[0, 'desc']] // Ordenar por ID (columna 0) descendente
        });
    });
</script>
<?= $this->endSection(); ?>