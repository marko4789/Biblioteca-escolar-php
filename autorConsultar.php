<?php
    include("validarSesion.php");

    include_once ('Conexion.php');
    if(isset($_POST["autor"])){
        $autor = $_POST["autor"];
        $datos = $server->buscarAutor($autor);
    }else{
        $autor = "";
        $datos = $server->consultarTabla("autores");
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
            <h1>Consultar Autor</h1>
        </div>

        

    </header>


    <div class = "frmFormulario">

        <form class = "frmBuscar" method="post" action= 'autorConsultar.php'>
            <input placeholder = "Escriba el nombre del autor a buscar" name="autor" type="text" pattern="([\w]|[á-úñÑ.\s])+" required>
            <button type="submit" name="buscar">🔍 Buscar</button>  
        </form>

        <div class = "tablaDatos">
            <table>
                <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Nombre(s)</th>
                        <th scope="col">Apellido paterno</th>
                        <th scope="col">Apellido materno</th>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                        while($fila = mysqli_fetch_array($datos)){
                            echo "<tr>";
                            echo "<th scope='row'>".$fila['idAutor']."</th>";
                            echo "<td>".$fila['nombre']."</td>";
                            echo "<td>".$fila['apellidoPaterno']."</td>";
                            echo "<td>".$fila['apellidoMaterno']."</td>";
                            echo "<td>
                                    <a class='btnEditar' href='autorModificar.php?id=".$fila['idAutor']."'>🖉 Editar</a>
                                    <a class='btnEliminar' href='autorDeshabilitar.php?id=".$fila['idAutor']."'>⮾ Eliminar</a>
                                </td>";
                            echo "</th>";
                            echo "</tr>";
                        }
                        if (mysqli_num_rows($datos) == 0){
                            echo 'No se han encontrado coincidencias con tu busqueda "'.$autor.'"';
                        }
                        
                    ?>
                </tbody>
            </table>

        </div> <!-- Div con la clase tablaDatos -->

        <a class = "cancel" href="autorConsultar.php">Cancelar</a>
        <br><br>

    </div> <!-- Div con la clase frmFormulario -->



</body>

</html>