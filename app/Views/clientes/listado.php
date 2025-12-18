<?= $this->extend('layout/main'); ?>

<?= $this->section('contenido'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestión de Clientes</h1>
    <a href="<?= base_url('clientes/nuevo'); ?>" class="btn btn-primary">
        <i class="bi bi-person-plus-fill me-1"></i> Nuevo Cliente
    </a>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover w-100" id="miTabla">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cli): ?>
                        <tr>
                            <td><?= $cli['id']; ?></td>
                            <td><?= $cli['nombre']; ?></td>
                            <td><?= $cli['telefono']; ?></td>
                            <td><?= $cli['email']; ?></td>
                            <td class="text-nowrap">
                                <a href="<?= base_url('clientes/editar/' . $cli['id']); ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <a href="#" 
                                   data-href="<?= base_url('clientes/borrar/' . $cli['id']); ?>" 
                                   class="btn btn-danger btn-sm btn-borrar"
                                   title="Eliminar Cliente">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
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
        $('#miTabla').DataTable();
    });
</script>
<?= $this->endSection(); ?>