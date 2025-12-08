<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Ventas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* Hacemos que el sidebar ocupe el 100% del alto en escritorio */
        .sidebar {
            min-height: 100vh;
        }

        /* Ajuste suave para el contenido */
        main {
            min-height: 100vh;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark d-lg-none p-3 shadow">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold"><i class="bi bi-shop-window me-2"></i>Sistema Ventas</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-2 d-none d-lg-block bg-dark sidebar p-0">
                <?= view('menu'); ?>
            </div>

            <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="sidebarMenu"
                aria-labelledby="sidebarMenuLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarMenuLabel">Menú</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-0">
                    <?= view('menu'); ?>
                </div>
            </div>

            <main class="col-lg-10 ms-sm-auto px-md-4 py-4 bg-light">
                <?= $this->renderSection('contenido'); ?>
            </main>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="<?= base_url('js/datatables_config.js'); ?>"></script>
    
    <?= $this->renderSection('scripts'); ?>

</body>

</html>