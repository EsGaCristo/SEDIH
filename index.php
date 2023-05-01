<?php 
        include("src/database/conexion_bd.php");
        include("controlador.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="index.css">
  <title>Asosiacion de hoteles y Moteles</title>
</head>
<body>
    <section> 
        <div class="form-box">
            <div class="form-value">
                <form method="post" action="controlador.php">
                    <h2>SEDIH</h2>
                    <h2>Iniciar sesion</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="usuario" required>
                        <label for="">Correo</label>
                    </div>
                    
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="clave" required>
                        <label for="">Contraseña</label>
                    </div>
                    
                    <button class="button" value="Ingresar" name="btningresar">Ingresar</button>
                    <p> Sistema estadistico para la  Asosiación <br> de Hoteles y Moteles de Tepic </p>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>