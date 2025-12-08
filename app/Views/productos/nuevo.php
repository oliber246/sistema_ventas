<?= $this->extend('layout/main'); ?>

<?= $this->section('contenido'); ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-box-seam me-2"></i>Nuevo Producto</h4>
            </div>
            <div class="card-body p-4">

                <form action="<?= base_url('productos/guardar'); ?>" method="post">

                    <div class="mb-3">
                        <label class="form-label">Nombre del Producto</label>
                        <input type="text" name="nombre" class="form-control" required autofocus>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Precio (S/)</label>
                            <input type="number" step="0.01" min="0" name="precio" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock Inicial</label>
                            <input type="number" min="0" name="stock" class="form-control" required>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('productos'); ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle me-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Guardar Producto
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>