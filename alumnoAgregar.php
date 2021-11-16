<?php
    include("validarSesion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <title>Biblioteca escolar</title>
    <meta charset="UTF-8">

    <link href="css/Estilo.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <script >

        function msjAlumnoExistente (){
            var modalAlumnoExistente = new bootstrap.Modal(document.getElementById('modalAlumnoExistente'), {
                keyboard: false
            });

            var btnContinuar = document.getElementById('btnContinuarAE');

            btnContinuar.addEventListener("click", function () {
                window.location = "alumnoConsultar.php";
            }, false);

            modalAlumnoExistente.show();
        }

        function msjExito(){
            var modalExito = new bootstrap.Modal(document.getElementById('modalExito'), {
                keyboard: false
            });

            var btnContinuar = document.getElementById('btnContinuarE');

            btnContinuar.addEventListener("click", function () {
                window.location = "alumnoConsultar.php";
            }, false);

            modalExito.show();
        }

        function msjFracaso (){
            var modalFracaso = new bootstrap.Modal(document.getElementById('modalFracaso'), {
                keyboard: false
            });

            var btnContinuar = document.getElementById('btnContinuarF');

            btnContinuar.addEventListener("click", function () {
                window.location = "alumnoConsultar.php";
            }, false);

            modalFracaso.show();
        }

    </script>


</head>

<body>

    <div class="modal" id="modalExito" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Éxito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>El alumno ha sido registrado con éxito!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCancelar" data-bs-dismiss="modal">Agregar otro alumno</button>
                    <button type="button" class="btn btn-primary" id="btnContinuarE">Continuar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modalFracaso" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Ha ocurrido un Error, intentelo más tarde.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCancelar" data-bs-dismiss="modal">Agregar otro alumno</button>
                    <button type="button" class="btn btn-danger" id="btnContinuarF">Continuar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modalAlumnoExistente" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>La matrícula del alumno que escribió ya está registrada</p>
                    <p>Elija otro y vuelva a intentarlo.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCancelar" data-bs-dismiss="modal">Agregar otro alumno</button>
                    <button type="button" class="btn btn-warning" id="btnContinuarAE">Continuar</button>
                </div>
            </div>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

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
                echo "  <script>
                            msjExito();
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