<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <title>Biblioteca escolar</title>
    <meta charset="UTF-8">
    <link href="css/Estilo.css" rel="stylesheet">

</head>

<style>

.index{
  background-color: transparent;  
  background-image: url("Imagenes/lineas y puntos.jpg");
  background-size: 30%;
  background-repeat: repeat;

}
</style>



<body class="index">

    <?php
    include("barraNavegacion.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Perfil de usuario</h1>
        </div>
    </header>

    <div  class="inicio">


    <section style="float:left;">
        <div class= "caja" >
            <h6>ID de usuario: <?php echo $_SESSION['idUsuario']?></h6>
            <h6>Nombre del usuario: <?php echo $_SESSION['nombreUsuario']?></h6>
            <h6>Nombre completo: <?php echo $_SESSION['nombres']." ".$_SESSION['apellidoPaterno']." ".$_SESSION['apellidoMaterno']?></h6>
        </div>
    </section>


    <section style="float:right">
    <h4>Opciones</h4>
    <a id="usuario" href="usuarioModificar.php?id=<?php echo $_SESSION['idUsuario']?>">Modificar Usuario</a>
    <a href="cerrarSesion.php">Cerrar sesión</a>


    </section>


    </div>






</body>

</html>