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
  background-image: url("Imagenes/fondo_libros.jpg");
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
            <img src="Imagenes/banner_logo_1.png" alt="Biblioteca Escolar">
        </div>
    </header>


    <div class="inicio">


     
    <section style="float:left">

    <H3>CONSULTAR LIBROS</H3>
    <p>
        En la consulta de libros se pueden hacer tanto consultas generales como específicas de cada libro
        cualquier usuario puede consultar los libros en existencia para un préstamo posterior.
    </p>
    <img src="https://image.freepik.com/vector-gratis/libro-blanco-sobre-fondo-blanco_1308-23052.jpg" alt="imagen ilustrativa">
    <a href="libroConsultar.php">📚 Libros</a>

    </section>

   

    <?php
    
    if(isset( $_SESSION['idUsuario'] )){
        
        echo'
        
        <section style="float:right">';?>

        

        <div class="carrusel">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="marcoImagen">
                            <img src="Imagenes/iconos/préstamo.png">
                        </div>
                        <div class="carrusel-separador">
                                <a id="prestamo" href="prestamoConsultar.php"><i class="fas fa-book"></i> Préstamos</a>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="marcoImagen">
                            <img src="Imagenes/iconos/alumno.png">
                        </div>
                        <div class="carrusel-separador">
                            <a id="alumno" href="alumnoConsultar.php"><i class="fas fa-user-graduate"></i> Alumnos</a>
                        </div>       
                    </div>

                    <div class="carousel-item">
                        <div class="marcoImagen">
                            <img src="Imagenes/iconos/autor.png">
                        </div>
                        <div class="carrusel-separador">
                            <a id="autor" href="autorConsultar.php"><i class="fas fa-user-tie"></i> Autores</a>
                        </div>       
                    </div>

                    <div class="carousel-item">
                        <div class="marcoImagen">
                            <img src="Imagenes/iconos/editorial.png">
                        </div>
                        <div class="carrusel-separador">
                            <a id="editorial" href="editorialConsultar.php"><i class="fas fa-globe"></i> Editoriales</a>
                        </div>       
                    </div>

                    <div class="carousel-item">
                        <div class="marcoImagen">
                            <img src="Imagenes/iconos/categoría.png">
                        </div>
                        <div class="carrusel-separador">
                            <a id="categoria" href="categoriaConsultar.php"><i class="fas fa-lightbulb"></i> Categorías</a>
                        </div>       
                    </div>

                    <div class="carousel-item">
                        <div class="marcoImagen">
                            <img src="Imagenes/iconos/usuario.png">
                        </div>
                        <div class="carrusel-separador">
                            <a id="usuario" href="usuarioConsultar.php"><i class="fas fa-user"></i> Usuarios</a>
                        </div>       
                    </div>
                    
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span  class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>    



        <?php
        echo '
         </section>
        
        ';

    }//fin si
    else{

        echo'
        
        <section style="float:right;">';
        ?>
        
        <div class="carrusel">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="Imagenes/libro2.jpg" class="d-block w-100">
                        
                    </div>
                    <div class="carousel-item">
                        <img src="Imagenes/libro1.jpg" class="d-block w-100" alt="...">
                        
                    </div>
                    
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span  class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>       
        
        <?php

        echo '

        <h4 style = "font-style: italic;">
        "Es un buen libro aquel que se abre con expectación y se cierra con provecho"
        </h4>
        <h5>Amos Bronson Alcott.</h5>
   
         </section>
        
        ';

    }//fin sino

    ?>


   
    </div><!--   Fin div class inicio   -->

  
    <footer>Trabajo realizado en conjunto por Ocampos Ortega Marco Antonio y Ruiz Martínez Mónica Lizbeth </footer>


</body>

</html>



<!--
    

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



!-->