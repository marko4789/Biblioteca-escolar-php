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
            mostrarFormulario();
        } else if (isset($_REQUEST["btnSiguiente"])){
            if ($_REQUEST["btnSiguiente"] == "paso2"){
                mostrarAutor();
            }else if ($_REQUEST["btnSiguiente"] == "paso3"){
                mostrarCategoria();
            }else if ($_REQUEST["btnSiguiente"] == "paso4"){
                mostrarEditorial();
            }
            
        } else if (isset($_GET["idCategoria"])) {
            mostrarEditorial();
        } else if (isset($_GET["idEditorial"])) {
            agregarLibro();
        } else {
            echo "<script>
                        msjFracaso();
                    </script>";
        }
    
        
        function mostrarFormulario(){
            echo '
            <div class= "frmFormulario">

            <h2>Datos del libro</h2>

            <form method="post" action= "libroAgregar.php">

                <div class="frmMargen">
                    
                    <label>Título</label>
                    <input placeholder = "Nombre del libro" name="titulo" type="text" pattern="([\w]|[á-úñÑ.\s]|[!¡#$%&/\(\)=¿?-+])+" required>

                    <label>Descripción</label><br>
                    <textarea placeholder = "Escriba una breve descripción" name="descripcion" rows="10" cols="50" required></textarea> <br>

                    <label>Número de páginas</label>
                    <input  placeholder = "Seleccione o digite el número de páginas" name="paginas" type="number" min=1 required><br>

                    <label>País</label>
                    <input  placeholder = "País de donde procede el libro" name="pais" type="text" pattern="([a-z]|[A-Z]|[á-úñÑ\s])+">

                    <label>Fecha de publicación</label>
                    <input name="fechaPublicacion" type="date" required><br>

                    <label>Idioma</label>
                    <input  placeholder = "Idioma en el que está escrito" name="idioma" type="text">

                    <label>ISBN</label>
                    <input  placeholder = "Número Internacional Normalizado del Libro" name="isbn" type="text" pattern="([-\d]){10,17}">

                    <label>Existencia</label>
                    <input name="existencia" placeholder = "Numero de ejemplares" type="number" min=1 required><br>


                    <button type="submit" name="btnSiguiente" value="paso2">Siguiente</button>

                </div>

            </form>

            <a class = "cancel" href="libroConsultar.php">Cancelar</a> <br><br>
                
            </div>
            
            ';
        }

        function mostrarAutor(){

            if (isset($_POST["titulo"])){
                setcookie("titulo", $_POST["titulo"], 0, "/");    
                setcookie("descripcion", $_POST["descripcion"], 0, "/");
                setcookie("paginas", $_POST["paginas"], 0, "/");
                setcookie("pais", $_POST["pais"], 0, "/");
                setcookie("fechaPublicacion", $_POST["fechaPublicacion"], 0, "/");
                setcookie("idioma", $_POST["idioma"], 0, "/");
                setcookie("isbn", $_POST["isbn"], 0, "/");
                setcookie("existencia", $_POST["existencia"], 0, "/");
            }

            global $server;
            
            if(isset($_POST["autor"])){
                $autor = $_POST["autor"];
                $datos = $server->buscarAutor($autor);
            }else{
                $datos = $server->consultarTabla("autores");
            }

            echo '
            <div class = "frmFormulario">

            <form class = "frmBuscar" method="post" action= "libroAgregar.php">
                <input placeholder = "Escriba el nombre del autor a buscar" name="autor" type="text" pattern="([\w]|[á-úñÑ.\s])+" required>
                <button type="submit" name="btnSiguiente" value="paso2">🔍 Buscar</button>  
            </form>

            <p>Seleccione los autores del libro: </p>

            <form method="post" action= "libroAgregar.php">
                <div class = "tablaDatos">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Seleccionar</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido paterno</th>
                                <th scope="col">Apellido materno</th>
                            </tr>
                        </thead>
                        <tbody>';

                                while($fila = mysqli_fetch_array($datos)){
                                    echo "<tr>";
                                    echo "<th scope='row'><input name='idAutor[]' type='checkbox' value=".$fila['idAutor']."></th>";
                                    echo "<td>".$fila['nombre']."</td>";
                                    echo "<td>".$fila['apellidoPaterno']."</td>";
                                    echo "<td>".$fila['apellidoMaterno']."</td>";
                                    echo "</th>";
                                    echo "</tr>";
                                }
                                if (mysqli_num_rows($datos) == 0){
                                    echo 'No se han encontrado coincidencias con tu busqueda "'.$autor.'"';
                                }
                                
                echo '        </tbody>
                    </table>

                </div>

            <div class= "frmMargen">
            <button type="submit" name="btnSiguiente" value="paso3">Siguiente</button>
            </div>                 

            <a class = "cancel" href="libroConsultar.php">Cancelar</a>

            </form>
            <br><br>

        </div>
                
                ';                
                
        }

        function mostrarCategoria() {

            if(isset($_POST['idAutor'])){
                setcookie("idAutor", serialize($_POST['idAutor']), 0, "/");
                
            }

            global $server;
            
            if(isset($_POST["categoria"])){
                $categoria = $_POST["categoria"];
                $datos = $server->buscarCategoria($categoria);
            }else{
                $datos = $server->consultarTabla("categorias");
            }

            echo '
            <div class = "frmFormulario">

            <form class = "frmBuscar" method="post" action= "libroAgregar.php">
                <input placeholder = "Escriba el nombre de la categoría a buscar" name="categoria" type="text" pattern="[\wñá-ú]+" required>
                <button type="submit" name="btnSiguiente" value="paso3">🔍 Buscar</button>  
            </form>
    
            <div class = "tablaDatos">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">#id</th>
                            <th scope="col">Categoría(s)</th>
                            <th scope="col">Acciones</th>
    
                        </tr>
                    </thead>
                    <tbody>';

                            while($fila = mysqli_fetch_array($datos)){
                                echo "<tr>";
                                echo "<th scope='row'>".$fila["idCategoria"]."</th>";
                                echo "<td>".$fila["categoria"]."</td>";
                                echo "<td>
                                        <a class='btnEditar' href='libroAgregar.php?idCategoria=".$fila['idCategoria']."'>Seleccionar</a>
                                    </td>";
                                echo "</th>";
                                echo "</tr>";
                            }
    
                            if (mysqli_num_rows($datos) == 0){
                                echo "No se han encontrado coincidencias con tu busqueda \"".$categoria."\"";
                            }
                            
            echo '      </tbody>
                </table>
    
            </div> <!-- Div con la clase tablaDatos -->
    
            <a class = "cancel" href="libroConsultar.php">Cancelar</a>
            <br><br>
    
        </div> <!-- Div con la clase frmFormulario -->
    
            ';

        }

        function mostrarEditorial() {
            
            global $server;

            if (isset($_GET["idCategoria"])){
                setcookie("idCategoria", $_GET["idCategoria"], 0, "/");
            }

            if(isset($_POST["editorial"])){
                $editorial = $_POST["editorial"];
                $datos = $server->buscarEditorial($editorial);
            }else{
                $editorial = "";
                $datos = $server->consultarTabla("editoriales");
            }
            
            echo '
            <div class = "frmFormulario">

                <form class = "frmBuscar" method="post" action= "libroAgregar.php">
                    <input placeholder = "Escriba el nombre de la editorial a buscar" name="editorial" type="text" pattern="([\w]|[á-úñÑ.\s])+" required>
                    <button type="submit" name="btnSiguiente" value="paso4">🔍 Buscar</button>  
                </form>

                <div class = "tablaDatos">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">#id</th>
                                <th scope="col">Nombre de editorial</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>';

                                while($fila = mysqli_fetch_array($datos)){
                                    echo "<tr>";
                                    echo "<th scope='row'>".$fila['idEditorial']."</th>";
                                    echo "<td>".$fila['editorial']."</td>";
                                    echo "<td>
                                            <a class='btnEditar' href='libroAgregar.php?idEditorial=".$fila['idEditorial']."'>Seleccionar</a>
                                        </td>";
                                    echo "</th>";
                                    echo "</tr>";
                                }
                                if (mysqli_num_rows($datos) == 0){
                                    echo 'No se han encontrado coincidencias con tu busqueda "'.$editorial.'"';
                                }
                               
                echo '        </tbody>
                    </table>

                </div>

                <a class = "cancel" href="libroConsultar.php">Cancelar</a>
                <br><br>

            </div>
            ';

        }

        function agregarLibro(){
            if (isset($_GET["idEditorial"])){
                setcookie("idEditorial", $_GET["idEditorial"], 0, "/");
                echo "<br>";
            }

            if(existeLibro($_COOKIE["isbn"])){
                borrarCookies();
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

            if (!isset($_COOKIE["idEditorial"])){
                $_COOKIE["idEditorial"] = $_GET["idEditorial"];
            }
            
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
                            VALUES ('".$_COOKIE["titulo"]."', 
                                    '".$_COOKIE["descripcion"]."', 
                                    ".$_COOKIE["paginas"].", 
                                    '".$_COOKIE["pais"]."', 
                                    '".$_COOKIE["fechaPublicacion"]."', 
                                    '".$_COOKIE["idioma"]."', 
                                    '".$_COOKIE["isbn"]."', 
                                    ".$_COOKIE["existencia"].", 
                                    ".$_COOKIE["idCategoria"].", 
                                    ".$_COOKIE["idEditorial"].", 
                                    'Activo');";


            $idAutores = unserialize($_COOKIE["idAutor"]);

            borrarCookies();
            
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

                        "<script>
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
                borrarCookies();
/*
                echo "<script>
                            msjFracaso();
                            window.location='libroAgregar.php';
                        </script>";*/
            }
        }

        function borrarCookies(){
            setcookie("titulo", "" , time() - 1, "/");    
            setcookie("descripcion", "", time() - 1, "/");
            setcookie("paginas", "", time() - 1, "/");
            setcookie("pais", "", time() - 1, "/");
            setcookie("fechaPublicacion", "", time() - 1, "/");
            setcookie("idioma", "", time() - 1, "/");
            setcookie("isbn", "", time() - 1, "/");
            setcookie("existencia", "", time() - 1, "/");
            setcookie("idAutor", "", time() - 1, "/");
            setcookie("idCategoria", "", time() - 1, "/");
            setcookie("idEditorial", "", time() - 1, "/");
        }
        
        ?>

        

</body>

</html>