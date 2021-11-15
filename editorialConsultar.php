<?php
    include("validarSesion.php");

    include_once ('Conexion.php');
    if(isset($_POST["editorial"])){
        $editorial = $_POST["editorial"];
        $datos = $server->buscarEditorial($editorial);
    }else{
        $editorial = "";
        $datos = $server->consultarTabla("editoriales");
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
            <h1>Consultar Editorial</h1>
        </div>
    </header>

        <div class = "frmFormulario">
        <a class ="agregar" href="editorialAgregar.php">  <i class='far fa-plus-square'></i> Nueva editorial</a>

        <div class="frmMargen2">

        <form class = "frmBuscar" method="post" action= 'editorialConsultar.php'>
            <input placeholder = "Escriba el nombre de la editorial a buscar" name="editorial" type="text" pattern="([\w]|[á-úñÑ.\s])+" required>
            <button type="submit" name="buscar"><i class="fas fa-search"></i> Buscar</button>  
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
                                    <a class='btnEditar' href='editorialModificar.php?id=".$fila['idEditorial']."'><i class='far fa-edit'></i> Editar</a>
                                    <a class='btnEliminar' href='editorialDeshabilitar.php?id=".$fila['idEditorial']."'><i class='far fa-minus-square'></i> Eliminar</a>
                                </td>";
                            echo "</th>";
                            echo "</tr>";
                        }
                        if (mysqli_num_rows($datos) == 0 && isset($_POST["editorial"])){
                            echo 'No se han encontrado coincidencias con tu busqueda "'.$editorial.'"';
                        }
                        
                    ?>
                </tbody>
            </table>

        </div>

        </div>

        <a class = "cancel" href="editorialConsultar.php">Cancelar</a>
        <br><br>

      

    </div>

</body>

</html>