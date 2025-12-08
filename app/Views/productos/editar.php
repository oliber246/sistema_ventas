<?= $this->extend('layout/main'); ?>

<?= $this->section('contenido'); ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Editar Producto</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('productos/actualizar'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $producto['id']; ?>">

                    <div class="mb-3">
                        <label class="form-label">Nombre del Producto</label>
                        <input type="text" name="nombre" class="form-control" value="<?= $producto['nombre']; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Precio (S/)</label>
                        <input type="number" step="0.01" name="precio" class="form-control"
                            value="<?= $producto['precio']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stock (Cantidad)</label>
                        <input type="number" name="stock" class="form-control" value="<?= $producto['stock']; ?>"
                            required>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('productos'); ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Actualizar Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>