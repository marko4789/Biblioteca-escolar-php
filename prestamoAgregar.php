<?php
    include("validarSesion.php");
    include_once("Conexion.php");
   // session_start();
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
            alert('El préstamo ha sido registrado con éxito!');
        }

        function msjFracaso (){
            alert('Ha ocurrido un Error, intentelo más tarde.');
        }

        function msjExistenciaAgotada(){
            alert('No se dispone de la existencia suficiente para realizar el préstamo.');

        }

    </script>

</head>

<body>

    <?php
    include("barraNavegacion.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Agregar Préstamo</h1>
        </div>
    </header>




    <?php

    if(!isset($_GET["idLibro"])&&!isset($_GET["idAlumno"])){
     mostrarLibros();
    }else
    if(isset($_GET["idLibro"])){
        mostrarAlumnos();
    }
    if(isset($_GET["idAlumno"])){
        agregarPrestamo();
    }



    function mostrarLibros(){

        global $server;

        if(isset($_POST["libro"])){
            $libro = $_POST["libro"];
            $datos = $server->buscarLibro($libro);
        }else{
            $libro = "";
            $datos = $server->consultarTabla("libros");
        }
        
        echo '
        
        
        <div class = "frmFormulario">

        <h3>Seleccione un libro</h3>


        <form class = "frmBuscar" method="post" action= "prestamoAgregar.php">
            <input placeholder = "Escriba el nombre, autor, ISBN a buscar" name="libro" type="text" pattern="([\w]|[á-úñÑ.\-\s])+" required>
            <button type="submit" name="buscar">🔍 Buscar</button>  
        </form>

        <div class = "tablaDatos">
            <table style = " width: 90%;">
                <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Libro</th>
                        <th scope="col">Autor(es)</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
        ';    

                        while($fila = mysqli_fetch_array($datos)){
                            echo "<tr>";
                            echo "<th scope='row'>".$fila['idLibro']."</th>";
                            echo "<td scope='row'>".$fila['isbn']."</td>";
                            echo "<td>".$fila['titulo']."</td>";
                            echo "<td>";
                                $autores = $server->obtenerAutores($fila['idLibro']);
                                    while ($autor = mysqli_fetch_array($autores)){
                                        echo " - ".$autor["nombre"]." ".$autor["apellidoPaterno"]." ".$autor["apellidoPaterno"]."<br>";
                                    }
                            echo "</td>";
                            echo "<td>
                                    <a class='btnEditar' href='prestamoAgregar.php?idLibro=".$fila['idLibro']."'>Seleccionar</a>
                                   
                                </td>";
                            echo "</th>";
                            echo "</tr>";
                        }
                        if (mysqli_num_rows($datos) == 0){
                            echo 'No se han encontrado coincidencias con tu busqueda "'.$libro.'"';
                        }
        
        
        echo '    
        
                </tbody>
            </table>
            
            </div>
            
                <a class = "cancel" href="prestamoConsultar.php">Cancelar</a>
                <br><br>
        
         </div>
        
        ';               
    


    }//fin mostrarLibros
    
    function mostrarAlumnos(){

        global $server;

        if (isset($_GET["idLibro"])){
            $_SESSION["idLibro"] = $_GET["idLibro"];
        }

        if(isset($_POST["alumno"])){
            $alumno = $_POST["alumno"];
            $datos = $server->buscarAlumno($alumno);
        }else{
            $alumno = "";
            $datos = $server->consultarTabla("alumnos");
        }


        echo '

        <div class = "frmFormulario">

        <h3>Seleccione un alumno</h3>

        <form class = "frmBuscar" method="post" action= "prestamoAgregar.php?idLibro='.$_SESSION["idLibro"].'">
            <input placeholder = "Escriba el nombre del alumno a buscar" name="alumno" type="text" pattern="[\wñÑá-ú\-]+" required>
            <button type="submit" name="buscar">🔍 Buscar</button>  
        </form>

        <div class = "tablaDatos">
            <table>
                <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Nombre(s)</th>
                        <th scope="col">Apellido paterno</th>
                        <th scope="col">Apellido materno</th>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Deudor</th>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    ';

                        while($fila = mysqli_fetch_array($datos)){
                            echo "<tr>";
                            echo "<th scope='row'>".$fila['idAlumno']."</th>";
                            echo "<td>".$fila['nombre']."</td>";
                            echo "<td>".$fila['apellidoPaterno']."</td>";
                            echo "<td>".$fila['apellidoMaterno']."</td>";
                            echo "<td>".$fila['matricula']."</td>";
                            echo "<td>".$fila['deudor']."</td>";
                            echo "<td>
                                    <a class='btnEditar' href='prestamoAgregar.php?idAlumno=".$fila['idAlumno']."'>Seleccionar</a>
                                </td>";
                            echo "</th>";
                            echo "</tr>";
                        }
                        if (mysqli_num_rows($datos) == 0){
                            echo 'No se han encontrado coincidencias con tu busqueda "'.$alumno.'"';
                        }
                    
        echo'            
                </tbody>
            </table>

        </div> <!-- Div con la clase tablaDatos -->

        <a class = "cancel" href="prestamoConsultar.php">Cancelar</a>
        <br><br>

      </div> <!-- Div con la clase frmFormulario -->
        
        ';


    }//fin mostrarAlumnos

    function agregarPrestamo(){
        if(isset($_GET["idAlumno"])){       
            $_SESSION["idAlumno"] = $_GET["idAlumno"];
        }

        if(existePrestamo($_SESSION["idLibro"], $_SESSION["idAlumno"])){
            borrarVariablesSesion();
            echo "<script>
                        msjPrestamoExistente();
                        window.location='prestamoAgregar.php';
                    </script>";
        }else{
            librosPrestados();

        }      
      
    }//fin agregarPrestamo


    function existePrestamo($idLibro,$idAlumno){
        global $server;

        $consulta = "SELECT idPrestamo FROM prestamos WHERE idLibro = '$idLibro' AND idAlumno = '$idAlumno' AND status ='Activo';";

        $datosPrestamo = $server->conexion->query($consulta);
        
        //Si existe un registro en la BD
        if(mysqli_num_rows($datosPrestamo) >= 1){
            return true;
        }else{
            return false;
        }
    }//fin existe préstamo


    function registrarPrestamo(){

        global $server;

        $idLibro = $_SESSION["idLibro"];
        $idAlumno = $_SESSION["idAlumno"];
        $idUsuario = $_SESSION["idUsuario"]; 

        borrarVariablesSesion();


        $registroPrestamo = "
        
                INSERT INTO `bd_biblioteca`.`prestamos`
                    (`idPrestamo`,
                    `idLibro`,
                    `idUsuario`,
                    `idAlumno`,
                    `fechaPrestamo`,
                    `fechaDevolucion`,
                    `status`)
                VALUES (NULL,
                        '$idLibro',
                        '$idUsuario',
                        '$idAlumno',
                        CURDATE(),
                        NULL,
                        'Activo');
        
        ";
        $deudaAlumno = "
                UPDATE `bd_biblioteca`.`alumnos`
                SET `deudor` = 'Verdadero'
                WHERE `idAlumno` = '$idAlumno';
        ";
    

        if ($server->conexion->query($registroPrestamo) && $server->conexion->query($deudaAlumno)) {
            
            echo "<script>
                    msjExito();
                    window.location='prestamoConsultar.php';
                </script>";
       
        }else{
            echo "<script>
            msjFracaso();
           window.location='prestamoAgregar.php';
        </script>";
        }
     
   
    }//fin registrarPrestamo

    function librosPrestados(){

        $idLibro = $_SESSION["idLibro"];
        $idAlumno = $_SESSION["idAlumno"];
        $idUsuario = $_SESSION["idUsuario"]; 

        global $server;

        $consultaP = "SELECT  COUNT(prestamos.`idPrestamo`) FROM prestamos INNER JOIN libros ON libros.`idLibro` = prestamos.`idLibro` 
        WHERE prestamos.`idLibro` = $idLibro; ";

        $consultaP = "SELECT  COUNT(prestamos.`idPrestamo`) AS 'prestados' FROM prestamos 
        INNER JOIN libros ON libros.`idLibro` = prestamos.`idLibro` WHERE prestamos.`idLibro` = $idLibro";
                     
        $consultaT = "SELECT existencia FROM libros WHERE idLibro = $idLibro; ";

        $prestados = $server->conexion->query($consultaP);
        $totales = $server->conexion->query($consultaT);

        while($campo= mysqli_fetch_array($prestados))
        $numprestados =(int) $campo["prestados"];

        while($campo= mysqli_fetch_array($totales))
        $numtotales = (int)$campo["existencia"];

        if($numtotales > $numprestados+1){
            registrarPrestamo();
            
        }
        else{
            echo "<script>
            msjExistenciaAgotada();
            window.location='prestamoAgregar.php';
           </script>";
        }


    }//fin libros prestados

    function borrarVariablesSesion(){
        unset($_SESSION["idAlumno"]);
        unset($_SESSION["idLibro"]);
    }//fin borrarVariablesSesion

  

    
    ?>

</body>

</html>