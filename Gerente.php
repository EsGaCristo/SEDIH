<?php
include("src/database/conexion_bd.php");
$mysqli = new mysqli("localhost", "root", "", "sedih", "3306");
$hotelid = isset($_GET['hotelid']) ? $_GET['hotelid'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="index.css">

<script>
	function updateValue() {
		var hotelDiv =document.getElementById("nombreHotelito").textContent;
		hotelDiv = hotelDiv.replace("Hotel: ","").replace(" ","-");
		var input1Value = document.getElementById("input1").value;
		document.getElementById("input2").value =  hotelDiv + "-"+input1Value ;
		}
</script>

</head>

<body style="background: url('./src/assets/Fondo4.jpg')no-repeat; background-position: center;">

	<div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;">
		BIENVENIDO A SEDIH
	</div>

	<!----------------------------------------------Codigo de formulario-------------------------------------------------------------------------->
	<form class="row g-3"
		style="margin-left: 400px; margin-right: 400px; margin-top: 20px; background: transparent; border-radius: 20px;  backdrop-filter: blur(35px);"
		action="insertargerente.php?id=<?php echo $hotelid ?>" method="post">

		<div class="col-md-13">
			<div
				style=" float: left; background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: LEFT; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;">
				CUENTA: GERENTE</div>

			<?php
			$query = $mysqli->query("SELECT nombre FROM hotel where idHotel =  '$hotelid' ");
			while ($valores = mysqli_fetch_array($query)) {
				echo '<div id = "nombreHotelito" style=" float: RIGHT; background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: RIGHT; color: WHITE; font-family: Impact, Haettenschweiler, Arial Narrow Bold, sans-serif; font-size: 25px;">Hotel: ' . $valores['nombre'] . '</div>';
			}
			?>
			<div
				style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;">
				HABITACIONES</div>
		</div>
		<!------------------------------------------------HABITACIONES------------------------------------------------------------------------------------->

		<div class="col-md-13">
			<label for="input" class="form-label">ID</label>
			<input type="text" readonly class="form-control" name="idHabitacion" id="input2">

			<label for="input" class="form-label">NÚMERO</label>
			<input type="number" class="form-control" id = "input1" name="numHabitacion" onchange="updateValue()">

			<div class="col-md-6">
				<label for="input" class="form-label">TIPO DE HABITACION</label>
				<select class="form-select" aria-label="Default select example" name="tipoHabitacion"
					id="tipoHabitacion" required>
					<option value="0">Seleccionar</option>
					<?php
					$query = $mysqli->query("SELECT * FROM tipohabitacion where idHotel=$hotelid");
					while ($valores = mysqli_fetch_array($query)) {
						echo '<option value="' . $valores['idTipo'] . '">' . $valores['nombre'] . '</option>';
					}
					?>
				</select>
			</div>
			<label for="input" class="form-label">Estado</label>
			<select class="form-select" aria-label="Default select example" name="estado" required>
				<option id="0" value="0" selected="selected">Seleccionar</option>
				<option value="DISPONIBLE">DISPONIBLE</option>
				<option value="OCUPADO">OCUPADO</option>
			</select>

			<label for="input" class="form-label">Costo</label>
			<input type="text" class="form-control" name="CostoHabitacion" required>

			<div class="col-3" style="text-align: center; margin-top: 15px; margin-bottom: 0 px;">
				<button type="submit" class="btn btn-primary" name="btnIngresar"
					style="margin-left: 785px;">Enviar</button>
			</div>
		</div>
	</form>
	<!------------------------------------------------Registro Cliente------------------------------------------------------------------------------------->
	<form class="row g-3"
		style="margin-left: 400px; margin-right: 400px; margin-top: 20px; background: transparent; border-radius: 20px;  backdrop-filter: blur(35px);"
		action="validarOpcionGerente.php?id=<?php echo $hotelid ?>" method="post">
		<div
			style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;">
			REGISTRO CLIENTE</div>

		<div style="background-color: transparent;">
			<table style="color: white; width: 100%;">
				<tr>
					<td>ID</td>
					<td>FECHA DE ENTRADA</td>
					<td>FECHA DE SALIDA</td>
					<td>MOTIVO</td>
					<td>LUGAR</td>
					<td>HABITACIÓN</td>
					<td>TIPO</td>
					<!------------------------------------------------Botones Dentro de Tabla--------------------------------------------------------------------------------- 
					<td>Eliminar </td> <td>Actualizar</td>---->
				</tr>

				<?php
					include("src/database/conexion_bd.php");
					$query = "SELECT * FROM registrocliente rc INNER JOIN tipoHabitacion th where th.idTipo = rc.tipoHabitacion && th.idHotel=$hotelid";
					$result = mysqli_query($conexion, $query);
						while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr>";
							echo "<td>" . $row["idRegistro"] . "</td>";
							echo "<td>" . $row["fechaHRegistro"] . "</td>";
							echo "<td>" . $row["fechaSalida"] . "</td>";
							echo "<td>" . $row["motivoVisita"] . "</td>";
							echo "<td>" . $row["lugarProcedencia"] . "</td>";
							echo "<td>" . $row["idHabitacion"] . "</td>";
							echo "<td>" . $row["tipoHabitacion"] . "</td>";
							echo "<td><input type='checkbox' name='eliminar[]' value='" . $row["idRegistro"] . "'></td>"; // Agregar una columna con una casilla de verificación
							echo "</tr>";
						}
				?>
			</table>
		</div>
		<div class="col-3" style="float: center; text-align: center; margin-top: 15px; margin-bottom: 200 px;">
			<button type="submit" class="btn btn-primary" value = "borrar" name="accion" style="margin-left: 800;">Eliminar</button>
		</div>
		<div class="col-3" style="float: center; text-align: center; margin-top: 15px; margin-bottom: 200 px;">
			<button type="submit" class="btn btn-primary" value = "actualizar" name="accion"
				style="margin-left: 800;">Actualizar</button>
		</div>
	</form>

	<form class="row g-3"
		style="margin-left: 500px; margin-right: 500px; margin-top: 20px; background: transparent; border-radius: 20px;  backdrop-filter: blur(30px);"
		method="POST" action="index.php">
		<!-- mostrar el botón en el formulario -->
		<div class="button" style="text-align: center; margin-top: 20px; margin-bottom: 10px;">
			<button type="submit" class="btn btn-primary" name="btnSalirGerente">Salir</button>
		</div>
	</form>

</body>

</html>