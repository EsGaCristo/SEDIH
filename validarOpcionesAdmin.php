<?php
include("src/database/conexion_bd.php");
$id = $_GET['id'];
//Código para insertar hotel en administrador
if (isset($_POST['accion'])) {
        $id = $_GET['id'];
        $idHotel = $_POST['idH'];
        $nombre = $_POST['Nombre'];
        $categoria = $_POST['Categoria'];
        $domicilio = $_POST['Domicilio'];
        $ocupacion = $_POST['Ocupacion'];
        $ubicacion = $_POST['Ubicacion'];
        $noHabitaciones = $_POST['NoHabitaciones']; 
    if ($_POST['accion'] == 'agregar') {
        $insertar = "INSERT INTO hotel (idHotel, nombre, categoria, domicilio, ocupacion, ubicacion, noHabitaciones) 
        VALUES ('','$nombre','$categoria', '$domicilio','$ocupacion','$ubicacion',$noHabitaciones)";
    
        $resultado = mysqli_query($conexion, $insertar);
        if ($resultado) {
            header("location: administrador.php?hotelid=$id");
        }
        
    }
    
    //Código para actualizar hotel en administrador   
    if ($_POST['accion'] == 'actualizar') {
        $actualizar = "UPDATE  hotel SET  nombre = '$nombre', categoria = '$categoria', domicilio = '$domicilio', 
        ocupacion = '$ocupacion', ubicacion = '$ubicacion' , noHabitaciones = $noHabitaciones WHERE idHotel = $idHotel;";
    
        $resultado = mysqli_query($conexion, $actualizar);
        if ($resultado) {
            header("location: administrador.php?hotelid=$id");
        }
        
    }
}

 //Código para insertar usuarios en administrador   
if (isset($_POST['accion2'])) {
    $id = $_GET['id'];
    $tipo = $_POST['tipo'];
    $idHotel = $_POST['idHo'];
    $idUsuario = $_POST['idUs'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contra'];

    if ($_POST['accion2'] == 'agregar') {
        $insertar = "INSERT INTO usuarios (idUsuario, tipo, correo, userPass, idhotel) 
        VALUES ('','$tipo','$correo', '$contraseña','$idHotel')";
        $resultado = mysqli_query($conexion, $insertar);        
        if ($resultado) {
            header("location: administrador.php?hotelid=$id");
        }
    
    }
 //Código para actualizar usuarios en administrador 
    if ($_POST['accion2'] == 'actualizar') {
        $actualizar = "UPDATE  usuarios SET tipo = '$tipo', correo='$correo', userPass='$contraseña', idhotel=$idHotel
        WHERE idUsuario = $idUsuario";

        $resultado = mysqli_query($conexion, $actualizar);
        if ($resultado) {
            header("location: administrador.php?hotelid=$id");
        }
    
    }
}

 //Código para elimnar hoteles en administrador 
if (isset($_POST['accion3'])) {
    $id = $_GET['id'];
    if ($_POST['accion3'] == 'eliminar') {
        // los valores seleccionados se encuentran en el arreglo $_POST['eliminar']
        $valores_seleccionados = $_POST['eliminar'];
        // puedes recorrer el arreglo y trabajar con cada valor individualmente
        foreach ($valores_seleccionados as $valor) {
            $borrar = "DELETE FROM hotel WHERE idHotel = " . $valor;
            $resultado = mysqli_query($conexion, $borrar);
            if ($resultado) {
                //echo '<script> alert ("Se ha borrado el dato);';
                header("location: administrador.php?hotelid=$id");
            }
        }
    }

    if ($_POST['accion3'] == 'borrarusuarios') {
        // los valores seleccionados se encuentran en el arreglo $_POST['eliminar']
        $valores_seleccionados = $_POST['eliminar2'];
        // puedes recorrer el arreglo y trabajar con cada valor individualmente
        foreach ($valores_seleccionados as $valor) {
            $borrar = "DELETE FROM usuarios WHERE idUsuario = " . $valor;
            $resultado = mysqli_query($conexion, $borrar);
            if ($resultado) {
                //echo '<script> alert ("Se ha borrado el dato);';
                header("location: administrador.php?hotelid=$id");
                }
            }
    }
}
?>