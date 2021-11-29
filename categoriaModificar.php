<?php
    include("validarSesion.php");
    include("Conexion.php");

    if (isset($_GET["id"])){

        $id = (int)$_GET["id"];
        $datos = $server->buscarCategoria($id);

        if ($fila = mysqli_fetch_array($datos)){
            $categoria = $fila['categoria'];

        }else{
            header("Location: categoriaConsultar.php");
        }

    }else if (!isset($_POST["categoria"])){
        header("Location: categoriaConsultar.php");
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
    
    function msjCategoriaExistente (){
            alert('El nombre de la categoría que escribió ya está registrada\n\nElija otro y vuelva a intentarlo');
        }

        function msjExito (){
            alert('La categoría ha sido modificado con éxito!');
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
            <h1>Modificar Categoría</h1>
        </div>

    </header>


    <div class= "frmFormulario">

        <h2>Datos de la categoría</h2>

        <form method="post" action= 'categoriaModificar.php?id=<?php echo $id;?>'>
        
        <div class="frmMargen">
                                                        
        <label>Categoría</label>
        <input value= "<?php echo $categoria; ?>" placeholder = "Categoría" name="categoria" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required>


        <button type="submit" name="modificar">Modificar</button>  

        </div>

        </form>
        
        <a class = "cancel" href="categoriaConsultar.php">Cancelar</a> <br><br>

    </div>

    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>
    
    <?php
        
        include_once("Conexion.php");

        if(isset($_POST["categoria"])){
            $idCategoria = $_GET["id"];
            $categoria = $_POST["categoria"];

            if(existeCategoria($idCategoria, $categoria)){
                echo "<script>
                            msjCategoriaExistente();
                        </script>";
            }else{
                modificarCategoria($idCategoria,$categoria );
            }

        }


        function existeCategoria($idCategoria,$categoria){
            global $server;

            $consulta = "SELECT categoria FROM categorias WHERE idCategoria != $idCategoria AND categoria = '$categoria' AND status ='Activo';";

            $datosCategoria = $server->conexion->query($consulta);

            //Si existe un registro en la BD
            if(mysqli_num_rows($datosCategoria) >= 1){
                return true;
            }else{
                return false;
            }
        }

        function modificarCategoria($idCategoria,$categoria){
            global $server;
        
            $consulta = "UPDATE categorias SET 
            categoria = '$categoria'
            WHERE idCategoria = $idCategoria AND status = 'Activo';";

            if ($server->conexion->query($consulta)) {
                echo "<script>
                            msjExito();
                            window.location='categoriaConsultar.php';
                        </script>";
            
            }else{
                echo "<script>
                            msjFracaso();
                            window.location='categoriaModificar.php?id=$idCategoria';
                        </script>";
            }
        }

    
        
    ?>



</body>

</html>