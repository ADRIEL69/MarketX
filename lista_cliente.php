<?php
session_start(); 

include "../conexion.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"?>
	<title>Lista de cliente</title>
	<style>
    /* Botones tipo "Crear cliente", "Crear usuario", etc. */
    a.btn_new {
        background-color: #05817D !important;
        color: white !important;
        padding: 5px 25px;
        font-size: 16px;
        text-decoration: none;
        border-radius: 4px;
        display: inline-block;
        transition: background-color 0.3s;
    }

    a.btn_new:hover {
        background-color: #04655F !important;
        color: white;
    }

    /* Encabezado de tablas */
    .table_venta th,
	table th {
        background-color: #05817D !important;
        color: white;
        padding: 10px;
    }

    /* Paginación seleccionada */
    .paginador li.pageSelected {
        background-color: #05817D;
        color: white;
        border: none;
        padding: 5px 10px;
        font-weight: bold;
    }

    /* Enlaces de paginación */
    .paginador li a {
        color: #05817D;
        padding: 5px 10px;
        text-decoration: none;
        border: 1px solid #ccc;
        display: inline-block;
        transition: background-color 0.3s, color 0.3s;
    }

    .paginador li a:hover {
        background-color: #05817D;
        color: white;
        border: 1px solid #05817D;
    }

    /* Iconos SVG en paginación */
    .paginador li a svg {
        fill: #05817D;
        transition: fill 0.3s;
    }

    .paginador li a:hover svg {
        fill: white;
    }
 </style>
</head>
<body>
	<?php include "includes/header.php"?>
	<section id="container">

		<h1><i class="fas fa-users"></i> Lista de cliente</h1>
		<a href="#" class="btn_new" id="nuevoCliente"><i class="fas fa-user-plus"></i> Crear cliente</a>

		<form action="buscar_cliente.php" method="post" class="form_search">
			<input type="text" name="busquedaCliente" id="busquedaCliente" placeholder="Buscar">	
		</form>
		<div style="width: 120px; margin-bottom: 5px">
						
						<p>
							<strong>Mostrar por : </strong>
							<select name="cantidad_mostrar_clientes" id="cantidad_mostrar_clientes">
								<option value="10">10</option>
								<option value="25">25</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
						</p>

					</div>
		<div class="containerTable" id="listaCliente">
			<!--CONTENIDO AJAX-->
		</div>
		<div class="paginador" id="paginadorClient">
			<!--CONTENIDO AJAX-->
		</div>
	</section>


		<?php include "includes/footer.php"?>

</body>

</html>