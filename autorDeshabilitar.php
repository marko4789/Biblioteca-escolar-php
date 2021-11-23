<?php
    include("validarSesion.php");
    include("Conexion.php");

    if (isset($_GET["id"])){

        $id = $_GET["id"];
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
    
    <script>
    
    function msjExito (){
            var modalExito = new bootstrap.Modal(document.getElementById('modalExito'), {
                keyboard: false,
                backdrop: 'static'
            });

            var btnAceptar = document.getElementById('btnAceptarE');

            btnAceptar.addEventListener("click", function () {
                window.location='autorConsultar.php';
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
                    <p>¡El autor ha sido eliminado con éxito!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnAceptarE">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include("barraNavegacion.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Deshabilitar Autor</h1>
        </div>
    </header>


    
    <div class= "frmFormulario">

         <h2>Datos del autor</h2>

        <form method="post" action= 'autorDeshabilitar.php?id=<?php echo $id;?>'>
            
        <div class="frmMargen">
                                                          
            <label>Nombre(s)</label>
            <input value= "<?php echo $nombre; ?>" placeholder = "Nombre" name="nombres" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required readonly>
        

            <label >Apellidos</label>
            <div>                        
                    <input value= "<?php echo $apellidoPaterno; ?>" name="apellidoPaterno" placeholder="Apellido paterno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" readonly>                                   
                    <input value= "<?php echo $apellidoMaterno; ?>" name="apellidoMaterno" placeholder="Apellido materno" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" readonly>                      
            </div>
         

            <button type="submit" name="eliminar">Eliminar</button>  

        </div>

        </form>
            
        <a class = "cancel" href="autorConsultar.php">Cancelar</a> <br><br>

    </div>

    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>
    
    <?php
    
    if (isset($_POST["nombres"])){

        $idAutor = $_GET["id"];
        
        eliminarAutor($idAutor);
        
    }
        
    function eliminarAutor($idAutor){
        global $server;

        $consulta = "UPDATE autores SET status = 'Inactivo'
                    WHERE idAutor = $idAutor AND status = 'Activo';";

        if ($server->conexion->query($consulta)) {
                          
                echo "<script>
                        msjExito();
                      </script>";
                        
        }
    }
    
    ?>

</body>

</html>