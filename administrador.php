<?php
include("src/database/conexion_bd.php");
$mysqli = new mysqli("localhost", "root", "", "sedih", "3306");
$hotelid = isset($_GET['hotelid']) ? $_GET['hotelid'] : '';
$resultado = $mysqli->query("SELECT * FROM hotel ");
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
	action="validarOpcionesAdmin.php?id=<?php echo $hotelid ?>" method="post">
	<!-- formulario Izquierdo AGREGAR HOTEL-->		
		<div class="col-md-13">
			<div
				style="background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px; margin-top: 10px; " >
				AGREGAR HOTEL
			</div>
		</div>

		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">NOMBRE</label>
			<input type="text" class="form-control" name="Nombre" style="margin-left: 105px; margin-right: 20px ; margin-top: 5px;">
		</div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">CATEGORIA</label>
			<input type="text" class="form-control" name="Categoria" style="margin-left: 80px; margin-right: 20px  ; margin-top: 5px; ">
	    </div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">DOMICILIO</label>
			<input type="text" class="form-control" name="Domicilio" style="margin-left: 90px;margin-right: 20px  ; margin-top: 5px;">
		</div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">OCUPACION</label>
			<input type="text" class="form-control" name="Ocupacion" style="margin-left: 77px; margin-right: 20px  ; margin-top: 5px;">
		</div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">UBICACION</label>
			<input type="text" class="form-control" name="Ubicacion" style="margin-left: 83px; margin-right: 20px  ; margin-top: 5px;">
		</div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">NUMERO DE HABITACIONES</label>
			<input type="number" class="form-control" name="NoHabitaciones" style="margin-left: 10px; margin-right: 20px  ;margin-top: 5px;">
		</div>

		<div class="col-20" style=" display: flex; text-align: center; margin-top: 15px; margin-bottom: 0 px;" >
			
			<label for="input" class="form-label" style="margin-left: 10px;" >ID Hotel</label>
			<input type="text" class="form-control" name="idH" style="margin-left: 120px; margin-right: 0px  ;margin-top: 5px;">

			<button type="submit" class="btn btn-primary" value = "agregar" name="accion"style="margin-left: 8px; margin-right: 10px">
			Agregar
			</button>

			<button type="submit" class="btn btn-primary" value = "actualizar" name="accion" style="margin-left: 10px; margin-right: 8px">
			Aplicar Cambios
			</button>

		</div>

   </form>
 

</div>
<div class="form-wrapper">
  <form class="row g-2" style="margin-left: 50px; margin-right: 0px; margin-top: 20px; background: transparent; border-radius: 20px;  backdrop-filter: blur(35px);"
  action="validarOpcionesAdmin.php?id=<?php echo $hotelid ?>" method="post">

	<div class="col-md-13">
		<div
			style="background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px; margin-top: 10px;">
			AGREGAR USUARIO
		</div>
	</div>

	<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">Tipo</label>
			<select class="form-select" aria-label="Default select example" name="tipo" required style="margin-left: 120px; margin-right: 20px ; margin-top: 5px;">
				<option id="0" value="0" selected="selected">Seleccionar</option>
				<option value=3>GERENTE</option>
				<option value=2>CAPTURISTA</option>
			</select>
		</div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">Correo</label>
			<input type="text" class="form-control" name="correo" style="margin-left: 100px; margin-right: 20px  ; margin-top: 5px; ">
	    </div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">ID Hotel</label>
			<select class="form-select" aria-label="Default select example"  name="idHo" style="margin-left: 100px; margin-right: 20px  ; margin-top: 5px; "required>
				<option value="0">Seleccionar</option>

				<?php while ($row = $resultado->fetch_assoc()) { ?>
					<option value="<?php echo $row['idHotel']; ?>"><?php echo $row['nombre']; ?></option>
				<?php } ?>
			</select>
		</div>
		<div style="display: flex; align-items: center;">
			<label for="input" class="form-label">Contraseña</label>
			<input type="text" class="form-control" name="contra" style="margin-left: 60px; margin-right: 20px  ; margin-top: 5px;">
		</div>


		<div class="col-20" style=" display: flex; text-align: center; margin-top: 15px; margin-bottom: 0 px;" >
			
			<label for="input" class="form-label" style="margin-left: 10px;" >ID Usuario</label>
			<input type="text" class="form-control" name="idUs" style="margin-left: 80px; margin-right: 0px  ;margin-top: 10px;">

			<button type="submit" class="btn btn-primary" value="agregar" name="accion2"style="margin-left: 8px; margin-right: 10px">
			Agregar
			</button>

			<button type="submit" class="btn btn-primary" value= "actualizar" name="accion2" style="margin-left: 10px; margin-right: 8px">
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
		style="margin-left: 100px; margin-right: 100px; margin-top: 20px; background: transparent; border-radius: 20px;  backdrop-filter: blur(35px);"
		action="validarOpcionesAdmin.php?id=<?php echo $hotelid ?>" method="post">
		<div
			style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;">
			CONTROL DE HOTELES Y USUARIOS</div>

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
		<div class="col-13" style="float: center; text-align: center; margin-top: 15px; margin-bottom: 200 px; mar">
			<button type="submit" class="btn btn-primary" value= "eliminar" name="accion3" style="margin-left: 800; margin-top: 15px">Eliminar hotel</button>
		</div>	
		<table style="color: white; width: 100%;">
				<tr>
					<td>ID</td>
					<td>TIPO</td>
					<td>HOTEL</td>
					<td>Correo</td>
					<td>CONTRASEÑA</td>
				</tr>

				<?php
				include("src/database/conexion_bd.php");
				$query = "SELECT * FROM usuarios";
				$result = mysqli_query($conexion, $query);

				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row["idUsuario"] . "</td>";
					echo "<td>" . $row["tipo"] . "</td>";
					echo "<td>" . $row["idHotel"] . "</td>";
					echo "<td>" . $row["correo"] . "</td>";
					echo "<td>" . $row["userPass"] . "</td>";
					echo "<td><input type='checkbox' name='eliminar2[]' value='" . $row["idUsuario"] . "'></td>"; // Agregar una columna con una casilla de verificación
					echo "</tr>";
				}

				?>
			</table>
			
		<div>	
			<button type="submit" class="btn btn-primary" value= "borrarusuarios" name="accion3" style="margin-left: 800; margin-top: 15px ">Borrar usuarios</button>
		</div>
	</form>
</div>

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
