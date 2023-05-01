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
                    header("location:Gerente.php");
                }else if($datos ->tipo ==2){
                    header("location:Capturista.php");
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