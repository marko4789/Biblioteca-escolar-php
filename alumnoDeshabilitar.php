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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script>
        function msjExito (){
            var modalExito = new bootstrap.Modal(document.getElementById('modalExito'), {
                keyboard: false
            });

            var btnContinuar = document.getElementById('btnContinuarE');

            btnContinuar.addEventListener("click", function () {
                window.location='alumnoConsultar.php';
            }, false);

            modalExito.show();
        }

        function msjFracaso (){
            var modalFracaso = new bootstrap.Modal(document.getElementById('modalFracaso'), {
            keyboard: false
            });
/*
            var btnContinuar = document.getElementById('btnContinuarF');

            btnContinuar.addEventListener("click", function () {
                window.location = "alumnoConsultar.php";
            }, false);
*/
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
                    <p>¡El alumno ha sido eliminado con éxito!</p>
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

    <?php
    include("barraNavegacion.php");
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

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
                            //window.location='alumnoConsultar.php';
                        </script>";
                
                
            }else{
                echo "<script>
                            msjFracaso();
                            //window.location='alumnoDeshabilitar.php?id=$idAlumno';
                        </script>";
            }
        }
    
    ?>

</body>

</html>