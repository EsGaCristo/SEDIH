<?php
    $conexion = mysqli_connect("localhost","root","","sedih","3306");

    if(!empty($_POST["btningresar"])){
        if(empty($_POST["usuario"]) and empty($_POST["password"])){
            echo '<div class= ""> LOS CAMPOS ESTAN VACIOS</div>';
        }else{
            $usuario=$_POST["usuario"];
            $clave=$_POST["clave"]; 
            $sql=$conexion->query("select * from usuarios where correo = '$usuario' and  userPass= '$clave'");
            if ($datos=$sql-> fetch_object()) {
                if($datos ->tipo ==1){
                    $hotelid= $datos -> idHotel;
                    header("location: ../Administrador.php?hotelid=$hotelid");
                }else if($datos ->tipo ==2){
                    $hotelid= $datos -> idHotel;
                    header("location: ../Capturista.php?hotelid=$hotelid");
                }else if($datos ->tipo ==3){
                    $hotelid= $datos -> idHotel;
                    header("location: ../Gerente.php?hotelid=$hotelid");;
                }
            } else {
                echo '
                    <script>
                    alert("Usuario no existente verifique los datos");
                    </script>
                    ';
            }
        }
    } 
?>