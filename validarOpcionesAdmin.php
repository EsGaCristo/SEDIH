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
        $ubicacion = $_POST['Ubicacion'];
    if ($_POST['accion'] == 'agregar') {
        $comprobarHotel = "SELECT nombre FROM hotel WHERE nombre ='$nombre'";
        $compHotel = mysqli_query($conexion, $comprobarHotel);

        if (mysqli_num_rows($compHotel) == 0) {
        // La consulta está vacía
            $insertar = "INSERT INTO hotel (idHotel, nombre, categoria, domicilio, ocupacion, ubicacion, noHabitaciones) 
            VALUES ('','$nombre','$categoria', '$domicilio','','$ubicacion','')";
        
            $resultado = mysqli_query($conexion, $insertar);
            if ($resultado) {
                header("location: administrador.php?hotelid=$id");
            }
        } else {
        // La consulta contiene resultados
            echo '<script>
            alert("¡ERROR, El hotel que intenta ingresar ya existe en el sistema!");
            setTimeout(function() {
                window.location.href = "administrador.php?hotelid=' . $id . '";
            }, 50); // espera 3 segundos antes de redirigir
            </script>';
        }
    }
    
    //Código para actualizar hotel en administrador   
    if ($_POST['accion'] == 'actualizar') {
        if (empty($_POST['idH'])) {
            echo '<script>
            alert("¡Ingrese un registro a actualizar!");
            setTimeout(function() {
                window.location.href = "administrador.php?hotelid=' . $id . '";
            }, 50); // espera 3 segundos antes de redirigir
            </script>';
        }else{
            $comprobarIDH = "SELECT idHotel FROM hotel WHERE idHotel = $idHotel";
            $compIDH = mysqli_query($conexion,$comprobarIDH);
        
            if (mysqli_num_rows($compIDH) == 0) {    
            echo '<script>
            alert("¡Ingrese un registro válido para actualizar!");
            setTimeout(function() {
                window.location.href = "administrador.php?hotelid=' . $id . '";
            }, 50); // espera 3 segundos antes de redirigir
            </script>';
            }else{
                $actualizar = "UPDATE  hotel SET  nombre = '$nombre', categoria = '$categoria', domicilio = '$domicilio', 
                ubicacion = '$ubicacion' WHERE idHotel = $idHotel;";
            
                $resultado = mysqli_query($conexion, $actualizar);
                if ($resultado) {
                    header("location: administrador.php?hotelid=$id");
                }
            }
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
        if (empty($_POST['idUs'])) {
            echo '<script>
            alert("¡Ingrese un registro a actualizar!");
            setTimeout(function() {
                window.location.href = "administrador.php?hotelid=' . $id . '";
            }, 50); // espera 3 segundos antes de redirigir
            </script>';
        }else{
            $comprobarIDU = "SELECT idusuario FROM usuarios WHERE idUsuario = $idUsuario";
            $compIDU = mysqli_query($conexion,$comprobarIDU);
        
            if (mysqli_num_rows($compIDU) == 0) {    
            echo '<script>
            alert("¡Ingrese un registro válido para actualizar!");
            setTimeout(function() {
                window.location.href = "administrador.php?hotelid=' . $id . '";
            }, 50); // espera 3 segundos antes de redirigir
            </script>';
            }else{
                $actualizar = "UPDATE  usuarios SET tipo = '$tipo', correo='$correo', userPass='$contraseña', idhotel=$idHotel
                WHERE idUsuario = $idUsuario";

                $resultado = mysqli_query($conexion, $actualizar);
                if ($resultado) {
                    header("location: administrador.php?hotelid=$id");
                }
            }
        }
    }
}

 //Código para elimnar hoteles en administrador 
if (isset($_POST['accion3'])) {
    $id = $_GET['id'];
    if ($_POST['accion3'] == 'eliminar') {
        // los valores seleccionados se encuentran en el arreglo $_POST['eliminar']
        if (empty($_POST['eliminar'])) {
            // La variable $valores_seleccionados está vacía
            echo '<script>
            alert("¡Seleccione al menos un valor a eliminar!");
            setTimeout(function() {
                window.location.href = "administrador.php?hotelid=' . $id . '";
            }, 50); // espera 3 segundos antes de redirigir
            </script>';
        }else{
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
    }

    if ($_POST['accion3'] == 'borrarusuarios') {
        // los valores seleccionados se encuentran en el arreglo $_POST['eliminar']
        if (empty($_POST['eliminar2'])) {
            // La variable $valores_seleccionados está vacía
            echo '<script>
            alert("¡Seleccione al menos un valor a eliminar!");
            setTimeout(function() {
                window.location.href = "administrador.php?hotelid=' . $id . '";
            }, 50); // espera 3 segundos antes de redirigir
            </script>';
        }else{
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
}
?>