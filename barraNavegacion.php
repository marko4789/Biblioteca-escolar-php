
<ul>
  <li><a class="active" href="Index.php" id = "inicio">Inicio</a></li>

  <li class="dropdown" ><a class="dropbtn" href="">Catálogo</a>
  <div class="dropdown-content">
  <a href="#">Link 1</a>
  <a href="#">Link 2</a>
  <a href="#">Link 3</a>
  </div>
  </li>






<?php
            if( !isset( $_SESSION["idUsuario"] ) ){
                echo " <li class = 'bntSesion'><a href='iniciarSesion.php'>Iniciar sesión</a></li> ";
            }else{
               echo "
               <li><a href=''>Libros</a></li>
               <li><a href=''>Autores</a></li>
               <li><a href=''>Categorías</a></li>
               <li><a href=''>Editoriales</a></li>
               <li><a href=''>Usuarios</a></li>
               <li><a href=''>Alumnos</a></li>
               <li><a href=''>Préstamos</a></li>
               <li class = 'msjBienvenida'><b>Bienvenido(a):</b> ".$_SESSION['nombres']."</li>
               <li class = 'bntSesion'><a href='cerrarSesion.php'>Cerrar sesión</a></li> ";
            }
        ?>

</ul>
