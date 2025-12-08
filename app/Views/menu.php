<?php $uri = service('uri'); ?>

<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark h-100">

  <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <i class="bi bi-shop-window fs-4 me-2"></i>
    <span class="fs-5 fw-bold">Sistema Ventas</span>
  </a>

  <hr>

  <ul class="nav nav-pills flex-column mb-auto">

    <li class="nav-item mb-1">
      <a href="<?= base_url('dashboard'); ?>"
        class="nav-link text-white <?= ($uri->getSegment(1) == 'dashboard') ? 'active' : '' ?>">
        <i class="bi bi-house-door-fill me-2"></i>
        Inicio
      </a>
    </li>

    <li class="nav-item mb-1">
      <a href="<?= base_url('productos'); ?>"
        class="nav-link text-white <?= ($uri->getSegment(1) == 'productos') ? 'active' : '' ?>">
        <i class="bi bi-box-seam me-2"></i>
        Inventario
      </a>
    </li>

    <li class="nav-item mb-1">
      <a href="<?= base_url('clientes'); ?>"
        class="nav-link text-white <?= ($uri->getSegment(1) == 'clientes') ? 'active' : '' ?>">
        <i class="bi bi-people-fill me-2"></i>
        Clientes
      </a>
    </li>

    <li class="nav-item mb-1">
      <a href="<?= base_url('usuarios'); ?>"
        class="nav-link text-white <?= ($uri->getSegment(1) == 'usuarios') ? 'active' : '' ?>">
        <i class="bi bi-person-badge-fill me-2"></i>
        Usuarios
      </a>
    </li>

    <li class="nav-item mb-1">
      <a href="#submenuVentas" data-bs-toggle="collapse" class="nav-link text-white dropdown-toggle">
        <i class="bi bi-cart4 me-2"></i> Ventas
      </a>
      <div class="collapse <?= ($uri->getSegment(1) == 'ventas') ? 'show' : '' ?>" id="submenuVentas">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-4 bg-secondary rounded mt-1">
          <li>
            <a href="<?= base_url('ventas'); ?>" class="nav-link text-white">
              <i class="bi bi-plus-lg me-1"></i> Nueva Venta
            </a>
          </li>
          <li>
            <a href="<?= base_url('ventas/historial'); ?>" class="nav-link text-white">
              <i class="bi bi-clock-history me-1"></i> Historial
            </a>
          </li>
        </ul>
      </div>
    </li>
  </ul>

  <hr>

  <div class="dropdown">
    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1"
      data-bs-toggle="dropdown" aria-expanded="false">
      <div class="rounded-circle bg-primary d-flex justify-content-center align-items-center me-2"
        style="width: 32px; height: 32px;">
        <i class="bi bi-person-fill"></i>
      </div>
      <strong>Usuario</strong>
    </a>
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
      <li><a class="dropdown-item" href="<?= base_url('perfil'); ?>">Cambiar Contraseña</a></li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li><a class="dropdown-item text-danger" href="<?= base_url('salir'); ?>">Cerrar Sesión</a></li>
    </ul>
  </div>
</div>