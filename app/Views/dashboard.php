<?= $this->extend('layout/main'); ?>

<?= $this->section('contenido'); ?>

<h2 class="mb-4">Resumen del Sistema</h2>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <i class="bi bi-bar-chart-fill me-2"></i>Estado del Inventario (Stock por Producto)
            </div>
            <div class="card-body">
                <canvas id="graficoStock"></canvas>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Obtenemos el contexto del canvas
    const ctx = document.getElementById('graficoStock');

    new Chart(ctx, {
        type: 'bar', // Tipo de gráfico: Barras
        data: {
            // Datos que vienen del controlador (PHP)
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
<?= $this->endSection(); ?>