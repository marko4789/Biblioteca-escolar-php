<?php
    include("validarSesion.php");
    include("Conexion.php");

    if (isset($_GET["id"])){

        $id = (int)$_GET["id"];
        $datos = $server->buscarPrestamo($id);

        if ($fila = mysqli_fetch_array($datos)){

            $fecha = $fila['fechaPrestamo'];
            $libro = $fila['titulo'];
            $alumno = $fila['nombre']." ".$fila['apellidoPaterno']." ".$fila['apellidoMaterno'];
            $idAlumno = $fila["idAlumno"];
            
        }else{
            header("Location: prestamoConsultar.php");
        }

    }else{
        header("Location: prestamoConsultar.php");
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
            alert('El préstamo ha sido deshabilitado con éxito!');
        }

        function msjFracaso (){
            alert('Ha ocurrido un Error, intentelo más tarde.');
        }

    </script>

</head>

<body>

    <?php
    include("barraNavegacion.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Deshabilitar Préstamo</h1>
        </div>
    </header>

    <div class="frmFormulario">

        <h2>Datos del préstamo</h2>

        <form method="post" action= 'prestamoDeshabilitar.php?id=<?php echo $id;?>'>

             <div class="frmMargen">
                     
                <label>Título del libro</label>
                <input value= "<?php echo $libro; ?>" name="fecha" type="text" readonly>
                
                <label>Alumno</label>
                <input value= "<?php echo $alumno; ?>" name="fecha" type="text" readonly>

                <label>Fecha de préstamo</label>
                <input value= "<?php echo $fecha; ?>" name="fecha" type="date" readonly>

                <button type="submit" name="eliminar">Eliminar</button>  

            </div> <!--Div de frmMargen-->
        </form>

        <a class = "cancel" href="prestamoConsultar.php">Cancelar</a> <br><br>

    </div> <!--Div de frmFormulario-->

    <?php
    
    if (isset($_POST["eliminar"])){

        $idPrestamo = $_GET["id"];
        
        eliminarPrestamo($idPrestamo,$idAlumno);
       
    }
        
    function eliminarPrestamo($idPrestamo,$idAlumno){
        global $server;

        $consulta = "UPDATE prestamos SET status = 'Inactivo'
                    WHERE idPrestamo = $idPrestamo AND status = 'Activo';";

        if ($server->conexion->query($consulta)) {
          
            deudaAlumno($idAlumno);              
                        
        }else{
            echo "<script>
                        msjFracaso();
                        window.location='prestamoDeshabilitar.php?id=$idPrestamo';
                    </script>";
        }
    }

    function deudaAlumno($idAlumno){

        global $server;

        $consulta = "SELECT idPrestamo FROM prestamos WHERE idAlumno = $idAlumno AND status = 'Activo';";

        $deuda = $server->conexion->query($consulta);

      
        if(!mysqli_num_rows($deuda) >= 1){
            
            $consulta2 = "UPDATE `bd_biblioteca`.`alumnos`
            SET `deudor` = 'Falso'
            WHERE `idAlumno` = $idAlumno;";

            $server->conexion->query($consulta2);
        }

            echo "<script>
            msjExito();
            window.location='prestamoConsultar.php';
            </script>";

    }//fin deuda alumno
    
    
    ?>


</body>

</html>