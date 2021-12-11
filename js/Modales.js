function msjRegistrado (op){
    var modalRegistrado = new bootstrap.Modal(document.getElementById('modalRegistro'), {
        keyboard: false,
        backdrop: 'static'
    });

    var btnAceptar = document.getElementById('btnAceptarR');
    var btnCancelar = document.getElementById('btnCancelarR');
    var mensaje = document.getElementById('mensajeR');

    if (op == "categoria" || op == "editorial"){
        mensaje.innerHTML = "La "+op+" ha sido registrada con éxito!";
        btnCancelar.innerHTML = "Agregar otra " + op;
    }else{
        mensaje.innerHTML = "El "+op+" ha sido registrado con éxito!";
        btnCancelar.innerHTML = "Agregar otro " + op;
    }
    

    btnAceptar.addEventListener("click", function () {
        window.location = op+"Consultar.php";
    }, false);

    btnCancelar.addEventListener("click", function () {
        if (op="prestamo"){
            window.location = "prestamoAgregar.php";
        }else{
            window.location = op+"Consultar.php";
        }
    }, false);

    modalRegistrado.show();
}

function msjExiste (op){
    var modalExiste = new bootstrap.Modal(document.getElementById('modalExiste'), {
        keyboard: false
    });

    var btnAceptar = document.getElementById('btnAceptarE');
    var mensaje = document.getElementById('mensajeE');

    if (op == "categoria" || op == "editorial"){
        mensaje.innerHTML = "La "+op+" que escribió ya está registrada";
    }else if (op == "alumno"){
        mensaje.innerHTML = "La matrícula del alumno que escribió ya está registrada";
    }else if (op == "libro"){
        mensaje.innerHTML = "El isbn del libro que escribió ya está registrado";
    }else{
        mensaje.innerHTML = "El "+op+" que escribió ya está registrado";
    }

    btnAceptar.addEventListener("click", function () {
            window.location = op+'Consultar.php';
    }, false);

    modalExiste.show();
}

function msjNoExiste (op){
    var modalNoExiste = new bootstrap.Modal(document.getElementById('modalNoExiste'), {
        keyboard: false,
        backdrop: 'static'
    });

    var btnAceptar = document.getElementById('btnAceptarNE');

    btnAceptar.addEventListener("click", function () {
        
    }, false);

    modalNoExiste.show();
}

function msjDeshabilitado (op, redireccion){
    var modalDeshabilitado = new bootstrap.Modal(document.getElementById('modalDeshabilitado'), {
        keyboard: false,
        backdrop: 'static'
    });

    var btnAceptar = document.getElementById('btnAceptarD');
    var mensaje = document.getElementById('mensajeD');

    if (op == "categoria" || op == "editorial"){
        mensaje.innerHTML = "La "+op+" ha sido eliminada con éxito!";
    }else{
        mensaje.innerHTML = "El "+op+" ha sido eliminado con éxito!";
    }

    btnAceptar.addEventListener("click", function () {
        if(op == 'usuario'){
            window.location = redireccion;    
        }
        window.location = op+'Consultar.php';
    }, false);

    modalDeshabilitado.show();
}

function msjModificado (op, id){
    var modalModificado = new bootstrap.Modal(document.getElementById('modalModificado'), {
        keyboard: false
    });

    var btnAceptar = document.getElementById('btnAceptarM');
    var btnSeguirEditando = document.getElementById('btnCancelarM');
    var mensaje = document.getElementById('mensajeM');

    if (op == "categoria" || op == "editorial"){
        mensaje.innerHTML = "La "+op+" ha sido modificada con éxito!";
    }else{
        mensaje.innerHTML = "El "+op+" ha sido modificado con éxito!";
    }

    btnAceptar.addEventListener("click", function () {
        window.location = op+"Consultar.php";
    }, false);

    btnSeguirEditando.addEventListener("click", function () {
        window.location = op+"Modificar.php?id="+id;
    }, false);

    modalModificado.show();
}

function msjFracaso (op){
    var modalFracaso = new bootstrap.Modal(document.getElementById('modalFracaso'), {
        keyboard: false,
        backdrop: 'static'
    });

    var btnAceptar = document.getElementById('btnAceptarF');
    var mensaje = document.getElementById('mensajeF');

    mensaje.innerHTML = "Ha ocurrido un error.";

    btnAceptar.addEventListener("click", function () {
        if(op == 'usuario'){
            window.location = redireccion;    
        }
        window.location = op+'Consultar.php';
    }, false);

    modalFracaso.show();
}

function msjFaltan(op){
    var modalFracaso = new bootstrap.Modal(document.getElementById('modalFracaso'), {
        keyboard: false,
        backdrop: 'static'
    });

    var btnAceptar = document.getElementById('btnAceptarF');
    var mensaje = document.getElementById('mensajeF');

    if (op = "libro"){
        mensaje.innerHTML = "No se seleccionó ningún autor.";
    }
    if (op = "prestamo" || op == "prestamoM"){
        mensaje.innerHTML = "No se dispone de la existencia suficiente para realizar el préstamo.";
    }
    
    btnAceptar.addEventListener("click", function () {
        if (op == "prestamoM"){
            window.location = op+'Modificar.php';
        }else{
            window.location = op+'Agregar.php';
        }
    }, false);

    modalFracaso.show();
}