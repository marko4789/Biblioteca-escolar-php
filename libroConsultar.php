<?php
    include("validarSesion.php");

    include_once ('Conexion.php');
    if(isset($_POST["libro"])){
        $libro = $_POST["libro"];
        $datos = $server->buscarLibro($libro);
    }else{
        $libro = "";
        $datos = $server->consultarTabla("libros");
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
            <h1>Consultar Libro</h1>
        </div>
    </header>

    <div class = "frmFormulario">

        <form class = "frmBuscar" method="post" action= 'libroConsultar.php'>
            <input placeholder = "Escriba el nombre, autor, ISBN a buscar" name="editorial" type="text" pattern="([\w]|[á-úñÑ.\s])+" required>
            <button type="submit" name="buscar">🔍 Buscar</button>  
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
                                    <a class='btnEditar' href='editorialModificar.php?id=".$fila['idEditorial']."'>🖉 Editar</a>
                                    <a class='btnEliminar' href='editorialDeshabilitar.php?id=".$fila['idEditorial']."'>⮾ Eliminar</a>
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

        <a class = "cancel" href="editorialConsultar.php">Cancelar</a>
        <br><br>

    </div>

</body>

</html>