<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('productos'); ?>">Sistema de Ventas</a>
            <a href="<?= base_url('salir'); ?>" class="btn btn-outline-light btn-sm">Salir</a>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4">Registrar Nueva Venta</h2>

        <div class="row">

            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        Datos de la Venta
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Cliente</label>
                            <select class="form-select" id="cliente" name="cliente">
                                <option value="">Seleccione un cliente...</option>
                                <?php foreach ($clientes as $cli): ?>
                                    <option value="<?= $cli['id']; ?>"><?= $cli['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Producto</label>
                            <select class="form-select" id="producto">
                                <option value="">Seleccione un producto...</option>
                                <?php foreach ($productos as $prod): ?>
                                    <option value="<?= $prod['id']; ?>"><?= $prod['nombre']; ?></option>
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

                        <button class="btn btn-success w-100" id="btn_agregar" type="button">Agregar al Carrito</button>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-secondary text-white">
                        Resumen de Venta
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
                            <tbody id="tabla_productos">
                            </tbody>
                        </table>

                        <div class="text-end mt-4">
                            <h3>Total: S/ <span id="total_venta">0.00</span></h3>
                        </div>

                        <div class="d-grid mt-3">
                            <button class="btn btn-primary btn-lg" onclick="guardarVenta()">
                                Finalizar Venta
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function () {

            // Lista oculta para guardar los productos
            let carrito = [];

            // 1. AJAX: Buscar precio al cambiar producto
            $('#producto').change(function () {
                let id_producto = $(this).val();
                if (id_producto != "") {
                    $.ajax({
                        url: "<?= base_url('ventas/precio_producto/'); ?>" + id_producto,
                        method: "GET",
                        dataType: "json",
                        success: function (datos) {
                            $('#precio').val(datos.precio);
                            $('#stock').val(datos.stock);
                        }
                    });
                } else {
                    $('#precio').val(''); $('#stock').val('');
                }
            });

            // 2. AGREGAR AL CARRITO
            $('#btn_agregar').click(function () {
                let id_producto = $('#producto').val();
                let nombre = $('#producto option:selected').text();
                let precio = parseFloat($('#precio').val());
                let cantidad = parseInt($('#cantidad').val());
                let stock = parseInt($('#stock').val());

                // Validaciones
                if (id_producto == "" || isNaN(precio)) {
                    alert("Selecciona un producto válido"); return;
                }
                if (cantidad > stock) {
                    alert("Stock insuficiente. Solo hay " + stock); return;
                }

                // Calcular subtotal
                let subtotal = precio * cantidad;

                // Agregar a la lista invisible (para enviar luego al servidor)
                carrito.push({
                    id: id_producto,
                    cantidad: cantidad,
                    precio: precio,
                    subtotal: subtotal
                });

                // Dibujar en la tabla visible
                let fila = "<tr>" +
                    "<td>" + nombre + "</td>" +
                    "<td>" + cantidad + "</td>" +
                    "<td>" + precio.toFixed(2) + "</td>" +
                    "<td>" + subtotal.toFixed(2) + "</td>" +
                    "<td><button class='btn btn-danger btn-sm' onclick='alert(\"Función pendiente\")'>X</button></td>" +
                    "</tr>";
                $('#tabla_productos').append(fila);

                // Actualizar Total
                actualizarTotal();
            });

            function actualizarTotal() {
                let total = 0;
                carrito.forEach(item => total += item.subtotal);
                $('#total_venta').text(total.toFixed(2));
            }

            // 3. FINALIZAR VENTA (Guardar en BD)
            window.guardarVenta = function () {
                let id_cliente = $('#cliente').val();

                if (id_cliente == "") {
                    alert("Por favor selecciona un cliente"); return;
                }
                if (carrito.length == 0) {
                    alert("El carrito está vacío"); return;
                }

                // Enviar todo al servidor por AJAX
                $.ajax({
                    url: "<?= base_url('ventas/guardar'); ?>",
                    method: "POST",
                    data: {
                        id_cliente: id_cliente,
                        productos: JSON.stringify(carrito) // Convertimos la lista a texto
                    },
                    success: function (respuesta) {
                        alert("Venta registrada correctamente!");
                        window.location.href = "<?= base_url('ventas'); ?>"; // Recargar página
                    },
                    error: function () {
                        alert("Error al guardar la venta");
                    }
                });
            };
        });
    </script>

</body>

</html>