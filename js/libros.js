function buscarLibros() {
    // Obtiene el valor del campo de búsqueda
    var busqueda = $('#buscador').val();

    // Validación: Verifica si la cadena de búsqueda contiene solo caracteres alfanuméricos y espacios
    if (/^[a-zA-Z0-9\s]*$/.test(busqueda)) {
        // Realiza la petición AJAX
        $.ajax({
            url: '../procesamiento_datos/procesar_libros.php', // Reemplaza esto con la ruta correcta
            type: 'GET',
            data: { buscador: busqueda },
            success: function(response) {
                // Actualiza el contenido de la sección de libros con la respuesta del servidor
                $('.libros_container').html(response);
            },
            error: function(error) {
                console.error('Error en la petición AJAX', error);
            }
        });
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
