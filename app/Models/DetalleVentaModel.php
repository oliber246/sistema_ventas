<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleVentaModel extends Model
{
    protected $table      = 'detalle_venta';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['id_venta', 'id_producto', 'cantidad', 'precio'];
}