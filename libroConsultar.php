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

    <a class ="agregar" href="libroAgregar.php">✚ Nuevo libro</a>


        <form class = "frmBuscar" method="post" action= 'libroConsultar.php'>
            <input placeholder = "Escriba el nombre, autor, ISBN a buscar" name="libro" type="text" pattern="([\w]|[á-úñÑ.\-\s])+" required>
            <button type="submit" name="buscar">🔍 Buscar</button>  
        </form>

        <div class = "tablaDatos">
            <table style = " width: 90%;">
                <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Libro</th>
                        <th scope="col">Autor(es)</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        while($fila = mysqli_fetch_array($datos)){
                            echo "<tr>";
                            echo "<th scope='row'>".$fila['idLibro']."</th>";
                            echo "<td scope='row'>".$fila['isbn']."</td>";
                            echo "<td>".$fila['titulo']."</td>";
                            echo "<td>";
                                $autores = $server->obtenerAutores($fila['idLibro']);
                                    while ($autor = mysqli_fetch_array($autores)){
                                        echo " - ".$autor["nombre"]." ".$autor["apellidoPaterno"]." ".$autor["apellidoPaterno"]."<br>";
                                    }
                            echo "</td>";
                            echo "<td>
                                    <a class='btnDetalles' href='libroDetalles.php?id=".$fila['idLibro']."'>👁 Ver detalles</a>
                                    <a class='btnEditar' href='libroModificar.php?id=".$fila['idLibro']."'>🖉 Editar</a>
                                    <a class='btnEliminar' href='libroDeshabilitar.php?id=".$fila['idLibro']."'>⮾ Eliminar</a>
                                </td>";
                            echo "</th>";
                            echo "</tr>";
                        }
                        if (mysqli_num_rows($datos) == 0){
                            echo 'No se han encontrado coincidencias con tu busqueda "'.$libro.'"';
                        }
                        
                    ?>
                </tbody>
            </table>

        </div>

        <a class = "cancel" href="libroConsultar.php">Cancelar</a>
        <br><br>

    </div>

</body>

</html>