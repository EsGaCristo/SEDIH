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
	<title>GerenteHabitacion</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="index.css">

<script>
	function updateValue() {
		var hotelDiv =document.getElementById("nombreHotelito").textContent;
		hotelDiv = hotelDiv.replace("Hotel: ","").replace(" ","-");
		var input1Value = document.getElementById("input1").value;
		document.getElementById("input2").value =  hotelDiv + "-"+input1Value ;
		
		if(input1Value < 10){
			document.getElementById("input2").value = hotelDiv + "-0"+input1Value ;
		}else{
			document.getElementById("input2").value = hotelDiv + "-"+input1Value ;
		}
	
		}

	function validaEstadoTipo() {
	var th = document.forms[0].tipoHabitacion.value;
	var es = document.forms[0].estado.value;
			if (th == 0) {
				alert("Por favor, selecciona un tipo de habitación.");
				return false;
			}

			if (es == 0) {
				alert("Por favor, selecciona un estado.");
				return false;
			}
	return true; // Permite el envío del formulario si todas las opciones están seleccionadas
	}		
</script>

</head>

<body style="background: url('./src/assets/Fondo8.jpg') no-repeat; background-position: center; background-size: cover;">

	<div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;">
		BIENVENIDO A SEDIH
	</div>

	
	<div class="col-6 mt-3;" style=" margin-left: auto; margin-right: auto">
	<!----------------------------------------------Codigo de formulario-------------------------------------------------------------------------->
		<form class="row g-3; "
			style="background: transparent; border-radius: 20px;  backdrop-filter: blur(35px);"
			action="validarOpcionGerente.php?id=<?php echo $hotelid ?>" method="post" onsubmit="return validaEstadoTipo()">

			<div  class="col-12 mt-3">
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
			<div  class="col-12 mt-3" >
				<label for="input" class="form-label">ID</label>
				<input type="text" readonly class="form-control" name="idHabitacion" id="input2" required>
				<label for="input" class="form-label">NÚMERO</label>
				<input type="number" class="form-control" id = "input1" name="numHabitacion" onchange="updateValue()"required>
				<div class="col-md-6">
					<label for="input" class="form-label">TIPO DE HABITACION</label>
					<select class="form-select" aria-label="Default select example" name="tipoHabitacion" onchange="updateValue2()"
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
				<label for="input" class="form-label">ESTADO</label>
				<select class="form-select" aria-label="Default select example" name="estado" required>
					<option id="0" value="0" selected="selected">Seleccionar</option>
					<option value="DISPONIBLE">DISPONIBLE</option>
					<option value="OCUPADO">OCUPADO</option>
				</select>
				<label for="input" class="form-label">COSTO</label>
				<input type="number" readonly class="form-control" name="CostoHabitacion" id="CostoHabitacion" required>
				<div class="d-flex justify-content-end" style="margin-top:5px">
					<button type="submit" class="btn btn-primary col-auto" name="accion2" value="RegHab">Registrar Habitacion</button>
			</div>
		</form>
	</div>
	
	<form action="validarOpcionGerente.php?id=<?php echo $hotelid ?>" method="post">
		<label for="input" class="form-label">Cantidad de habitaciones en el Hotel</label>
		<input type="number" class="form-control" name="cantidadHabitaciones" id="cantidadHabitaciones">
		<div class="d-flex justify-content-end">
		<button method="post" type="submit" class="btn btn-primary col-auto" name="accion2" style="margin-top:5px"value="SaveCantHab">
				Guardar
			</button>
		</div>					
	</form>


	<form class="row g-3 mx-auto"
	style="max-width: 800px; margin-top: 20px; background: transparent; border-radius: 20px; backdrop-filter: blur(65px);"
	action="validarOpcionGerente.php?id=<?php echo $hotelid ?>" method="post">
	<div
		style="background: transparent; border-radius: 20px; backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;"
		class="col-12 mt-3">
		HABITACION
	</div>
	<div class="col-12 mt-3">
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
					<th>ID</th>
					<th>NÚMERO</th>
					<th>TIPO</th>
					<th>ESTADO</th>
					<th>COSTO</th>
					<th title="SELECCIONE LOS REGISTROS QUE DESEA ELIMINAR">
					SELECCIÓN
					</th>
				</tr>
				<?php
					include("src/database/conexion_bd.php");
					$query = "SELECT * FROM habitacion WHERE idHotel=$hotelid ORDER BY codigoHabitacion ASC";
					$result = mysqli_query($conexion, $query);
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr style='text-align: center;'>";
						echo "<td>" . $row["codigoHabitacion"] . "</td>";
						echo "<td>" . $row["numeroHabitacion"] . "</td>";
						echo "<td>" . $row["idTipo"] . "</td>";
						echo "<td>" . $row["estado"] . "</td>";
						echo "<td>" . $row["costo"] . "</td>";
						echo "<td title='SELECCIONE LOS REGISTROS QUE DESEA ELIMINAR'><input type='checkbox' name='eliminar[]' value='" . $row["numeroHabitacion"] . "'></td>"; // Agregar una columna con una casilla de verificación
						echo "</tr>";
					}
				?>
			</table>
		</div>
	</div>
	<div class="col-12 mt-3 text-center">
		<button type="submit" class="btn btn-primary" value="borrarHabitacion" name="accion3">Eliminar</button>
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