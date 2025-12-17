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

        // 1. Recibir la imagen
        $img = $this->request->getFile('imagen');
        $nombreImagen = null; // Por defecto nulo

        // 2. Si subieron algo válido, lo guardamos
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $nombreImagen = $img->getRandomName(); // Nombre aleatorio (ej: 18237.jpg)
            $img->move(FCPATH . 'uploads/productos', $nombreImagen); // Guardar en carpeta
        }

        // 3. Preparar datos (SOLO los que tú usas)
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'precio' => $this->request->getPost('precio'),
            'stock' => $this->request->getPost('stock'),
            'imagen' => $nombreImagen // <--- Lo nuevo
        ];

        // 4. Guardar en Base de Datos
        $productoModel = new \App\Models\ProductoModel();
        $productoModel->save($data);

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
        // 1. Recibimos el ID y datos básicos
        $id = $this->request->getPost('id');

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'precio' => $this->request->getPost('precio'),
            'stock' => $this->request->getPost('stock'),
        ];

        // 2. Lógica de la Imagen
        $img = $this->request->getFile('imagen');

        // Si el usuario subió una imagen nueva válida
        if ($img && $img->isValid() && !$img->hasMoved()) {

            // Generamos nuevo nombre y movemos
            $nuevoNombre = $img->getRandomName();
            $img->move(FCPATH . 'uploads/productos', $nuevoNombre);

            // Agregamos al array para actualizar la BD
            $data['imagen'] = $nuevoNombre;
        }
        // SI NO SUBIÓ NADA, NO HACEMOS NADA (Se queda la imagen vieja en la BD)

        // 3. Guardar cambios
        $productoModel = new \App\Models\ProductoModel();
        $productoModel->update($id, $data);

        return redirect()->to(base_url('productos'));
    }
}