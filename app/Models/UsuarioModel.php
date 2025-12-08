<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    
    // Permitimos que se consulten o modifiquen estos campos
    protected $allowedFields = ['usuario', 'password', 'email'];
}