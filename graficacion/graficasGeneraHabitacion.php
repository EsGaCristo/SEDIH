<?php
include("../src/database/conexion_bd.php");
include("../crud/controlador.php");
$mysqli = new mysqli("localhost", "root", "", "sedih", "3306");
$id = 1;
$fechas = $mysqli->query("SELECT DISTINCT fecha FROM registroocupacion WHERE idHotel = '$id'");

//consulta general debe hacerse despues de presionar un boton
if (isset($_POST["fechaConsulta"])) {
    $fechaConsulta = $_POST["fechaConsulta"];
    $tipoConsulta = $_POST["tipoConsulta"];

    if ($tipoConsulta == "2") {
        $consultaGeneral = $mysqli->query("SELECT tipoHabitacion, nivelHabitacion as nivelOcupacion FROM registroocupacion WHERE fecha = '$fechaConsulta' AND idHotel = '$id'");
    } else {
        $consultaGeneral = $mysqli->query("SELECT DISTINCT idHotel as tipoHabitacion , nivelGeneral as nivelOcupacion FROM registroocupacion WHERE fecha = '$fechaConsulta'AND idHotel = '$id' ");
    }
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
    <link rel="stylesheet" href="index.css">

</head>

<body>
<div class="col-md-6">
        <form id="miFormulario" method="POST">
            <label for="input" class="form-label">Tipo de habitacion</label>
            <select class="form-select" aria-label="Default select example" id="tipoConsulta" name="tipoConsulta"
                required>
                <option value="0">Seleccionar</option>
                <option value="1" selected >Ocupacion general</option>
                <option value="2">Ocupacion Por habitacion</option>
            </select>
            <select class="form-select" aria-label="Default select example" id="fechaConsulta" name="fechaConsulta"
                required>
                <option value="0">Seleccionar</option>
                <?php while ($row = $fechas->fetch_assoc()): ?>
                    <option value="<?php echo $row['fecha']; ?>"><?php echo $row['fecha']; ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit" id="guardar-btn">Graficar</button>
        </form>
    </div>
    <div
        style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;">
        VENTANA DE ESTADISTICAS
    </div>




    <div style="width: 500px; height: 250px; display: inline-block;">
        <canvas id="chart1"></canvas>
    </div>

    <div style="width: 800px; height: 250px; display: inline-block; margin-left: 50px;">
        <canvas id="chart2"></canvas>
    </div>

    <div style="width: 500px; height: 250px;">
        <canvas id="chart3"></canvas>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        var consultaGeneral = <?php echo json_encode($resultados); ?>;
        var columnas = [];
        var datos = [];

        consultaGeneral.forEach((object) => {
            //console.log(`tipoHabitacion: ${object.tipoHabitacion} , nivel: ${object.nivelHabitacion}`);
            columnas.push(`Tipo Habitacion : ${object.tipoHabitacion}`)
            datos.push(object.nivelOcupacion);
        });

        // Datos de la primera gráfica
        const data1 = {
            labels: columnas,
            datasets: [{
                label: '% de Tarifas',
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



</body>

</html>