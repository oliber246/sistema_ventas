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
    // 3. Guardar la venta completa (VERSIÓN CON DIAGNÓSTICO)
    public function guardar()
    {
        // Activar reporte de errores para verlos
        try {
            // Modelos necesarios
            $ventaModel = new VentaModel();
            $detalleModel = new DetalleVentaModel();
            $productoModel = new ProductoModel();
    
            // Recibir datos del AJAX
            $idCliente = $this->request->getPost('id_cliente');
            $productos = json_decode($this->request->getPost('productos'), true);
    
            // Validación básica
            if (empty($productos)) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'No hay productos en el carrito']);
            }
    
            // Calcular total
            $totalVenta = 0;
            foreach ($productos as $prod) {
                $totalVenta += $prod['subtotal'];
            }
    
            // A. Insertar en tabla VENTAS
            $dataVenta = [
                'id_cliente' => $idCliente,
                'id_usuario' => session()->get('id_usuario'),
                'total'      => $totalVenta,
                'fecha'      => date('Y-m-d H:i:s') // <--- AGREGAMOS LA FECHA MANUALMENTE POR SI ACASO
            ];
    
            // Intentamos insertar
            if (!$ventaModel->insert($dataVenta)) {
                // Si falla, devolvemos los errores del modelo
                return $this->response->setJSON(['status' => 'error', 'message' => $ventaModel->errors()]);
            }
            
            $idVenta = $ventaModel->getInsertID();
    
            // B. Insertar DETALLES y Actualizar STOCK
            foreach ($productos as $prod) {
                $detalleModel->insert([
                    'id_venta'    => $idVenta,
                    'id_producto' => $prod['id'],
                    'cantidad'    => $prod['cantidad'],
                    'precio'      => $prod['precio']
                ]);
    
                // Restar stock
                $productoActual = $productoModel->find($prod['id']);
                if($productoActual) {
                    $nuevoStock = $productoActual['stock'] - $prod['cantidad'];
                    $productoModel->update($prod['id'], ['stock' => $nuevoStock]);
                }
            }
    
            // Si llegamos aquí, todo salió bien
            return $this->response->setJSON(['status' => 'success']);
            
        } catch (\Throwable $e) {
            // AQUÍ ESTÁ EL TRUCO: Si algo explota, devolvemos el error real
            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }
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