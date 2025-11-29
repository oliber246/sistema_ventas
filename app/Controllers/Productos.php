<?php

namespace App\Controllers;

use App\Models\ProductoModel; // Importamos el Modelo que creaste antes

class Productos extends BaseController
{
    public function index()
    {
        
        // 1. Llamamos al Modelo
        $productoModel = new ProductoModel();

        // 2. Le pedimos TODOS los productos de la base de datos
        $datos['productos'] = $productoModel->findAll();

        // 3. Enviamos esos datos a la Vista (que crearemos en el siguiente paso)
        return view('productos/listado', $datos);
    }

    // 1. Muestra el formulario
    public function nuevo()
    {
        return view('productos/nuevo');
    }

    // 2. Recibe los datos y los guarda en la BD
    public function guardar()
    {
        $productoModel = new ProductoModel();

        // Recibimos los datos del formulario (por el 'name' de cada input)
        $datos = [
            'nombre' => $this->request->getPost('nombre'),
            'precio' => $this->request->getPost('precio'),
            'stock'  => $this->request->getPost('stock'),
        ];

        // Guardamos en la base de datos
        $productoModel->insert($datos);

        // Redireccionamos a la lista
        return redirect()->to(base_url('productos'));
    }

    // 3. Función para borrar
    public function borrar($id)
    {
        $productoModel = new ProductoModel();
        
        // CodeIgniter hace el DELETE WHERE id = $id automáticamente
        $productoModel->delete($id);

        return redirect()->to(base_url('productos'));
    }
    
    // 4. Mostrar el formulario de edición con los datos cargados
    public function editar($id)
    {
        $productoModel = new ProductoModel();
        
        // Buscamos el producto por su ID
        $datos['producto'] = $productoModel->find($id);

        return view('productos/editar', $datos);
    }

    // 5. Procesar la actualización
    public function actualizar()
    {
        $productoModel = new ProductoModel();

        // Obtenemos el ID del producto (vendrá oculto en el formulario)
        $id = $this->request->getPost('id');

        $datos = [
            'nombre' => $this->request->getPost('nombre'),
            'precio' => $this->request->getPost('precio'),
            'stock'  => $this->request->getPost('stock'),
        ];

        // Actualizamos el registro que tenga ese ID
        $productoModel->update($id, $datos);

        return redirect()->to(base_url('productos'));
    }
}