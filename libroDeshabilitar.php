<?php
    include("validarSesion.php");
    include("Conexion.php");

    if (isset($_GET["id"])){

        $id = (int)$_GET["id"];
        $datos = $server->buscarLibro($id);

        if ($libro = mysqli_fetch_array($datos)){
            $isbn = $libro['isbn'];
            $titulo = $libro['titulo'];
            $paginas = $libro['paginas'];
            $descripcion = $libro['descripcion'];
            $pais = $libro['pais'];
            $fechaPublicacion = $libro['fechaPublicacion'];
            $idioma = $libro['idioma'];
            $editorial = $libro['editorial'];
            $categoria = $libro['categoria'];

            $autores = $server->obtenerAutores($libro['idLibro']);
        }else{
            header("Location: libroConsultar.php");
        }

    }else {
        header("Location: libroConsultar.php");
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
            <h1>Deshabilitar Libro</h1>
        </div>
    </header>

    <div class= "frmFormulario">

        <h2>Datos del libro</h2>

        <form method="post" action= 'libroDeshabilitar.php?id=<?php echo $id;?>'>

            <div class="frmMargen">
               
                                                
                <label>Título </label>
                <input value= "<?php echo $titulo; ?>" name="titulo" type="text" readonly>

                <label>Autores </label>
                <textarea name="autores" rows="5" cols="30" readonly>
                    <?php while ($autor = mysqli_fetch_array($autores)){
                               echo "\n- ".$autor["nombre"]." ".$autor["apellidoPaterno"]." ".$autor["apellidoPaterno"];
                            }?>
                </textarea>
                
                <label>ISBN </label>
                <input value= "<?php echo $isbn; ?>" name="isbn" type="text" readonly>
                
                <label>Número de páginas </label>
                <input value= "<?php echo $paginas; ?>" name="paginas" type="text" readonly>
                
                <label>Descripción </label>
                <input value= "<?php echo $descripcion; ?>" name="descripcion" type="text" readonly>
                
                <label>País </label>
                <input value= "<?php echo $pais; ?>" name="pais" type="text" readonly>
                
                <label>Fecha de publicación</label>
                <input value= "<?php echo $fechaPublicacion; ?>" name="fechaPublicacion" type="date" readonly>
                
                <label>Idioma </label>
                <input value= "<?php echo $idioma; ?>" name="idioma" type="text" readonly>
                
                <label>Editorial </label>
                <input value= "<?php echo $editorial; ?>" name="editorial" type="text" readonly>
                
                <label>Categoría </label>
                <input value= "<?php echo $titulo; ?>" name="categoria" type="text" readonly>
                
                <button type="submit" name="eliminar">Eliminar</button>
            </div>
    
        </form>

        <a class = "cancel" href="libroConsultar.php">Cancelar</a> <br><br>        
            
    </div>

    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>

    <?php
    
        include_once("Conexion.php");

        if(isset($_POST["isbn"])){
            $idEditorial = $_GET["id"];
            $editorial = $_POST["editorial"];

            eliminarEditorial($idEditorial);

        }

        function eliminarEditorial($idLibro){
            global $server;
         
            $consulta = "UPDATE libros SET 
            status = 'Inactivo'
            WHERE idLibro = $idLibro AND status = 'Activo';";

            if ($server->conexion->query($consulta)) {
                echo "  <script>
                            msjDeshabilitado ('libro')
                        </script>";
             
            }
        }

       
        
    ?>

</body>

</html>