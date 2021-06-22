<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca Escolar</title>
 
  <link href="css/Estilo.css" rel="stylesheet">
  <link href="css/EstilosNavegacion.css" rel="stylesheet">
 


</head>
<body>
  

<ul>
  <li><a href="Index.php" id = "inicio">Inicio</a></li>

  
  <!-- 
  <div class="dropdown-content">
  <a href="libroConsultar.php">Libros</a>
  <a href="#">Autores</a>
  <a href="#">Categorías</a> 
  </div>
  -->

  </li>






<?php
            if( !isset( $_SESSION["idUsuario"] ) ){
                echo " <li class = 'btnSesion'><a class = 'btnSesion' href='iniciarSesion.php'>Iniciar sesión</a></li> ";
                echo'<li class="dropdown" ><a class="dropbtn" href="libroConsultar.php">Libros</a>';
            }else{
               echo "
               <li class='dropdown'><a href='libroConsultar.php'>Libros</a>

               <div class='dropdown-content'>
               <a href='libroAgregar.php'>Agregar Libro</a>
               <a href='libroConsultar.php'>Consultar Libros</a>


               
               </div>
               
               </li>

               <li class='dropdown'><a href='autorConsultar.php'>Autores</a>
               
               <div class='dropdown-content'>
               <a href='autorAgregar.php'>Agregar Autor</a>
               <a href='autorConsultar.php'>Consultar Autores</a>
               </div>

               </li>


               <li class='dropdown'><a href='categoriaConsultar.php'>Categorías</a>
               
               <div class='dropdown-content'>
               <a href='categoriaAgregar.php'>Agregar Categoría</a>
               <a href='categoriaConsultar.php'>Consultar Categorías</a>
               </div>

               </li>


               <li class='dropdown'><a href='editorialConsultar.php'>Editoriales</a>
               
               <div class='dropdown-content'>
               <a href='editorialAgregar.php'>Agregar Editorial</a>
               <a href='editorialConsultar.php'>Consultar Editoriales</a>
               </div>

               </li>


               <li class='dropdown'><a href='usuarioConsultar.php'>Usuarios</a>
               
               <div class='dropdown-content'>
               <a href='usuarioAgregar.php'>Agregar Usuario</a>
               <a href='usuarioConsultar.php'>Consultar Usuarios</a>
               </div>
               
               </li>


               <li class='dropdown'><a href='alumnoConsultar.php'>Alumnos</a>
               
               <div class='dropdown-content'>
               <a href='alumnoAgregar.php'>Agregar Alumno</a>
               <a href='alumnoConsultar.php'>Consultar Alumnos</a>
               </div>
               
               </li>


               <li class='dropdown'><a href='prestamoConsultar.php'>Préstamos</a>
               
               <div class='dropdown-content'>
               <a href='prestamoAgregar.php'>Agregar Préstamo</a>
               <a href='prestamoConsultar.php'>Consultar Préstamos</a> 
               </div>
               
               </li>

               <li class='dropdown' id = 'msjBienvenida'><b>Bienvenido(a):</b> ".$_SESSION['nombres']."
              
               <div class='dropdown-content'>
               <a href='cerrarSesion.php'>Cerrar sesión</a>
               </div>

               </li>
               
               ";
            }
        ?>

</ul>



</body>
</html>


