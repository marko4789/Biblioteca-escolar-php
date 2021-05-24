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

    <header>
        <div class="titulo">
            <h2>Biblioteca escolar</h2>
        </div>

        <?php
            if( !isset( $_SESSION["idUsuario"] ) ){
                echo "  <button type='submit' onclick='location.href=\"IniciarSesion.php\"'>
                            Iniciar sesión
                        </button>";
            }else{
               echo"Bienvenido(a):".$_SESSION['nombres']." ";
            }
        ?>

    </header>

</body>

</html>