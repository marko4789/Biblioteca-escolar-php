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
    
    function msjAutorExistente (){
            alert('El nombre del autor que escribió ya está registrado\n\nElija otro y vuelva a intentarlo');
        }

        function msjExito (){
            alert('El autor ha sido registrado con éxito!');
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
            <h1>Agregar Autor</h1>
        </div>
    </header>


    <div class= "frmFormulario">

        <h2>Datos del usuario</h2>

        <form method="post" action= 'autorAgregar.php'>

            <div class="frmMargen">
               
                                                
                    <label>Nombre(s)</label>
                    <input placeholder = "Nombre" name="nombres" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required>
                

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

    
    <?php
    
        include_once("Conexion.php");

        if(isset($_POST["nombres"])){

            $nombre = $_POST["nombres"];
            $apellidoPaterno = $_POST["apellidoPaterno"];
            $apellidoMaterno = $_POST["apellidoMaterno"];

            if(existeAutor($nombre, $apellidoPaterno, $apellidoMaterno)){
                echo "<script>
                            msjAutorExistente();
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
                echo "<script>
                            msjExito();
                            window.location='autorConsultar.php';
                        </script>";
             
            }else{
                echo "<script>
                            msjFracaso();
                        </script>";
            }
        }
        
    ?>





</body>

</html>