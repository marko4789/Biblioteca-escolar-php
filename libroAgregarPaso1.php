<?php 
    if(!isset($_SESSION["editando"])){
                borrarDatosLibro();
    }
?>

<div class= "frmFormulario">

    <h2>Datos del libro</h2>

    <form class="frmMargen" method="post" action= "libroAgregar.php">
            
        <label>Título</label>
        <input placeholder = "Nombre del libro" name="titulo" type="text" pattern="([\w]|[á-úñÑ.\s]|[!¡#$%&/\(\)=¿?-+])+" value= "<?php if (isset($_SESSION["titulo"])){echo $_SESSION["titulo"];} ?>" required>

        <label>Descripción</label><br>
        <textarea placeholder = "Escriba una breve descripción" name="descripcion" rows="10" cols="50" required><?php if (isset($_SESSION["descripcion"])){echo str_replace("\\", "", $_SESSION["descripcion"]);} ?></textarea> <br>

        <label>Número de páginas</label>
        <input  placeholder = "Seleccione o digite el número de páginas" name="paginas" type="number" min=1 value="<?php if (isset($_SESSION["paginas"])){echo $_SESSION["paginas"];} ?>" required><br>

        <label>País</label>
        <input  placeholder = "País de donde procede el libro" name="pais" type="text" pattern="([a-z]|[A-Z]|[á-úñÑ\s])+" value="<?php if (isset($_SESSION["pais"])){echo $_SESSION["pais"];} ?>">

        <label>Fecha de publicación</label>
        <input name="fechaPublicacion" type="date" value="<?php if (isset($_SESSION["fechaPublicacion"])){echo $_SESSION["fechaPublicacion"];} ?>" required><br>

        <label>Idioma</label>
        <input  placeholder = "Idioma en el que está escrito" name="idioma" type="text" pattern="([a-z]|[A-Z]|[á-úñÑ\s])+" value="<?php if (isset($_SESSION["idioma"])){echo $_SESSION["idioma"];} ?>" required>

        <label>ISBN</label>
        <input  placeholder = "Número Internacional Normalizado del Libro" name="isbn" type="text" pattern="([-\d]){10,17}" value="<?php if (isset($_SESSION["isbn"])){echo $_SESSION["isbn"];} ?>" required>

        <label>Existencia</label>
        <input name="existencia" placeholder = "Numero de ejemplares" type="number" min=1 value="<?php if (isset($_SESSION["existencia"])){echo $_SESSION["existencia"];} ?>" required><br>


        <button type="submit" name="btnSiguiente" value="paso2">Siguiente</button>

    </form>

    <a class = "cancel" href="libroConsultar.php">Cancelar</a> <br><br>

    <?php
        if (isset($_SESSION["editando"])){
                    unset($_SESSION["editando"]);
        }
    ?>
        
</div>