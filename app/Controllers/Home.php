<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function repararVentas()
    {
        $db = \Config\Database::connect();
        try {
            // 1. Agregar columna id_usuario a la tabla ventas
            $db->query("ALTER TABLE ventas ADD COLUMN id_usuario INT(11) DEFAULT NULL AFTER id_cliente;");
            echo "<h1>Paso 1: Columna 'id_usuario' creada en Ventas. <br>";
        } catch (\Throwable $e) {
            echo "Paso 1 Error (quizas ya existe): " . $e->getMessage() . "<br>";
        }

        try {
            // 2. Asegurar que la fecha se ponga sola (por si acaso)
            $db->query("ALTER TABLE ventas MODIFY COLUMN fecha DATETIME DEFAULT CURRENT_TIMESTAMP;");
            echo "Paso 2: Fecha automática configurada.</h1>";
        } catch (\Throwable $e) {
            echo "Paso 2 Error: " . $e->getMessage() . "</h1>";
        }
    }

}
