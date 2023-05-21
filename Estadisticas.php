<!DOCTYPE html>
<html lang="en">
<?php
$hotelid = isset($_GET['hotelid']) ? $_GET['hotelid'] : '';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadisticas</title>
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
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            font-size: 20px;
            color: white;
        }

        .nav-tabs li {
            display: inline-block;
        }

        .nav-tabs li a {
            display: block;
            padding: 50px 80px;
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

<body style="background: url('./src/assets/Fondo3.jpg') no-repeat; center center fixed; background-size: cover;">

    <div
        style=" background: transparent; border-radius: 20px;  backdrop-filter: blur(10px); text-align: center; color: white; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 35px;">
        BIENVENIDO SEDIH
    </div>

    <ul class="nav-tabs">
        <li><a href="./graficacion/graficasCostoOcupacionCategoria.php?id=<?php echo $hotelid ?>">Costo x Ocupacion</a>
        </li>
        <li><a href="./graficacion/graficasCostoPromedio.php?id=<?php echo $hotelid ?>">Costo x Promedio</a></li>
        <li><a href="./graficacion/graficasGeneraHabitacion.php?id=<?php echo $hotelid ?>">Genera Habitacion</a></li>
        <li><a href="./graficacion/graficasMotivoVisita.php?id=<?php echo $hotelid ?>">Visita Del Motivo</a></li>
    </ul>

    <form class="row g-3 mx-sm-3 mx-md-5 mx-lg-5 mx-xl-5 mt-3 text-center"
        style="justify-content: center; align-items: center;"
        action="validarOpcionGerente.php?id=<?php echo $hotelid ?>" method="post">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-3">
            <button type="submit" class="btn btn-primary" value="Salir" name="accion2">
                Salir
            </button>
        </div>
    </form>





</body>

</html>