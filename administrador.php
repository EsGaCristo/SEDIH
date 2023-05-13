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

<body style="background: url('./src/assets/Fondo7.jpg') no-repeat; background-position: center; background-size: cover;">

<!-- BIENVENIDO A SEDIH (ADMINISTRADOR) -->
<div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;"> BIENVENIDO A SEDIH (ADMINISTRADOR)</div>
<div style="display: flex;">
<!-- CODIGO DE AGREGAR HOTEL-->
<div class="col-4 mt-3;" style=" margin-left: auto; margin-right: auto; margin-top: 8px; margin-bottom: 8px">
<form class="row g-3" style="margin-left: 50px; margin-right: 0px; margin-top: 20px; background: transparent; border-radius: 20px;  backdrop-filter: blur(35px);"
	action="validarOpcionesAdmin.php?id=<?php echo $hotelid ?>" method="post" onsubmit="return validateCategoria()">
	<!-- formulario Izquierdo AGREGAR HOTEL-->		
			<div class="col-md-13">
				<div
					style="background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;" >
					AGREGAR HOTEL
				</div>
			</div>

			<div class="col-md-12">
				<label for="input" class="form-label">NOMBRE</label>
				<input type="text" class="form-control" name="Nombre" required>
				<label for="input" class="form-label">CATEGORIA</label>
				<select class="form-select" aria-label="Default select example"  name="Categoria"required>
					<option value="0">Seleccionar</option>
					<option value="1">1 ESTRELLA</option>
					<option value="2">2 ESTRELLAS</option>
					<option value="3">3 ESTRELLAS</option>
					<option value="4">4 ESTRELLAS</option>
					<option value="5">5 ESTRELLAS</option>
				</select>
				<label for="input" class="form-label">DOMICILIO</label>
				<input type="text" class="form-control" name="Domicilio"required>
				<label for="input" class="form-label">UBICACION</label>
				<input type="text" class="form-control" name="Ubicacion"required>
					<div class="d-flex justify-content-end" style="margin-top:20px">
						<button type="submit" class="btn btn-primary btn-sm float-end col-md-5" value="agregar" name="accion">
							Agregar
						</button>
						</div>		
					<label for="input" class="form-label" style="margin-left: 10px;" >ID Hotel</label>
				<input type="text" class="form-control" name="idH">
					<div class="d-flex justify-content-end" style="margin-top:20px; margin-bottom:10px;">
						<button type="submit" class="btn btn-primary btn-sm float-end col-md-5" value = "actualizar" name="accion" style="margin-left: 10px; margin-right: 8px">
						Aplicar Cambios
						</button>
					</div>
			</div>
	</form>
</div>
<!-- CODIGO DE AGREGAR USUARIOS-->
<div class="col-4 mt-3;" style=" margin-left: auto; margin-right: auto; margin-top 8px; margin-bottom: 8px">
	<form class="row g-3" style="margin-left: 50px; margin-right: 0px; margin-top: 20px; background: transparent; border-radius: 20px;  backdrop-filter: blur(35px);"
	action="validarOpcionesAdmin.php?id=<?php echo $hotelid ?>" method="post" onsubmit="return validateTipoidHotel()">

		<div class="col-md-13">
			<div
			style="background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px; margin-top: 10px; " >
					AGREGAR USUARIO
			</div>
		</div>

		<div class="col-md-12">
			<label for="input" class="form-label">Tipo</label>
			<select class="form-select" aria-label="Default select example" name="tipo" required >
				<option id="0" value="0" selected>Seleccionar</option>
				<option value=3>GERENTE</option>
				<option value=2>CAPTURISTA</option>
			</select>
			<label for="input" class="form-label">Correo</label>
			<input type="text" class="form-control" name="correo" required>
	    	<label for="input" class="form-label">ID Hotel</label>
			<select class="form-select" aria-label="Default select example"  name="idHo"required>
				<option value="0">Seleccionar</option>

				<?php while ($row = $resultado->fetch_assoc()) { ?>
					<option value="<?php echo $row['idHotel']; ?>"><?php echo $row['nombre']; ?></option>
				<?php } ?>
			</select>
			<label for="input" class="form-label">Contraseña</label>
			<input type="text" class="form-control" name="contra" required>	
			<div class="d-flex justify-content-end" style="margin-top:20px">		
				<button type="submit" class="btn btn-primary btn-sm float-end col-md-5" value="agregar" name="accion2"style="margin-left: 8px; margin-right: 10px">
				Agregar
				</button>
			</div>
			<label for="input" class="form-label">ID Usuario</label>
			<input type="text" class="form-control" name="idUs" >
			
			<div class="d-flex justify-content-end" style="margin-top:20px; margin-bottom:10px">					
				<button type="submit" class="btn btn-primary btn-sm float-end col-md-5" value= "actualizar" name="accion2" style="margin-left: 10px; margin-right: 8px">
				Aplicar Cambios
				</button>
			</div>
			
		</div>

	<!-- formulario Derecho -->
  </form>
</div>

</div>


<style>
	.form-wrapper {
		width: 49%;
		display: inline-block; /* o display: flex; */
	}

	#tablaContainer {
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100vh;
	}

	#tablaContainer table {
		margin: 0 auto;
	}
</style>
<div class="container mt-5">
	<!------------------------------------------------HOTELES Y USUARIOS------------------------------------------------------------------------------------->
	<form class="row g-3"
		style="margin-left: 100px; margin-right: 100px; margin-top: 20px; background: transparent; border-radius: 20px;  backdrop-filter: blur(35px);"
		action="validarOpcionesAdmin.php?id=<?php echo $hotelid ?>" method="post">
		<div
			style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;"
			id = 'etiquetaHotelUsuario'>
			CONTROL DE HOTELES Y USUARIOS</div>

		<div style="background-color: transparent ;" >
		<div class="table-responsive" style="max-width: 100%;">
