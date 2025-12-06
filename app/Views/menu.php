<?php $uri = service('uri'); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 rounded shadow">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">
      <i class="bi bi-shop-window me-2"></i>Sistema de Ventas
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link <?= ($uri->getSegment(1) == 'dashboard') ? 'active' : '' ?>"
            href="<?= base_url('dashboard'); ?>">Inicio</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= ($uri->getSegment(1) == 'productos') ? 'active' : '' ?>"
            href="<?= base_url('productos'); ?>">Inventario</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= ($uri->getSegment(1) == 'clientes') ? 'active' : '' ?>"
            href="<?= base_url('clientes'); ?>">Clientes</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= ($uri->getSegment(1) == 'ventas') ? 'active' : '' ?>" href="#"
            role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ventas
          </a>
          <ul class="dropdown-menu dropdown-menu-dark shadow border-0">
            <li>
              <a class="dropdown-item py-2" href="<?= base_url('ventas'); ?>">
                <i class="bi bi-cart-plus-fill text-success me-2"></i>Nueva Venta
              </a>
            </li>
            <li>
              <hr class="dropdown-divider border-secondary">
            </li>
            <li>
              <a class="dropdown-item py-2" href="<?= base_url('ventas/historial'); ?>">
                <i class="bi bi-clock-history text-warning me-2"></i>Historial
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item ms-lg-3">
          <a class="nav-link text-danger fw-bold btn btn-outline-light border-0" href="<?= base_url('salir'); ?>">
            <i class="bi bi-box-arrow-right me-1"></i> Salir
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>