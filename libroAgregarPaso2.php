<?php
    global $server;
                
    if(isset($_POST["autor"])){
        $autor = $_POST["autor"];
        $datos = $server->buscarAutor($autor);
        if (mysqli_num_rows($datos) == 0){
            $datos = $server->consultarTabla("autores");
            echo "  <script>
                        msjNoExiste ('agregandoLibro');
                    </script>";
        }
    }else{
        $datos = $server->consultarTabla("autores");
    }

    if (isset($_POST["titulo"])){

        $infoLibro = [  "titulo"            => $_POST["titulo"], 
                        "descripcion"       => $_POST["descripcion"], 
                        "paginas"           => $_POST["paginas"], 
                        "pais"              => $_POST["pais"], 
                        "fechaPublicacion"  => $_POST["fechaPublicacion"], 
                        "idioma"            => $_POST["idioma"], 
                        "isbn"              => $_POST["isbn"], 
                        "existencia"        => $_POST["existencia"], 
                        "idAutor"           => null, 
                        "idCategoria"       => null, 
                        "idEditorial"       => null];

        file_put_contents("infoLibro.json", json_encode($infoLibro));

    }
?>

<div class = "frmFormulario">
        
    <div class= "frmMargen">

        <form class = "frmBuscar" method="post" action= "libroAgregar.php">
            <input placeholder = "Escriba el nombre del autor a buscar" name="autor" type="text" pattern="([\w]|[á-úñÑ.\s])+">
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
                        ?>
                    </tbody>
                </table>
            </div>

            <button type="submit" name="btnSiguiente" value="paso3">Siguiente</button>

        </form>
    <br><br>

    <a class = "cancel" href="libroConsultar.php">Cancelar</a>
    
    </div>
</div>