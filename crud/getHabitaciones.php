<?php
    require("../src/database/conexion_bd.php");
    $mysqli = new mysqli("localhost","root","","sedih","3306");

    $idTipo = $_POST['idTipo'];
    
    $queryM = ("SELECT codigoHabitacion FROM habitacion WHERE idTipo= '$idTipo' && estado = 'DISPONIBLE' ");
    $resultadoH  = $mysqli->query($queryM);
    
    echo "<option value = '0'>Seleccionar</option>";
    WHILE($rowH = $resultadoH->fetch_assoc()){
        echo "<option value='".$rowH['codigoHabitacion']."'>".$rowH['codigoHabitacion']."</option>";
      //  $query = $mysqli -> query ("SELECT * FROM tipoHabitacion WHERE ID");                    
    }
?>