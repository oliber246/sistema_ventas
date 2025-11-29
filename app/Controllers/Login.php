<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Login extends BaseController
{
    // Muestra el formulario
    public function index()
    {
        return view('login');
    }

    // Procesa los datos
    public function acceder()
    {
        $usuarioModel = new UsuarioModel();
        
        // 1. Recibir datos del formulario
        $usuarioForm = $this->request->getPost('usuario');
        $passwordForm = $this->request->getPost('password');

        // 2. Buscar en la BD si existe ese usuario
        $usuarioBD = $usuarioModel->where('usuario', $usuarioForm)->first();

        // 3. Verificar si el usuario existe
        if ($usuarioBD) {
            // 4. Verificar si la contraseña coincide
            if ($passwordForm == $usuarioBD['password']) {
                
                // ¡ÉXITO! Creamos la SESIÓN
                // Esto es como ponerle un sello en la mano para que entre al club
                $datosSesion = [
                    'id_usuario' => $usuarioBD['id'],
                    'nombre'     => $usuarioBD['nombre'],
                    'logueado'   => true
                ];
                
                session()->set($datosSesion);

                // Lo mandamos a la lista de productos
                return redirect()->to(base_url('productos'));

            } else {
                // Contraseña incorrecta
                return redirect()->to(base_url('/'))->with('mensaje', 'Contraseña incorrecta');
            }
        } else {
            // Usuario no existe
            return redirect()->to(base_url('/'))->with('mensaje', 'Usuario no encontrado');
        }
    }

    // Cerrar sesión
    public function salir()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}