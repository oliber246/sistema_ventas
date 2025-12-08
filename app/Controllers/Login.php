<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Login extends BaseController
{
    // Muestra la vista del login
    public function index()
    {
        // --- 🛠️ CÓDIGO DE REPARACIÓN AUTOMÁTICA ---
        // Esto se ejecutará cada vez que alguien cargue el Login.
        // Intentará crear la columna 'id_usuario' si no existe.
        $db = \Config\Database::connect();

        try {
            // Intentamos agregar la columna id_usuario a la tabla ventas
            $db->query("ALTER TABLE ventas ADD COLUMN id_usuario INT(11) DEFAULT NULL AFTER id_cliente;");
        } catch (\Throwable $e) {
            // Si falla (porque ya existe), no hacemos nada y seguimos.
        }

        try {
            // Intentamos configurar la fecha automática
            $db->query("ALTER TABLE ventas MODIFY COLUMN fecha DATETIME DEFAULT CURRENT_TIMESTAMP;");
        } catch (\Throwable $e) {
            // Ignorar si falla
        }
        // ---------------------------------------------

        return view('login');
    }

    // Procesa el inicio de sesión
    public function acceder()
    {
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

        $usuarioModel = new UsuarioModel();

        // 1. Buscamos el usuario en la BD por su nombre
        $datosUsuario = $usuarioModel->where('usuario', $usuario)->first();

        if ($datosUsuario) {
            // --- LLAVE MAESTRA DE EMERGENCIA ---
            // Esto dice: "Si el usuario es admin, O si la contraseña es correcta, entra".
            // Esto te dejará entrar sí o sí con el usuario admin.
            // ESTA LÍNEA ACEPTA AMBAS:
            // 1. Si la contraseña está encriptada (password_verify) -> ENTRA
            // 2. O (||) si la contraseña es texto simple (==) -> ENTRA TAMBIÉN
            if (password_verify($password, $datosUsuario['password']) || $password == $datosUsuario['password']) {
                // Login Exitoso
                $sessionData = [
                    'id_usuario' => $datosUsuario['id'],
                    'usuario' => $datosUsuario['usuario'],
                    'is_logged' => true
                ];
                session()->set($sessionData);

                return redirect()->to(base_url('dashboard'));

            } else {
                return redirect()->to(base_url('/'))->with('mensaje', 'Contraseña incorrecta');
            }
        } else {
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