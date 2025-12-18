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
        let carrito = [];

        // 1. EVENTO: Cuando cambia el producto seleccionado
        $('#producto').change(function () {
            let selected = $(this).find('option:selected');
            let precio = selected.data('precio');
            let stock = selected.data('stock');

            $('#precio').val(precio);
            $('#stock').val(stock);
        });

        // 2. EVENTO: Botón "Agregar al Carrito"
        $('#btnAgregar').click(function () {
            let idProd = $('#producto').val();
            let nombreProd = $('#producto option:selected').text();
            let precio = parseFloat($('#precio').val());
            let cantidad = parseInt($('#cantidad').val());
            let stock = parseInt($('#stock').val());

            if (!idProd) { Swal.fire('Atención', "Seleccione un producto", 'warning'); return; }
            if (cantidad > stock) { Swal.fire('Error', "No hay suficiente stock", 'error'); return; }
            if (cantidad <= 0) { Swal.fire('Error', "Cantidad inválida", 'error'); return; }

            let subtotal = precio * cantidad;

            carrito.push({
                id: idProd,
                nombre: nombreProd,
                cantidad: cantidad,
                precio: precio,
                subtotal: subtotal
            });

            actualizarTabla();
        });

        // 3. FUNCIÓN: Actualizar Tabla Visual
        function actualizarTabla() {
            let tbody = $('#tablaCarrito');
            tbody.empty();
            let total = 0;

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

            $('#totalVenta').text(total.toFixed(2));
        }

        // 4. FUNCIÓN GLOBAL: Eliminar ítem
        window.eliminarDelCarrito = function (index) {
            carrito.splice(index, 1);
            actualizarTabla();
        };

        // 5. EVENTO: Finalizar Venta (CON SWEETALERT Y PDF)
        $('#btnFinalizar').click(function () {
            let idCliente = $('#cliente').val();

            if (!idCliente) { Swal.fire('Falta Cliente', "Seleccione un cliente para la boleta", 'warning'); return; }
            if (carrito.length === 0) { Swal.fire('Carrito Vacío', "Agregue productos antes de vender", 'warning'); return; }

            // Preguntamos con SweetAlert antes de enviar
            Swal.fire({
                title: '¿Procesar Venta?',
                text: "Se generará la boleta y se descontará el stock.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, finalizar venta'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    // Enviamos los datos al servidor
                    $.post('<?= base_url('ventas/guardar'); ?>', {
                        id_cliente: idCliente,
                        productos: JSON.stringify(carrito)
                    }, function (response) {

                        if (response.status === 'success') {
                            // SI TODO SALIÓ BIEN:
                            Swal.fire({
                                title: '¡Venta Exitosa!',
                                text: 'Generando boleta electrónica...',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                // 1. Abrimos el PDF en una nueva pestaña usando el ID que nos devolvió el Controller
                                window.open('<?= base_url("ventas/generarBoleta/") ?>' + response.id_venta, '_blank');
                                
                                // 2. Recargamos la página para limpiar todo
                                location.reload();
                            });
                        } else {
                            // SI HUBO ERROR (Stock, BD, etc)
                            Swal.fire('Error', "Detalle: " + JSON.stringify(response.message), 'error');
                        }

                    }).fail(function (xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire('Error Fatal', "Ocurrió un error en el servidor. Revisa la consola.", 'error');
                    });
                }
            })
        });
    });
</script>
<?= $this->endSection(); ?>