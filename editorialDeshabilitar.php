<?php
    include("validarSesion.php");
    include("Conexion.php");

    if (isset($_GET["id"])){

        $id = $_GET["id"];
        $datos = $server->buscarEditorial($id);

        if ($fila = mysqli_fetch_array($datos)){
            $editorial = $fila['editorial'];
        }else{
            header("Location: editorialConsultar.php");
        }

    }else if (!isset($_POST["editorial"])){
        header("Location: editorialConsultar.php");
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
    ?>

    <header>
        <div class="titulo">
            <h1>Deshabilitar Editorial</h1>
        </div>
    </header>

    <div class= "frmFormulario">

        <h2>Datos de la editorial</h2>

        <form method="post" action= 'editorialDeshabilitar.php?id=<?php echo $id;?>'>

            <div class="frmMargen">
               
                                                
                <label>Nombre de la editorial: </label>
                <input value= "<?php echo $editorial; ?>" placeholder = "editorial" name="editorial" type="text" pattern="([\w]|[á-úñÑ.\s])+" required readonly>
            
                <button type="submit" name="eliminar">Eliminar</button>  

            </div>
    
        </form>

        <a class = "cancel" href="editorialConsultar.php">Cancelar</a> <br><br>
            
    </div>
    
    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>

    <?php
    
        include_once("Conexion.php");

        if(isset($_POST["editorial"])){
            $idEditorial = $_GET["id"];
            $editorial = $_POST["editorial"];

            eliminarEditorial($idEditorial);

        }

        function eliminarEditorial($idEditorial){
            global $server;
         
            $consulta = "UPDATE editoriales SET 
            status = 'Inactivo'
            WHERE idEditorial = $idEditorial AND status = 'Activo';";

            if ($server->conexion->query($consulta)) {
                echo "  <script>
                            msjDeshabilitado ('editorial');
                        </script>";
             
            }
        }

       
        
    ?>

</body>

</html>