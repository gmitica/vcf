/**
 * Mostrar al usuario una notificación
 * Se puede llamar varias veces provocando unas notificaciones en cascada
 * 
 * @param {string} texto el texto del la notificación
 * @param {boolean} esError en caso de que se tenga que mostrar como error true
 * @param {number} tiempo (integer) secundos los que tiene que permanecer
 */
function showNotify(texto, esError, tiempo) {
    var example = document.getElementById("notifyCont");
    result = "";
    if (example == null) {
        result += '<div id="notifyCont" style="position:absolute; top:0; right:0; min-width: 200px; color:black;">';
    }
    tiempo = tiempo * 1000;
    result += '<div class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="' + tiempo + '">';
    result += '<div class="toast-header">';
    imagen = "succes.svg";
    estado = "Info";
    if (esError) {
        imagen = "faild.svg";
        estado = "Error";
    }
    result += '<img src="/img/' + imagen + '" class="rounded mr-2" alt="error" width="16px">';
    result += '<strong class="mr-auto">' + estado + '</strong>';
    result += '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">';
    result += '<span aria-hidden="true">&times;</span>';
    result += '</button>';
    result += '</div>';
    result += '<div class="toast-body">';
    result += texto;
    result += '</div></div>';
    if (example != null) {
        $("#notifyCont").append(result);
    } else {
        result += '</div>';
        $("body").append(result);
    }
    $('.toast').toast('show');
    $('.toast').on('hidden.bs.toast', function() {
        this.remove();
    });

}