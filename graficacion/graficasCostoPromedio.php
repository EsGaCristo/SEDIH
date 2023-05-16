<?php
include("../src/database/conexion_bd.php");
include("../crud/controlador.php");
$mysqli = new mysqli("localhost", "root", "", "sedih", "3306");
$id = 1;
$fechas = $mysqli->query("SELECT DISTINCT fecha FROM registroocupacion WHERE idHotel = '$id'");

//consulta general debe hacerse despues de presionar un boton
if (isset($_POST["fechaConsulta"])) {
    $fechaConsulta = $_POST["fechaConsulta"];

    $consultaGeneral = $mysqli->query("SELECT tipoHabitacion, costoPromedio  FROM registroocupacion WHERE fecha = '$fechaConsulta' AND idHotel = '$id'");
    $resultados = array();
    while ($fila = $consultaGeneral->fetch_assoc()) {
        $resultados[] = $fila;
    }
} else {
    $resultados = array();
}

//parte de consulta general
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESTADISTICAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../index.css">


    <style>
        /* Estilos para la navegación con tabs */
        .nav-tabs {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        }
        .nav-tabs li {
        display: inline-block;
        }
        .nav-tabs li a {
        display: block;
        padding: 10px 15px;
        text-decoration: none;
        color: #666;
        border: 1px solid #666;
        }
        .nav-tabs li.active a {
        background-color: #666;
        color: #fff;
        }
  </style>

</head>

<body style="background: url('../src/assets/Fondo3.jpg') no-repeat; center center fixed; background-size: cover;">

    <div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;">
        BIENVENIDO SEDIH
	</div>

    <ul class="nav-tabs">
        <li><a href="./graficasCostoOcupacionCategoria.php">Costo x Ocupacion</a></li>
        <li><a href="./graficasCostoPromedio.php">Costo x Promedio</a></li>
        <li><a href="./graficasGeneraHabitacion.php">Genera Habitacion</a></li>
        <li><a href="./graficasMotivoVisita.php">Visita Del Motivo</a></li>
    </ul>
    
    <div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;">
        Tipo de habitacion
	</div>



    <div class="col-md-11">
        <form id="miFormulario" method="POST" style="display: flex; justify-content: center; align-items: center;">
            <select class="form-select" aria-label="Default select example" id="fechaConsulta" name="fechaConsulta" required style="margin-left: 100px; margin-right: 20px;">
                <option value="0">Seleccionar Fecha de consulta</option>
                <?php while ($row = $fechas->fetch_assoc()): ?>
                    <option value="<?php echo $row['fecha']; ?>"><?php echo $row['fecha']; ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit" id="guardar-btn">Graficar</button>
        </form>
    </div>




    <div style="width: 500px; height: 250px; display: flex; margin-left: 500px;">
        <canvas id="chart1"></canvas>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        var consultaGeneral = <?php echo json_encode($resultados); ?>;
        var columnas = [];
        var datos = [];

        consultaGeneral.forEach((object) => {
            console.log(`tipoHabitacion: ${object.tipoHabitacion} , nivel: ${object.costoPromedio}`);
            columnas.push(`Tipo Habitacion : ${object.tipoHabitacion}`)
            datos.push(object.costoPromedio);
        });

        // Datos de la primera gráfica
        const data1 = {
            labels: columnas,
            datasets: [{
                label: '$ Por tipo de cuarto',
                data: datos,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        // Configuración de la primera gráfica
        const config1 = {
            type: 'bar',
            data: data1,
            options: {}
        };

        // Crear la primera gráfica
        const chart1 = new Chart(
            document.getElementById('chart1'),
            config1
        );

    </script>

    <form class="col-md-11" action="../Gerente.php?hotelid=<?php echo $id ?>" method="POST" style="display: flex; justify-content: center; align-items: center;">
        <div class="col-md-11" >
            <button type="submit" class="btn btn-primary" value="Salir" name="accion2" >
                Regresar
            </button>
        </div>
    </form>



</body>

</html>