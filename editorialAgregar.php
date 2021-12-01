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

    <script src="js/Modales.js"></script>

</head>

<body>

    <?php
    include("barraNavegacion.php");
    include("Modales.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Agregar Editorial</h1>
        </div>

    </header>

    <div class= "frmFormulario">

        <h2>Datos de la editorial</h2>

        <form method="post" action= 'editorialAgregar.php'>

            <div class="frmMargen">
               
                                                
                <label>Editorial </label>
                <input placeholder = "Nombre de la editorial" name="editorial" type="text" pattern="([\w]|[á-úñÑ.\s])+" required>
            
                <button type="submit" name="registrar">Registrar</button>  

            </div>
    
        </form>

        <a class = "cancel" href="Index.php">Cancelar</a> <br><br>
            
    </div>
    
    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>

    <?php
    
        include_once("Conexion.php");

        if(isset($_POST["editorial"])){

            $editorial = $_POST["editorial"];

            if(existeEditorial($editorial)){
                echo "  <script>
                            msjExiste ('editorial');
                        </script>";
            }else{
                registrarEditorial($editorial);
            }

        }


        function existeEditorial($editorial){
            global $server;

            $consulta = "SELECT editorial FROM editoriales WHERE editorial = '$editorial' AND status ='Activo';";

            $datosEditorial = $server->conexion->query($consulta);

            //Si existe un registro en la BD
            if(mysqli_num_rows($datosEditorial) >= 1){
                return true;
            }else{
                return false;
            }
        }

        function registrarEditorial($editorial){
            global $server;

            $consulta = "INSERT INTO editoriales (editorial, status)
            VALUES ('$editorial', 'Activo');";

            if ($server->conexion->query($consulta)) {
                echo "  <script>
                            msjRegistrado ('editorial');
                        </script>";
             
            }
        }
        
    ?>

</body>

</html>