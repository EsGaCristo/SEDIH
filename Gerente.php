<?php
include("src/database/conexion_bd.php");
$mysqli = new mysqli("localhost", "root", "", "sedih", "3306");
$hotelid = isset($_GET['hotelid']) ? $_GET['hotelid'] : '';
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

<body style="background: url('./src/assets/Fondo3.jpg') no-repeat; background-position: center; background-size: cover;">

	<div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;">
		BIENVENIDO A SEDIH
	</div>
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

    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
        <button type="submit" class="btn btn-primary" value="Salir" name="accion2">
            Salir
        </button>
    </div>
	</form>
	<div class="container mt-5">
	
	<!------------------------------------------------Registro Cliente------------------------------------------------------------------------------------->
	<form class="row g-3"
	style="margin-left: 5%; margin-right: 5%; margin-top: 20px; background: transparent; border-radius: 20px; backdrop-filter: blur(35px);"
	action="validarOpcionGerente.php?id=<?php echo $hotelid ?>" method="post">
	<div
		style="background: transparent; border-radius: 20px; backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;">
		REGISTRO CLIENTE</div>
	<div style="background-color: transparent; overflow-x: auto;">
		<table style="color: white; width: 100%;" class="table">
			<tr style='text-align: center;'>
				<td>ID</td>
				<td>FECHA DE ENTRADA</td>
				<td>FECHA DE SALIDA</td>
				<td>MOTIVO</td>
				<td>LUGAR</td>
				<td>HABITACIÓN</td>
				<td>TIPO</td>
				<td>SELECCIÓN</td>
				<!------------------------------------------------Botones Dentro de Tabla---------------------------------------------------------------------------------
					<td>Eliminar</td>
					<td>Actualizar</td>
				---->
			</tr>
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
						echo "<td style='text-align: center;'><input type='checkbox' name='eliminar[]' value='" . $row["idRegistro"] . "'></td>"; // Agregar una columna con una casilla de verificación y centrarla
						echo "</tr>";
					}
			?>
		</table>
	</div>

	<div class="d-flex justify-content-center" style="margin-bottom:10px">
		<div class="col-2" style="margin-right: 20px">
			<button type="submit" class="btn btn-primary" value="borrar" name="accion">Eliminar</button>
		</div>
	
		<div class="col-3">
			<button type="submit" class="btn btn-primary" value="actualizar" name="accion">Control de registros</button>
		</div>
	</div>
	

</form>
</div>

</body>

</html>