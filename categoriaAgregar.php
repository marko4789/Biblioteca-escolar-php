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
            <h1>Agregar Categoría</h1>
        </div>   
    </header>


    <div class= "frmFormulario">

        <h2>Datos de la categoría</h2>

        <form method="post" action= 'categoriaAgregar.php'>

            <div class="frmMargen">
                                                          
                    <label>Categoría</label>
                    <input placeholder = "Nombre de la categoría" name="categoria" type="text" pattern="([a-z]|[A-Z]|[á-úñN\s])+" required>
                
              
                <button type="submit" name="registrar">Registrar</button>  

            </div>

        </form>

        <a class = "cancel" href="Index.php">Cancelar</a> <br><br>
            
    </div>

    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>
    
    <?php
        
        include_once("Conexion.php");

        if(isset($_POST["categoria"])){

            $categoria = $_POST["categoria"];

            if(existeCategoria($categoria)){
                echo "  <script>
                            msjExiste ('categoria');
                        </script>";
            }else{
                registrarCategoria($categoria);
            }

        }


        function existeCategoria($categoria){
            global $server;

            $consulta = "SELECT categoria FROM categorias WHERE categoria = '$categoria' AND status ='Activo';";

            $datosCategoria = $server->conexion->query($consulta);

            //Si existe un registro en la BD
            if(mysqli_num_rows($datosCategoria) >= 1){
                return true;
            }else{
                return false;
            }
        }

        function registrarCategoria($categoria){
            global $server;

            $consulta = "INSERT INTO categorias (categoria, status)
            VALUES ('$categoria', 'Activo');";

            if ($server->conexion->query($consulta)) {
                echo "<script>
                            msjExito ('categoria');
                        </script>";
            
            }
        }
        
    ?>

</body>

</html>