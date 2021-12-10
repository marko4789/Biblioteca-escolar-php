<div class="modal" id="modalRegistro" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Éxito</h5>
            </div>
            <div class="modal-body">
                <p id="mensajeR"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCancelarR" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-primary" id="btnAceptarR">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalExiste" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="mensajeE"></p>
                <p>Elija otro y vuelva a intentarlo.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="btnAceptarE" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalNoExiste" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error</h5>
            </div>
            <div class="modal-body">
                <p>No se han encontrado coincidencias con tu busqueda.</p>
                <p>Vuelva a intentarlo.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="btnAceptarNE" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalDeshabilitado" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Éxito</h5>
            </div>
            <div class="modal-body">
                <p id="mensajeD"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnAceptarD">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalModificado" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Éxito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="mensajeM"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCancelarM" data-bs-dismiss="modal">Seguir modificando</button>
                <button type="button" class="btn btn-primary" id="btnAceptarM">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalFracaso" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error</h5>
            </div>
            <div class="modal-body">
                <p id="mensajeF"></p>
                <p>Intentelo más tarde</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnAceptarF">Aceptar</button>
            </div>
        </div>
    </div>
</div>