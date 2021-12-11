<?php
    include("validarSesion.php");
    
    $mostrarModal = false;

    include_once ('Conexion.php');

    if(isset($_POST["alumno"])){
        $alumno = $_POST["alumno"];
        $datos = $server->buscarAlumno($alumno);

        if (mysqli_num_rows($datos) == 0){
            $mostrarModal = true;
            $datos = $server->consultarTabla("alumnos");
        }

    }else{
        $alumno = "";
        $datos = $server->consultarTabla("alumnos");
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
            <h1>Consultar Alumno</h1>
        </div>       
    </header>

    <div class = "frmFormulario">

    <a class ="agregar" href="alumnoAgregar.php">  <i class='far fa-plus-square'></i> Nuevo alumno</a>

    <div class="frmMargen2">

        <form class = "frmBuscar" method="post" action= 'alumnoConsultar.php'>
            <input placeholder = "Escriba el nombre del alumno a buscar" name="alumno" value="<?php echo $alumno;?>" type="text" pattern="[\wñÑá-ú\- .,]+" required>
            <button type="submit" name="buscar"><i class="fas fa-search"></i> Buscar</button>  
        </form>

        <div class = "tablaDatos">
            <table>
                <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Nombre(s)</th>
                        <th scope="col">Apellido paterno</th>
                        <th scope="col">Apellido materno</th>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Deudor</th>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                        while($fila = mysqli_fetch_array($datos)){
                            echo "<tr>";
                            echo "<th scope='row'>".$fila['idAlumno']."</th>";
                            echo "<td>".$fila['nombre']."</td>";
                            echo "<td>".$fila['apellidoPaterno']."</td>";
                            echo "<td>".$fila['apellidoMaterno']."</td>";
                            echo "<td>".$fila['matricula']."</td>";
                            echo "<td>".$fila['deudor']."</td>";
                            echo "<td>
                                    <a class='btnEditar' href='alumnoModificar.php?id=".$fila['idAlumno']."'><i class='far fa-edit'></i> Editar</a>
                                    <a class='btnEliminar' href='alumnoDeshabilitar.php?id=".$fila['idAlumno']."'><i class='far fa-minus-square'></i> Eliminar</a>
                                </td>";
                            echo "</th>";
                            echo "</tr>";
                        }
                        if ($mostrarModal){
                            echo "  <script>
                                        msjNoExiste ('alumno');
                                    </script>";
                        }
                    
                    ?>
                </tbody>
            </table>

        </div> <!-- Div con la clase tablaDatos -->

        </div>

        <a class = "cancel" href="alumnoConsultar.php">Cancelar</a>
        <br><br>

        

    </div> <!-- Div con la clase frmFormulario -->

    
    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>

</body>

</html>