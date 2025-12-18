<?php

namespace App\Controllers;

use App\Models\VentaModel;
use App\Models\DetalleVentaModel;
use App\Models\ProductoModel;
use App\Models\ClienteModel;
//  IMPORTANTE: Importamos la librería del PDF
use Dompdf\Dompdf;

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
    public function precio_producto($id)
    {
        $productoModel = new ProductoModel();
        $producto = $productoModel->find($id);

        if ($producto) {
            return $this->response->setJSON($producto); 
        } else {
            return $this->response->setJSON(['error' => 'Producto no encontrado']);
        }
    }

    // 3. Guardar la venta completa
    public function guardar()
    {
        try {
            $ventaModel = new VentaModel();
            $detalleModel = new DetalleVentaModel();
            $productoModel = new ProductoModel();
    
            // Recibir datos del AJAX
            $idCliente = $this->request->getPost('id_cliente');
            $productos = json_decode($this->request->getPost('productos'), true);
    
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
                'fecha'      => date('Y-m-d H:i:s') 
            ];
    
            if (!$ventaModel->insert($dataVenta)) {
                return $this->response->setJSON(['status' => 'error', 'message' => $ventaModel->errors()]);
            }
            
            // Obtenemos el ID de la venta recién creada para el PDF
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
    
            // Si todo salió bien, devolvemos success Y EL ID DE LA VENTA (Para el PDF)
            return $this->response->setJSON([
                'status' => 'success', 
                'id_venta' => $idVenta // <--- IMPORTANTE: Enviamos el ID al Javascript
            ]);
            
        } catch (\Throwable $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Listar historial de ventas
    public function historial()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('ventas');

        $builder->select('ventas.id, ventas.fecha, ventas.total, clientes.nombre as cliente');
        $builder->join('clientes', 'clientes.id = ventas.id_cliente');
        $builder->orderBy('ventas.id', 'DESC'); 

        $data['ventas'] = $builder->get()->getResultArray();

        return view('ventas/listado', $data);
    }

    //  4. NUEVA FUNCIÓN: Generar PDF de Boleta
    public function generarBoleta($id)
    {
        $ventaModel = new VentaModel();
        $clienteModel = new ClienteModel();
        
        // 1. Buscamos la venta
        $venta = $ventaModel->find($id);
        if (!$venta) {
            return "Venta no encontrada";
        }

        // 2. Buscamos al cliente
        $cliente = $clienteModel->find($venta['id_cliente']);

        // 3. Buscamos los detalles (CON EL NOMBRE DEL PRODUCTO)
        // Usamos Query Builder para unir con la tabla productos
        $db = \Config\Database::connect();
        $builder = $db->table('detalle_venta');
        $builder->select('detalle_venta.*, productos.nombre as nombre_producto');
        $builder->join('productos', 'productos.id = detalle_venta.id_producto');
        $builder->where('detalle_venta.id_venta', $id);
        $detalles = $builder->get()->getResultArray();

        // 4. Preparamos los datos para la vista boleta.php
        $datos = [
            'nro_boleta'     => 'B001-' . str_pad($venta['id'], 8, '0', STR_PAD_LEFT),
            'fecha_emision'  => date('d/m/Y H:i', strtotime($venta['fecha'])),
            'cliente_nombre' => $cliente['nombre'],
            'cliente_dni'    => $cliente['num_documento'] ?? '----', // Si no tiene DNI en la BD
            'total_venta'    => $venta['total'],
            'detalles'       => $detalles
        ];

        // 5. Generamos el PDF con DomPDF
        $dompdf = new Dompdf();
        
        // Cargamos la vista como HTML string
        $html = view('ventas/boleta', $datos);
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Stream: false para descargar, true para ver en navegador (Usamos false para abrir en nueva pestaña)
        $dompdf->stream("Boleta_Venta_" . $id . ".pdf", ["Attachment" => false]);
    }

}