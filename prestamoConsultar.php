<?php
    include("validarSesion.php");
    include_once ('Conexion.php');
    if(isset($_POST["prestamo"])){
        $prestamo = $_POST["prestamo"];
        $datos = $server->buscarPrestamo($prestamo);
    }else{
        $prestamo = "";
        $datos = $server->consultarPrestamo();
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
            <h1>Consultar Préstamo</h1>
        </div>
    </header>



    <div class = "frmFormulario">

        <a class ="agregar" href="prestamoAgregar.php">  <i class='far fa-plus-square'></i> Nuevo préstamo</a>

        <div class="frmMargen2">

            <form class = "frmBuscar" method="post" action= 'prestamoConsultar.php'>
                <input placeholder = "Escriba datos relacionados con el préstamo" name="prestamo" type="text" pattern="([\w]|[á-úñÑ.\-\s])+" required>
                <button type="submit" name="buscar"><i class="fas fa-search"></i> Buscar</button>  
            </form>

            <div class = "tablaDatos">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">#id</th>
                            <th scope="col">Título</th>
                            <th scope="col">Nombre(s)</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Matrícula</th>
                            <th scope="col">Fecha préstamo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            while($fila = mysqli_fetch_array($datos)){
                                echo "<tr>";
                                echo "<th scope='row'>".$fila['idPrestamo']."</th>";
                                echo "<td scope='row'>".$fila['titulo']."</td>";
                                echo "<td>".$fila['nombre']."</td>";
                                echo "<td>".$fila['apellidoPaterno']."<br>".$fila['apellidoMaterno']."</td>";
                                echo "<td>".$fila['matricula']."</td>";
                                echo "<td>".$fila['fechaPrestamo']."</td>";
                                
                                echo "<td>  
                                        <a class='btnEditar' href='prestamoModificar.php?id=".$fila['idPrestamo']."'><i class='far fa-edit'></i> Editar</a>
                                        <a class='btnEliminar' href='prestamoDeshabilitar.php?id=".$fila['idPrestamo']."'><i class='far fa-minus-square'></i> Eliminar</a>
                                    </td>";
                                echo "</th>";
                                echo "</tr>";
                            }
                            if (mysqli_num_rows($datos) == 0 && isset($_POST["prestamo"])){
                                echo 'No se han encontrado coincidencias con tu busqueda "'.$prestamo.'"';
                            }
                            
                        ?>
                    </tbody>
                </table>

            </div>

            </div>

            <a class = "cancel" href="prestamoConsultar.php">Cancelar</a>
            <br><br>

            

    </div>




</body>

</html>