<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class Dashboard extends BaseController
{
    public function index()
    {
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