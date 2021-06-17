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

</head>

<body>

    <?php
    include("barraNavegacion.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Deshabilitar Alumno</h1>
        </div>

        <script>
            

            function msjExito (){
                alert('¡El alumno ha sido eliminado con éxito!');
            }

            function msjFracaso (){
                alert('Ha ocurrido un Error, intentelo más tarde.');
            }

        </script>

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
                            msjExito();
                            window.location='alumnoConsultar.php';
                        </script>";
                
                
            }else{
                echo "<script>
                            msjFracaso();
                            window.location='alumnoDeshabilitar.php?id=$idAlumno';
                        </script>";
            }
        }
    
    ?>

</body>

</html>