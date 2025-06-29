<?php
require_once '../libs/fpdf/fpdf.php';
require_once '../Capa_Datos/ProductoDAO.php';

date_default_timezone_set('America/Guayaquil');

$dao = new ProductoDAO();
$productos = $dao->listarProductos();

$pdf = new FPDF();
$pdf->AddPage();

// Título
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Reporte de Inventario - Tecnomovil',0,1,'C');

// Fecha y hora actual
$fechaHora = date('d/m/Y H:i:s');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0,10,'Generado el: ' . $fechaHora, 0,1,'R');

$pdf->Ln(5);

// Encabezado de la tabla
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,10,'ID',1);
$pdf->Cell(60,10,'Nombre',1);
$pdf->Cell(30,10,'Stock',1);
$pdf->Cell(30,10,'Precio',1);
$pdf->Cell(40,10,'Subtotal',1);
$pdf->Ln();

// Variables para los totales
$totalProductos = 0;
$totalValor = 0;

$pdf->SetFont('Arial','',12);
foreach ($productos as $p) {
    $subtotal = $p->getStock() * $p->getPrecio();
    $totalProductos++;
    $totalValor += $subtotal;

    $pdf->Cell(20,10,$p->getId(),1);
    $pdf->Cell(60,10,$p->getNombre(),1);
    $pdf->Cell(30,10,$p->getStock(),1);
    $pdf->Cell(30,10,'$'.number_format($p->getPrecio(), 2),1);
    $pdf->Cell(40,10,'$'.number_format($subtotal, 2),1);
    $pdf->Ln();
}

// Línea en blanco
$pdf->Ln(5);

// Mostrar totales
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,"Total de productos registrados: $totalProductos",0,1);
$pdf->Cell(0,10,"Valor total del inventario: $" . number_format($totalValor, 2),0,1);

$nombreArchivo = 'reporte_inventario_' . date('Ymd_His') . '.pdf';
$pdf->Output('I', $nombreArchivo);
?>