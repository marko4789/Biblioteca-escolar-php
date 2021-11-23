<?php
    include("validarSesion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <title>Biblioteca escolar</title>
    <meta charset="UTF-8">

    <link href="css/Estilo.css" rel="stylesheet">
    <link href="Bootstrap_5.1.3/css/bootstrap.min.css" rel="stylesheet">
    
    <script>
    
    function msjAutorExistente (){
            var modalAutorExistente = new bootstrap.Modal(document.getElementById('modalAutorExistente'), {
                keyboard: false
            });

            var btnCancelar = document.getElementById('btnCancelarAE');

            btnCancelar.addEventListener("click", function () {
                window.location = "autorConsultar.php";
            }, false);

            modalAutorExistente.show();
        }

        function msjExito (){
            var modalExito = new bootstrap.Modal(document.getElementById('modalExito'), {
                keyboard: false,
                backdrop: 'static'
            });

            var btnContinuar = document.getElementById('btnContinuarE');

            btnContinuar.addEventListener("click", function () {
                window.location = "autorConsultar.php";
            }, false);

            modalExito.show();
        }

    </script>

</head>

<body>

    <div class="modal" id="modalExito" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Éxito</h5>
                </div>
                <div class="modal-body">
                    <p>El autor ha sido registrado con éxito!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCancelarE" data-bs-dismiss="modal">Agregar otro alumno</button>
                    <button type="button" class="btn btn-primary" id="btnContinuarE">Continuar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modalAutorExistente" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>El nombre del autor que escribió ya está registrado</p>
                    <p>Elija otro y vuelva a intentarlo.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCancelarAE">Modificar otro alumno</button>
                    <button type="button" class="btn btn-warning" id="btnAceptarAE" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include("barraNavegacion.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Agregar Autor</h1>
        </div>
    </header>


    <div class= "frmFormulario">

        <h2>Datos del autor</h2>

        <form method="post" action= 'autorAgregar.php'>

            <div class="frmMargen">
               
                                                
                    <label>Nombre(s)</label>
                    <input placeholder = "Nombre" name="nombres" type="text" pattern="([\w]|[á-úñÑ.\s])+" required>
                

                    <label >Apellidos</label>
                    <div>                        
                            <input name="apellidoPaterno" placeholder="Apellido paterno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+">                                   
                            <input name="apellidoMaterno" placeholder="Apellido materno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+">                      
                    </div>
          
                 
                <button type="submit" name="registrar">Registrar</button>  

            </div>

        
        
        </form>

        <a class = "cancel" href="Index.php">Cancelar</a> <br><br>
            
    </div>

    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>
    
    <?php
    
        include_once("Conexion.php");

        if(isset($_POST["nombres"])){

            $nombre = $_POST["nombres"];
            $apellidoPaterno = $_POST["apellidoPaterno"];
            $apellidoMaterno = $_POST["apellidoMaterno"];

            if(existeAutor($nombre, $apellidoPaterno, $apellidoMaterno)){
                echo "<script>
                            msjAutorExistente();
                        </script>";
            }else{
                registrarAutor($nombre, $apellidoPaterno, $apellidoMaterno);
            }

        }


        function existeAutor($nombre, $apellidoPaterno, $apellidoMaterno){
            global $server;

            $consulta = "SELECT nombre FROM autores WHERE nombre = '$nombre' AND apellidoPaterno = '$apellidoPaterno' AND apellidoMaterno = '$apellidoMaterno' AND status ='Activo';";

            $datosAutor = $server->conexion->query($consulta);

            //Si existe un registro en la BD
            if(mysqli_num_rows($datosAutor) >= 1){
                return true;
            }else{
                return false;
            }
        }

        function registrarAutor($nombre, $apellidoPaterno, $apellidoMaterno){
            global $server;

            $consulta = "INSERT INTO autores (nombre, apellidoPaterno, apellidoMaterno, status)
            VALUES ('$nombre', '$apellidoPaterno', '$apellidoMaterno', 'Activo');";

            if ($server->conexion->query($consulta)) {
                echo "<script>
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