<?php

namespace App\Controllers;

use App\Models\ClienteModel;

class Clientes extends BaseController
{
    // 1. Listar Clientes
    public function index()
    {
        $clienteModel = new ClienteModel();
        $data['clientes'] = $clienteModel->findAll();
        return view('clientes/listado', $data);
    }

    // 2. Formulario Nuevo
    public function nuevo()
    {
        return view('clientes/nuevo');
    }

    // 3. Guardar Cliente
    public function guardar()
    {
        $clienteModel = new ClienteModel();
        $datos = [
            'nombre'   => $this->request->getPost('nombre'),
            'telefono' => $this->request->getPost('telefono'),
            'email'    => $this->request->getPost('email'),
        ];
        
        $clienteModel->insert($datos);
        return redirect()->to(base_url('clientes'));
    }

    // 4. Formulario Editar
    public function editar($id)
    {
        $clienteModel = new ClienteModel();
        $data['cliente'] = $clienteModel->find($id);
        return view('clientes/editar', $data);
    }

    // 5. Actualizar Cliente
    public function actualizar()
    {
        $clienteModel = new ClienteModel();
        $id = $this->request->getPost('id');
        
        $datos = [
            'nombre'   => $this->request->getPost('nombre'),
            'telefono' => $this->request->getPost('telefono'),
            'email'    => $this->request->getPost('email'),
        ];

        $clienteModel->update($id, $datos);
        return redirect()->to(base_url('clientes'));
    }

    // 6. Borrar Cliente
    public function borrar($id)
    {
        $clienteModel = new ClienteModel();
        $clienteModel->delete($id);
        return redirect()->to(base_url('clientes'));
    }
}