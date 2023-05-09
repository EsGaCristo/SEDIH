<?php
include("src/database/conexion_bd.php");

//Elimina los registros de clientes que se encuentren marcados en el CheckBox
if (isset($_POST['accion'])) {
  if ($_POST['accion'] == 'borrar') {
    if (isset($_POST['accion'])) {
        $id = $_GET['id'];
        // los valores seleccionados se encuentran en el arreglo $_POST['eliminar']
        $valores_seleccionados = $_POST['eliminar'];
        // puedes recorrer el arreglo y trabajar con cada valor individualmente
        foreach ($valores_seleccionados as $valor) {                
            $actualizar = "UPDATE habitacion set estado = 'DISPONIBLE' WHERE codigoHabitacion = (SELECT idHabitacion FROM registrocliente WHERE idRegistro= ".$valor.") ";
            $update = mysqli_query($conexion, $actualizar);
    
            $borrar = "DELETE FROM registrocliente WHERE idRegistro = " . $valor;
            $resultado = mysqli_query($conexion, $borrar);
    
            if ($resultado) {
                //echo '<script> alert ("Se ha borrado el dato);';
                header("location: Gerente.php?hotelid=$id");
            }
        }
    }
//Redirige a la ventana para Actualizar Registros del Gerente
  } elseif ($_POST['accion'] == 'actualizar') {
    $id = $_GET['id'];
    header("location: GerenteActualizar.php?hotelid=$id");
  }
//Desde Gerente Actualizar trae los datos y hace la actualizacion 
  if ($_POST['accion'] == 'actualizarRegistro') {
    $id = $_GET['id'];
    $idRegistro = $_POST['idRegistro'];
    $fEntrada = $_POST['fEntrada'];
    $fSalida = $_POST['fSalida'];
    $Motivo = $_POST['Motivo'];
    $Lugar = $_POST['Lugar'];
    
    echo"<script>console.log('$idRegistro')</script>";
    
    $actualizar = "UPDATE registrocliente set fechaHRegistro = '$fEntrada' , fechaSalida = '$fSalida' 
    , motivoVisita = '$Motivo' , lugarProcedencia = '$Lugar'  WHERE idRegistro = '$idRegistro' ";
    $update = mysqli_query($conexion, $actualizar);
    if ($update) {
      header("location: Gerente.php?hotelid=$id");
    }

  }
}


if (isset($_POST['accion2'])) {
  //Registra la habitación desde la ventana del Gerente
  if ($_POST['accion2'] == 'RegHab') {
    $id = $_GET['id'];
    $idH = $_POST['idHabitacion'];
    $num = $_POST['numHabitacion'];
    $Tipo = $_POST['tipoHabitacion'];
    $estado = $_POST['estado'];
    $costo = $_POST['CostoHabitacion'];
    //$idHotel = $_POST['$hotelid'];

    try {
      $insertar =
        "INSERT INTO habitacion (codigoHabitacion, numeroHabitacion, idTipo, estado, costo, idHotel) 
    VALUES ('$idH',$num,$Tipo,'$estado', $costo, $id)";

      $resultado = mysqli_query($conexion, $insertar);

      if ($resultado) {
        header("location: Gerente.php?hotelid=$id");
      }
    } catch (mysqli_sql_exception $e) {
      // si se produce una excepción, significa que hubo un error al insertar el registro
      // enviamos un alert al usuario indicando el problema
      echo "<script>alert('Hubo un error al insertar el registro: " . $e->getMessage() . "');</script>";
    }

    echo '<script>
alert("No se ha podido registrar la habitacion, verifique que los datos.");
setTimeout(function() {
  window.location.href = "Gerente.php?hotelid=' . $id . '";
}, 50); // espera 3 segundos antes de redirigir
</script>';


  } elseif ($_POST['accion2'] == 'RegTipoHab') {
    $id = $_GET['id'];
    header("location: GerenteTipoHabitacion.php?hotelid=$id");
  }
}


if (isset($_POST['accion3'])) {
  if ($_POST['accion3'] == 'insertarTipoHab') {
    $id = $_GET['id'];
    $name   = $_POST['nombreHabitacion'];
    $num   = $_POST['cantidadHab'];
    $costo   = $_POST['costoHab'];
    //$idHotel = $_POST['$hotelid'];

    try {
      $insertar =
        "INSERT INTO tipoHabitacion (idTipo, nombre, cantidad, idHotel,costo) 
    VALUES ('','$name',$num, $id, $costo)";

      $resultado = mysqli_query($conexion, $insertar);

      if ($resultado) {
        header("location: GerenteTipoHabitacion.php?hotelid=$id");
      }
    } catch (mysqli_sql_exception $e) {
      // si se produce una excepción, significa que hubo un error al insertar el registro
      // enviamos un alert al usuario indicando el problema
      echo "<script>alert('Hubo un error al insertar el registro: " . $e->getMessage() . "');</script>";
    }
    echo '<script>
    alert("No se ha podido ingresar el tipo de habitacion, verifique que los datos.");
    setTimeout(function() {
      window.location.href = "GerenteTipoHabitacion.php?hotelid=' . $id . '";
    }, 50); // espera 3 segundos antes de redirigir
    </script>';
  }

  if ($_POST['accion3'] == 'borrar') {
    if (isset($_POST['accion3'])) {
      $id = $_GET['id'];
      // los valores seleccionados se encuentran en el arreglo $_POST['eliminar']
      $valores_seleccionados = $_POST['eliminar'];
      // puedes recorrer el arreglo y trabajar con cada valor individualmente
      foreach ($valores_seleccionados as $valor) {
        $borrar = "DELETE FROM tipoHabitacion WHERE idTipo = " . $valor;
        $resultado = mysqli_query($conexion, $borrar);

        if ($resultado) {
          //echo '<script> alert ("Se ha borrado el dato);';
          header("location: GerenteTipoHabitacion.php?hotelid=$id");
        }
      }
    }
  }
}
?>