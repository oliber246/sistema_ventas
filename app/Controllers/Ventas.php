<?php

namespace App\Controllers;

use App\Models\VentaModel;
use App\Models\DetalleVentaModel;
use App\Models\ProductoModel;
use App\Models\ClienteModel;

class Ventas extends BaseController
{
    // 1. Mostrar el formulario de nueva venta
    public function index()
    {
        $clienteModel = new ClienteModel();
        $productoModel = new ProductoModel();

        // Enviamos la lista de clientes y productos a la vista
        $datos['clientes'] = $clienteModel->findAll();
        $datos['productos'] = $productoModel->where('stock >', 0)->findAll(); // Solo productos con stock

        return view('ventas/registrar', $datos);
    }

    // 2. Función AJAX: Recibe un ID y devuelve el precio
    // Esta es la que llamaremos desde JavaScript sin recargar la página
    public function precio_producto($id)
    {
        $productoModel = new ProductoModel();
        $producto = $productoModel->find($id);

        if ($producto) {
            return $this->response->setJSON($producto); // Respondemos en formato JSON (datos puros)
        } else {
            return $this->response->setJSON(['error' => 'Producto no encontrado']);
        }
    }

    // 3. Guardar la venta completa
    public function guardar()
    {
        // Modelos necesarios
        $ventaModel = new VentaModel();
        $detalleModel = new DetalleVentaModel();
        $productoModel = new ProductoModel();

        // Recibir datos del AJAX
        $idCliente = $this->request->getPost('id_cliente');
        $productos = json_decode($this->request->getPost('productos'), true); // Convertir texto a array

        // Calcular el total final (por seguridad, lo recalculamos aquí)
        $totalVenta = 0;
        foreach ($productos as $prod) {
            $totalVenta += $prod['subtotal'];
        }

        // A. Insertar en tabla VENTAS
        $dataVenta = [
            'id_cliente' => $idCliente,
            'id_usuario' => session()->get('id_usuario'), // El usuario que está logueado
            'total' => $totalVenta,
            // 'fecha' se pone automática por la base de datos
        ];

        $ventaModel->insert($dataVenta);
        $idVenta = $ventaModel->getInsertID(); // Obtenemos el ID de la venta recién creada

        // B. Insertar DETALLES y Actualizar STOCK
        foreach ($productos as $prod) {
            // 1. Guardar detalle
            $detalleModel->insert([
                'id_venta' => $idVenta,
                'id_producto' => $prod['id'],
                'cantidad' => $prod['cantidad'],
                'precio' => $prod['precio']
            ]);

            // 2. Restar stock del producto
            // Primero buscamos el stock actual
            $productoActual = $productoModel->find($prod['id']);
            $nuevoStock = $productoActual['stock'] - $prod['cantidad'];

            // Actualizamos
            $productoModel->update($prod['id'], ['stock' => $nuevoStock]);
        }

        // Responder al JS que todo salió bien
        return $this->response->setJSON(['status' => 'success']);
    }

    // Listar historial de ventas con nombre de cliente
    public function historial()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('ventas');

        // Seleccionamos ID, Fecha, Total y el Nombre del Cliente (haciendo unión de tablas)
        $builder->select('ventas.id, ventas.fecha, ventas.total, clientes.nombre as cliente');
        $builder->join('clientes', 'clientes.id = ventas.id_cliente');
        $builder->orderBy('ventas.id', 'DESC'); // Las más recientes primero

        $data['ventas'] = $builder->get()->getResultArray();

        return view('ventas/listado', $data);
    }

}