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

<body>

    <?php
    include("barraNavegacion.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Biblioteca escolar</h1>
        </div>
    </header>


    <div class="inicio">

    <h2>BIENVENIDO</h2>
     <div class ="">
    <section style="float:left">

    <H3>CONSULTAR LIBROS</H3>
    <p>
        En la consulta de libros se pueden hacer tanto consultas generales como específicas de cada libro
        cualquier usuario puede consultar los libros en existencia para un préstamo posterior.
    </p>
    <img src="https://image.freepik.com/vector-gratis/libro-blanco-sobre-fondo-blanco_1308-23052.jpg" alt="imagen ilustrativa">
    <a href="libroConsultar.php">Ir a la consulta de libros</a>

    </section>


    <section style="float:right">

    <H3>CONSULTAR LIBROS</H3>
    <p>
        En la consulta de libros se pueden hacer tanto consultas generales como específicas de cada libro
        cualquier usuario puede consultar los libros en existencia para un préstamo posterior.
    </p>
   

    </section>
    </div>
    </div>

<small>
    <footer>Trabajo realizado en conjunto por Ocampos Ortega Marco Antonio y Ruiz Martínez Mónica Lizbeth </footer>
    </small>

</body>

</html>