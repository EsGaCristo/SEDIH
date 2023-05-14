<?php
include("src/database/conexion_bd.php");
include("crud/controlador.php");
$mysqli = new mysqli("localhost", "root", "", "sedih", "3306");
$fechas = $mysqli->query("SELECT DISTINCT fecha FROM registroocupacion");

//consulta general debe hacerse despues de presionar un boton
if (isset($_POST["fechaConsulta"])) {
    $fechaConsulta = $_POST["fechaConsulta"];
    $tipoConsulta = $_POST["tipoConsulta"];

    if ($tipoConsulta == "2") {
        $consultaGeneral = $mysqli->query("SELECT tipoHabitacion, nivelHabitacion as nivelOcupacion FROM registroocupacion WHERE fecha = '$fechaConsulta'");
    } else {
        $consultaGeneral = $mysqli->query("SELECT DISTINCT idHotel as tipoHabitacion , nivelGeneral as nivelOcupacion FROM registroocupacion WHERE fecha = '$fechaConsulta'");
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
    <link rel="stylesheet" href="index.css">
    <title>Asosiacion de hoteles y Moteles</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
</head>

<body>

    <div class="col-md-6">
        <form id="miFormulario" method="POST">
            <label for="input" class="form-label">Tipo de habitacion</label>
            <select class="form-select" aria-label="Default select example" id="tipoConsulta" name="tipoConsulta"
                required>
                <option value="0">Seleccionar</option>
                <option value="1">Ocupacion general</option>
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



    <canvas id="myChart"></canvas>
    <!-- DE AQUI PA DELANTE GRAFICAS-->

    <script>
        var consultaGeneral = <?php echo json_encode($resultados); ?>;
        var columnas = [];
        var datos = [];

        consultaGeneral.forEach((object) => {
            //console.log(`tipoHabitacion: ${object.tipoHabitacion} , nivel: ${object.nivelHabitacion}`);
            columnas.push(`Tipo Habitacion : ${object.tipoHabitacion}`)
            datos.push(object.nivelOcupacion);
        });

        let miCanvas = document.getElementById("myChart").getContext("2d");
        var chart = new Chart(miCanvas, {
            type: "bar",
            data: {
                labels: columnas,
                datasets: [{
                    label: 'Num datos',
                    backgroundColor: "rgb(255,255,0)",
                    borderColor: "rgb(255,255,0)",
                    data: datos
                }]
            },
            options: {
                canvas: {
                    width: 100,
                    height: 200
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>