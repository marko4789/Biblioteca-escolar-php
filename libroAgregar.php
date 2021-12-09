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
    <link href="Bootstrap_5.1.3/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="js/Modales.js"></script>

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
        include("Modales.php");
    ?>

    <header>
        <div class="titulo">
            <h1>Agregar Libro</h1>
        </div>
    </header>
            
    <script src="Bootstrap_5.1.3/js/bootstrap.min.js"></script>

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
            
        } else if ( isset( $_GET[ "idCategoria" ] ) ) {
            include 'libroAgregarPaso4.php';
        } else if (isset( $_GET[ "idEditorial" ] ) ) {
            agregarLibro();
        } else {
            echo "  <script>
                        msjFracaso();
                    </script>";
        }
    

        

        function agregarLibro(){
            if (isset( $_GET[ "idEditorial" ] ) ) {
                $infoLibro = json_decode( file_get_contents( 'infoLibro.json' ), true );
                $infoLibro[ "idEditorial" ] = ( int ) $_GET[ 'idEditorial' ];
                file_put_contents( "infoLibro.json", json_encode( $infoLibro ) );
            }

            if(existeLibro($infoLibro["isbn"])){
                borrarDatosLibro();
                echo "<script>
                            msjExiste ('libro');
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
            
            $infoLibro = json_decode( file_get_contents( 'infoLibro.json' ), true );
            
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
                            VALUES ('".$infoLibro["titulo"]."', 
                                    '".$infoLibro["descripcion"]."', 
                                    ".$infoLibro["paginas"].", 
                                    '".$infoLibro["pais"]."', 
                                    '".$infoLibro["fechaPublicacion"]."', 
                                    '".$infoLibro["idioma"]."', 
                                    '".$infoLibro["isbn"]."', 
                                    ".$infoLibro["existencia"].", 
                                    ".$infoLibro["idCategoria"].", 
                                    ".$infoLibro["idEditorial"].", 
                                    'Activo');";

            $idAutores = $infoLibro["idAutor"];
            
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
                                msjFracaso('libro');
                              </script>";
                    }

                }

                echo "  <script>
                            msjRegistrado ('libro');
                        </script>";
            
            }else{
                borrarDatosLibro();
                echo "<script>
                            msjFracaso('libro');
                        </script>";
            }
        }

        function borrarDatosLibro(){

            file_put_contents( "infoLibro.json", "");

        }
        
        ?>

</body>

</html>