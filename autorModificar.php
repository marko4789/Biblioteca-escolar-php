<?php
    include("validarSesion.php");
    include("Conexion.php");

    if (isset($_GET["id"])){

        $id = (int)$_GET["id"];
        $datos = $server->buscarAutor($id);

        if ($fila = mysqli_fetch_array($datos)){
            $nombre = $fila['nombre'];
            $apellidoPaterno = $fila['apellidoPaterno'];
            $apellidoMaterno = $fila['apellidoMaterno'];
        }else{
            header("Location: autorConsultar.php");
        }

    }else if (!isset($_POST["autor"])){
        header("Location: autorConsultar.php");
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

    <div class="modal" id="modalExito" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Éxito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>El autor ha sido modificado con éxito!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCancelarE" data-bs-dismiss="modal">Seguir modificando</button>
                    <button type="button" class="btn btn-primary" id="btnAceptarE">Aceptar</button>
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
                    <button type="button" class="btn btn-warning" id="btnAceptarAE" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <?php
        include("barraNavegacion.php");
        include("Modales.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Modificar Autor</h1>
        </div>     

    </header>


    <div class= "frmFormulario">

         <h2>Datos del autor</h2>

        <form method="post" action= 'autorModificar.php?id=<?php echo $id;?>'>
            
        <div class="frmMargen">
                                                          
            <label>Nombre(s)</label>
            <input value= "<?php echo $nombre; ?>" placeholder = "Nombre" name="nombres" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required>
        

            <label >Apellidos</label>
            <div>                        
                    <input value= "<?php echo $apellidoPaterno; ?>" name="apellidoPaterno" placeholder="Apellido paterno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+">                                   
                    <input value= "<?php echo $apellidoMaterno; ?>" name="apellidoMaterno" placeholder="Apellido materno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+">                      
            </div>
         

            <button type="submit" name="modificar">Modificar</button>  

        </div>

        </form>
            
        <a class = "cancel" href="autorConsultar.php">Cancelar</a> <br><br>

    </div>

    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>
    
    <?php
    
        include_once("Conexion.php");

        if(isset($_POST["nombres"])){
            $idAutor = $_GET["id"];
            $nombre = $_POST["nombres"];
            $apellidoPaterno = $_POST["apellidoPaterno"];
            $apellidoMaterno = $_POST["apellidoMaterno"];

            if(existeAutor($idAutor, $nombre, $apellidoPaterno, $apellidoMaterno)){
                echo "  <script>
                            msjExiste ('autor');
                        </script>";
            }else{
                modificarAutor($idAutor, $nombre, $apellidoPaterno, $apellidoMaterno);
            }

        }


        function existeAutor($idAutor, $nombre, $apellidoPaterno, $apellidoMaterno){
            global $server;

            $consulta = "SELECT nombre FROM autores WHERE idAutor != $idAutor AND nombre = '$nombre' AND apellidoPaterno = '$apellidoPaterno' AND apellidoMaterno = '$apellidoMaterno' AND status ='Activo';";

            $datosAutor = $server->conexion->query($consulta);

            //Si existe un registro en la BD
            if(mysqli_num_rows($datosAutor) >= 1){
                return true;
            }else{
                return false;
            }
        }

        function modificarAutor($idAutor, $nombre, $apellidoPaterno, $apellidoMaterno){
            global $server;
         
            $consulta = "UPDATE autores SET 
            nombre = '$nombre', 
            apellidoPaterno = '$apellidoPaterno', 
            apellidoMaterno = '$apellidoMaterno' 
            WHERE idAutor = $idAutor AND status = 'Activo';";

            if ($server->conexion->query($consulta)) {
                echo "  <script>
                            msjModificado ('autor', $idAutor);
                        </script>";
             
            }
        }
        
    ?>

</body>

</html>