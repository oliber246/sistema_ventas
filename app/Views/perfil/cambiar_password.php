<?= $this->extend('layout/main'); ?>

<?= $this->section('contenido'); ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i>Cambiar Contraseña</h5>
            </div>
            <div class="card-body p-4">

                <?php if (session()->getFlashdata('mensaje')): ?>
                    <div class="alert alert-danger text-center">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?= session()->getFlashdata('mensaje'); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('perfil/actualizar'); ?>" method="post">

                    <div class="mb-3">
                        <label class="form-label">Contraseña Actual</label>
                        <input type="password" name="password_actual" class="form-control" required>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label">Nueva Contraseña</label>
                        <div class="input-group">
                            <input type="password" name="password_nueva" id="passInput" class="form-control"
                                placeholder="Mínimo 4 caracteres" required minlength="4">

                            <button class="btn btn-outline-secondary" type="button" onclick="togglePass()">
                                <i class="bi bi-eye-slash" id="iconoOjo"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
                        <a href="<?= base_url('dashboard'); ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    function togglePass() {
        var input = document.getElementById("passInput");
        var icono = document.getElementById("iconoOjo");

        if (input.type === "password") {
            // SI ESTÁ OCULTO -> LO MOSTRAMOS
            input.type = "text";
            // Cambiamos icono a Ojo Abierto (bi-eye)
            icono.classList.remove("bi-eye-slash");
            icono.classList.add("bi-eye");
        } else {
            // SI ESTÁ VISIBLE -> LO OCULTAMOS
            input.type = "password";
            // Cambiamos icono a Ojo Tachado (bi-eye-slash)
            icono.classList.remove("bi-eye");
            icono.classList.add("bi-eye-slash");
        }
    }
</script>
<?= $this->endSection(); ?>