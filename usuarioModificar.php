<?php
    include("validarSesion.php");
    include("Conexion.php");

    if (isset($_GET["id"])){

        $id = (int)$_GET["id"];
        $datos = $server->buscarUsuario($id);

        if ($fila = mysqli_fetch_array($datos)){
            $usuario = $fila['nombreUsuario'];
            $nombre = $fila['nombre'];
            $apellidoPaterno = $fila['apellidoPaterno'];
            $apellidoMaterno = $fila['apellidoMaterno'];
            $email = $fila['email'];
        }else{
            header("Location: usuarioConsultar.php");
        }

    }else if (!isset($_POST["usuario"])){
        header("Location: usuarioConsultar.php");
    }

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
            <h1>Usuario Modificar</h1>
        </div>
    </header>

    <div class= "frmFormulario">

            <h2>Datos del usuario</h2>
           
                <form method="post" action= 'usuarioModificar.php?id=<?php echo $id;?>' onsubmit="return validarPassword()">
                    
                <div class="frmMargen">

                    <label>Usuario</label>
                    <input value= "<?php echo $usuario; ?>" placeholder = "Nombre de usuario" name="usuario" type="text" pattern="[\wñÑ]+" required>
                

                    <?php 
                        if ($_GET["id"] == $_SESSION["idUsuario"]){ 
                            echo "<label>Contraseña</label> <span style = 'color: red;'>*</span> 
                            <input placeholder = 'Contraseña del usuario' id='inputPassword1' name='password' type='password' pattern='(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])([\wñÑ]){8,16}'>
                            <br> <span style = 'color: red;'>*</span> <span style = 'color: rgb(120, 120, 120);'>Debe contener de 8 a 16 caracteres, al menos un dígito, una minúscula y una mayúscula. </span> <br>
    
                            
                            <label>Confirmar contraseña</label>
                            <input placeholder = 'Escriba de nuevo la contraseña' id='inputPassword2' name='confirmepassword' type='password'  pattern='(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])([\wñÑ]){8,16}'>
                       ";
                        }
                    ?>
                    
                                                
                    <label>Nombre(s)</label>
                    <input value= "<?php echo $nombre; ?>" placeholder = "Nombre" name="nombres" type="text" pattern="([a-z]|[A-Z]|[á-úñÑ\s])+" required>
                

                    <label >Apellidos</label>
                    <div>                        
                            <input value= "<?php echo $apellidoPaterno; ?>" name="apellidoPaterno" placeholder="Apellido paterno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required>                                   
                            <input value= "<?php echo $apellidoMaterno; ?>" name="apellidoMaterno" placeholder="Apellido materno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required>                      
                    </div>

                
                    <label>Email</label>
                    <input value= "<?php echo $email; ?>" name="email" type="email" placeholder="ejemplo.email@gmail.com" required>
                    
           
                    <button type="submit" name="modificar">Modificar</button>  

                </div>

                </form>
                      
                <a class = "cancel" href="usuarioConsultar.php">Cancelar</a> <br><br>

    </div>

    <!-- JavaScript de Bootstrap -->
    <script src="Bootstrap_5.1.3/js/bootstrap.bundle.min.js"></script>

    <?php
        
        if (isset($_POST["usuario"])){

            $idUsuario = $_GET["id"];
            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombres'];
            $apellidoPaterno = $_POST['apellidoPaterno'];
            $apellidoMaterno = $_POST['apellidoMaterno'];
            $email = $_POST['email'];

            if ( isset($_POST['password']) ){
                $password = $_POST['password'];
            }else{
                $password = "";
            }
            
            if(existeUsuario($idUsuario, $usuario)){
                echo "<script>
                        msjExiste ('alumno');
                      </script>";
            }else{
                modificarUsuario($idUsuario, $usuario, $password, $nombre, $apellidoPaterno, $apellidoMaterno, $email);
            }
            
            
        }
            
        function existeUsuario($idUsuario, $usuario){
            global $server;

            $consulta = "SELECT nombreUsuario FROM usuarios WHERE idUsuario != $idUsuario AND nombreUsuario = '$usuario' AND status ='Activo';";

            $datosUsuario = $server->conexion->query($consulta);

            //Si existe un registro en la BD
            if(mysqli_num_rows($datosUsuario) >= 1){
                return true;
            }else{
                return false;
            }
        }

        function modificarUsuario($idUsuario, $usuario, $password, $nombre, $apellidoPaterno, $apellidoMaterno, $email){
            global $server;

            if ($password == ""){
                $consulta = "UPDATE usuarios SET nombreUsuario = '$usuario', 
                                            nombre = '$nombre', 
                                            apellidoPaterno = '$apellidoPaterno', 
                                            apellidoMaterno = '$apellidoMaterno', 
                                            email = '$email'
                        WHERE idUsuario = $idUsuario AND status = 'Activo';";

            }else{
                $consulta = "UPDATE usuarios SET nombreUsuario = '$usuario', 
                                            password = MD5('$password'), 
                                            nombre = '$nombre', 
                                            apellidoPaterno = '$apellidoPaterno', 
                                            apellidoMaterno = '$apellidoMaterno', 
                                            email = '$email'
                        WHERE idUsuario = $idUsuario AND status = 'Activo';";
            }

            

            if ($server->conexion->query($consulta)) {
                echo "<script>
                        msjModificado ('usuario');
                      </script>";
            }
        }
        
    ?>

</body>

</html>