<?= $this->extend('layout/main'); ?>

<?= $this->section('contenido'); ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Editar Producto</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('productos/actualizar'); ?>" method="post" enctype="multipart/form-data">
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
                    <div class="mb-3">
                        <label class="form-label">Imagen del Producto</label>

                        <?php if (!empty($producto['imagen'])): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('uploads/productos/' . $producto['imagen']) ?>" class="img-thumbnail"
                                    width="100">
                                <small class="d-block text-muted">Imagen actual</small>
                            </div>
                        <?php endif; ?>

                        <input type="file" class="form-control" name="imagen" accept="image/*">
                        <div class="form-text">Deja esto vacío si no quieres cambiar la imagen.</div>
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