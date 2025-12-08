<?= $this->extend('layout/main'); ?>

<?= $this->section('contenido'); ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Editar Cliente</h4>
            </div>
            <div class="card-body p-4">

                <form action="<?= base_url('clientes/actualizar'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $cliente['id']; ?>">

                    <div class="mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control" value="<?= $cliente['nombre']; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="<?= $cliente['telefono']; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" value="<?= $cliente['email']; ?>">
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('clientes'); ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle me-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle-fill me-1"></i> Actualizar Datos
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>