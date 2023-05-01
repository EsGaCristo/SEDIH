<?php 
        include("src/database/conexion_bd.php");
		$mysqli = new mysqli("localhost","root","","sedih","3306");
		$hotelid = isset($_GET['hotelid']) ? $_GET['hotelid'] : '';
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="index.css">
</head>
<body style="background: url('./src/assets/Fondo4.jpg')no-repeat; background-position: center;">
	
<div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;"> BIENVENIDO A SEDIH</div>

	<!----------------------------------------------Codigo de formulario-------------------------------------------------------------------------->
	<form class="row g-3" style="margin-left: 400px; margin-right: 400px; margin-top: 20px; background: transparent; border-radius: 20px;  backdrop-filter: blur(35px);"  method="post" action="insertargerente.php">
		
		<div class="col-md-13">
			<div style=" float: left; background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: LEFT; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;"> CUENTA: GERENTE</div>
			<?php	
			$query = $mysqli -> query ("SELECT nombre FROM hotel where idHotel =  '$hotelid' ");
			while ($valores = mysqli_fetch_array($query)) {
			echo '<div style=" float: RIGHT; background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: RIGHT; color: WHITE; font-family: Impact, Haettenschweiler, Arial Narrow Bold, sans-serif; font-size: 25px;">Hotel '.$valores['nombre'].'</div>';
			}
		?>
			<div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;"> HABITACIONES</div>
		</div>	
    <!------------------------------------------------HABITACIONES------------------------------------------------------------------------------------->
	
		<div class="col-md-13">
				<label for="input" class="form-label" >ID</label> 
				<input type="text" class="form-control" name="idHabitacion" >
		
				<label for="input" class="form-label" >NÚMERO</label> 
				<input type="number" class="form-control" name="numHabitacion" >

				<div class="col-md-6">
				<label for="input" class="form-label">TIPO DE HABITACION</label>
					<select class="form-select" aria-label="Default select example" name="tipoHabitacion" id="tipoHabitacion" required>
						<option value = "0">Seleccionar</option>
							<?php	
								$query = $mysqli -> query ("SELECT * FROM tipohabitacion where idHotel = $hotelid ");
								while ($valores = mysqli_fetch_array($query)) {
									echo '<option value="'.$valores['idTipo'].'">'.$valores['nombre'].'</option>';
								}
							?>
					</select>
				</div>
				<label for="input" class="form-label">Estado</label> 
				<select class="form-select" aria-label="Default select example" name="estado" required>
					<option id="0" value ="0" selected = "selected">Seleccionar</option>
					<option value="DISPONIBLE">DISPONIBLE</option>
					<option value="OCUPADO">OCUPADO</option>
				</select>

				<label for="input" class="form-label">Costo</label> 
				<input type="text" class="form-control" name="CostoHabitacion" required>
			
				<div class="col-3" style="text-align: center; margin-top: 15px; margin-bottom: 0 px;">
				<button type="submit" class="btn btn-primary" name="btnIngresar" style="margin-left: 660px;">Ingresar</button>
			</div>
		</div>
	</form>		
	<!------------------------------------------------Registro Cliente------------------------------------------------------------------------------------->
<form class="row g-3" style="margin-left: 400px; margin-right: 400px; margin-top: 20px; background: transparent; border-radius: 20px;  backdrop-filter: blur(35px);">	
	<div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: CENTER; color: WHITE; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 25px;"> REGISTRO CLIENTE</div>
	
		<div style="background-color: transparent;">
		
			<table style="color: white; width: 100%;">
				<tr>
					<td>ID</td>
					<td>FECHA DE ENTRADA</td>
					<td>FECHA DE SALIDA</td>
					<td>MOTIVO</td>
					<td>LUGAR</td>
					<td>HABITACION</td>
					<td>TIPO</td>
					<td>Eliminar </td>
					<td>Actualizar</td>
				</tr>

				<tr>
					<td>1</td>
					<td style="text-align: center;">26/04/2023</td>
					<td style="text-align: center;">29/04/2023</td>
					<td>negocios</td>
					<td>Tepic</td>
					<td style="text-align: center;">1</td>
					<td style="text-align: center;">1</td>
					<td>
						<button style="color: white; background-color: transparent;">
							<img src="./src/assets/Boton.png" alt="Eliminar" style="width: 30px;">
						</button>   
					</td>
					
					<td>
						<button style="color: white; background-color: transparent;">
							<img src="./src/assets/Actualizar.png" alt="Actualizar" style="width: 20px;">
						</button>  
					</td>
				</tr>	

				<tr>
					<td>1</td>
					<td style="text-align: center;">26/04/2023</td>
					<td style="text-align: center;">29/04/2023</td>
					<td>negocios</td>
					<td>Tepic</td>
					<td style="text-align: center;">1</td>
					<td style="text-align: center;">1</td>
					<td>
					<button style="color: white; background-color: transparent;">
							<img src="./src/assets/Boton.png" alt="Eliminar" style="width: 30px;">
						</button>   
					</td>
					<td>
					<button style="color: white; background-color: transparent;">
							<img src="./src/assets/Actualizar.png" alt="Actualizar" style="width: 20px;">
						</button>  
					</td>
				</tr>	
			</table>
		</div>
	</div>
</form>		

	

</body>
</html>