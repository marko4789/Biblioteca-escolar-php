<?php
    include("validarSesion.php");
    include("Conexion.php");

    if (isset($_GET["id"])){

        $id = (int)$_GET["id"];
        $datos = $server->buscarPrestamo($id);

        if ($fila = mysqli_fetch_array($datos)){
            $idAlumnoInicial = $fila['idAlumno'];
            $idAlumno = $fila['idAlumno'];
            $idLibro = $fila['idLibro'];
            $fecha = $fila['fechaPrestamo'];

            $libros = $server->consultarTabla("libros");
            $alumnos = $server->consultarTabla("alumnos");
            
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
            <h1>Modificar Préstamo</h1>
        </div>
    </header>

    <div class="frmFormulario">

      <h2>Datos del préstamo</h2>

     <form method="post" action= 'prestamoModificar.php?id=<?php echo $id;?>'>

        <div class="frmMargen">

        <label>Libro </label>
        <select name="idLibro" id="idLibro">
        <?php
            while ($libro = mysqli_fetch_array($libros)){
                echo "<option value='".$libro['idLibro']."'>".$libro['titulo']."</option>";
            }
        ?>
        </select>

        <script>
            document.ready = document.getElementById("idLibro").value = <?php echo $idLibro ?>;
        </script>


        <label>Alumno </label>
        <select name="idAlumno" id="idAlumno">
        <?php
            while ($alumno = mysqli_fetch_array($alumnos)){
                echo "<option value='".$alumno['idAlumno']."'>".$alumno['nombre']." ".$alumno["apellidoPaterno"]." ".$alumno["apellidoMaterno"]."</option>";
            }
        ?>
        </select>

        <script>
            document.ready = document.getElementById("idAlumno").value = <?php echo $idAlumno ?>;
        </script>
              
        <label>Fecha de préstamo</label>
        <input value= "<?php echo $fecha; ?>" name="fecha" type="date" readonly>
    
        <button type="submit" name="modificar">Modificar</button>  



        </div> <!--Div de frmMargen-->
     </form>

     <a class = "cancel" href="prestamoConsultar.php">Cancelar</a> <br><br>

    </div> <!--Div de frmFormulario-->

    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>

    <?php

        if (isset($_POST["modificar"])){
            $idLibro=$_POST["idLibro"];
            $idAlumno=$_POST["idAlumno"];
            $idPrestamo = $_GET["id"];

            if(existePrestamo ($idPrestamo,$idLibro,$idAlumno)){
                echo "  <script>
                            msjExiste('prestamo');
                        </script>";
            }else{
                if(librosPrestados($idLibro)){
                modificarPrestamo($idPrestamo,$idLibro,$idAlumno,$idAlumnoInicial);
                }
                else{
                    echo "  <script>
                                msjFaltan('prestamoM');
                            </script>";
                }
            }    
        }

        function existePrestamo($idPrestamo,$idLibro,$idAlumno){
            global $server;
    
            $consulta = "SELECT idPrestamo FROM prestamos WHERE idPrestamo!=$idPrestamo AND idLibro = $idLibro AND idAlumno = $idAlumno AND status ='Activo';";
    
            $datosPrestamo = $server->conexion->query($consulta);
            
            //Si existe un registro en la BD
            if(mysqli_num_rows($datosPrestamo) >= 1){
                return true;
            }else{
                return false;
                echo $consulta;
            }
        }//fin existe préstamo

        function modificarPrestamo($idPrestamo,$idLibro,$idAlumno,$inicial){
            global $server;
         
            $consulta = "UPDATE prestamos SET 
            idLibro = '$idLibro', idAlumno = '$idAlumno'
            WHERE idPrestamo = $idPrestamo AND status = 'Activo';";

            if ($server->conexion->query($consulta)) {
                deudaAlumno($idAlumno);
                deudaAlumno($inicial);
                echo "  <script>
                            msjModificado ('prestamo', $idPrestamo);
                        </script>";
            }
        }

        function deudaAlumno($idAlumno){

            global $server;
    
            $consulta = "SELECT idPrestamo FROM prestamos WHERE idAlumno = $idAlumno AND status = 'Activo';";
    
            $deuda = $server->conexion->query($consulta);
    
          
            if(mysqli_num_rows($deuda) >= 1){
                
                $consulta2 = "UPDATE `bd_biblioteca`.`alumnos`
                SET `deudor` = 'Verdadero'
                WHERE `idAlumno` = $idAlumno;";
    
                $server->conexion->query($consulta2);
            }
            else if(!mysqli_num_rows($deuda) >= 1){
                
                $consulta2 = "UPDATE `bd_biblioteca`.`alumnos`
                SET `deudor` = 'Falso'
                WHERE `idAlumno` = $idAlumno;";
    
                $server->conexion->query($consulta2);
            }
    
    
        }//fin deuda alumno
        
        function librosPrestados($idLibro){
  
            global $server;
   
            $consultaP = "SELECT  COUNT(prestamos.`idPrestamo`) AS 'prestados' FROM prestamos 
            INNER JOIN libros ON libros.`idLibro` = prestamos.`idLibro` WHERE prestamos.`idLibro` = $idLibro AND prestamos.`status`='Activo';";
                         
            $consultaT = "SELECT existencia FROM libros WHERE idLibro = $idLibro  AND status = 'Activo'; ";
    
            $prestados = $server->conexion->query($consultaP);
            $totales = $server->conexion->query($consultaT);
    
            while($campo= mysqli_fetch_array($prestados))
            $numprestados =(int) $campo["prestados"];
    
            while($campo= mysqli_fetch_array($totales))
            $numtotales = (int)$campo["existencia"];
    
            if($numtotales > $numprestados+1){
               return true;
                
            }
            else{
                
               return false;
            }
    
    
        }//fin libros prestados
    
    

    ?>

</body>

</html>