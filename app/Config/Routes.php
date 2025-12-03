<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index'); // La raíz ahora es el login
$routes->post('login/acceder', 'Login::acceder'); // Ruta para procesar el login
$routes->get('salir', 'Login::salir'); // Ruta para cerrar sesión

// Todo lo que va aquí dentro, pasará por el filtro 'auth'
$routes->group('', ['filter' => 'auth'], function($routes) {
    
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
});