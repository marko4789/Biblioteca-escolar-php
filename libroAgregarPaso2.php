<?php
    global $server;
                
    if(isset($_POST["autor"])){
        $autor = $_POST["autor"];
        $datos = $server->buscarAutor($autor);
        if (mysqli_num_rows($datos) == 0){
            $datos = $server->consultarTabla("autores");
        }
    }else{
        $datos = $server->consultarTabla("autores");
    }
?>

<div class = "frmFormulario">

    <form class = "frmBuscar" method="post" action= "libroAgregar.php">
        <input placeholder = "Escriba el nombre del autor a buscar" name="autor" type="text" pattern="([\w]|[á-úñÑ.\s])+" required>
        <button type="submit" name="btnSiguiente" value="paso2">🔍 Buscar</button>  
    </form>

    <p>Seleccione los autores del libro: </p>

    <form method="post" action= "libroAgregar.php">
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

                        while($fila = mysqli_fetch_array($datos)){
                            echo "<tr>";
                            echo "<th scope='row'><input name='idAutor[]' type='checkbox' value=".$fila['idAutor']."></th>";
                            echo "<td>".$fila['nombre']."</td>";
                            echo "<td>".$fila['apellidoPaterno']."</td>";
                            echo "<td>".$fila['apellidoMaterno']."</td>";
                            echo "</th>";
                            echo "</tr>";
                        }
                        if (mysqli_num_rows($datos) == 0){
                            echo 'No se han encontrado coincidencias con tu busqueda "'.$autor.'"';
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <div class= "frmMargen">
            <button type="submit" name="btnSiguiente" value="paso3">Siguiente</button>
        </div>                 

        <a class = "cancel" href="libroConsultar.php">Cancelar</a>

    </form>
    <br><br>

    <?php
        if (isset($_POST["titulo"])){
        $_SESSION["titulo"] = $_POST["titulo"];
        $_SESSION["descripcion"] = str_replace("'", "\\'", $_POST["descripcion"]);
        $_SESSION["paginas"] = $_POST["paginas"];
        $_SESSION["pais"] = $_POST["pais"];
        $_SESSION["fechaPublicacion"] = $_POST["fechaPublicacion"];
        $_SESSION["idioma"] = $_POST["idioma"];
        $_SESSION["isbn"] = $_POST["isbn"];
        $_SESSION["existencia"] = $_POST["existencia"];
        }
    ?>

</div>