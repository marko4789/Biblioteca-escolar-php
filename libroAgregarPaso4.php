<?php
    if (isset($_GET["idCategoria"])){
        $_SESSION["idCategoria"] = $_GET["idCategoria"];
    }

    global $server;

    if(isset($_POST["editorial"])){
        $editorial = $_POST["editorial"];
        $datos = $server->buscarEditorial($editorial);
    }else{
        $editorial = "";
        $datos = $server->consultarTabla("editoriales");
    }
?>

<div class = "frmFormulario">

    <form class = "frmBuscar" method="post" action= "libroAgregar.php">
        <input placeholder = "Escriba el nombre de la editorial a buscar" name="editorial" type="text" pattern="([\w]|[á-úñÑ.\s])+" required>
        <button type="submit" name="btnSiguiente" value="paso4">🔍 Buscar</button>  
    </form>

    <div class = "tablaDatos">
        <table>
            <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Nombre de editorial</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    while($fila = mysqli_fetch_array($datos)){
                        echo "<tr>";
                        echo "<th scope='row'>".$fila['idEditorial']."</th>";
                        echo "<td>".$fila['editorial']."</td>";
                        echo "<td>
                                <a class='btnEditar' href='libroAgregar.php?idEditorial=".$fila['idEditorial']."'>Seleccionar</a>
                            </td>";
                        echo "</th>";
                        echo "</tr>";
                    }
                    if (mysqli_num_rows($datos) == 0){
                        echo 'No se han encontrado coincidencias con tu busqueda "'.$editorial.'"';
                    }
                ?>
                   
            </tbody>
        </table>

    </div>

    <a class = "cancel" href="libroConsultar.php">Cancelar</a>
    <br><br>

</div>
