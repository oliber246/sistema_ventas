<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function repararBase()
    {
        $db = \Config\Database::connect();

        // Ejecutamos el comando SQL directamente desde PHP
        try {
            $db->query("ALTER TABLE usuarios ADD COLUMN email VARCHAR(100) AFTER usuario;");
            echo "<h1 style='color:green'>¡ÉXITO! Columna 'email' agregada correctamente.</h1>";
        } catch (\Throwable $e) {
            echo "<h1 style='color:red'>Error o ya existe: " . $e->getMessage() . "</h1>";
        }
    }
}
