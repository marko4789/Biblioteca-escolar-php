<?php
    include("validarSesion.php");
    include("Conexion.php");

    if (isset($_GET["id"])){

        $id = $_GET["id"];
        $datos = $server->buscarAutor($id);

        if ($fila = mysqli_fetch_array($datos)){
            $nombre = $fila['nombre'];
            $apellidoPaterno = $fila['apellidoPaterno'];
            $apellidoMaterno = $fila['apellidoMaterno'];
        }else{
            header("Location: autorConsultar.php");
        }

    }else if (!isset($_POST["autor"])){
        header("Location: autorConsultar.php");
    }
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
            alert('El autor ha sido modificado con éxito!');
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
            <h1>Modificar Autor</h1>
        </div>     

    </header>


    <div class= "frmFormulario">

         <h2>Datos del autor</h2>

        <form method="post" action= 'autorModificar.php?id=<?php echo $id;?>'>
            
        <div class="frmMargen">
                                                          
            <label>Nombre(s)</label>
            <input value= "<?php echo $nombre; ?>" placeholder = "Nombre" name="nombres" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required>
        

            <label >Apellidos</label>
            <div>                        
                    <input value= "<?php echo $apellidoPaterno; ?>" name="apellidoPaterno" placeholder="Apellido paterno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+">                                   
                    <input value= "<?php echo $apellidoMaterno; ?>" name="apellidoMaterno" placeholder="Apellido materno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+">                      
            </div>
         

            <button type="submit" name="modificar">Modificar</button>  

        </div>

        </form>
            
        <a class = "cancel" href="autorConsultar.php">Cancelar</a> <br><br>

    </div>


    <?php
    
        include_once("Conexion.php");

        if(isset($_POST["nombres"])){
            $idAutor = $_GET["id"];
            $nombre = $_POST["nombres"];
            $apellidoPaterno = $_POST["apellidoPaterno"];
            $apellidoMaterno = $_POST["apellidoMaterno"];

            if(existeAutor($idAutor, $nombre, $apellidoPaterno, $apellidoMaterno)){
                echo "<script>
                            msjAutorExistente();
                        </script>";
            }else{
                modificarAutor($idAutor, $nombre, $apellidoPaterno, $apellidoMaterno);
            }

        }


        function existeAutor($idAutor, $nombre, $apellidoPaterno, $apellidoMaterno){
            global $server;

            $consulta = "SELECT nombre FROM autores WHERE idAutor != $idAutor AND nombre = '$nombre' AND apellidoPaterno = '$apellidoPaterno' AND apellidoMaterno = '$apellidoMaterno' AND status ='Activo';";

            $datosAutor = $server->conexion->query($consulta);

            //Si existe un registro en la BD
            if(mysqli_num_rows($datosAutor) >= 1){
                return true;
            }else{
                return false;
            }
        }

        function modificarAutor($idAutor, $nombre, $apellidoPaterno, $apellidoMaterno){
            global $server;
         
            $consulta = "UPDATE autores SET 
            nombre = '$nombre', 
            apellidoPaterno = '$apellidoPaterno', 
            apellidoMaterno = '$apellidoMaterno' 
            WHERE idAutor = $idAutor AND status = 'Activo';";

            if ($server->conexion->query($consulta)) {
                echo "<script>
                            msjExito();
                            window.location='autorConsultar.php';
                        </script>";
             
            }else{
                echo "<script>
                            msjFracaso();
                            window.location='autorModificar.php?id=$idAutor';
                        </script>";
            }
        }

       
        
    ?>

</body>

</html>