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
        
        function msjAlumnoExistente (){
            alert('La matrícula del alumno que escribió ya está registrada\n\nElija otro y vuelva a intentarlo');
        }

        function msjExito (){
            alert('El alumno ha sido registrado con éxito!');
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
            <h1>Agregar Alumno</h1>
        </div>        
    </header>


    <div class= "frmFormulario">

        <h2>Datos del alumno</h2>

            <form method="post" action= 'alumnoAgregar.php'>
                
                <div class="frmMargen">
                                                                                                                
                    <label>Nombre(s)</label>
                    <input placeholder = "Nombre del alumno" name="nombres" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required>
                

                    <label >Apellidos</label>
                    <div>                        
                            <input name="apellidoPaterno" placeholder="Apellido paterno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required>                                   
                            <input name="apellidoMaterno" placeholder="Apellido materno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required>                      
                    </div>

            
                    <label>Matrícula</label>
                    <input name="matricula" type="text" placeholder="Matrícula identificadora del alumno" required>
                

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
            $matricula = $_POST["matricula"];

            if(existeAlumno($matricula)){
                echo "<script>
                            msjAlumnoExistente();
                        </script>";
            }else{
                registrarAlumno($nombre, $apellidoPaterno, $apellidoMaterno, $matricula);
            }

        }


        function existeAlumno($matricula){
            global $server;

            $consulta = "SELECT matricula FROM alumnos WHERE matricula = '$matricula' AND status ='Activo';";

            $datosAlumno = $server->conexion->query($consulta);

            //Si existe un registro en la BD
            if(mysqli_num_rows($datosAlumno) >= 1){
                return true;
            }else{
                return false;
            }
        }

        function registrarAlumno($nombre, $apellidoPaterno, $apellidoMaterno, $matricula){
            global $server;

            $consulta = "INSERT INTO alumnos (nombre, apellidoPaterno, apellidoMaterno, matricula, deudor, status)
            VALUES ('$nombre', '$apellidoPaterno', '$apellidoMaterno', '$matricula', 'Falso', 'Activo');";

            if ($server->conexion->query($consulta)) {
                echo "<script>
                            msjExito();
                            window.location='alumnoConsultar.php';
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