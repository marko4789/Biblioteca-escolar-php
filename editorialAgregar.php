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
    
    function msjEditorialExistente (){
            alert('El nombre de la editorial que escribió ya está registrado\n\nElija otro y vuelva a intentarlo');
        }

        function msjExito (){
            alert('La editorial ha sido registrado con éxito!');
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
            <h1>Agregar Editorial</h1>
        </div>

    </header>

    <div class= "frmFormulario">

        <h2>Datos del usuario</h2>

        <form method="post" action= 'editorialAgregar.php'>

            <div class="frmMargen">
               
                                                
                <label>Nombre de la editorial: </label>
                <input placeholder = "editorial" name="editorial" type="text" pattern="([\w]|[á-úñÑ.\s])+" required>
            
                <button type="submit" name="registrar">Registrar</button>  

            </div>
    
        </form>

        <a class = "cancel" href="Index.php">Cancelar</a> <br><br>
            
    </div>

    <?php
    
        include_once("Conexion.php");

        if(isset($_POST["editorial"])){

            $editorial = $_POST["editorial"];

            if(existeEditorial($editorial)){
                echo "<script>
                            msjEditorialExistente();
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
                echo "<script>
                            msjExito();
                            window.location='editorialConsultar.php';
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