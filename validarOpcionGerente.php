<?php
include("src/database/conexion_bd.php");
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
  } elseif ($_POST['accion'] == 'actualizar') {
    $id = $_GET['id'];
    header("location: GerenteActualizar.php?hotelid=$id");

  }
}
?>