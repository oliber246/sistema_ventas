<?= $this->extend('layout/main'); ?>

<?= $this->section('contenido'); ?>

<div class="row">
    <div class="col-md-5">
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Datos de la Venta</h5>
            </div>
            <div class="card-body">
                <form id="formVenta">
                    <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <select class="form-select" id="cliente" required>
                            <option value="">Seleccione un cliente...</option>
                            <?php foreach ($clientes as $cli): ?>
                                <option value="<?= $cli['id']; ?>"><?= $cli['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <select class="form-select" id="producto">
                            <option value="">Seleccione un producto...</option>
                            <?php foreach ($productos as $prod): ?>
                                <option value="<?= $prod['id']; ?>" data-precio="<?= $prod['precio']; ?>"
                                    data-stock="<?= $prod['stock']; ?>">
                                    <?= $prod['nombre']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Precio Unitario</label>
                        <input type="text" class="form-control" id="precio" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock Disponible</label>
                        <input type="text" class="form-control" id="stock" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" value="1" min="1">
                    </div>

                    <button type="button" class="btn btn-success w-100" id="btnAgregar">
                        Agregar al Carrito
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Resumen de Venta</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cant.</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody id="tablaCarrito">
                    </tbody>
                </table>

                <div class="text-end">
                    <h3>Total: S/ <span id="totalVenta">0.00</span></h3>
                </div>

                <button type="button" class="btn btn-primary w-100 mt-3" id="btnFinalizar">
                    Finalizar Venta
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>
<script>
    $(document).ready(function () {
        let carrito = []; // Array para almacenar los productos seleccionados

        // 1. EVENTO: Cuando cambia el producto seleccionado
        $('#producto').change(function () {
            // Obtenemos la opción seleccionada
            let selected = $(this).find('option:selected');
            // Extraemos los datos guardados en data-precio y data-stock
            let precio = selected.data('precio');
            let stock = selected.data('stock');

            // Actualizamos los inputs visuales
            $('#precio').val(precio);
            $('#stock').val(stock);
        });

        // 2. EVENTO: Botón "Agregar al Carrito"
        $('#btnAgregar').click(function () {
            // Capturamos valores del formulario
            let idProd = $('#producto').val();
            let nombreProd = $('#producto option:selected').text();
            let precio = parseFloat($('#precio').val());
            let cantidad = parseInt($('#cantidad').val());
            let stock = parseInt($('#stock').val());

            // Validaciones básicas
            if (!idProd) { alert("Seleccione un producto"); return; }
            if (cantidad > stock) { alert("No hay suficiente stock"); return; }
            if (cantidad <= 0) { alert("Cantidad inválida"); return; }

            // Calculamos subtotal
            let subtotal = precio * cantidad;

            // Agregamos el objeto al array del carrito
            carrito.push({
                id: idProd,
                nombre: nombreProd,
                cantidad: cantidad,
                precio: precio,
                subtotal: subtotal
            });

            // Actualizamos la tabla visual
            actualizarTabla();
        });

        // 3. FUNCIÓN: Actualizar Tabla Visual
        function actualizarTabla() {
            let tbody = $('#tablaCarrito');
            tbody.empty(); // Limpiamos la tabla
            let total = 0;

            // Recorremos el carrito y dibujamos cada fila
            carrito.forEach((item, index) => {
                total += item.subtotal;
                tbody.append(`
                    <tr>
                        <td>${item.nombre}</td>
                        <td>${item.cantidad}</td>
                        <td>${item.precio}</td>
                        <td>${item.subtotal.toFixed(2)}</td>
                        <td><button class="btn btn-danger btn-sm" onclick="eliminarDelCarrito(${index})">X</button></td>
                    </tr>
                `);
            });

            // Actualizamos el texto del Total
            $('#totalVenta').text(total.toFixed(2));
        }

        // 4. FUNCIÓN GLOBAL: Eliminar ítem (necesita estar en window para que el botón HTML la vea)
        window.eliminarDelCarrito = function (index) {
            carrito.splice(index, 1); // Quita el elemento del array
            actualizarTabla(); // Redibuja la tabla
        };

        // 5. EVENTO: Finalizar Venta (AJAX)
        $('#btnFinalizar').click(function () {
            let idCliente = $('#cliente').val();

            if (!idCliente) { alert("Seleccione un cliente"); return; }
            if (carrito.length === 0) { alert("El carrito está vacío"); return; }

            if (!confirm("¿Procesar venta?")) return;

            // Enviamos los datos al servidor con AJAX
            $.post('<?= base_url('ventas/guardar'); ?>', {
                id_cliente: idCliente,
                productos: carrito // Enviamos todo el array de productos
            }, function (response) {
                alert("Venta registrada correctamente");
                location.reload(); // Recargamos la página para limpiar todo
            }).fail(function () {
                alert("Error al procesar la venta");
            });
        });
    });
</script>
<?= $this->endSection(); ?>