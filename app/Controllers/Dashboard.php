<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // --- CÓDIGO DE REPARACIÓN TEMPORAL ---
        $db = \Config\Database::connect();
        try {
            // Intentamos agregar la columna
            $db->query("ALTER TABLE usuarios ADD COLUMN email VARCHAR(100) AFTER usuario;");
            echo "<h1 style='color:green; text-align:center; margin-top:50px;'>¡EXITO! BASE DE DATOS REPARADA. <br> Ahora borra este código y recarga.</h1>";
            die(); // Detenemos todo aquí para que veas el mensaje
        } catch (\Throwable $e) {
            // Si falla (o ya existe), seguimos normal
        }
        // -------------------------------------
        $productoModel = new ProductoModel();
        
        // Obtenemos todos los productos
        $productos = $productoModel->findAll();

        // Preparamos dos listas vacías para el gráfico
        $nombres = [];
        $stocks = [];

        // Llenamos las listas con los datos reales
        foreach ($productos as $prod) {
            $nombres[] = $prod['nombre'];
            $stocks[] = $prod['stock'];
        }

        // Enviamos estos datos a la vista
        $data = [
            'nombres' => json_encode($nombres), // Convertimos a texto para JavaScript
            'stocks'  => json_encode($stocks)
        ];

        return view('dashboard', $data);
    }
}