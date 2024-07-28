<?php
// Include the main TCPDF library (search for installation path).
require_once('../app/tcpdf-main/tcpdf.php');
include('../app/config.php');

$id_venta_get = $_GET['id_venta'];
$nro_venta_get = $_GET['nro_venta'];


$sql_ventas = "SELECT *, cli.nombre_cliente as nombre_cliente, cli.dni_cliente as dni_cliente  
			   FROM tb_ventas as ven INNER JOIN tb_clientes as cli on ven.id_cliente = cli.id_cliente WHERE ven.id_venta = '$id_venta_get' ";
$query_ventas = $pdo->prepare($sql_ventas);
$query_ventas->execute();
$ventas_datos = $query_ventas->fetchAll(PDO::FETCH_ASSOC);

foreach ($ventas_datos as $ventas_dato)
{
    $fyh_creacion = $ventas_dato['fyh_creacion'];
    $nombre_cliente = $ventas_dato['nombre_cliente'];
    $dni_cliente = $ventas_dato['dni_cliente'];
    $total_pagado = $ventas_dato['total_pagado'];
}

$fecha = date("d/m/Y", strtotime($fyh_creacion));

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(58,150), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Distribuidora');
$pdf->setTitle('Distribuidora');
$pdf->setSubject('Distribuidora');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins( left: 5, top: 5, right: 5);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, 15);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFontSubsetting(true);

// Set font
$pdf->setFont('Helvetica', '', 12);

// Add a page
$pdf->AddPage();

// create some html content
$html = '

<table border ="0">
<tr>
	<td>
            <b>MagInformática</b><br>
        <b>Cuil:</b> 20452319561<br>
            Rio Negro 3158<br>
            Cel. 3874818683<br>
            Salta - Argentina
	</td>
</tr>
</table>
<br><br>

<table border ="0">
<tr>
	<td>
        <b>Fecha:</b> '.$fecha.'<br>
        <b>Señor/a:</b> '.$nombre_cliente.'<br>
        <b>Dni:</b> '.$dni_cliente.'
    </td>
</tr>
</table>

<br><br>

<table border ="1" cellpadding="5px" style="font-size:10px">
<tr style="text-align: center">
	<th style="width: 63px"><b>Producto</b></th>
	<th style="width: 40px"><b>Cant.</b></th>
	<th style="width: 65px"><b>Subtotal</b></th>
</tr>
';

$contador_de_carrito = 0;
$total = 0;

$sql_carrito = "SELECT *, pro.nombre as nombre, pro.descripcion as descripcion, pro.precio_venta as precio, pro.stock as stock, pro.id_producto as id_producto FROM tb_carrito as carr 
                INNER JOIN tb_almacen as pro on carr.id_producto = pro.id_producto WHERE nro_venta = '$nro_venta_get' ORDER BY id_carrito ASC";

$query_carrito = $pdo->prepare($sql_carrito);
$query_carrito->execute();
$carrito_datos = $query_carrito->fetchAll(PDO::FETCH_ASSOC);
foreach ($carrito_datos as $carrito_dato)
{
    $id_carrito = $carrito_dato['id_carrito'];
    $contador_de_carrito = $contador_de_carrito + 1;
    $subtotal = $carrito_dato['cantidad'] * $carrito_dato['precio'];
    $total = $total + $subtotal;

    $html .='

	<tr style="text-align: center">
		<td>'.$carrito_dato['nombre'].'</td>
		<td>'.$carrito_dato['cantidad'].'</td>
		<td style= "text-align: right">$ '.$subtotal.'</td>
	</tr>
	';
}

$html .='

<tr>
<td colspan="2" style="text-align: right"><b>Total a Pagar</b></td>
<td style="text-align: right"><b>$ '.$total.'</b></td>
</tr>
</table>

';

// output the html content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
