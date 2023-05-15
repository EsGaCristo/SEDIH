<?php
include("src/database/conexion_bd.php");
$mysqli = new mysqli("localhost", "root", "", "sedih", "3306");
$hotelid = isset($_GET['hotelid']) ? $_GET['hotelid'] : '';
$resultado = $mysqli->query("SELECT * FROM habitacion where idHotel = '$hotelid' && estado = 'DISPONIBLE' ");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<script>
		function validateMotivo() {
			var motivoVisita = document.forms[1].Motivo.value;
			if (motivoVisita == 0) {
				alert("Por favor, selecciona un motivo de visita.");
				return false;
			}
		}
	</script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gerente</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="index.css">
</head>
<body style="background: url('./src/assets/Fondo4.jpg') no-repeat; center center fixed; background-size: cover;">
	
	<div
		style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;">
		BIENVENIDO A SEDIH</div>
	
	<div class="col- mt-3;" style=" margin-left: auto; margin-right: auto">
	<!----------------------------------------------Codigo de formulario-------------------------------------------------------------------------->
	<form class="row g-3 mx-auto"
	style="max-width: 800px; margin-top: 20px; background: transparent; border-radius: 20px; backdrop-filter: blur(65px);"
		action="validarOpcionGerente.php?id=<?php echo $hotelid ?>" method="post">
			<div
		style="background: transparent; border-radius: 20px; backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;"
		class="col-12 mt-3">CONTROL DE REGISTROS</div>
		<div class="col-12 mt-3">
		<div style="background-color: transparent; overflow-x: auto;" class="table-wrapper">
					<style>
						.table-wrapper {
							height: 230px; /* Altura máxima de la tabla /
							overflow-y: scroll; / Agrega un scroll vertical */
						}
						table {
							width: 100%;
						}
					</style>
				<table style="color: white; width: 100%;" class='table'>
					<tr style='text-align: center;' >
						<td>ID</td>
						<td>FECHA DE ENTRADA</td>
						<td>FECHA DE SALIDA</td>
						<td>MOTIVO</td>
						<td>LUGAR</td>
						<td>HABITACIÓN</td>
						<td>TIPO</td>
						<!------------------------------------------------Botones Dentro de Tabla---------------------------------------------------------------------------------> 
					<?php
						include("src/database/conexion_bd.php");
						$query = "SELECT * FROM registrocliente rc INNER JOIN tipoHabitacion th where th.idTipo = rc.tipoHabitacion && th.idHotel=$hotelid";
						$result = mysqli_query($conexion, $query);
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<tr style='text-align: center;'>";
								echo "<td>" . $row["idRegistro"] . "</td>";
								echo "<td>" . $row["fechaHRegistro"] . "</td>";
								echo "<td>" . $row["fechaSalida"] . "</td>";
								echo "<td>" . $row["motivoVisita"] . "</td>";
								echo "<td>" . $row["lugarProcedencia"] . "</td>";
								echo "<td>" . $row["idHabitacion"] . "</td>";
								echo "<td>" . $row["tipoHabitacion"] . "</td>";
								echo "</tr>";
							}
					?>
				</table>
			</div>
		</div>
		</form>
	</div>

	<div class="col-12 mt-3;" style=" margin-left: auto; margin-right: auto">
	<form class="row g-3 mx-auto"
	style="max-width: 800px; margin-top: 20px; background: transparent; border-radius: 20px; backdrop-filter: blur(65px);"
	action="validarOpcionGerente.php?id=<?php echo $hotelid ?>" method="post" onsubmit="return validateMotivo()">
		<div
			style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;">
			ACTUALIZAR</div>

		<table style="color: white; width: 100%;">
			<tr>
				<td>ID</td>
				<td>FECHA DE ENTRADA</td>
				<td>FECHA DE SALIDA</td>
				<td>MOTIVO</td>
				<td>LUGAR</td>
				<!--<td>TIPO</td>-->
			</tr>

			<tr>
				<td><input type="text" class="form-control" name="idRegistro" required></td>
				<td><input type="date" class="form-control" name="fEntrada" required></td>
				<td><input type="date" class="form-control" name="fSalida" required></td>
				<td>						
					<select class="form-select" aria-label="Default select example" name="Motivo" id = "Motivo" required>
					<option id="0" value="0" selected="selected">Seleccionar</option>
					<option value="PLACER">PLACER</option>
					<option value="NEGOCIOS">NEGOCIOS</option>
					</select>
				</td>
				<td><input type="text" class="form-control" name="Lugar" required></td>
			</tr>
		</table>
		<div class="col-3" style="float: center; text-align: center; margin-top: 15px; margin-bottom: 200 px;">
			<button type="submit" class="btn btn-primary" name="accion" value = "actualizarRegistro"
				style="margin-left: 800;">Actualizar</button>
		</div>
	</form>

	</div>

	<div class="d-flex justify-content-center">
	<form class="row g-15 col-3"
		style="border-radius: 20px; margin-right: 75px;  backdrop-filter: blur(30px);"
		method="POST"  action="Gerente.php?hotelid=<?php echo $hotelid ?>">
		<!-- mostrar el botón en el formulario -->
		<div class="button" style="text-align: center; margin-top: 20px; margin-bottom: 10px;">
			<button type="submit" class="btn btn-primary" name="btnSalirGerente">Volver</button>
		</div>
	</form>

		<form class="row g-15 col-2"
			style="border-radius: 20px;  backdrop-filter: blur(30px);"
		method="POST" action="index.php">
			<!-- mostrar el botón en el formulario -->
		<div class="button" style="text-align: center; margin-top: 20px; margin-bottom: 10px;">
			<button type="submit" class="btn btn-primary" name="btnSalirGerente">Salir</button>
		</div>
	</form>
	</div>
</body>

</html>