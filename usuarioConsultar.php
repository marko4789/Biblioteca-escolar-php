<?php
    include("validarSesion.php");

    include_once ('Conexion.php');
    if(isset($_POST["usuario"])){
        $usuario = $_POST["usuario"];
        $datos = $server->buscarUsuario($usuario);
    }else{
        $datos = $server->consultarTabla("usuarios");
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
            <h1>Consultar Usuario</h1>
        </div>

        <form method="post" action= 'usuarioConsultar.php'>
            <input placeholder = "Nombre de usuario o Nombre de empleado" name="usuario" type="text" pattern="[\wñ]+" required>
            <button type="submit" name="buscar">Buscar</button>  
        </form>
        
        <div>
        <div>
            <h2 style="text-align: center;">Listado de usuarios</h2>
        </div>

        <div>
            <table>
                <thead>
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
                                    <a class='btn btn-success' href='usuarioModificar.php?id=".$fila['idUsuario']."'><img src='Imagenes/Lapiz.png' width='28' height='28'> Editar</a>
                                    <a class='btn btn-danger' href='usuarioDeshabilitar.php?id=".$fila['idUsuario']."'><img src='Imagenes/Basura.png' width='28' height='28'> Eliminar</a>
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