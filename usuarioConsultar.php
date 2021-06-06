<?php
    include("validarSesion.php");

    include_once ('Conexion.php');

    $datos = $server->consultarTabla("usuarios");
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
            <h1>Consultar Usuario</h1>
        </div>

        <div class="card">
        <div class="card-header">
            <h2 style="text-align: center;">Listado de usuarios</h2>
        </div>

        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Nombre(s)</th>
                        <th scope="col">Apellido paterno</th>
                        <th scope="col">Apellido materno</th>
                        <th scope="col">Email</th>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                        while($fila = mysqli_fetch_array($datos)){
                            echo "<tr>";
                            echo "<th scope='row'>".$fila['idUsuario']."</th>";
                            echo "<td>".$fila['nombreUsuario']."</td>";
                            echo "<td>".$fila['nombre']."</td>";
                            echo "<td>".$fila['apellidoPaterno']."</td>";
                            echo "<td>".$fila['apellidoMaterno']."</td>";
                            echo "<td>".$fila['email']."</td>";
                            echo "<td>
                                    <a class='btn btn-success' href='usuariosEditar.php?id=".$fila['idUsuario']."'><img src='Imagenes/Lapiz.png' width='28' height='28'> Editar</a>
                                    <a class='btn btn-danger' href='usuariosEliminar.php?id=".$fila['idUsuario']."'><img src='Imagenes/Basura.png' width='28' height='28'> Eliminar</a>
                                </td>";
                            echo "</th>";
                            echo "</tr>";
                        }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
        

    </header>

</body>

</html>