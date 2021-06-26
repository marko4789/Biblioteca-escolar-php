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

    <script>
    
        function msjPrestamoExistente (){
            alert('El préstamo ya está registrado\n\nElija otro y vuelva a intentarlo');
        }

        function msjExito (){
            alert('El préstamo ha sido modificada con éxito!');
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

    <?php

        if (isset($_POST["modificar"])){
            $idLibro=$_POST["idLibro"];
            $idAlumno=$_POST["idAlumno"];
            $idPrestamo = $_GET["id"];

            if(existePrestamo ($idPrestamo,$idLibro,$idAlumno)){
                echo "<script>
                            msjPrestamoExistente();
                            window.location='prestamoConsultar.php';
                        </script>";
            }else{
                modificarPrestamo($idPrestamo,$idLibro,$idAlumno,$idAlumnoInicial);
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
                echo "<script>
                            msjExito();
                            window.location='prestamoConsultar.php';
                        </script>";
             
            }else{
                echo "<script>
                            msjFracaso();
                            window.location='prestamoModificar.php?id=$idPrestamo';
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
        
    

    ?>

</body>

</html>