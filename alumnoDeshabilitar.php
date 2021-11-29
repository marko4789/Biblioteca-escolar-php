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
            <h1>Deshabilitar Alumno</h1>
        </div>
    </header>


     <div class= "frmFormulario">

        <h2>Datos del alumno</h2>

            <form method="post" action= 'alumnoDeshabilitar.php?id=<?php echo $id;?>'>
                
            <div class="frmMargen">
            
                                            
                <label>Nombre(s)</label>
                <input value= "<?php echo $nombre; ?>" placeholder = "Nombre del alumno" name="nombres" type="text" pattern="([a-z]|[A-Z]|[á-úñÑ\s])+" required readonly>
            

                <label >Apellidos</label>
                <div>                        
                        <input value= "<?php echo $apellidoPaterno; ?>" name="apellidoPaterno" placeholder="Apellido paterno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required readonly>                                   
                        <input value= "<?php echo $apellidoMaterno; ?>" name="apellidoMaterno" placeholder="Apellido materno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required readonly>                      
                </div>

            
                <label>Matrícula</label>
                <input value= "<?php echo $matricula; ?>" name="matricula" type="text" placeholder="Matrícula identificadora del alumno" required readonly>
                

                <button type="submit" name="eliminar">Eliminar</button>  

            </div>

            </form>
                
            <a class = "cancel" href="alumnoConsultar.php">Cancelar</a> <br><br>

    </div>

    <!-- JavaScript de Bootstrap -->
    <script src="Bootstrap_5.1.3/js/bootstrap.bundle.min.js"></script>

    <!-- Código PHP -->
    <?php
    
        if (isset($_POST["nombres"])){

            $idAlumno = $_GET["id"];
            
            eliminarAlumno($idAlumno);
            
        }
            
        function eliminarAlumno($idAlumno){
            global $server;

            $consulta = "UPDATE alumnos SET status = 'Inactivo'
                        WHERE idAlumno = $idAlumno AND status = 'Activo';";

            if ($server->conexion->query($consulta)) {
                                   
                    echo "<script>
                            msjDeshabilitado ('alumno');
                          </script>";
            }
        }
    
    ?>

</body>

</html>