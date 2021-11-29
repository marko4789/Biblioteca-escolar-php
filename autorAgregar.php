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
    
    <script src="js/Modales.js"></script>

</head>

<body>

    <?php
        include("barraNavegacion.php");
        include("Modales.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Agregar Autor</h1>
        </div>
    </header>


    <div class= "frmFormulario">

        <h2>Datos del autor</h2>

        <form method="post" action= 'autorAgregar.php'>

            <div class="frmMargen">
               
                                                
                    <label>Nombre(s)</label>
                    <input placeholder = "Nombre" name="nombres" type="text" pattern="([\w]|[á-úñÑ.\s])+" required>
                

                    <label >Apellidos</label>
                    <div>                        
                            <input name="apellidoPaterno" placeholder="Apellido paterno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+">                                   
                            <input name="apellidoMaterno" placeholder="Apellido materno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+">                      
                    </div>
          
                 
                <button type="submit" name="registrar">Registrar</button>  

            </div>

        
        
        </form>

        <a class = "cancel" href="Index.php">Cancelar</a> <br><br>
            
    </div>

    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>
    
    <?php
    
        include_once("Conexion.php");

        if(isset($_POST["nombres"])){

            $nombre = $_POST["nombres"];
            $apellidoPaterno = $_POST["apellidoPaterno"];
            $apellidoMaterno = $_POST["apellidoMaterno"];

            if(existeAutor($nombre, $apellidoPaterno, $apellidoMaterno)){
                echo "<script>
                            msjExiste ('autor');
                        </script>";
            }else{
                registrarAutor($nombre, $apellidoPaterno, $apellidoMaterno);
            }

        }


        function existeAutor($nombre, $apellidoPaterno, $apellidoMaterno){
            global $server;

            $consulta = "SELECT nombre FROM autores WHERE nombre = '$nombre' AND apellidoPaterno = '$apellidoPaterno' AND apellidoMaterno = '$apellidoMaterno' AND status ='Activo';";

            $datosAutor = $server->conexion->query($consulta);

            //Si existe un registro en la BD
            if(mysqli_num_rows($datosAutor) >= 1){
                return true;
            }else{
                return false;
            }
        }

        function registrarAutor($nombre, $apellidoPaterno, $apellidoMaterno){
            global $server;

            $consulta = "INSERT INTO autores (nombre, apellidoPaterno, apellidoMaterno, status)
            VALUES ('$nombre', '$apellidoPaterno', '$apellidoMaterno', 'Activo');";

            if ($server->conexion->query($consulta)) {
                echo "  <script>
                            msjRegistrado ('autor');
                        </script>";
             
            }
        }
        
    ?>

</body>

</html>