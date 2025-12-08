<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index'); // La raíz ahora es el login
$routes->post('login/acceder', 'Login::acceder'); // Ruta para procesar el login
$routes->get('salir', 'Login::salir'); // Ruta para cerrar sesión

// Todo lo que va aquí dentro, pasará por el filtro 'auth'
$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('productos', 'Productos::index');
    $routes->get('productos/nuevo', 'Productos::nuevo');
    $routes->post('productos/guardar', 'Productos::guardar');
    $routes->get('productos/borrar/(:num)', 'Productos::borrar/$1');
    $routes->get('productos/editar/(:num)', 'Productos::editar/$1');
    $routes->post('productos/actualizar', 'Productos::actualizar');

    // Rutas de Ventas
    $routes->get('ventas', 'Ventas::index');
    $routes->post('ventas/guardar', 'Ventas::guardar');

    // Esta es la ruta especial para AJAX
    $routes->get('ventas/precio_producto/(:num)', 'Ventas::precio_producto/$1');
    $routes->get('dashboard', 'Dashboard::index');

    // Rutas de Reportes
    $routes->get('reportes/html', 'Reportes::html');
    $routes->get('reportes/pdf', 'Reportes::pdf');
    $routes->get('reportes/excel', 'Reportes::excel');
    $routes->get('reportes/csv', 'Reportes::csv');

    // --- RUTAS DE CLIENTES ---
    $routes->get('clientes', 'Clientes::index');
    $routes->get('clientes/nuevo', 'Clientes::nuevo');
    $routes->post('clientes/guardar', 'Clientes::guardar');
    $routes->get('clientes/editar/(:num)', 'Clientes::editar/$1');
    $routes->post('clientes/actualizar', 'Clientes::actualizar');
    $routes->get('clientes/borrar/(:num)', 'Clientes::borrar/$1');

    $routes->get('ventas/historial', 'Ventas::historial');

    // Rutas de Perfil
    $routes->get('perfil', 'Perfil::index');
    $routes->post('perfil/actualizar', 'Perfil::actualizar');

    // --- RUTAS DE USUARIOS ---
    $routes->get('usuarios', 'Usuarios::index');
    $routes->get('usuarios/nuevo', 'Usuarios::nuevo');
    $routes->post('usuarios/guardar', 'Usuarios::guardar');
    $routes->get('usuarios/editar/(:num)', 'Usuarios::editar/$1');
    $routes->post('usuarios/actualizar', 'Usuarios::actualizar');
    $routes->get('usuarios/borrar/(:num)', 'Usuarios::borrar/$1');
});
$routes->get('reparar-ventas', 'Home::repararVentas');