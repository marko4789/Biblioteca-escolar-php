<?php
    include("validarSesion.php");
    include("Conexion.php");

    if (isset($_GET["id"])){

        $id = $_GET["id"];
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
    
    <script src="js/Modales.js"></script>

</head>

<body>

    <?php
        include("barraNavegacion.php");
        include("Modales.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Deshabilitar Categoría</h1>
        </div>        

    </header>

    <div class= "frmFormulario">

        <h2>Datos de la categoría</h2>

        <form method="post" action= 'categoriaDeshabilitar.php?id=<?php echo $id;?>'>

        <div class="frmMargen">
                                                        
        <label>Categoría</label>
        <input value= "<?php echo $categoria; ?>" placeholder = "Categoría" name="categoria" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" readonly>


        <button type="submit" name="eliminar">Eliminar</button>  

        </div>

        </form>

        <a class = "cancel" href="categoriaConsultar.php">Cancelar</a> <br><br>

    </div>

    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>

    <?php
    
        if (isset($_POST["categoria"])){

            $idCategoria = $_GET["id"];
            
            eliminarCategoria($idCategoria);
            
        }
            
        function eliminarCategoria($idCategoria){
            global $server;

            $consulta = "UPDATE categorias SET status = 'Inactivo'
                        WHERE idCategoria = $idCategoria AND status = 'Activo';";

            if ($server->conexion->query($consulta)) {
                            
                    echo "<script>
                            msjDeshabilitado ('categoria');
                        </script>";
                            
            }
        }
    
    ?>

</body>

</html>