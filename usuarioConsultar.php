<?php
    include("validarSesion.php");

    $mostrarModal = false;

    include_once ('Conexion.php');
    
    if(isset($_POST["usuario"])){
        $usuario = $_POST["usuario"];
        $datos = $server->buscarUsuario($usuario);

        if (mysqli_num_rows($datos) == 0){
            $mostrarModal = true;
            $datos = $server->consultarTabla("usuarios");
        }

    }else{
        $usuario = "";
        $datos = $server->consultarTabla("usuarios");
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
            <h1>Consultar Usuario</h1>
        </div>
    </header>
        

    <div class = "frmFormulario">
    <a class ="agregar" href="usuarioAgregar.php">  <i class='far fa-plus-square'></i> Nuevo usuario</a>

    <div class="frmMargen2">

        <form class = "frmBuscar" method="post" action= 'usuarioConsultar.php'>
            <input placeholder = "Escriba el nombre del usuario a buscar" name="usuario" value="<?php echo $usuario;?>" type="text" pattern="[\wñÑá-ú]+" required>
            <button type="submit" name="buscar"><i class="fas fa-search"></i> Buscar</button>  
        </form>
        
        <div class = "tablaDatos">
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
                                    <a class='btnEditar' href='usuarioModificar.php?id=".$fila['idUsuario']."'><i class='far fa-edit'></i> Editar</a>
                                    <a class='btnEliminar' href='usuarioDeshabilitar.php?id=".$fila['idUsuario']."'><i class='far fa-minus-square'></i> Eliminar</a>
                                </td>";
                            echo "</th>";
                            echo "</tr>";
                        }
                        if ($mostrarModal){
                            echo "  <script>
                                        msjNoExiste ('usuario');
                                    </script>";
                        }
                    
                    ?>
                </tbody>
            </table>

        </div> <!-- Div con la clase tablaDatos -->

        </div>

        <a class = "cancel" href="usuarioConsultar.php">Cancelar</a>
        <br><br>

    </div> <!-- Div con la clase frmFormulario -->
        
    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>
    
</body>

</html>