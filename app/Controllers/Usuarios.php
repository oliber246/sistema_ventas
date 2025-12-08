<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuarios extends BaseController
{
    // 1. LISTAR USUARIOS
    public function index()
    {
        $usuarioModel = new UsuarioModel();
        $data['usuarios'] = $usuarioModel->findAll();
        return view('usuarios/listado', $data);
    }

    // 2. FORMULARIO NUEVO
    public function nuevo()
    {
        return view('usuarios/nuevo');
    }

    // 3. GUARDAR (CON VALIDACIÓN Y ENCRIPTACIÓN)
    public function guardar()
    {
        $usuarioModel = new UsuarioModel();

        // Recibimos los datos
        $nombreUsuario = $this->request->getPost('usuario');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // A. VALIDACIÓN: ¿Ya existe este nombre de usuario?
        $existe = $usuarioModel->where('usuario', $nombreUsuario)->first();

        if ($existe) {
            // Si existe, alerta JS y regresamos atrás
            echo "<script>
                    alert('El nombre de usuario " . $nombreUsuario . " ya existe. Intenta con otro.'); 
                    window.history.back();
                  </script>";
            return;
        }

        // B. GUARDAR: Encriptamos la contraseña
        $datos = [
            'usuario' => $nombreUsuario,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT) // ¡Clave encriptada!
        ];

        $usuarioModel->insert($datos);
        return redirect()->to(base_url('usuarios'));
    }

    // 4. FORMULARIO EDITAR
    public function editar($id)
    {
        $usuarioModel = new UsuarioModel();
        $data['usuario'] = $usuarioModel->find($id);
        return view('usuarios/editar', $data);
    }

    // 5. ACTUALIZAR (LÓGICA INTELIGENTE DE CONTRASEÑA)
    public function actualizar()
    {
        $usuarioModel = new UsuarioModel();
        $id = $this->request->getPost('id');

        // Datos básicos
        $datos = [
            'usuario' => $this->request->getPost('usuario'),
            'email' => $this->request->getPost('email')
        ];

        // Solo actualizamos la contraseña si el usuario escribió una nueva
        $passwordNueva = $this->request->getPost('password');

        if (!empty($passwordNueva)) {
            // Si escribió algo, lo encriptamos y lo agregamos a los datos a guardar
            $datos['password'] = password_hash($passwordNueva, PASSWORD_DEFAULT);
        }

        $usuarioModel->update($id, $datos);
        return redirect()->to(base_url('usuarios'));
    }

    // 6. BORRAR
    public function borrar($id)
    {
        $usuarioModel = new UsuarioModel();
        $usuarioModel->delete($id);
        return redirect()->to(base_url('usuarios'));
    }
}