<!--------------------------------TABLA DE HOTELES--------------------------------------------------------------------------------------------------------->
			<table style="color: white; width: 100%; margin-right: auto; margin-top: auto;" id="TablaHoteles" class="table" >
				<tr style='text-align: center;'>
					<td>ID</td>
					<td>NOMBRE</td>
					<td>CATEGORIA</td>
					<td>DOMICILIO</td>
					<td>OCUPACION</td>
					<td>UBICACION</td>
					<td>NUMERO DE HABITACIONES</td>
					<td title='SELECCIONE LOS REGISTROS QUE DESEA ELIMINAR'>SELECCIÓN</td>
	
				</tr>

				<?php
				include("src/database/conexion_bd.php");
				$query = "SELECT * FROM hotel";
				$result = mysqli_query($conexion, $query);

				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr style='text-align: center;'>";
					echo "<td>" . $row["idHotel"] . "</td>";
					echo "<td>" . $row["nombre"] . "</td>";
					echo "<td>" . $row["categoria"] . "</td>";
					echo "<td>" . $row["domicilio"] . "</td>";
					echo "<td>" . $row["ocupacion"] . "</td>";
					echo "<td>" . $row["ubicacion"] . "</td>";
					echo "<td>" . $row["noHabitaciones"] . "</td>";
					echo "<td title='SELECCIONE LOS REGISTROS QUE DESEA ELIMINAR'><input type='checkbox' name='eliminar[]' value='" . $row["idHotel"] . "'></td>"; // Agregar una columna con una casilla de verificación
					echo "</tr>";
				}

				?>
			</table>
			</div>
		</div>

		
		<!--------------------------------TABLA DE USUARIOS--------------------------------------------------------------------------------------------------------->
		<div style="background-color: transparent;" >
		<div class="table-responsive" id="TablaUsuarios" style="max-width: 100%; display: none; justify-content: center;">
  <table style="color: white; width: 100%; text-align: center;"  class="table">
    <tr style='text-align: center;'>	<td>ID</td>
						<td>TIPO</td>
						<td>HOTEL</td>
						<td>Correo</td>
						<td>CONTRASEÑA</td>
						<td title='SELECCIONE LOS REGISTROS QUE DESEA ELIMINAR'>SELECCIÓN</td>
				
					</tr>

					<?php
					include("src/database/conexion_bd.php");
					$query = "SELECT * FROM usuarios";
					$result = mysqli_query($conexion, $query);

					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr style='text-align: center;'>";
						echo "<td>" . $row["idUsuario"] . "</td>";
						echo "<td>" . $row["tipo"] . "</td>";
						echo "<td>" . $row["idHotel"] . "</td>";
						echo "<td>" . $row["correo"] . "</td>";
						echo "<td>" . $row["userPass"] . "</td>";
						echo "<td title='SELECCIONE LOS REGISTROS QUE DESEA ELIMINAR'><input type='checkbox' name='eliminar2[]' value='" . $row["idUsuario"] . "'></td>"; // Agregar una columna con una casilla de verificación
						echo "</tr>";
					}

					?>
				</table>
			</div>
		</div>	
			
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-3 mb-3">
				<button type="submit" class="btn btn-primary"  value="eliminar" id="eliminarHotel"name="accion3">Eliminar hotel</button>
			</div>
			
			<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-3 mb-3">
				<button type="submit" class="btn btn-primary"  value="borrarusuarios" id="borrarUsuarios" name="accion3" disabled>Borrar usuarios</button>
			</div>

		</div>
	</form>
</div>	

	<div class="col-8" style=" display: flex; text-align: center; margin-left: 195px; margin-top: 15px; margin-bottom: 0 px;" >
		<button id="boton" type="button" class="btn btn-primary" style="margin-right: 10px; display: inline-block; margin-left: 70px;">Cambiar Tabla</button>
		<button type="button" class="btn btn-primary" onclick="window.location.href='index.php';" style="display: inline-block; margin-left: 15px; margin-right: 30px;">Salir</button>
	</div>

	<script>
		var tabla1 = document.getElementById("TablaHoteles");
		var tabla2 = document.getElementById("TablaUsuarios");
		var boton = document.getElementById("boton");
		var etiqueta =document.getElementById("etiquetaHotelUsuario");
		var boton1 = document.getElementById("eliminarHotel");
		var boton2 = document.getElementById("borrarUsuarios");
		
		boton.onclick = function() {
			if (tabla1.style.display !== "none") {
			tabla1.style.display = "none";
			tabla2.style.display = "flex";
			etiqueta.innerHTML = "Usuarios";
			boton1.disabled = true;
			boton2.disabled = false;
			} else {
			tabla1.style.display = "block";
			tabla2.style.display = "none";
			etiqueta.innerHTML = "Hoteles";
			boton2.disabled = true;
			boton1.disabled = false;
			}
		};
			function validateCategoria() {
			var cat = document.forms[0].Categoria.value;
			if (cat == 0) {
				alert("Por favor, selecciona una categoria.");
				return false;
			}
			return true;
			}	

			function validateTipoidHotel() {
			var tipoU = document.forms[1].tipo.value;
				if(tipoU==0){
					alert("Por favor, selecciona un tipo de usuario.");
					return false;
				}

			var idHot =document.forms[1].idHo.value;
				if(idHot==0){
					alert("Por favor, selecciona un hotel.");
					return false;
				}


			return true;
			}
				
	</script>

</body>
</html>