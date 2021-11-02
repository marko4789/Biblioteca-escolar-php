<?php
    include("validarSesion.php");
    include_once("Conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <title>Biblioteca escolar</title>
    <meta charset="UTF-8">

    <link href="css/Estilo.css" rel="stylesheet">

    <script>
    
        function msjLibroExistente (){
            alert('El isbn del libro que escribió ya está registrado\n\nElija otro y vuelva a intentarlo');
        }

        function msjFaltanAutores(){
            alert('No se seleccionó ningún autor');
        }

        function msjExito (){
            alert('El libro ha sido registrado con éxito!');
        }

        function msjFracaso (){
            alert('Ha ocurrido un Error, intentelo más tarde.');
        }

    </script>

</head>

<body>

    <?php
    include("barraNavegacion.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Agregar Libro</h1>
        </div>
    </header>
            

    <?php

        if(!isset($_REQUEST["btnSiguiente"]) && !isset($_GET["idCategoria"]) && !isset($_GET["idEditorial"])){
            include 'libroAgregarPaso1.php';
        } else if (isset($_REQUEST["btnSiguiente"])){
            if ($_REQUEST["btnSiguiente"] == "paso2"){
                include 'libroAgregarPaso2.php';
            }else if ($_REQUEST["btnSiguiente"] == "paso3"){
                include 'libroAgregarPaso3.php';
            }else if ($_REQUEST["btnSiguiente"] == "paso4"){
                include 'libroAgregarPaso4.php';
            }
            
        } else if (isset($_GET["idCategoria"])) {
            include 'libroAgregarPaso4.php';
        } else if (isset($_GET["idEditorial"])) {
            agregarLibro();
        } else {
            echo "<script>
                        msjFracaso();
                    </script>";
        }
    

        

        function agregarLibro(){
            if (isset($_GET["idEditorial"])){
                $_SESSION["idEditorial"] = $_GET["idEditorial"];
            }

            if(existeLibro($_SESSION["isbn"])){
                borrarDatosLibro();
                echo "<script>
                            msjLibroExistente();
                            window.location='libroAgregar.php';
                        </script>";
            }else{
                registrarLibro();

            }            

        }

        function existeLibro($isbn){
            global $server;

            $consulta = "SELECT isbn FROM libros WHERE isbn = '$isbn' AND status ='Activo';";

            $datosLibro = $server->conexion->query($consulta);
            
            //Si existe un registro en la BD
            if(mysqli_num_rows($datosLibro) >= 1){
                return true;
            }else{
                return false;
            }
        }

        function registrarLibro() {

            global $server;
            
            $registroLibro = "INSERT INTO libros (titulo, 
                                            descripcion, 
                                            paginas, 
                                            pais, 
                                            fechaPublicacion, 
                                            idioma, 
                                            isbn, 
                                            existencia, 
                                            idCategoria, 
                                            idEditorial, 
                                            status)
                            VALUES ('".$_SESSION["titulo"]."', 
                                    '".$_SESSION["descripcion"]."', 
                                    ".$_SESSION["paginas"].", 
                                    '".$_SESSION["pais"]."', 
                                    '".$_SESSION["fechaPublicacion"]."', 
                                    '".$_SESSION["idioma"]."', 
                                    '".$_SESSION["isbn"]."', 
                                    ".$_SESSION["existencia"].", 
                                    ".$_SESSION["idCategoria"].", 
                                    ".$_SESSION["idEditorial"].", 
                                    'Activo');";

            $idAutores = unserialize($_SESSION["idAutor"]);
            
            borrarDatosLibro();
            
            if ($server->conexion->query($registroLibro)) {
                
                $idLibro = $server->conexion->insert_id;

                foreach ($idAutores as $idAutor){

                    $relacionAutores = "INSERT INTO relacion_autoria (idAutor, idLibro)
                                            VALUES ($idAutor, $idLibro);";

                    try {
                        $server->conexion->query($relacionAutores);
                    } catch (mysqli_sql_exception $e) {
                        echo $e;
                        $server->conexion->query("DELETE FROM relacion_autoria WHERE idLibro = $idLibro");
                        $server->conexion->query("DELETE FROM libros WHERE idLibro = $idLibro");

                        echo "<script>
                                msjFracaso();
                                window.location='libroAgregar.php';
                              </script>";

                    }

                }

                echo "<script>
                            msjExito();
                            window.location='libroConsultar.php';
                        </script>";
            
            }else{
                borrarDatosLibro();
                echo "<script>
                            msjFracaso();
                            window.location='libroAgregar.php';
                        </script>";
            }
        }

        function borrarDatosLibro(){
            unset($_SESSION["titulo"]);    
            unset($_SESSION["descripcion"]);
            unset($_SESSION["paginas"]);
            unset($_SESSION["pais"]);
            unset($_SESSION["fechaPublicacion"]);
            unset($_SESSION["idioma"]);
            unset($_SESSION["isbn"]);
            unset($_SESSION["existencia"]);
            unset($_SESSION["idAutor"]);
            unset($_SESSION["idCategoria"]);
            unset($_SESSION["idEditorial"]);
        }
        
        ?>

        

</body>

</html>