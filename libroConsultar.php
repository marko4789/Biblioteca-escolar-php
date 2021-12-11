<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    $mostrarModal = false;

    include_once ('Conexion.php');
    if(isset($_POST["libro"])){
        $libro = $_POST["libro"];
        $datos = $server->buscarLibro($libro);

        if (mysqli_num_rows($datos) == 0){
            $mostrarModal = true;
            $datos = $server->consultarTabla("libros");
        }

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
            <h1>Consultar Libro</h1>
        </div>
    </header>

    <div class = "frmFormulario">

    <?php  
        if (isset( $_SESSION['idUsuario'])) {
            echo '<a class ="agregar" href="libroAgregar.php"> <i class="far fa-plus-square"></i> Nuevo libro</a>';
        }
    ?>


    <div class="frmMargen2">

        <form class = "frmBuscar" method="post" action= 'libroConsultar.php'>
            <input placeholder = "Título, autor, ISBN o la categoría del libro a buscar" name="libro" type="text" pattern="([\w]|[á-úñÑ.\-\s])+" required>
            <button type="submit" name="buscar">  <i class="fas fa-search"></i> Buscar</button>  
        </form>

        <div class = "tablaDatos">
            <table>
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
                                        echo " - ".$autor["nombre"]." ".$autor["apellidoPaterno"]." ".$autor["apellidoMaterno"]."<br>";
                                    }
                            echo "</td>";
                            if (isset( $_SESSION['idUsuario'])) {
                                echo "<td>
                                    <a class='btnDetalles' href='libroDetalles.php?id=".$fila['idLibro']."'> <i class='far fa-eye'></i> Ver detalles</a>
                                    <a class='btnEditar' href='libroModificar.php?id=".$fila['idLibro']."'> <i class='far fa-edit'></i> Editar</a>
                                    <a class='btnEliminar' href='libroDeshabilitar.php?id=".$fila['idLibro']."'>  <i class='far fa-minus-square'></i> Eliminar</a>
                                </td>";
                            }else{
                                echo "<td>
                                    <a class='btnDetalles' href='libroDetalles.php?id=".$fila['idLibro']."'>👁 Ver detalles</a>
                                </td>";
                            }
                            echo "</th>";
                            echo "</tr>";
                        }

                        if ($mostrarModal){
                            echo "  <script>
                                        msjNoExiste ('libro');
                                    </script>";
                        }
                        
                    ?>
                </tbody>
            </table>

            </div> 

        </div>

        <a class = "cancel" href="libroConsultar.php">Cancelar</a>
        <br><br>

    </div>

    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>

</body>

</html>