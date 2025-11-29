<?php

namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model
{
    protected $table      = 'ventas';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['id_cliente', 'id_usuario', 'fecha', 'total'];
}