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
	
	<title>Pestaña Administrador</title>
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="index.css">
</head>

<body style="background: url('./src/assets/Fondo4.jpg')no-repeat;">
<!-- BIENVENIDO A SEDIH (ADMINISTRADOR) -->
<div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;"> BIENVENIDO A SEDIH (ADMINISTRADOR)</div>

<div class="form-wrapper">
	<form class="row g-2" style="margin-left: 50px; margin-right: 0px; margin-top: 20px; background: transparent; border-radius: 20px;  backdrop-filter: blur(35px);"
	action="insertarHotelAdministrador.php?id=<?php echo $hotelid ?>" method="post">
	<!-- formulario Izquierdo AGREGAR HOTEL-->		
		<div class="col-md-13">
			<div
				style="background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px; margin-top: 10px; " >
				AGREGAR HOTEL
			</div>
		</div>

		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">NOMBRE</label>
			<input type="text" class="form-control" name="Nombre" style="margin-left: 35px; margin-right: 20px ; margin-top: 5px;">
		</div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">CATEGORIA</label>
			<input type="text" class="form-control" name="Categoria" style="margin-left: 10px; margin-right: 20px  ; margin-top: 5px; ">
	    </div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">DOMICILIO</label>
			<input type="text" class="form-control" name="Domicilio" style="margin-left: 10px;margin-right: 20px  ; margin-top: 5px;">
		</div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">OCUPACION</label>
			<input type="text" class="form-control" name="Ocupacion" style="margin-left: 10px; margin-right: 20px  ; margin-top: 5px;">
		</div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">UBICACION</label>
			<input type="text" class="form-control" name="Ubicacion" style="margin-left: 10px; margin-right: 20px  ; margin-top: 5px;">
		</div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">NUMERO DE HABITACION</label>
			<input type="text" class="form-control" name="NoHabitantes" style="margin-left: 10px; margin-right: 20px  ;margin-top: 5px;">
		</div>

		<div class="col-3" style="text-align: center; margin-top: 15px; margin-bottom: 0 px;">
				<button type="submit" class="btn btn-primary" name="btnInsertar"style="margin-left: 625px;">
				Agregar
				</button>
		</div>

   </form>
   <!-- formulario Izquierdo ACTUALIZAR DATOS DE HOTEL-->
</div>
<div class="form-wrapper">
  <form class="row g-2" style="margin-left: 50px; margin-right: 0px; margin-top: 20px; background: transparent; border-radius: 20px;  backdrop-filter: blur(35px);"
  action="actualizarRegistrosGerente.php?id=<?php echo $hotelid ?>" method="post">

	<div class="col-md-13">
		<div
			style="background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px; margin-top: 10px;">
			ACTUALIZAR DATOS DEL HOTEL
		</div>
	</div>

		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">idHotel</label>
			<input type="text" class="form-control" name="id" style="margin-left: 35px; margin-right: 20px  ; margin-top: 5px;">
		</div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">NOMBRE</label>
			<input type="text" class="form-control" name="nombre" style="margin-left: 35px; margin-right: 20px  ; margin-top: 5px;">
		</div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">CATEGORIA</label>
			<input type="text" class="form-control" name="Categoria" style="margin-left: 10px; margin-right: 20px  ; margin-top: 5px; ">
	    </div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">DOMICILIO</label>
			<input type="text" class="form-control" name="Domicilio" style="margin-left: 10px;margin-right: 20px  ; margin-top: 5px;">
		</div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">OCUPACION</label>
			<input type="text" class="form-control" name="Ocupacion" style="margin-left: 10px; margin-right: 20px  ; margin-top: 5px;">
		</div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">UBICACION</label>
			<input type="text" class="form-control" name="Ubicacion" style="margin-left: 10px; margin-right: 20px  ; margin-top: 5px;">
		</div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">NUMERO DE HABITACION</label>
			<input type="text" class="form-control" name="NoHabitaciones" style="margin-left: 10px; margin-right: 20px  ;margin-top: 5px;">
		</div>
		<div class="col-3" style="text-align: center; margin-top: 15px; margin-bottom: 0 px;">
				<button type="submit" class="btn btn-primary" name="btnAplicar"style="margin-left: 625px;">
				Aplicar Cambios
				</button>
		</div>

	<!-- formulario Derecho -->
  </form>
</div>

<style>
  .form-wrapper {
    width: 49%;
    display: inline-block; /* o display: flex; */
  }
</style>



<!------------------------------------------------HOTELES REGISTRADOS------------------------------------------------------------------------------------->
	<form class="row g-3"
		style="margin-left: 400px; margin-right: 400px; margin-top: 20px; background: transparent; border-radius: 20px;  backdrop-filter: blur(35px);"
		action="BorrarAdministrador.php" method="post">
		<div
			style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;">
			HOTELES REGISTRADOS</div>

		<div style="background-color: transparent;">
			<table style="color: white; width: 100%;">
				<tr>
					<td>ID</td>
					<td>NOMBRE</td>
					<td>CATEGORIA</td>
					<td>DOMICILIO</td>
					<td>OCUPACION</td>
					<td>UBICACION</td>
					<td>NUMERO DE HABITACIONES</td>
	
				</tr>

				<?php
				include("src/database/conexion_bd.php");
				$query = "SELECT * FROM hotel";
				$result = mysqli_query($conexion, $query);

				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row["idHotel"] . "</td>";
					echo "<td>" . $row["nombre"] . "</td>";
					echo "<td>" . $row["categoria"] . "</td>";
					echo "<td>" . $row["domicilio"] . "</td>";
					echo "<td>" . $row["ocupacion"] . "</td>";
					echo "<td>" . $row["ubicacion"] . "</td>";
					echo "<td>" . $row["noHabitaciones"] . "</td>";
					echo "<td><input type='checkbox' name='eliminar[]' value='" . $row["idHotel"] . "'></td>"; // Agregar una columna con una casilla de verificación
					echo "</tr>";
				}

				?>
			</table>
		</div>
		<div class="col-13" style="float: center; text-align: center; margin-top: 15px; margin-bottom: 200 px;">
			<button type="submit" class="btn btn-primary" name="btnBorrar" style="margin-left: 800;">Eliminar</button>
		</div>
	</form>





</body>
</html>
