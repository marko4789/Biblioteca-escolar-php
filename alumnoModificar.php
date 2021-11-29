<?php
    include("validarSesion.php");
    include("Conexion.php");

    if (isset($_GET["id"])){

        $id = (int)$_GET["id"];
        $datos = $server->buscarAlumno($id);

        if ($fila = mysqli_fetch_array($datos)){
            $idAlumno = $fila ['idAlumno'];
            $nombre = $fila['nombre'];
            $apellidoPaterno = $fila['apellidoPaterno'];
            $apellidoMaterno = $fila['apellidoMaterno'];
            $matricula = $fila['matricula'];
        }else{
            header("Location: alumnoConsultar.php");
        }

    }else if (!isset($_POST["alumno"])){
        header("Location: alumnoConsultar.php");
    }
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
            <h1>Modificar Alumno</h1>
        </div>
    </header>

    <div class= "frmFormulario">

        <h2>Datos del alumno</h2>

            <form method="post" action= 'alumnoModificar.php?id=<?php echo $id;?>'>
                
            <div class="frmMargen">
               
                                            
                <label>Nombre(s)</label>
                <input value= "<?php echo $nombre; ?>" placeholder = "Nombre del alumno" name="nombres" type="text" pattern="([a-z]|[A-Z]|[á-úñÑ\s])+" required>
            

                <label >Apellidos</label>
                <div>                        
                        <input value= "<?php echo $apellidoPaterno; ?>" name="apellidoPaterno" placeholder="Apellido paterno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required>                                   
                        <input value= "<?php echo $apellidoMaterno; ?>" name="apellidoMaterno" placeholder="Apellido materno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required>                      
                </div>

            
                <label>Matrícula</label>
                <input value= "<?php echo $matricula; ?>" name="matricula" type="text" placeholder="Matrícula identificadora del alumno" required>
                

                <button type="submit" name="modificar">Modificar</button>  

            </div>

            </form>
                
            <a class = "cancel" href="alumnoConsultar.php">Cancelar</a> <br><br>

    </div>

    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>

    <?php
        
        if (isset($_POST["nombres"])){

            $idAlumno = $_GET["id"];
            $nombre = $_POST['nombres'];
            $apellidoPaterno = $_POST['apellidoPaterno'];
            $apellidoMaterno = $_POST['apellidoMaterno'];
            $matricula = $_POST['matricula'];
          
            if(existeAlumno($idAlumno, $matricula)){
                echo "<script>
                            msjExiste ('alumno');
                        </script>";
            }else{
                modificarAlumno($idAlumno, $nombre, $apellidoPaterno, $apellidoMaterno, $matricula);
            }
            
            
        }
            
        function existeAlumno($idAlumno, $matricula){
            global $server;

            $consulta = "SELECT nombre FROM alumnos WHERE idAlumno != $idAlumno AND matricula = '$matricula' AND status ='Activo';";

            $datosAlumno = $server->conexion->query($consulta);

            //Si existe un registro en la BD
            if(mysqli_num_rows($datosAlumno) >= 1){
                return true;
            }else{
                return false;
            }
        }

        function   modificarAlumno($idAlumno, $nombre, $apellidoPaterno, $apellidoMaterno, $matricula){
            global $server;
          
                $consulta = "UPDATE alumnos SET nombre = '$nombre', 
                                            apellidoPaterno = '$apellidoPaterno', 
                                            apellidoMaterno = '$apellidoMaterno', 
                                            matricula = '$matricula'
                        WHERE idAlumno = $idAlumno AND status = 'Activo';";           
          

            if ($server->conexion->query($consulta)) {
                echo "  <script>
                            msjModificado ('alumno');
                        </script>";
            }
        }
        
    ?>

</body>

</html>