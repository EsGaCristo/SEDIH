<?php
include("../src/database/conexion_bd.php");
include("../crud/controlador.php");
$mysqli = new mysqli("localhost", "root", "", "sedih", "3306");
$id = isset($_GET['id']) ? $_GET['id'] : '';
$categoria = $mysqli->query("SELECT DISTINCT categoria FROM registroocupacion WHERE idHotel = '$id'")->fetch_object()->categoria;

//consulta general debe hacerse despues de presionar un boton
if (isset($_POST["fechaConsulta"])) {
    $fechaConsulta = $_POST["fechaConsulta"];
    $tipoConsulta = $_POST["tipoConsulta"];

    if ($tipoConsulta == "2") {
        $consultaGeneral = $mysqli->query("SELECT ro.tipoHabitacion as tipoHabitacion, h.nombre as nombre, ro.costoPromedio as costoPromedio 
        FROM registroocupacion ro 
        INNER JOIN hotel h
        WHERE MONTH(ro.fecha) = '$fechaConsulta' 
        AND ro.categoria = '$categoria' 
        AND ro.idHotel = h.idHotel;");
    } else {
        $consultaGeneral = $mysqli->query("SELECT DISTINCT h.nombre as nombre, ro.nivelGeneral as nivelGeneral 
        FROM registroocupacion ro
        INNER JOIN hotel h
        WHERE MONTH(ro.fecha) = '$fechaConsulta' AND ro.categoria = '$categoria' AND ro.idHotel = h.idHotel;");
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

    <style>
        /* Estilos para la navegación con tabs */
        .nav-tabs {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;   
        font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        font-size: 20px;   
        color: white;  
        }
        .nav-tabs li {
        display: inline-block;
        }
        .nav-tabs li a {
        display: block;
        padding: 15px 20px;
        text-decoration: none;
        color: white;
        border: 1px solid #666;
        }
        .nav-tabs li.active a {
        background-color: white;
        color: white;
        }
  </style>

</head>

<body style="background: url('../src/assets/Fondo3.jpg') no-repeat; center center fixed; background-size: cover;">

    <div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;">
        BIENVENIDO SEDIH
	</div>

    <ul class="nav-tabs">
        <li><a href="./graficasCostoOcupacionCategoria.php?id=<?php echo $id ?>">Costo x Ocupacion</a></li>
        <li><a href="./graficasCostoPromedio.php?id=<?php echo $id ?>">Costo x Promedio</a></li>
        <li><a href="./graficasGeneraHabitacion.php?id=<?php echo $id ?>">Genera Habitacion</a></li>
        <li><a href="./graficasMotivoVisita.php?id=<?php echo $id ?>">Visita Del Motivo</a></li>
    </ul>





    <div style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;">
        Estadisticas de tu misma categoria
	</div>

    <div class="col-md-11">
        <form id="miFormulario" method="POST" style="display: flex; justify-content: center; align-items: center;">
            <select class="form-select" aria-label="Default select example" id="tipoConsulta" name="tipoConsulta" required style="margin-left: 100px; margin-right: 20px;">
                <option value="0">Seleccionar</option>
                <option value="1" selected>Ocupacion general</option>
                <option value="2">Costo Promedio</option>
            </select>
            <select class="form-select" aria-label="Default select example" id="fechaConsulta" name="fechaConsulta"
                required>
                <option value="0">Seleccionar</option>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            <button type="submit" class="btn btn-primary" id="guardar-btn" style="margin-left: 10px;">Graficar</button>
        </form>
    </div>

    

    <div style="width: 500px; height: 250px; display: flex; margin-left: 500px; background-color: white; padding: 10px; margin-top: 20px;">
        <canvas id="chart1"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        //** METER ESTO EN UN IF **//
        var tipoConsulta = "<?php echo $tipoConsulta; ?>";
        var consultaGeneral = <?php echo json_encode($resultados); ?>;
        var etiqueta = "";
        var columnas = [];
        var datos = [];


        if (tipoConsulta == 2) {
            consultaGeneral.forEach((object) => {
                columnas.push(`Hotel : ${object.nombre} tipo ${object.tipoHabitacion} `)
                datos.push(object.costoPromedio);
            });
            etiqueta = 'Costo promedio'
        }else{
            consultaGeneral.forEach((object) => {
                columnas.push(`Hotel : ${object.nombre}`)
                datos.push(object.nivelGeneral);
            });
            etiqueta = '% De Ocupacion';
        }


        //** METER ESTO EN UN IF **//

        // Datos de la primera gráfica
        const data1 = {
            labels: columnas,
            datasets: [{
                label: etiqueta,
                data: datos,
                backgroundColor: 'color: black;',
                borderColor: 'color: black;',
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



    <form class="col-md-11" action="../Gerente.php?hotelid=<?php echo $id ?>" method="POST" style="display: flex; justify-content: center; align-items: center; margin-top: 10px;">
        <div class="col-13" >
            <button type="submit" class="btn btn-primary" value="Salir" name="accion2" >
                Regresar
            </button>
        </div>
    </form>




</body>

</html>