<?php
include("src/database/conexion_bd.php");
$mysqli = new mysqli("localhost", "root", "", "sedih", "3306");
$hotelid = isset($_GET['hotelid']) ? $_GET['hotelid'] : '';

//Actualizar ocupado a disponible si ya pasó la fecha de salida
$ayer = date('Y/m/d', strtotime('-2 day'));
$sqlup = "UPDATE habitacion SET estado  = 'DISPONIBLE' WHERE codigoHabitacion IN 
(SELECT idHabitacion from registrocliente where fechaSalida = '$ayer')";

if (mysqli_query($conexion, $sqlup)) {

} else {
    echo "Error en la actualización: " . mysqli_error($conexion);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<script>
function updateValue2() {
  var select = document.getElementById("tipoHabitacion");
  var idTipo = select.options[select.selectedIndex].value;
  if (idTipo != 0) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("CostoHabitacion").value = this.responseText;
      }
    };
    xhr.open("GET", "crud/obtener_costo_habitacion.php?idTipo=" + idTipo, true);
    xhr.send();
  }
}
</script>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gerente</title>
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

<body style="background: url('./src/assets/Fondo3.jpg') no-repeat; center center fixed; background-size: cover;">
	<div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;">
		BIENVENIDO A SEDIH
	</div>


	<div class="container mt-2" >
	<!------------------------------------------------Registro Cliente------------------------------------------------------------------------------------->
		<form class="row g-3" style="margin-left: 5%; margin-right: 5%; margin-top: 10px; background: transparent; border-radius: 20px; backdrop-filter: blur(35px);"
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
				style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;">
		HISTORIAL DE REGISTROS</div>	
				<div style="background-color: transparent; overflow-x: auto;" class="table-wrapper">
					<style>
						.table-wrapper {
							height: 250px; /* Altura máxima de la tabla /
							overflow-y: scroll; / Agrega un scroll vertical */
						}
						table {
							width: 100%;
						}
					</style>
				<table style="color: white; width: 100%;" class="table">
					<tr style='text-align: center;'>
						<td>ID</td>
						<td>FECHA DE ENTRADA</td>
						<td>FECHA DE SALIDA</td>
						<td>MOTIVO</td>
						<td>LUGAR</td>
						<td>HABITACIÓN</td>
						<td>TIPO</td>
						<td title="SELECCIONE LOS REGISTROS QUE DESEA ELIMINAR">SELECCIÓN</td>
					</tr>
					<?php
						include("src/database/conexion_bd.php");
						$query = "SELECT * FROM registrocliente rc WHERE idHotel = $hotelid";
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
								echo "<td title='SELECCIONE LOS REGISTROS QUE DESEA ELIMINAR' style='text-align: center;'><input type='checkbox' name='eliminar[]' value='" . $row["idRegistro"] . "'></td>"; // Agregar una columna con una casilla de verificación y centrarla
								echo "</tr>";
							}
					?>
				</table>
			</div>
			<div class="d-flex justify-content-center" style="margin-bottom:10px">
				<div class="col-3" style="margin-right: 20px">
					<button type="submit" class="btn btn-primary" value="borrar" name="accion">Eliminar</button>
				</div>
			
				<div class="col-3">
					<button type="submit" class="btn btn-primary" value="actualizar" name="accion">Control de registros</button>
				</div>
			</div>
	</form>
</div>

<div class="container mt-3">
	<form class="row g-3 mx-sm-3 mx-md-5 mx-lg-5 mx-xl-5 mt-3 text-center"
		style="background: transparent; border-radius: 20px; backdrop-filter: blur(30px);"
		action="validarOpcionGerente.php?id=<?php echo $hotelid ?>" method="post">

		<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-3">
			<button type="submit" class="btn btn-primary" value="RegHabitacion" name="accion2">
				Control de Habitaciones
			</button>
		</div>

		<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-3">
			<button type="submit" class="btn btn-primary" value="RegTipoHab" name="accion2">
				Control de Tipos de Habitación
			</button>
		</div>

		<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-3">
			<button type="submit" class="btn btn-primary" value="verEstadisticas" name="accion2">
				Ver estadísticas
			</button>
		</div>

		<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-3">
			<button type="submit" class="btn btn-primary" value="Salir" name="accion2">
				Salir
			</button>
		</div>
	</form>
</div>
</body>

</html>