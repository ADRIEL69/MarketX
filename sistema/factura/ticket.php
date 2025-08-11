<?php
$subtotal 	= 0;
$iva 	 	= 0;
$impuesto 	= 0;
$tl_sniva   = 0;
$total 		= 0;
//print_r($configuracion); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Venta</title>
	<link rel="stylesheet" href="styleticket.css">
</head>

<body>
	<?php echo $anulada; ?>
	<div id="">
		<br>
		<br>
		<table id="factura_head">
			<tr>
				<td class="logo_factura">
					<div style="position: relative; left: 20px;">
						<img src="img/<?php echo $configuracion['foto']; ?>" style="width: 100px; alt="Logo; height: auto;">
					</div>

				</td>
			</tr>
			<tr>
				<td class="info_empresa" style="text-align: center; vertical-align: top;">
	<?php
	if ($result_config > 0) {
		$iva = $configuracion['iva'];
		$moned = $configuracion['moneda'];
	?>
		<div style="text-align: center;">
			<!-- Nombre de la empresa -->
			<h2 style="font-size: 24px; font-weight: bold; margin: 0 0 10px 0;">
				<?php echo strtoupper($configuracion['nombre']); ?>
			</h2>

			<!-- Información de contacto -->
			<p style="margin: 5px 0;">RUC: <?php echo $configuracion['nit']; ?></p>
			<p style="margin: 5px 0;">Cel: <?php echo $configuracion['telefono']; ?></p>
			<p style="margin: 5px 0;"><?php echo $configuracion['razon_social']; ?></p>
		</div>
	<?php
		if ($venta['status'] == 1) {
			$tipo_pago = 'Contado';
		} elseif ($venta['status'] == 3) {
			$tipo_pago = 'Crédito';
		} else {
			$tipo_pago = 'Anulado';
		}
	}

	if ($tipo_pago == 'Crédito') {
		date_default_timezone_set("America/Managua");
		$fecha = date('d-m-Y', strtotime($venta["fecha"]));
		$fecha_a_vencer = date('d-m-Y', strtotime($fecha . '+ 30 days'));
		$vence = '<p style="margin-top: 10px;">Vencimiento: ' . $fecha_a_vencer . '</p>';
	} else {
		$vence = '';
	}

	echo $vence;
	?>
</td>
			</tr>
			<tr>
				<td class="">

					<div style="padding-top: 100px;"> <!-- Ajusta el valor de '20px' según lo necesites -->
						<p style="margin-top: 54px;">Tipo de venta: <?php echo $tipo_pago; ?></p> <!-- Ajusta el valor de 50px según lo necesites -->
						<strong>No. Venta: <?php echo str_pad($venta['noventa'], 11, '0', STR_PAD_LEFT); ?> | Fecha: <?php echo $venta['fechaF']; ?></strong>
						<p style="margin-top: 54px;">Hora: <?php echo $venta['horaF']; ?></p> <!-- Ajusta el valor de 50px según sea necesario -->
						<p style="padding-top: 17px;">Vendedor: <?php echo $venta['vendedor']; ?></p> <!-- Ajusta el valor según sea necesario -->
						<strong>Cliente: <?php echo $venta['nombre']; ?></strong>
						<p style="margin-top: 54px;">Nit: <?php echo $venta['nit']; ?></p> <!-- Ajusta el valor de 50px según sea necesario -->
						<?php echo $vence; ?>


					</div>


				</td>
			</tr>
		</table>
		<table id="factura_detalle" width="100%" cellspacing="0" cellpadding="5" border="0">
	<thead>
		<tr>
			<th colspan="4" style="text-align: left; padding-bottom: 5px;">
				<strong>Descripción de productos</strong>
			</th>
		</tr>
		<tr>
			<th style="text-align: left;">Código</th>
			<th style="text-align: center;">Cantidad</th>
			<th style="text-align: right;">Precio</th>
			<th style="text-align: right;">Total</th>
		</tr>
		<tr>
			<td colspan="4"><hr></td>
		</tr>
	</thead>
	<tbody id="detalle_productos">
		<?php
		if ($result_detalle > 0) {
			while ($row = mysqli_fetch_assoc($query_productos)) {
				$precio_venta = number_format($row['precio_venta'], 2);
				$precio_total = number_format($row['precio_total'], 2);
		?>
			<tr>
				<td style="text-align: left;"><?php echo $row['codigo']; ?></td>
				<td style="text-align: center;"><?php echo $row['cantidad']; ?></td>
				<td style="text-align: right;"><?php echo $precio_venta; ?></td>
				<td style="text-align: right;"><?php echo $precio_total; ?></td>
			</tr>
			<tr>
				<td colspan="4" style="text-align: left; font-size: 12px; padding-left: 5px;">
					<?php echo $row['descripcion']; ?>
				</td>
			</tr>
		<?php
				$subtotal = round($subtotal + $row['precio_total'], 2);
			}
		}

		$impuesto 	= round($subtotal * ($iva / 100), 2);
		$tl_sniva 	= round($subtotal - $impuesto, 2);
		$total 		= $tl_sniva + $impuesto;
		$tl_sniva1  = number_format($tl_sniva, 2);
		$impuesto1  = number_format($impuesto, 2);
		$descuento  = number_format($venta['descuento'], 2);
		?>
	</tbody>
	<tfoot id="detalle_totales">
		<tr><td colspan="4"><hr></td></tr>

		<tr>
			<td colspan="2"></td>
			<td style="text-align: right;"><strong>Subtotal:</strong></td>
			<td style="text-align: right;"><?php echo $moned . ' ' . number_format($subtotal, 2); ?></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td style="text-align: right;"><strong>Descuento:</strong></td>
			<td style="text-align: right;"><?php echo $moned . ' ' . $descuento; ?></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td style="text-align: right;"><strong>TOTAL:</strong></td>
			<td style="text-align: right;"><?php echo $moned . ' ' . number_format($total - $venta['descuento'], 2); ?></td>
		</tr>
	</tfoot>
</table>

		<br>
		<br>
		<br>


<!-- Contenedor del código de barras -->
<div style="text-align: center; margin-top: 5px;">
    <div style="
        display: inline-block;
        padding: 25	px;
        border: 0px solid #ddd;
        border-radius: 0px;
        background-color: #fff;
    ">
        <?php
        require_once __DIR__ . '/../../vendor/autoload.php';
        use Picqer\Barcode\BarcodeGeneratorPNG;

        $generator = new BarcodeGeneratorPNG();
        $codigo_barra = isset($venta['noventa']) ? $venta['noventa'] : '000000000';
        $barcode_image = base64_encode($generator->getBarcode($codigo_barra, $generator::TYPE_CODE_128));
        echo '<img src="data:image/png;base64,' . $barcode_image . '" alt="Código de barras">';
        ?>
    </div>

    <!-- Texto del número del código de barras -->
    <p style="margin-top: 100px; font-size: 16px; font-weight: bold;">
        Número: <?php echo $codigo_barra; ?>
    </p>
</div>




</body>

</html>s
