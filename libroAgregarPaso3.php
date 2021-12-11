<?php
    global $server;

    if(isset($_POST["categoria"])){
        $categoria = $_POST["categoria"];
        $datos = $server->buscarCategoria($categoria);
        if (mysqli_num_rows($datos) == 0){
            $datos = $server->consultarTabla("categorias");
            echo "  <script>
                        msjNoExiste ('agregandoLibro');
                    </script>";
        }
    }else{
        $datos = $server->consultarTabla("categorias");
    }

    if(isset($_POST['idAutor'])){
        $infoLibro = json_decode(file_get_contents('infoLibro.json'), true);
        $infoLibro["idAutor"] =  (array) $_POST['idAutor'];
        file_put_contents("infoLibro.json", json_encode($infoLibro));
    } else if (!isset($_POST["categoria"])) {
        $_SESSION["editando"] = "Activo";
        echo "  <script>
                    msjFaltan('libro');
                </script>";
    }
    
?>

<div class = "frmFormulario">
    <div class= "frmMargen">
        
        <form class = "frmBuscar" method="post" action= "libroAgregar.php">
            <input placeholder = "Escriba el nombre de la categoría a buscar" name="categoria" type="text" pattern="[\wñá-ú]+" required>
            <button type="submit" name="btnSiguiente" value="paso3">🔍 Buscar</button>  
        </form>

        <div class = "tablaDatos">
            <table>
                <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Categoría(s)</th>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($fila = mysqli_fetch_array($datos)){
                            echo "<tr>";
                            echo "<th scope='row'>".$fila["idCategoria"]."</th>";
                            echo "<td>".$fila["categoria"]."</td>";
                            echo "<td>
                                    <a class='btnEditar' href='libroAgregar.php?idCategoria=".$fila['idCategoria']."'>Seleccionar</a>
                                </td>";
                            echo "</th>";
                            echo "</tr>";
                        }
                    ?>
                        
                </tbody>
            </table>

        </div> <!-- Div con la clase tablaDatos -->

    </div>

    <a class = "cancel" href="libroConsultar.php">Cancelar</a>
    <br><br>

</div> <!-- Div con la clase frmFormulario -->