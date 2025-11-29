<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    // Nombre de la tabla en tu base de datos
    protected $table      = 'productos';
    
    // El nombre de la columna que es llave primaria
    protected $primaryKey = 'id';

    // Qué formato devolver (array es más fácil de usar)
    protected $returnType     = 'array';

    // ¡IMPORTANTE! Aquí pones las columnas que permites editar
    // Si no pones esto, CodeIgniter no te dejará guardar nada por seguridad.
    protected $allowedFields = ['nombre', 'precio', 'stock'];
    
    // Activa las fechas automáticas (opcional, pero útil)
    protected $useTimestamps = false;
}