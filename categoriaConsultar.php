<?php
    include("validarSesion.php");
    include_once ('Conexion.php');

    if(isset($_POST["categoria"])){
        $categoria = $_POST["categoria"];
        $datos = $server->buscarCategoria($categoria);
    }else{
        $datos = $server->consultarTabla("categorias");
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
            <h1>Consultar Categoría</h1>
        </div>

    </header>


    <div class = "frmFormulario">

        <form class = "frmBuscar" method="post" action= 'categoriaConsultar.php'>
            <input placeholder = "Escriba el nombre de la categoría a buscar" name="categoria" type="text" pattern="[\wñá-ú]+" required>
            <button type="submit" name="buscar">🔍 Buscar</button>  
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
                            echo "<th scope='row'>".$fila['idCategoria']."</th>";
                            echo "<td>".$fila['categoria']."</td>";
                            echo "<td>
                                    <a class='btnEditar' href='categoriaModificar.php?id=".$fila['idCategoria']."'>🖉 Editar</a>
                                    <a class='btnEliminar' href='categoriaDeshabilitar.php?id=".$fila['idCategoria']."'>⮾ Eliminar</a>
                                </td>";
                            echo "</th>";
                            echo "</tr>";
                        }
                        
                    ?>
                </tbody>
            </table>

        </div> <!-- Div con la clase tablaDatos -->

        <a class = "cancel" href="categoriaConsultar.php">Cancelar</a>
        <br><br>

    </div> <!-- Div con la clase frmFormulario -->



</body>

</html>