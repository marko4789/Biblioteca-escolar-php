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

</head>

<body>

    <header>
        <div class="titulo">
            <h2>Biblioteca escolar</h2>
        </div>
    </header>

    <div class="frmInicioSesion">
        <h4 style="margin-bottom: 30px;">Inicia sesión con tu cuenta</h4>

        <form method="post" action='IniciarSesion.php'>

            <div>
                <label>Usuario</label>
                <input name="usuario" type="text" pattern="[\wñ]+" required>
            </div>

            <div>
                <label>Contraseña</label>
                <input name="password" type="password" pattern="[\wñ]+" required>
            </div>

            <button type="submit">Iniciar Sesion</button>

        </form>

    </div>

    <?php

        //Se llenó el formulario de Inicio de sesión
        if(isset($_POST["usuario"]) && !isset($_POST["nombre"])){
            include_once("Conexion.php");

            $usuario = $_POST["usuario"];
            $password = md5($_POST["password"]);
            
            //Si existe un registro en la BD
            if(existeUsuario($usuario, $password)){
                guardarSesion($usuario);

                echo "  <script type='text/javascript'>
                            window.location='Index.php';
                        </script>";
                
            }else{
                echo "Salte pinche jaker xfavor tnxs";
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
                
            }else{
                echo "Fracasado";
            }

            
        }
        
    ?>

</body>

</html>