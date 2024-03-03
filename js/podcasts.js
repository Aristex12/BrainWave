$(document).ready(function () {
    // Utiliza delegación de eventos para los elementos con clase 'podcast'
    $('.podcast_container').on('click', '.podcast', function () {
        var link = $(this).data('link');
        var modal = $('#myModal');
        var modalContent = $('#modalContent');
        var closeBtn = $('#closeBtn');

        // Mostrar iframe con el enlace del podcast
        modalContent.html('<iframe width="100%" height="100%" src="' + link + '" frameborder="0" allowfullscreen></iframe>');

        // Mostrar el modal
        modal.css('display', 'flex');
    });

    // Utiliza delegación de eventos para el botón de cierre
    $('#myModal').on('click', '#closeBtn', function () {
        $('#myModal').css('display', 'none');
        $('#modalContent').html(''); // Limpiar el contenido del iframe
    });

    // Utiliza delegación de eventos para cerrar el modal al hacer clic fuera del contenido
    $(window).on('click', function (event) {
        if (event.target == $('#myModal')[0]) {
            $('#myModal').css('display', 'none');
            $('#modalContent').html(''); // Limpiar el contenido del iframe
        }
    });
});

function buscarPodcasts() {
    // Obtiene el valor del campo de búsqueda
    var busqueda = $('#buscador').val();

    // Validación: Verifica si la cadena de búsqueda contiene solo caracteres alfanuméricos y espacios
    if (/^[a-zA-Z0-9\s]*$/.test(busqueda)) {
        // Realiza la petición AJAX
        $.ajax({
            url: '../procesamiento_datos/procesar_podcasts.php', // Reemplaza esto con la ruta correcta
            type: 'GET',
            data: { buscador: busqueda },
            success: function(response) {
                // Actualiza el contenido de la sección de libros con la respuesta del servidor
                $('.podcast_container').html(response);
            },
            error: function(error) {
                console.error('Error en la petición AJAX', error);
            }
        });
        esconderMensajes();
    } else {
        // Mensaje de error si la cadena de búsqueda no es válida
        mostrarError('La búsqueda contiene caracteres no permitidos. Por favor, ingrese una búsqueda válida.');
    }
}

$(document).ready(function () {
    $('form').submit(function (e) {
        e.preventDefault(); // Evita el envío predeterminado del formulario
        buscarLibros(); // Llama a tu función de búsqueda de libros
    });
});

function mostrarError(mensaje) {
    const errorDiv = document.querySelector('.error');
    const errorText = document.querySelector('.error_text');
    const exitoDiv = document.querySelector('.succes');
    
    // Mostrar el mensaje de error y hacer visible el div
    errorText.textContent = mensaje;
    errorDiv.style.display = 'flex';
    exitoDiv.style.display = 'none';

}

function esconderMensajes(){
    const errorDiv = document.querySelector('.error');
    const exitoDiv = document.querySelector('.succes');

    errorDiv.style.display = "none";
    exitoDiv.style.display = "none";

}