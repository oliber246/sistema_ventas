<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Reportes extends BaseController
{
    // 1. REPORTE HTML (Para vista previa o impresión simple)
    public function html()
    {
        $productoModel = new ProductoModel();
        $data['productos'] = $productoModel->findAll();
        return view('reportes/lista_simple', $data);
    }

    // 2. REPORTE PDF (Usando DomPDF)
    public function pdf()
    {
        $productoModel = new ProductoModel();
        $data['productos'] = $productoModel->findAll();
        
        // Cargar vista como texto
        $html = view('reportes/lista_simple', $data);

        // Generar PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        // Descargar
        $dompdf->stream("Inventario.pdf", ["Attachment" => true]);
    }

    // 3. REPORTE EXCEL (Usando PhpSpreadsheet)
    public function excel()
    {
        $productoModel = new ProductoModel();
        $productos = $productoModel->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Encabezados
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'Precio');
        $sheet->setCellValue('D1', 'Stock');

        // Datos
        $fila = 2;
        foreach ($productos as $prod) {
            $sheet->setCellValue('A' . $fila, $prod['id']);
            $sheet->setCellValue('B' . $fila, $prod['nombre']);
            $sheet->setCellValue('C' . $fila, $prod['precio']);
            $sheet->setCellValue('D' . $fila, $prod['stock']);
            $fila++;
        }

        // Descargar
        $writer = new Xlsx($spreadsheet);
        $filename = 'Inventario.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    // 4. REPORTE CSV (Texto plano separado por comas)
    public function csv()
    {
        $productoModel = new ProductoModel();
        $productos = $productoModel->findAll();
        $filename = 'Inventario.csv';

        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv;");

        $file = fopen('php://output', 'w');

        // Encabezados
        fputcsv($file, ['ID', 'Nombre', 'Precio', 'Stock']);

        // Datos
        foreach ($productos as $prod) {
            fputcsv($file, $prod);
        }

        fclose($file);
        exit;
    }
}