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


     
    <section style="float:left">

    <H3>CONSULTAR LIBROS</H3>
    <p>
        En la consulta de libros se pueden hacer tanto consultas generales como específicas de cada libro
        cualquier usuario puede consultar los libros en existencia para un préstamo posterior.
    </p>
    <img style="width:30%;" src="https://image.freepik.com/vector-gratis/libro-blanco-sobre-fondo-blanco_1308-23052.jpg" alt="imagen ilustrativa">
    <a style="width:50%;" href="libroConsultar.php">📚 Libros</a>

    </section>

   

    <?php
    
    if(isset( $_SESSION['idUsuario'] )){
        
        echo'
        
        <section style="float:right">

        <br><br>

        <table>
        <tbody>
           
            <tr>
               <td> <a id="prestamo" href="prestamoConsultar.php">📓 Préstamos</a> </td>
               <td> <a id="alumno" href="alumnoConsultar.php">🙋 Alumnos</a> </td>
            </tr>
            <tr>
               <td> <a id="autor" href="autorConsultar.php">👨 Autores</a> </td>
               <td> <a id="usuario" href="usuarioConsultar.php">👤 Usuarios</a> </td>
            </tr>
            <tr>
               <td> <a id="categoria" href="categoriaConsultar.php">💡 Categorías</a> </td>
               <td> <a id="editorial" href="editorialConsultar.php">🏢 Editoriales</a> </td>
            </tr>
            
        </tbody>
    </table>

        
         </section>
        
        ';

    }//fin si
    else{

        echo'
        
        <section style="float:right;">

        <img src="https://image.freepik.com/vector-gratis/ilustracion-dia-mundial-libro-plano-organico_23-2148884673.jpg" alt="Día mundial del libro">

        <h3 style = "font-style: italic;">
        "Es un buen libro aquel que se abre con expectación y se cierra con provecho"
        </h3>
        <h4>Amos Bronson Alcott.</h4>
   
         </section>
        
        ';

    }//fin sino

    ?>


   
    </div><!--   Fin div class inicio   -->

<small>
    <footer>Trabajo realizado en conjunto por Ocampos Ortega Marco Antonio y Ruiz Martínez Mónica Lizbeth </footer>
    </small>

</body>

</html>