<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    if(isset( $_SESSION['idUsuario'] )){
        header("Location: Index.php");
    }
?>
<html lang="es">

<head>

    <title>Inicio de sesión</title>
    <meta charset="UTF-8">

    <link href="css/Estilo.css" rel="stylesheet">

    <script>
        function msjUsuarioIncorrecto (){
            alert('Usuario o contraseña incorrectos. \n\nVuelva a intentarlo')
        }

        function msjError (){
            alert('Error')
        }
    </script>

</head>

<body>

    <?php
        include("barraNavegacion.php");
    ?>


    <header>
        <div class="titulo">
            <h1>Biblioteca escolar</h1>
        </div>
    </header>

    <div class="frmInicioSesion">
        

        <form method="post" action='IniciarSesion.php'>

            <h2 style="margin-bottom: 30px;">Inicia sesión con tu cuenta</h2>

            <div class = "frmMargen">
                <div>
                    <label>Usuario</label>
                    <input placeholder = "Nombre del usuario" name="usuario" type="text" pattern="[\wÑñ]+" required>
                </div>

                <div>
                    <label>Contraseña</label>
                    <input placeholder = "Contraseña del usuario" name="password" type="password" pattern="[\wñÑ]{8,}" required>
                </div>

                <button type="submit">Iniciar Sesion</button>
            </div>

        </form>

    </div>

    <?php

        //Se llenó el formulario de Inicio de sesión
        if(isset($_POST["usuario"])){
            include_once("Conexion.php");

            $usuario = $_POST["usuario"];
            $password = md5($_POST["password"]);
            
            //Si existe un registro en la BD
            if(existeUsuario($usuario, $password)){
                guardarSesion($usuario);

                header("Location: Index.php");
                
            }else{
                echo "<script>msjUsuarioIncorrecto();</script>";
            }
        }

        function existeUsuario($usuario, $password){
            global $server;

            $consulta = "SELECT nombreUsuario, password FROM usuarios WHERE nombreUsuario = '$usuario' AND password = '$password' AND status ='Activo';";

            $datosUsuario = $server->conexion->query($consulta);

                //Si existe un registro en la BD
                if(mysqli_num_rows($datosUsuario) == 1){
                    return true;
                }else{
                    return false;
                }

                $server->conexion->close();
        }

        function guardarSesion($usuario){
            global $server;

            $consulta = "SELECT idUsuario, nombreUsuario, nombre, apellidoPaterno, apellidoMaterno, email FROM usuarios WHERE nombreUsuario = '$usuario';";
            
            if ($datosUsuario =  mysqli_fetch_array( $server->conexion->query($consulta) )) {
                
                $_SESSION["idUsuario"] = $datosUsuario[0];
                $_SESSION["nombreUsuario"] = $datosUsuario[1];
                $_SESSION["nombres"] = $datosUsuario[2];
                $_SESSION["apellidoPaterno"] = $datosUsuario[3];
                $_SESSION["apellidoMaterno"] = $datosUsuario[4];
                $_SESSION["email"] = $datosUsuario[5];

                setcookie("usuario", $datosUsuario[1], time() + (60 * 10), "/");
                setcookie("email", $datosUsuario[5], time() + (60 * 10), "/");
                setcookie("direccion-ip", obtenerIP(), time() + (60 * 10), "/");

            }else{
                echo "<script>msjError('Error.');</script>";
            }

        }

        function obtenerIP() {
            // Caso IP compartido
            if ( !empty($_SERVER['HTTP_CLIENT_IP']) ){
                return $_SERVER['HTTP_CLIENT_IP'];
            }
               
            // Caso IP Proxy
            if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
           
            // IP Acceso
            return $_SERVER['REMOTE_ADDR'];
        }
        
    ?>

</body>

</html>