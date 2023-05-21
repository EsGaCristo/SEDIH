<?php
    $conexion = mysqli_connect("localhost","root","","sedih","3306");
    session_start();

    if (isset($_SESSION['bloqueado_hasta']) && time() < $_SESSION['bloqueado_hasta']) {
        $tiempo_restante = $_SESSION['bloqueado_hasta'] - time();
        echo "Ha excedido el número máximo de intentos fallidos. Por favor, inténtelo de nuevo en <span id='timer'>$tiempo_restante</span> segundos.";
        exit();
    }

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
                    mysqli_free_result($sql);
                    mysqli_close($conexion);
                    session_destroy();
                    setcookie(session_name(), '', time()-3600, '/');
                }else if($datos ->tipo ==2){
                    $hotelid= $datos -> idHotel;
                    header("location: ../Capturista.php?hotelid=$hotelid");
                    mysqli_free_result($sql);
                    mysqli_close($conexion);
                    session_destroy();
                    setcookie(session_name(), '', time()-3600, '/');
                }else if($datos ->tipo ==3){
                    $hotelid= $datos -> idHotel;
                    header("location: ../Gerente.php?hotelid=$hotelid");
                    mysqli_free_result($sql);
                    mysqli_close($conexion);
                    session_destroy();
                    setcookie(session_name(), '', time()-3600, '/');
                }
            } else {
                // Aumentar el número de intentos fallidos
                $sql = "INSERT INTO intentos_fallidos (usuario, fecha_hora) VALUES ('$usuario', NOW())";
                $conexion->query($sql);
        
                $sql = "SELECT COUNT(*) AS num_intentos FROM intentos_fallidos WHERE usuario = '$usuario'";
                $result = $conexion->query($sql);
                $row = $result->fetch_assoc();
                $num_intentos = $row['num_intentos'];

                if ($num_intentos >= 3) {
                    // Registra la fecha y hora del último intento fallido
                    $sql = "UPDATE intentos_fallidos SET fecha_hora = NOW() WHERE usuario = '$usuario' ORDER BY id DESC LIMIT 1";
                    $conexion->query($sql);
                    $sql2 = "DELETE  FROM intentos_fallidos ";
                    $conexion->query($sql2);
                    // Bloquear el acceso del usuario durante 30 segundos
                    $_SESSION['bloqueado_hasta'] = time() + 15;
        
                    echo "Ha excedido el número máximo de intentos fallidos. Por favor, inténtelo de nuevo en <span id='timer'>15</span> segundos.";
                    exit();
                } else {
                    if ($num_intentos >= 1) {
                        echo '<script>
                        alert("Usuario o contraseña incorrectos. Por favor, inténtelo de nuevo.");
                        setTimeout(function() {
                          window.location.href = "../index.php";
                        }, 50); // espera 3 segundos antes de redirigir
                        </script>';
                    }
                }




            
                }
        }
    } 
?>