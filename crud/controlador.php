<?php
    if(!empty($_POST["btningresar"])){
        if(empty($_POST["usuario"]) and empty($_POST["password"])){
            echo '<div class= ""> LOS CAMPOS ESTAN VACIOS</div>';
        }else{
            $usuario=$_POST["usuario"];
            $clave=$_POST["clave"]; 
            $sql=$conexion->query("select * from usuarios where correo = '$usuario' and  userPass= '$clave'");
            if ($datos=$sql-> fetch_object()) {
                if($datos ->tipo ==1){
                    header("location:Administrador.php");
                }else if($datos ->tipo ==2){
                    $mensaje= $datos -> idHotel;
                    header("location: Capturista.php?mensaje=$mensaje");

                }else if($datos ->tipo ==3){
                    $mensaje= $datos -> idHotel;
                    header("location:Gerente.php?mensaje=$mensaje");;
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