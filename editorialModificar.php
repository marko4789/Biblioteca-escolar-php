<?php
    include("validarSesion.php");
    include("Conexion.php");

    if (isset($_GET["id"])){

        $id = (int)$_GET["id"];
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
        include("Modales.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Modificar Editorial</h1>
        </div>
    </header>

    <div class= "frmFormulario">

        <h2>Datos de la editorial</h2>

        <form method="post" action= 'editorialModificar.php?id=<?php echo $id;?>'>

            <div class="frmMargen">
               
                <label>Editorial </label>
                <input value= "<?php echo $editorial; ?>" placeholder = "Nombre de la editorial" name="editorial" type="text" pattern="([\w]|[á-úñÑ.\s])+" required>
            
                <button type="submit" name="modificar">Modificar</button>  

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

            if(existeEditorial($idEditorial, $editorial)){
                echo "  <script>
                            msjExiste ('editorial');
                        </script>";
            }else{
                modificarEditorial($idEditorial, $editorial);
            }

        }


        function existeEditorial($idEditorial, $editorial){
            global $server;

            $consulta = "SELECT editorial FROM editoriales WHERE idEditorial != $idEditorial AND editorial = '$editorial' AND status ='Activo';";

            $datosEditorial = $server->conexion->query($consulta);

            //Si existe un registro en la BD
            if(mysqli_num_rows($datosEditorial) >= 1){
                return true;
            }else{
                return false;
            }
        }

        function modificarEditorial($idEditorial, $editorial){
            global $server;
         
            $consulta = "UPDATE Editoriales SET 
            editorial = '$editorial'
            WHERE idEditorial = $idEditorial AND status = 'Activo';";

            if ($server->conexion->query($consulta)) {
                echo "  <script>
                            msjModificado ('editorial', $idEditorial);
                        </script>";
             
            }
        }

    ?>

</body>

</html>