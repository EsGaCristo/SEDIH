<?php 
	include("src/database/conexion_bd.php");
	$mysqli = new mysqli("localhost","root","","sedih","3306");
	if (isset($_GET["mensaje"])) {
		setcookie("datos", $_GET["mensaje"], time() + 3600); // cookie durará 1 hora
	}
	$datos = isset($_COOKIE["datos"]) ? $_COOKIE["datos"] : '';

	$resultado = $mysqli -> query ("SELECT idTipo , nombre FROM tipoHabitacion where idHotel = $datos ");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script lenguage= "javascript" src="jquery-3.6.4.js"></script>
	
	<script lenguage="javascript">
		$(document).ready(function(){
			
			$("#tipoHab").change(function(){
				$("#tipoHab option:selected").each(function(){
					idTipo = $(this).val();
					$.post("crud/getHabitaciones.php?",{idTipo:idTipo
					},function(data){			
						$("#idHab").html(data);
					});
				});
			})
		});
	</script>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SEDIH</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="index.css">

</head>
<body style="background: url('./src/assets/Fondo3.jpg')no-repeat; background-position: center; background-size: cover;">
		<div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;"> BIENVENIDO A SEDIH</div>
		<?php	
			$query = $mysqli -> query ("SELECT nombre FROM hotel where idHotel =  '$datos' ");
			while ($valores = mysqli_fetch_array($query)) {
			echo '<div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, Arial Narrow Bold, sans-serif; font-size: 35px;"> Hotel '.$valores['nombre'].'</div>';
			}
		?>

		<!----------------------------------------------Codigo de formulario---------------------------------------------------->
		<form class="row g-3" style="margin-left: 500px; margin-right: 500px; margin-top: 20px; background: transparent; border-radius: 20px;  backdrop-filter: blur(30px);" method="POST" action="insertar.php">
		
			<div class="col-md-6">
				<label for="inputEmail4" class="form-label">Fecha de registro</label>
				<input type="date" class="form-control" name="fechaRegistro" required>
			</div>
			
			<div class="col-md-6">
				<label for="inputEmail4" class="form-label">Fecha de salida</label>
				<input type="date" class="form-control" id="inputEmail4" name="fechaSalida" required>
			</div>
			
			<div class="col-12">
				<label for="input" class="form-label">Motivo de la visita</label>
				<select class="form-select" aria-label="Default select example" name="motVis" required>
					<option id="0" value ="0" selected = "selected">Seleccionar</option>
					<option value="PLACER">PLACER</option>
					<option value="NEGOCIOS">NEGOCIOS</option>
				</select>
			</div>
			
			<div class="col-12">
				<label for="input" class="form-label">Lugar de procedencia</label>
				<input type="text" class="form-control" name="lugarProc" required>
			</div>
		
		
			<div class="col-md-6">
				<label for="input" class="form-label">Tipo de habitacion</label>
				<select class="form-select" aria-label="Default select example"  id ="tipoHab" name="tipoHab" required>
					<option value = "0">Seleccionar</option>

					<?php while($row = $resultado->fetch_assoc()) { ?>
						<option value="<?php echo $row['idTipo']; ?>"><?php echo $row['nombre'];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="col-md-6">
				<label for="input" class="form-label">Id de habitacion</label>
				<select class="form-select" aria-label="Default select example" name="idHab" id="idHab" required>
					<option value = "0">Seleccionar</option>
				</select>
			</div>

		
			<div class="col-12" style="text-align: center; margin-top: 20px; margin-bottom: 10px;">
				<button type="submit" class="btn btn-primary" name="btnRegistrar">Registrar</button>
			</div>
			
		</form>	
</body>
</html>