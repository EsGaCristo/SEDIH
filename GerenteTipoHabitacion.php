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
	<title>Tipo de Habitacion</title>
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

<body style="background: url('./src/assets/Fondo4.jpg') no-repeat; background-position: center; background-size: cover;">

	<div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;">
		BIENVENIDO A SEDIH
	</div>
		<!------------------------------------------------TIPOS DE HABITACION------------------------------------------------------------------------------------->

	<div class="col-6 mt-3;" style=" margin-left: auto; margin-right: auto">
	<!----------------------------------------------Codigo de formulario-------------------------------------------------------------------------->
		<form class="row g-3; "
			style="background: transparent; border-radius: 20px;  backdrop-filter: blur(35px);"
			action="validarOpcionGerente.php?id=<?php echo $hotelid ?>" method="post">
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
		
		</div>
		<div
				style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: cyan; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;">
				CONTROL - TIPOS DE HABITACION</div>
		<div class="col-md-13">
			<label for="input" class="form-label">Nombre</label>
			<input type="text" class="form-control" name="nombreHabitacion" >
			<label for="input" class="form-label">Cantidad de habitaciones</label>
			<input type="number" class="form-control" id = "input1" name="cantidadHab">
			<label for="input" class="form-label">Costo </label>
			<input type="number" class="form-control" id = "input1" name="costoHab">
			<div class="d-flex justify-content-end" style="margin-top:20px">
				<button type="submit" class="btn btn-primary" value = "insertarTipoHab" name="accion3" style="margin-left: 650px;">Registrar</button>
			</div>
		</div>
		</form>
	</div>
	
	<!------------------------------------------------Registro Cliente------------------------------------------------------------------------------------->
	<form class="row g-3 mx-auto"
	style="max-width: 800px; margin-top: 20px; background: transparent; border-radius: 20px; backdrop-filter: blur(35px);"
	action="validarOpcionGerente.php?id=<?php echo $hotelid ?>" method="post">
	<div
		style="background: transparent; border-radius: 20px; backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;"
		class="col-12 mt-3">
			TIPOS DE HABITACION</div>
		<div class="col-12 mt-3">
		<div class="table-responsive">
			<table style="color: white; width: 100%;" class="table">
				<tr style='text-align: center;'>
					<td>ID</td>
					<td>NOMBRE</td>
					<td>CANTIDAD</td>
					<td>COSTO</td>
					<td>SELECCION</td>
					<!------------------------------------------------Botones Dentro de Tabla--------------------------------------------------------------------------------- 
					<td>Eliminar </td> <td>Actualizar</td>---->
				</tr>
				<?php
					include("src/database/conexion_bd.php");
					$query = "SELECT * FROM tipoHabitacion WHERE idHotel=$hotelid";
					$result = mysqli_query($conexion, $query);
						while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr style='text-align: center;'>";
							echo "<td>" . $row["idTipo"] . "</td>";
							echo "<td>" . $row["nombre"] . "</td>";
							echo "<td>" . $row["cantidad"] . "</td>";
							echo "<td>" . $row["costo"] . "</td>";
							echo "<td><input type='checkbox' name='eliminar[]' value='" . $row["idTipo"] . "'></td>"; // Agregar una columna con una casilla de verificación
							echo "</tr>";
						}
				?>
			</table>
			</div>
		</div>
		<div class="col-12 mt-3 text-center">
			<button type="submit" class="btn btn-primary" value="borrar" name="accion3">Eliminar</button>
		</div>
		</form>


<div class="d-flex justify-content-center">
	<form class="row g-15 col-3"
		style="border-radius: 20px; margin-right: 9rem;  backdrop-filter: blur(30px);"
		method="POST"  action="Gerente.php?hotelid=<?php echo $hotelid ?>">
		<!-- mostrar el botón en el formulario -->
		<div class="button" style="text-align: center; margin-top: 20px; margin-bottom: 10px;">
			<button type="submit" class="btn btn-primary" name="btnSalirGerente">Volver</button>
		</div>
	</form>

	<form class="row g-15 col-3"
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