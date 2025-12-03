<?php $uri = service('uri'); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 rounded">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">Sistema de Ventas</a>
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
          <a class="nav-link <?= ($uri->getSegment(1) == 'ventas') ? 'active' : '' ?>" 
             href="<?= base_url('ventas'); ?>">Registrar Venta</a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-danger fw-bold" href="<?= base_url('salir'); ?>">Salir</a>
        </li>

      </ul>
    </div>
  </div>
</nav>