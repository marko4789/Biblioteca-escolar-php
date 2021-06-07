<?php
    include("validarSesion.php");
    include("Conexion.php");

    if (isset($_GET["id"])){

        $id = $_GET["id"];
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

    <script>

        function msjExito (){
            alert('El usuario ha sido eliminado con éxito!');
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
            <h1>Deshabilitar Usuario</h1>
        </div>
    </header>

    <div class= "frmInicioSesion">

        <h2>Datos del usuario</h2>
        
        <form method="post" action= 'usuarioDeshabilitar.php?id=<?php echo $id;?>'>
            
        <div class="frmMargen">

            <label>Usuario</label>
            <input value= "<?php echo $usuario; ?>" placeholder = "Nombre de usuario" name="usuario" type="text" pattern="[\wñ]+" required readonly>
        
                                        
            <label>Nombre(s)</label>
            <input value= "<?php echo $nombre; ?>" placeholder = "Nombre" name="nombres" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required readonly>
        

            <label >Apellidos</label>
            <div>                        
                    <input value= "<?php echo $apellidoPaterno; ?>" name="apellidoPaterno" placeholder="Apellido paterno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required readonly>                                   
                    <input value= "<?php echo $apellidoMaterno; ?>" name="apellidoMaterno" placeholder="Apellido materno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required readonly>                      
            </div>

        
            <label>Email</label>
            <input value= "<?php echo $email; ?>" name="email" type="email" placeholder="ejemplo.email@gmail.com" required readonly>
            
    
            <button type="submit" name="eliminar">Eliminar</button>  

        </div>

        </form>
                    
    </div>

    <?php
    
    if (isset($_POST["usuario"])){

        $idUsuario = $_GET["id"];
        
        eliminarUsuario($idUsuario);
        
    }
        
    function eliminarUsuario($idUsuario){
        global $server;

        $consulta = "UPDATE usuarios SET status = 'Inactivo'
                    WHERE idUsuario = $idUsuario AND status = 'Activo';";

        if ($server->conexion->query($consulta)) {
                
            if ($idUsuario == $_SESSION["idUsuario"]){
                echo "<script>
                        msjExito();
                        window.location='cerrarSesion.php';
                      </script>";
            }else{
                echo "<script>
                        msjExito();
                        window.location='usuarioConsultar.php';
                      </script>";
            }
            
        }else{
            echo "<script>
                        msjFracaso();
                        window.location='usuarioDeshabilitar.php?id=$idUsuario';
                    </script>";
        }
    }
    
    ?>

</body>

</html>