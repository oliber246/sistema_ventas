<?php

namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model
{
    protected $table      = 'ventas';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    
    // AQUÍ ESTÁ LA CLAVE: Deben estar estos 4 campos
    protected $allowedFields = ['fecha', 'id_cliente', 'id_usuario', 'total'];
}