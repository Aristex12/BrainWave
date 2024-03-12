$(document).ready(function () {
    // Utiliza delegación de eventos para los elementos con clase 'articulo'
    $('.articulos_container').on('click', '.articulo', function () {
        var modal = $('#myModal');
        var modalContent = $('#modalContent');
        var closeBtn = $('#closeBtn');

        // Obtener datos del artículo
        var titulo = $(this).find('h2').text();

        // Obtener contenido completo oculto
        var contenidoCompleto = $(this).find('.contenido-completo-oculto').text();

        // Mostrar datos en el modal
        modalContent.html('<h2>' + titulo + '</h2><p class="contenido-completo">' + contenidoCompleto + '</p>');

        // Mostrar el modal
        modal.css('display', 'flex');
    });

    // Utiliza delegación de eventos para el botón de cierre
    $('#myModal').on('click', '#closeBtn', function () {
        $('#myModal').css('display', 'none');
    });

    // Utiliza delegación de eventos para cerrar el modal al hacer clic fuera del contenido
    $(window).on('click', function (event) {
        if (event.target == $('#myModal')[0]) {
            $('#myModal').css('display', 'none');
        }
    });

    // Resto de tu código...
});

function buscarArticulos() {
    // Obtiene el valor del campo de búsqueda
    var busqueda = $('#buscador').val();

    // Validación: Verifica si la cadena de búsqueda contiene solo caracteres alfanuméricos y espacios
    if (/^[a-zA-Z0-9\s]*$/.test(busqueda)) {
        // Realiza la petición AJAX
        $.ajax({
            url: '../procesamiento_datos/procesar_articulos.php', // Reemplaza esto con la ruta correcta
            type: 'GET',
            data: { buscador: busqueda },
            success: function(response) {
                // Actualiza el contenido de la sección de libros con la respuesta del servidor
                $('.articulos_container').html(response);
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
        buscarArticulos(); // Llama a tu función de búsqueda de libros
    });
});

function mostrarError(mensaje) {
    const errorDiv = document.querySelector('.error');
    const errorText = document.querySelector('.error_text');
    
    // Mostrar el mensaje de error y hacer visible el div
    errorText.textContent = mensaje;
    errorDiv.style.display = 'flex';
}

function esconderMensajes(){
    const errorDiv = document.querySelector('.error');

    errorDiv.style.display = "none";
}