<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Perfil extends BaseController
{
    public function index()
    {
        return view('perfil/cambiar_password');
    }

    public function actualizar()
    {
        $usuarioModel = new UsuarioModel();
        $idUsuario = session()->get('id_usuario');

        // Obtenemos los datos del formulario
        $passActual = $this->request->getPost('password_actual');
        $passNueva = $this->request->getPost('password_nueva');

        // 1. Buscamos al usuario en la BD para ver su contraseña real
        $usuario = $usuarioModel->find($idUsuario);

        // 2. Verificamos si la contraseña actual ingresada coincide con la de la BD
        if (!password_verify($passActual, $usuario['password'])) {
            // Si falla, lo regresamos con un error
            return redirect()->back()->with('mensaje', 'Error: La contraseña actual no es correcta.');
        }

        // 3. Si es correcta, procedemos a cambiarla por la nueva
        $hashNueva = password_hash($passNueva, PASSWORD_DEFAULT);
        $usuarioModel->update($idUsuario, ['password' => $hashNueva]);

        // 4. Cerramos sesión por seguridad
        return redirect()->to(base_url('salir'));
    }
}