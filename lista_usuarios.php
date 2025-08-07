<?php
session_start();
	if ($_SESSION['rol'] != 1) 
	{
		header("location: ./");
	} 

include "../conexion.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Sistema de Ventas</title>

	<style>
		a#nuevoUsuario.btn_new {
			background-color: #05817D !important;
			color: white !important;
			padding: 5px 25px;
			font-size: 16px;
			text-decoration: none;
			border-radius: 4px;
			display: inline-block;
			transition: background-color 0.3s;
		}

		a#nuevoUsuario.btn_new:hover {
			background-color: #04655F !important; /* Un poco más oscuro al pasar el mouse */
			color: white;
		}
	</style>
</head>
<body>
	<?php include "includes/header.php";?>
	<section id="container">

		<h1><i class="fas fa-users"></i> Lista de usuarios</h1>
		<a href="#" class="btn_new" id="nuevoUsuario"><i class="fas fa-user-plus"></i> Crear Usuario</a>

		<form action="" method="post" class="form_search">
			<input type="text" name="busquedaUsuario" id="busquedaUsuario" placeholder="Buscar">
		</form>
		<div style="width: 120px; margin-bottom: 5px">
						
						<p>
							<strong>Mostrar por : </strong>
							<select name="cantidad_mostrar_usuarios" id="cantidad_mostrar_usuarios">
								<option value="10">10</option>
								<option value="25">25</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
						</p>

					</div>
		<div class="containerTable" id="listaUsuario">
			<!--CONTENIDO AJAX-->
		</div>
		<div class="paginador" id="paginadorUsuario">
			<!--CONTENIDO AJAX-->
		</div>
	</section>


		<?php include "includes/footer.php"?>

</body>
</html>