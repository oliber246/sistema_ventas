<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleta de Venta Electrónica</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        .container { width: 100%; margin: 0 auto; }
        
        /* Cabecera */
        .header { width: 100%; margin-bottom: 20px; }
        .empresa-info { width: 60%; float: left; }
        .boleta-info { width: 35%; float: right; border: 1px solid #000; padding: 10px; text-align: center; }
        
        h1 { font-size: 18px; margin: 0; font-weight: bold; }
        h2 { font-size: 14px; margin: 5px 0; }
        .ruc-box { font-size: 14px; font-weight: bold; }

        /* Cliente */
        .cliente-section { margin-top: 120px; border-top: 1px solid #ccc; padding-top: 10px; }
        .cliente-row { margin-bottom: 5px; }
        .label { font-weight: bold; display: inline-block; width: 100px; }

        /* Tabla Productos */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #eee; border: 1px solid #000; padding: 5px; text-align: center; }
        td { border: 1px solid #ccc; padding: 5px; }
        .col-cant { width: 50px; text-align: center; }
        .col-desc { text-align: left; }
        .col-precio { width: 80px; text-align: right; }
        .col-total { width: 80px; text-align: right; }

        /* Totales */
        .footer-totales { margin-top: 20px; text-align: right; }
        .total-row { margin-bottom: 5px; }
        .gran-total { font-size: 14px; font-weight: bold; border-top: 1px solid #000; padding-top: 5px; }

        /* Pie de página */
        .footer-legal { margin-top: 40px; text-align: center; font-size: 10px; color: #666; border-top: 1px dashed #ccc; padding-top: 10px; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <div class="empresa-info">
                <h1>BITGLOBAL SYSTEMS S.A.C.</h1>
                <p>Jr. Los Ingenieros 123 - Puno, Perú</p>
                <p>Teléfono: (051) 123-456</p>
                <p>Email: ventas@bitglobal.online</p>
            </div>
            <div class="boleta-info">
                <div class="ruc-box">R.U.C. 20601234567</div>
                <div style="margin: 10px 0; background: #eee; padding: 5px;">BOLETA DE VENTA ELECTRÓNICA</div>
                <div><?= $nro_boleta; ?></div> </div>
        </div>

        <div class="cliente-section">
            <div class="cliente-row">
                <span class="label">Señor(es):</span> <?= $cliente_nombre; ?>
            </div>
            <div class="cliente-row">
                <span class="label">DNI / RUC:</span> <?= $cliente_dni; ?>
            </div>
            <div class="cliente-row">
                <span class="label">Fecha:</span> <?= $fecha_emision; ?>
            </div>
            <div class="cliente-row">
                <span class="label">Moneda:</span> SOLES
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>CANT.</th>
                    <th>DESCRIPCIÓN</th>
                    <th>P. UNIT</th>
                    <th>IMPORTE</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($detalles as $item): ?>
                <tr>
                    <td class="col-cant"><?= $item['cantidad']; ?></td>
                    <td class="col-desc"><?= $item['nombre_producto']; ?></td> <td class="col-precio"><?= number_format($item['precio'], 2); ?></td>
                    <td class="col-total"><?= number_format($item['cantidad'] * $item['precio'], 2); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="footer-totales">
            <div class="total-row">Subtotal: S/ <?= number_format($total_venta / 1.18, 2); ?></div>
            <div class="total-row">IGV (18%): S/ <?= number_format($total_venta - ($total_venta / 1.18), 2); ?></div>
            <div class="total-row gran-total">TOTAL A PAGAR: S/ <?= number_format($total_venta, 2); ?></div>
        </div>

        <div class="footer-legal">
            Representación Impresa de la Boleta de Venta Electrónica.<br>
            Consulte su documento en <strong>bitglobal.online</strong>
        </div>
    </div>

</body>
</html>