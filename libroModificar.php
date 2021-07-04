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
            $existencia = $libro['existencia'];
            $idEditorial = $libro['idEditorial'];
            $idCategoria = $libro['idCategoria'];

            $autoresLibro = $server->obtenerAutores($libro['idLibro']);
            $autores = $server->consultarTabla("autores");
            $categorias = $server->consultarTabla("categorias");
            $editoriales = $server->consultarTabla("editoriales");

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
            <h1>Modificar libro</h1>
        </div>

        <script>
        
            function msjLibroExistente (){
                alert('El isbn del libro que escribió ya está registrado\n\nElija otro y vuelva a intentarlo');
            }

            function msjExito (){
                alert('El libro ha sido modificado con éxito!');
            }

            function msjFracaso (){
                alert('Ha ocurrido un Error, intentelo más tarde.');
            }

        </script>

    </header>

    <div class= "frmFormulario">

        <h2>Datos del libro</h2>

        <form method="post" action= 'libroModificar.php?id=<?php echo $id;?>'>

            <div class="frmMargen">
               
                                                
                <label>Titulo: </label>
                <input value= "<?php echo $titulo; ?>" name="titulo" type="text" pattern="([\w]|[á-úñÑ.\s]|[!¡#$%&/\(\)=¿?-+])+" required>

                <label>Autores anteriores: </label><br><br>
                <textarea rows="5" cols="30" readonly>
                    <?php while ($autor = mysqli_fetch_array($autoresLibro)){
                               echo "\n- ".$autor["nombre"]." ".$autor["apellidoPaterno"]." ".$autor["apellidoPaterno"];
                            }?>
                </textarea><br><br>

                <label>Seleccione los nuevos autores del libro: </label>

                <div class = "tablaDatos">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Seleccionar</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido paterno</th>
                                <th scope="col">Apellido materno</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($fila = mysqli_fetch_array($autores)){
                                    echo "<tr>";
                                    echo "<th scope='row'><input name='idAutor[]' type='checkbox' value='".$fila["idAutor"]."'></th>";
                                    echo "<td>".$fila['nombre']."</td>";
                                    echo "<td>".$fila['apellidoPaterno']."</td>";
                                    echo "<td>".$fila['apellidoMaterno']."</td>";
                                    echo "</th>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                
                <label>isbn: </label>
                <input value= "<?php echo $isbn; ?>" name="isbn" type="text"  pattern="([-\d]){10,17}" required> <br>
                
                <label>Número de páginas: </label>
                <input value= "<?php echo $paginas; ?>" placeholder = "Seleccione o digite el número de páginas" name="paginas" type="number" min=1 required> <br><br>
                
                <label>Descripcion: </label> <br><br>
                <textarea placeholder = "Escriba una breve descripción" name="descripcion" rows="10" cols="50" required><?php echo $descripcion; ?></textarea> <br><br>
                
                <label>País: </label>
                <input value= "<?php echo $pais; ?>" name="pais" type="text" pattern="([a-z]|[A-Z]|[á-úñÑ\s])+"> <br><br>
                
                <label>Fecha de publicacion: </label>
                <input value= "<?php echo $fechaPublicacion; ?>" name="fechaPublicacion" type="date" required> <br><br>
                
                <label>Idioma: </label>
                <input value= "<?php echo $idioma; ?>" name="idioma" type="text" pattern="([a-z]|[A-Z]|[á-úñÑ\s])+" required> <br><br>
                
                <label>Editorial: </label>
                <select name="idEditorial" id="idEditorial">
                <?php
                    while ($editorial = mysqli_fetch_array($editoriales)){
                        echo "<option value='".$editorial['idEditorial']."'>".$editorial['editorial']."</option>";
                    }
                ?>
                </select>

                <script>
                    document.ready = document.getElementById("idEditorial").value = <?php echo $idEditorial ?>;
                </script>
                
                <br><br>

                <label>Categoria: </label>
                <select name="idCategoria" id="idCategoria">
                <?php
                    while ($categoria = mysqli_fetch_array($categorias)){
                        echo "<option value='".$categoria['idCategoria']."'>".$categoria['categoria']."</option>";
                    }
                ?>
                </select>

                <script>
                    document.ready = document.getElementById("idCategoria").value = <?php echo $idCategoria ?>;
                </script>

                <label>Existencia: </label>
                <input value= "<?php echo $existencia; ?>" placeholder = "Seleccione o digite el número de libros en existencia" name="existencia" type="number" min=1 required> <br><br>
                
                
                <button type="submit" name="modificar">Modificar</button>

            </div>
    
        </form>

        <a class = "cancel" href="libroConsultar.php">Volver</a> <br><br>
            
    </div>

    <?php

    if (isset($_POST["titulo"])){



        if(existeLibro($_GET["id"], $_POST["isbn"])){
            echo "<script>
                        msjLibroExistente();
                        window.location='libroAgregar.php';
                    </script>";
        }else{
            modificarLibro();
        }    
    }
    

    function existeLibro($idLibro, $isbn){
        global $server;

        $consulta = "SELECT isbn FROM libros WHERE idLibro != $idLibro AND isbn = '$isbn' AND status ='Activo';";

        $datosLibro = $server->conexion->query($consulta);
        
        //Si existe un registro en la BD
        if(mysqli_num_rows($datosLibro) >= 1){
            return true;
        }else{
            return false;
        }
    }

    function modificarLibro() {

        global $server;

        $idLibro = $_GET["id"];
        
        $modificaLibro = "UPDATE libros SET 
                                titulo = '".$_POST["titulo"]."', 
                                descripcion = '".str_replace("'", "\\'", $_POST["descripcion"])."', 
                                paginas = ".$_POST["paginas"].", 
                                pais = '".$_POST["pais"]."', 
                                fechaPublicacion = '".$_POST["fechaPublicacion"]."', 
                                idioma = '".$_POST["idioma"]."', 
                                isbn = '".$_POST["isbn"]."', 
                                existencia = ".$_POST["existencia"].", 
                                idCategoria = ".$_POST["idCategoria"].", 
                                idEditorial = ".$_POST["idEditorial"]." 
                          WHERE idLibro = ".$idLibro.";";

        
        if ($server->conexion->query($modificaLibro)) {

            if (isset($_POST["idAutor"])){
                
                $idAutores = $_POST["idAutor"];
                $server->conexion->query("DELETE FROM relacion_autoria WHERE idLibro = $idLibro");

                foreach ($idAutores as $idAutor){

                    $relacionAutores = "INSERT INTO relacion_autoria (idAutor, idLibro)
                                            VALUES ($idAutor, $idLibro);";

                    try {
                        $server->conexion->query($relacionAutores);
                    } catch (mysqli_sql_exception $e) {
                        echo $e;
                        $server->conexion->query("DELETE FROM relacion_autoria WHERE idLibro = $idLibro");
                        $server->conexion->query("DELETE FROM libros WHERE idLibro = $idLibro");

                        echo "<script>
                                msjFracaso();
                                window.location='libroModificar.php?id=\"".$idLibro."\"';
                            </script>";

                    }

                }
            }

            echo "<script>
                        msjExito();
                        window.location='libroConsultar.php';
                    </script>";
        
        }else{
            echo "sepa 2";
/*
            echo "<script>
                        msjFracaso();
                        window.location='libroModificar.php?id=\"".$idLibro."\"';
                    </script>";*/
        }
    }
    
    ?>

</body>

</html>