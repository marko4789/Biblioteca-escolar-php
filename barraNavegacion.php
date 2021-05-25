
<ul>
  <li><a class="active" href="">Inicio</a></li>
  <li><a href="">Libros</a></li>
  <li><a href="">Autores</a></li>
  <li><a href="">Categorías</a></li>



<?php
            if( !isset( $_SESSION["idUsuario"] ) ){
                echo " <li class = 'bntSesion'><a href='iniciarSesion.php'>Iniciar sesión</a></li> ";
            }else{
              // echo"Bienvenido(a):".$_SESSION['nombres']." ";
               echo " <li class = 'bntSesion'><a href='cerrarSesion.php'>Cerrar sesión</a></li> ";
            }
        ?>

</ul>
