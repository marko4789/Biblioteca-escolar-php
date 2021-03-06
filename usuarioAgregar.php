<?php
    include("validarSesion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <title>Biblioteca escolar</title>
    <meta charset="UTF-8">

    <link href="css/Estilo.css" rel="stylesheet">
    <link href="Bootstrap_5.1.3/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="js/Modales.js">
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
    </script>

</head>

<body>

    <?php
    include("barraNavegacion.php");
    include("Modales.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Agregar Usuario</h1>
        </div>
    </header>

 
                    
    <div class= "frmFormulario">

        <h2>Datos del usuario</h2>
        
            <form method="post" action= 'usuarioAgregar.php' onsubmit="return validarPassword()">
                
            <div class="frmMargen">

                <label>Usuario</label>
                <input placeholder = "Nombre de usuario" name="usuario" type="text" pattern="[\wñÑ]+" required>
            
                                
                <label>Contraseña</label> <span style = "color: red;">*</span> 
                <input placeholder = "Contraseña del usuario" id="inputPassword1" name="password" type="password"  pattern="(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])([\wñÑ]){8,16}" required>
                <br> <span style = "color: red;">*</span> <span style = "color: rgb(120, 120, 120);">Debe contener de 8 a 16 caracteres, al menos un dígito, una minúscula y una mayúscula. </span> <br>


                <label>Confirmar contraseña</label>
                <input placeholder = "Escriba de nuevo la contraseña" id="inputPassword2" name="confirmepassword" type="password"  pattern="(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])([\wñÑ]){8,16}" required>
                
                                            
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

            <a class = "cancel" href="Index.php">Cancelar</a> <br><br>
                    
    </div>

    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>
    
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
                            msjExiste ('usuario');
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
                echo "  <script>
                            msjRegistrado ('usuario');
                        </script>";
            }
        }
        
    ?>

</body>

</html>

<!-- Lo Otro --> 