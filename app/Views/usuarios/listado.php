<?= $this->extend('layout/main'); ?>

<?= $this->section('contenido'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestión de Usuarios</h1>
    <a href="<?= base_url('usuarios/nuevo'); ?>" class="btn btn-primary">
        <i class="bi bi-person-plus-fill me-1"></i> Nuevo Usuario
    </a>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover w-100" id="tablaUsuarios">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usu): ?>
                        <tr>
                            <td><?= $usu['id']; ?></td>
                            <td><?= $usu['usuario']; ?></td>
                            <td><?= $usu['email']; ?></td>
                            <td class="text-nowrap">
                                <a href="<?= base_url('usuarios/editar/' . $usu['id']); ?>" class="btn btn-warning btn-sm"
                                    title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="<?= base_url('usuarios/borrar/' . $usu['id']); ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar usuario permanentemente?');" title="Eliminar">
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
        // Ya no necesitas poner el 'language', se carga solo.
        $('#miTabla').DataTable();
    });
</script>
<?= $this->endSection(); ?>