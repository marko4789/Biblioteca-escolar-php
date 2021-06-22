<?php
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

</head>

<body>

    <?php
    include("barraNavegacion.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Detalles del libro</h1>
        </div>
    </header>

    <div class= "frmFormulario">

        <h2>Datos del libro</h2>

        <form>

            <div class="frmMargen">
               
                                                
                <label>Titulo: </label>
                <input value= "<?php echo $titulo; ?>" name="titulo" type="text" readonly>

                <label>Autores: </label><br><br>
                <textarea name="autores" rows="5" cols="30" readonly>
                    <?php while ($autor = mysqli_fetch_array($autores)){
                               echo "\n- ".$autor["nombre"]." ".$autor["apellidoPaterno"]." ".$autor["apellidoPaterno"];
                            }?>
                </textarea><br><br>
                
                <label>isbn: </label>
                <input value= "<?php echo $isbn; ?>" name="isbn" type="text" readonly>
                
                <label>Número de páginas: </label>
                <input value= "<?php echo $paginas; ?>" name="paginas" type="text" readonly>
                
                <label>Descripcion: </label>
                <input value= "<?php echo $descripcion; ?>" name="descripcion" type="text" readonly>
                
                <label>País: </label>
                <input value= "<?php echo $pais; ?>" name="pais" type="text" readonly>
                
                <label>Fecha de publicacion: </label>
                <input value= "<?php echo $fechaPublicacion; ?>" name="fechaPublicacion" type="date" readonly>
                
                <label>Idioma: </label>
                <input value= "<?php echo $idioma; ?>" name="idioma" type="text" readonly>
                
                <label>Editorial: </label>
                <input value= "<?php echo $editorial; ?>" name="editorial" type="text" readonly>
                
                <label>Categoria: </label>
                <input value= "<?php echo $categoria; ?>" name="categoria" type="text" readonly>
                
            </div>
    
        </form>

        <a class = "cancel" href="libroConsultar.php">Volver</a> <br><br>
            
    </div>

</body>

</html>