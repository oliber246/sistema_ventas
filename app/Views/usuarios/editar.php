<?= $this->extend('layout/main'); ?>

<?= $this->section('contenido'); ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Editar Usuario</h5>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('usuarios/actualizar'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $usuario['id']; ?>">

                    <div class="mb-3">
                        <label class="form-label">Nombre de Usuario</label>
                        <input type="text" name="usuario" class="form-control" value="<?= $usuario['usuario']; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" value="<?= $usuario['email']; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cambiar Contraseña <small class="text-muted">(Déjalo vacío para no
                                cambiar)</small></label>
                        <div class="input-group">
                            <input type="password" name="password" id="editPassword" class="form-control"
                                placeholder="Nueva contraseña (Opcional)">
                            <button class="btn btn-outline-secondary" type="button"
                                onclick="togglePassword('editPassword', 'iconEyeEdit')">
                                <i class="bi bi-eye-slash" id="iconEyeEdit"></i>
                            </button>
                        </div>
                    </div>

                    <hr>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= base_url('usuarios'); ?>" class="btn btn-secondary me-md-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        } else {
            input.type = "password";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        }
    }
</script>
<?= $this->endSection(); ?>