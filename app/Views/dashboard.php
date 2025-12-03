<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Sistema de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    
    <?= view('menu'); ?>

    <div class="container">
        <h2 class="mb-4">Resumen del Sistema</h2>
        
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header">
                        Estado del Inventario (Stock por Producto)
                    </div>
                    <div class="card-body">
                        <canvas id="graficoStock"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Obtenemos el contexto del canvas
        const ctx = document.getElementById('graficoStock');

        new Chart(ctx, {
            type: 'bar', // Tipo de gráfico: Barras
            data: {
                // Aquí usamos los datos que vinieron de PHP
                labels: <?= $nombres; ?>, 
                datasets: [{
                    label: 'Cantidad en Stock',
                    data: <?= $stocks; ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)', // Color azulito
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>