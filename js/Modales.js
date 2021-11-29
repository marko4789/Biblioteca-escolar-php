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
    }else{
        mensaje.innerHTML = "El "+op+" que escribió ya está registrado";
    }

    modalExiste.show();
}

function msjNoExiste (op){
    var modalNoExiste = new bootstrap.Modal(document.getElementById('modalNoExiste'), {
        keyboard: false,
        backdrop: 'static'
    });

    var btnAceptar = document.getElementById('btnAceptarNE');

    btnAceptar.addEventListener("click", function () {
        window.location = op+'Consultar.php';
    }, false);

    modalNoExiste.show();
}

function msjDeshabilitado (op){
    var modalDeshabilitado = new bootstrap.Modal(document.getElementById('modalDeshabilitado'), {
        keyboard: false,
        backdrop: 'static'
    });

    var btnAceptar = document.getElementById('btnAceptarD');
    var mensaje = document.getElementById('mensajeD');

    if (op == "categoria" || op == "editorial"){
        mensaje.innerHTML = "La "+op+" ha sido eliminado con éxito!";
    }else{
        mensaje.innerHTML = "El "+op+" ha sido eliminado con éxito!";
    }

    btnAceptar.addEventListener("click", function () {
        window.location = op+'Consultar.php';
    }, false);

    modalDeshabilitado.show();
}

function msjModificado (op){
    var modalModificado = new bootstrap.Modal(document.getElementById('modalModificado'), {
        keyboard: false
    });

    var btnAceptar = document.getElementById('btnAceptarM');
    var mensaje = document.getElementById('mensajeM');

    if (op == "categoria" || op == "editorial"){
        mensaje.innerHTML = "La "+op+" ha sido modificada con éxito!";
    }else{
        mensaje.innerHTML = "El "+op+" ha sido modificado con éxito!";
    }

    btnAceptar.addEventListener("click", function () {
        window.location = op+"Consultar.php";
    }, false);

    modalModificado.show();
}