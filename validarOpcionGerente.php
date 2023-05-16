<?php
include("src/database/conexion_bd.php");

//Elimina los registros de clientes que se encuentren marcados en el CheckBox
if (isset($_POST['accion'])) {
  if ($_POST['accion'] == 'borrar') { 
        $id = $_GET['id'];
        if (empty($_POST['eliminar'])) {
          // La variable $valores_seleccionados está vacía
          echo '<script>
          alert("¡Seleccione al menos un valor a eliminar!");
          setTimeout(function() {
              window.location.href = "Gerente.php?hotelid=' . $id . '";
          }, 50); // espera 3 segundos antes de redirigir
          </script>';
          } else {
          $valores_seleccionados = $_POST['eliminar'];
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

    $comprobarID = "SELECT idRegistro FROM registrocliente WHERE idRegistro ='$idRegistro' AND idHotel = $id";
    $compID = mysqli_query($conexion,$comprobarID);

    if (mysqli_num_rows($compID) == 0) {    
      echo '<script>
      alert("¡Ingrese un registro válido para actualizar!");
      setTimeout(function() {
          window.location.href = "GerenteActualizar.php?hotelid=' . $id . '";
      }, 50); // espera 3 segundos antes de redirigir
      </script>';

    }else{
      $actualizar = "UPDATE registrocliente set fechaHRegistro = '$fEntrada' , fechaSalida = '$fSalida' 
    , motivoVisita = '$Motivo' , lugarProcedencia = '$Lugar'  WHERE idRegistro = '$idRegistro' ";
    $update = mysqli_query($conexion, $actualizar);
      if ($update) {
        echo '<script>
        alert("¡El campo se ha actualizado con éxito!");
        setTimeout(function() {
            window.location.href = "GerenteActualizar.php?hotelid=' . $id . '";
        }, 50); // espera 3 segundos antes de redirigir
        </script>';
      }
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

    $habitacionesDelHotel = "SELECT COUNT(idTipo) FROM habitacion WHERE idHotel = $id";
    $habitacionesAgregadas = mysqli_query($conexion, $habitacionesDelHotel);
    $habitacionesAgregadas = mysqli_fetch_array($habitacionesAgregadas);
    $habitacionesAgregadas = $habitacionesAgregadas[0];
    
    $totalHabi = "SELECT noHabitaciones FROM hotel WHERE idHotel = $id";
    $totalHab = mysqli_query($conexion, $totalHabi);
    $totalHab = mysqli_fetch_array($totalHab);
    $totalHab = $totalHab[0];
    
    // Comparación de los valores
    if ($habitacionesAgregadas != $totalHab) {
      try {
        $insertar = "INSERT INTO habitacion (codigoHabitacion, numeroHabitacion, idTipo, estado, costo, idHotel) 
                    VALUES ('$idH',$num,$Tipo,'$estado', $costo, $id)";
        $resultado = mysqli_query($conexion, $insertar);
        if ($resultado) {
          header("location: GerenteHabitacion.php?hotelid=$id");
        }
      } catch (mysqli_sql_exception $e) {
        // si se produce una excepción, significa que hubo un error al insertar el registro
        // enviamos un alert al usuario indicando el problema
        echo "<script>alert('Hubo un error al insertar el registro: " . $e->getMessage() . "');</script>";
      }

      echo '<script>
            alert("No se ha podido registrar la habitacion, verifique que los datos.");
            setTimeout(function() {
              window.location.href = "GerenteHabitacion.php?hotelid=' . $id . '";
            }, 50); // espera 3 segundos antes de redirigir
          </script>';
    } else {
      echo '<script>
            alert("¡Limite de habitaciones excedido!");
            setTimeout(function() {
                window.location.href = "GerenteHabitacion.php?hotelid=' . $id . '";
            }, 50); // espera 3 segundos antes de redirigir
            </script>';
    }

  } elseif ($_POST['accion2'] == 'RegTipoHab') {
    $id = $_GET['id'];
    header("location: GerenteTipoHabitacion.php?hotelid=$id");
  }

  if ($_POST['accion2'] == 'RegHabitacion') {
    $id = $_GET['id'];
    header("location: GerenteHabitacion.php?hotelid=$id");
  }

  if ($_POST['accion2'] == 'Salir') {
    $id = $_GET['id'];
    header("location: index.php");
  }

  if($_POST['accion2'] == 'VolverGerente'){
    $id = $_GET['id'];
    header("location: Gerente.php?hotelid=$id");
  }

  if($_POST['accion2'] == 'verEstadisticas'){
    $id = $_GET['id'];
    header("location: Estadisticas.php?hotelid=$id");
  }




  if($_POST['accion2'] == 'SaveCantHab'){
    $id = $_GET['id'];
    if (empty($_POST['cantidadHabitaciones'])) {
      // La variable $valores_seleccionados está vacía
      echo '<script>
      alert("¡Ingrese una cantidad para poder actualizar las habitaciones!");
      setTimeout(function() {
          window.location.href = "GerenteHabitacion.php?hotelid=' . $id . '";
      }, 50); // espera 3 segundos antes de redirigir
      </script>';
    } else {
        // La variable $valores_seleccionados contiene valores
      $cantidad = $_POST['cantidadHabitaciones'];
      $actualizar = "UPDATE hotel set noHabitaciones = $cantidad WHERE idhotel =$id";
      $update = mysqli_query($conexion, $actualizar);
      if($update){
      echo '<script>
              alert("Se ha actualizado la cantidad de habitaciones con éxito.");
              setTimeout(function() {
                  window.location.href = "GerenteHabitacion.php?hotelid=' . $id . '";
              }, 50); // espera 3 segundos antes de redirigir
              </script>';
      } 
    } 
  }


}

if (isset($_POST['accion3'])) {
  if ($_POST['accion3'] == 'insertarTipoHab') {
    $id = $_GET['id'];
    $name   = $_POST['nombreHabitacion'];
    $costo   = $_POST['costoHab'];
    //$idHotel = $_POST['$hotelid'];
    $comprobarValor = "SELECT nombre FROM tipoHabitacion WHERE nombre ='$name' AND idHotel = $id";
    $comprobacion = mysqli_query($conexion,$comprobarValor);

    if (mysqli_num_rows($comprobacion) == 0) {
      // La variable $valores_seleccionados está vacía
      echo "La variable está vacía.";
      try {
        $insertar =
          "INSERT INTO tipoHabitacion (idTipo, nombre, idHotel,costo) 
      VALUES ('','$name', $id, $costo)";
  
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
    } else {
      // La variable $valores_seleccionados contiene valores
      echo '<script>
      alert("¡El tipo de habitación ya se encuentra registrado!");
      setTimeout(function() {
        window.location.href = "GerenteTipoHabitacion.php?hotelid=' . $id . '";
      }, 50); // espera 3 segundos antes de redirigir
      </script>';
    }
  
  }

  if ($_POST['accion3'] == 'borrar') {
    if (isset($_POST['accion3'])) {
      $id = $_GET['id'];
      // los valores seleccionados se encuentran en el arreglo $_POST['eliminar']
      if (empty($_POST['eliminar'])) {
        // La variable $valores_seleccionados está vacía
        echo '<script>
        alert("¡Seleccione al menos un valor a eliminar!");
        setTimeout(function() {
            window.location.href = "GerenteTipoHabitacion.php?hotelid=' . $id . '";
        }, 50); // espera 3 segundos antes de redirigir
        </script>';
      } else {
        // La variable $valores_seleccionados contiene valores
        echo "La variable no está vacía.";
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

  if ($_POST['accion3'] == 'borrarHabitacion') {
    if (isset($_POST['accion3'])) {
      $id = $_GET['id'];
      // los valores seleccionados se encuentran en el arreglo $_POST['eliminar']
      if (empty($_POST['eliminar'])) {
        // La variable $valores_seleccionados está vacía
        echo '<script>
          alert("¡Seleccione al menos un valor a eliminar!");
          setTimeout(function() {
              window.location.href = "GerenteHabitacion.php?hotelid=' . $id . '";
          }, 50); // espera 3 segundos antes de redirigir
          </script>';
      } else {
        // La variable $valores_seleccionados contiene valores
        echo "La variable no está vacía.";
        $valores_seleccionados = $_POST['eliminar'];
        // puedes recorrer el arreglo y trabajar con cada valor individualmente
        foreach ($valores_seleccionados as $valor) {
          $borrar = "DELETE FROM habitacion WHERE numeroHabitacion = " . $valor . " AND idHotel = " . $id;
          $resultado = mysqli_query($conexion, $borrar);
          if ($resultado) {
            //echo '<script> alert ("Se ha borrado el dato);';
            header("location: GerenteHabitacion.php?hotelid=$id");
          }
        }
      }
    }
  }
}
?>