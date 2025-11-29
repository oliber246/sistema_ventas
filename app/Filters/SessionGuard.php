<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SessionGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Preguntamos: ¿NO existe la variable 'logueado' en la sesión?
        if (!session()->get('logueado')) {
            // Si no existe, lo mandamos al login con un mensaje
            return redirect()->to(base_url('/'))->with('mensaje', 'Debes iniciar sesión primero');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No necesitamos hacer nada después
    }
}