<?php

require __DIR__ . '/code128.php';
require_once __DIR__ . '/conexion.php';

if (!isset($_GET['id'])) {
    die("ID de venta no especificado.");
}

$idVenta = intval($_GET['id']);

// Obtener datos de la venta
$stmt = $conn->prepare("
    SELECT v.*, u.nombre_completo AS nombre_usuario 
    FROM ventas v
    JOIN usuarios u ON v.id_usuario = u.id_Usuario
    WHERE v.id_venta = ?
");
$stmt->execute([$idVenta]);
$venta = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$venta) {
    die("Venta no encontrada.");
}

// Obtener productos de la venta
$stmt = $conn->prepare("
    SELECT dv.*, p.nombre_producto 
    FROM detalle_venta dv
    JOIN productos p ON dv.id_producto = p.id_producto
    WHERE dv.id_venta = ?
");
$stmt->execute([$idVenta]);
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Crear PDF
$pdf = new PDF_Code128('P', 'mm', 'Letter');
$pdf->SetMargins(17, 17, 17);
$pdf->AddPage();

// Logo y encabezado
$pdf->Image('Ticket/img/logo1.jpeg', 165, 12, 35, 35, 'JPEG');
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(23, 69, 107);
$pdf->Cell(150, 10, iconv("UTF-8", "ISO-8859-1", strtoupper("TextilExport")), 0, 0, 'L');
$pdf->Ln(9);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(150, 9, iconv("UTF-8", "ISO-8859-1", "RUC: 0000000000"), 0, 0, 'L');
$pdf->Ln(5);
$pdf->Cell(150, 9, iconv("UTF-8", "ISO-8859-1", "Dirección San Salvador, El Salvador"), 0, 0, 'L');
$pdf->Ln(5);
$pdf->Cell(150, 9, iconv("UTF-8", "ISO-8859-1", "Teléfono: 00000000"), 0, 0, 'L');
$pdf->Ln(5);
$pdf->Cell(150, 9, iconv("UTF-8", "ISO-8859-1", "Email: correo@ejemplo.com"), 0, 0, 'L');
$pdf->Ln(10);

// Fecha, cajero y número de factura
$pdf->Cell(30, 7, iconv("UTF-8", "ISO-8859-1", "Fecha de emisión:"), 0, 0);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(116, 7, date("d/m/Y h:i A", strtotime($venta['fecha'])), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(23, 69, 107);
$pdf->Cell(35, 7, iconv("UTF-8", "ISO-8859-1", strtoupper("Factura Nro.")), 0, 0, 'C');
$pdf->Ln(7);

$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(12, 7, "Cajero:", 0, 0);
$pdf->Cell(134, 7, iconv("UTF-8", "ISO-8859-1", $venta['nombre_usuario']), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 7, iconv("UTF-8", "ISO-8859-1", $venta['id_venta']), 0, 0, 'C');
$pdf->Ln(10);

// Cliente genérico
$pdf->SetTextColor(23, 69, 107);
$pdf->Cell(13, 7, "Cliente:", 0, 0);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(60, 7, "Consumidor Final", 0, 0, 'L');
$pdf->SetTextColor(23, 69, 107);
$pdf->Cell(8, 7, "Doc:", 0, 0);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(60, 7, "N/A", 0, 0, 'L');
$pdf->SetTextColor(23, 69, 107);
$pdf->Cell(7, 7, "Tel:", 0, 0);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(35, 7, "N/A", 0, 0);
$pdf->Ln(7);
$pdf->SetTextColor(23, 69, 107);
$pdf->Cell(6, 7, "Dir:", 0, 0);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(109, 7, "San Salvador, El Salvador", 0, 0);
$pdf->Ln(9);

// Tabla de productos
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(23, 69, 107);
$pdf->SetDrawColor(23, 69, 107);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(90, 8, "Descripción", 1, 0, 'C', true);
$pdf->Cell(15, 8, "Cantidad", 1, 0, 'C', true);
$pdf->Cell(25, 8, "Precio", 1, 0, 'C', true);
$pdf->Cell(19, 8, "Descuento", 1, 0, 'C', true);
$pdf->Cell(32, 8, "Subtotal", 1, 0, 'C', true);
$pdf->Ln(8);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$total = 0;

foreach ($productos as $p) {
    $subtotal = $p['cantidad'] * $p['precio_unitario'];
    $total += $subtotal;
    $pdf->Cell(90, 7, iconv("UTF-8", "ISO-8859-1", $p['nombre_producto']), 'L', 0, 'L');
    $pdf->Cell(15, 7, $p['cantidad'], 'L', 0, 'C');
    $pdf->Cell(25, 7, "$" . number_format($p['precio_unitario'], 2), 'L', 0, 'C');
    $pdf->Cell(19, 7, "$0.00", 'L', 0, 'C'); // Descuento estático
    $pdf->Cell(32, 7, "$" . number_format($subtotal, 2), 'LR', 0, 'C');
    $pdf->Ln(7);
}

// Totales
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(100, 7, '', 'T', 0);
$pdf->Cell(15, 7, '', 'T', 0);
$pdf->Cell(32, 7, "SUBTOTAL", 'T', 0, 'C');
$pdf->Cell(34, 7, "$" . number_format($total, 2), 'T', 0, 'C');
$pdf->Ln(7);
$pdf->Cell(100, 7, '', 0, 0);
$pdf->Cell(15, 7, '', 0, 0);
$pdf->Cell(32, 7, "IVA (13%)", 0, 0, 'C');
$iva = $total * 0.13;
$pdf->Cell(34, 7, "$" . number_format($iva, 2), 0, 0, 'C');
$pdf->Ln(7);
$pdf->Cell(100, 7, '', 0, 0);
$pdf->Cell(15, 7, '', 0, 0);
$pdf->Cell(32, 7, "TOTAL A PAGAR", 'T', 0, 'C');
$totalConIVA = $total + $iva;
$pdf->Cell(34, 7, "$" . number_format($totalConIVA, 2), 'T', 0, 'C');
$pdf->Ln(7);

// Si deseas mostrar el total pagado y cambio, puedes agregar más campos
$pdf->Ln(12);
$pdf->SetFont('Arial', '', 9);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(0, 9, iconv("UTF-8", "ISO-8859-1", "*** Precios incluyen impuestos. Para devoluciones presente esta factura ***"), 0, 'C');

// Código de barras
$pdf->SetFillColor(39, 39, 51);
$pdf->SetDrawColor(23, 83, 201);
$codigo = "VENTA" . str_pad($venta['id_venta'], 6, "0", STR_PAD_LEFT);
$pdf->Code128(72, $pdf->GetY(), $codigo, 70, 20);
$pdf->SetXY(12, $pdf->GetY() + 21);
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 5, $codigo, 0, 'C');

$pdf->Output("I", "Factura_Nro_" . $venta['id_venta'] . ".pdf");

?>
