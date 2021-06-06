<?php
    include("validarSesion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <title>Biblioteca escolar</title>
    <meta charset="UTF-8">

    <link href="css/Estilo.css" rel="stylesheet">

    <script>
        function validarPassword(){
            var pass1 = document.getElementById('inputPassword1').value;
            var pass2 = document.getElementById('inputPassword2').value;
        
            if (pass1 === pass2){
                return true;
            }else {
                alert('Las contraseñas no coinciden.');
                return false;
            }
        }

        function msjUsuarioExistente (){
            alert('El nombre de usuario que escribió ya está registrado\n\nElija otro y vuelva a intentarlo');
        }

        function msjExito (){
            alert('El usuario ha sido registrado con éxito!');
        }

        function msjFracaso (){
            alert('Ah ocurrido un Error, intentelo más tarde.');
        }

    </script>

</head>

<body>

    <?php
    include("barraNavegacion.php");
    ?>
    <header>
        <div class="titulo">
            <h1>Agregar Usuario</h1>
        </div>
    </header>

 
                    
        <div class= "frmInicioSesion">

            <h2>Datos del usuario</h2>
           
                <form method="post" action= 'usuarioAgregar.php' onsubmit="return validarPassword()">
                    
                <div class="frmMargen">

                        <label>Usuario</label>
                        <input placeholder = "Nombre de usuario" name="usuario" type="text" pattern="[\wñ]+" required>
                    
                                       
                        <label >Contraseña</label>
                        <input placeholder = "Contraseña del usuario" id="inputPassword1" name="password" type="password"  pattern="[\wñÑ]{8,}" required>
                    
                       
                        <label>Confirmar contraseña</label>
                        <input placeholder = "Escriba de nuevo la contraseña" id="inputPassword2" name="confirmepassword" type="password"  pattern="[\wñÑ]{8,}" required>
                       
                                                    
                        <label>Nombre(s)</label>
                        <input placeholder = "Nombre" name="nombres" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required>
                    

                        <label >Apellidos</label>
                        <div>                        
                                <input name="apellidoPaterno" placeholder="Apellido paterno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required>                                   
                                <input name="apellidoMaterno" placeholder="Apellido materno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required>                      
                        </div>

                   
                        <label>Email</label>
                        <input name="email" type="email" placeholder="ejemplo.email@gmail.com" required>
                    
           
                    <button type="submit" name="registrar">Registrar</button>  

                    </div>

                </form>
                      
        </div>


    
    <?php
    
        include_once("Conexion.php");

        if(isset($_POST["usuario"])){

            $usuario = $_POST["usuario"];
            $password = $_POST["password"];
            $nombre = $_POST["nombres"];
            $apellidoPaterno = $_POST["apellidoPaterno"];
            $apellidoMaterno = $_POST["apellidoMaterno"];
            $email = $_POST["email"];

            if(existeUsuario($usuario)){
                echo "<script>
                            msjUsuarioExistente();
                        </script>";
            }else{
                registrarUsuario($usuario, $password, $nombre, $apellidoPaterno, $apellidoMaterno, $email);
            }

        }


        function existeUsuario($usuario){
            global $server;

            $consulta = "SELECT nombreUsuario FROM usuarios WHERE nombreUsuario = '$usuario' AND status ='Activo';";

            $datosUsuario = $server->conexion->query($consulta);

            //Si existe un registro en la BD
            if(mysqli_num_rows($datosUsuario) >= 1){
                return true;
            }else{
                return false;
            }
        }

        function registrarUsuario($usuario, $password, $nombre, $apellidoPaterno, $apellidoMaterno, $email){
            global $server;

            $consulta = "INSERT INTO usuarios (nombreUsuario, password, nombre, apellidoPaterno, apellidoMaterno, email, status)
            VALUES ('$usuario', MD5('$password'), '$nombre', '$apellidoPaterno', '$apellidoMaterno', '$email', 'Activo');";

            if ($server->conexion->query($consulta)) {
                echo "<script>
                            msjExito();
                            window.location='usuarioConsultar.php';
                        </script>";
               // header("Location: usuarioConsultar.php");
            }else{
                echo "<script>
                            msjFracaso();
                        </script>";
            }
        }
        
    ?>




</body>

</html>

<!-- Lo Otro --> 