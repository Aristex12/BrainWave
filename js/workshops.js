document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('myModal');
    var modalContent = document.getElementById('modalContent');
    var closeBtn = document.getElementById('closeBtn');

    // Utilizar la delegación de eventos en el contenedor .workshop_container
    $('.workshop_container').on('click', '.workshop', function () {
        // Obtener datos del taller
        var nombreEvento = $(this).find('h2').text();
        var contenidoCompleto = $(this).find('.contenido-completo-oculto').text();

        // Mostrar datos en el modal
        modalContent.innerHTML = '<h2>' + nombreEvento + '</h2>';
        modalContent.innerHTML += '<p>' + contenidoCompleto + '</p>';

        // Mostrar detalles comunes a todos los eventos
        modalContent.innerHTML += '<ul class="lista">';
        modalContent.innerHTML += '<li><span class="fuerte">Fecha:</span> ' + $(this).data('fecha') + '</li>';
        modalContent.innerHTML += '<li><span class="fuerte">Hora:</span> ' + $(this).data('hora') + '</li>';
        modalContent.innerHTML += '<li><span class="fuerte">Lugar:</span> ' + $(this).data('lugar-nombre') + ', ' + $(this).data('lugar-direccion') + '</li>';
        modalContent.innerHTML += '</ul>';

        // Mostrar actividades
        modalContent.innerHTML += '<h2>Lo que haremos</h2>';
        modalContent.innerHTML += '<ul class="lista_actividades">';
        modalContent.innerHTML += '<li><span class="fuerte">Sesiones Educativas:</span> Sumérgete en sesiones informativas dirigidas por expertos en TDAH, donde exploraremos la neurobiología, diagnóstico, tratamiento y manejo del TDAH en diferentes etapas de la vida.</li>';
        modalContent.innerHTML += '<li><span class="fuerte">Talleres Interactivos:</span> Participa en talleres prácticos diseñados para enseñar estrategias y habilidades de afrontamiento tanto para aquellos que viven con TDAH como para sus familiares y cuidadores.</li>';
        modalContent.innerHTML += '<li><span class="fuerte">Red de Apoyo:</span> Conecta con otras personas afectadas por el TDAH, comparte experiencias y construye una red de apoyo sólida y comprensiva.</li>';
        modalContent.innerHTML += '<li><span class="fuerte">Recursos Útiles:</span> Descubre una variedad de recursos locales y nacionales disponibles para aquellos que enfrentan desafíos relacionados con el TDAH, incluyendo servicios de salud mental, grupos de apoyo y organizaciones comunitarias.</li>';
        modalContent.innerHTML += '</ul>';

        // Mostrar razones para participar
        modalContent.innerHTML += '<h2>Por qué deberías participar</h2>';
        modalContent.innerHTML += '<p>"' + nombreEvento + '" no es solo un evento, es una oportunidad para aprender, conectarte y encontrar apoyo en un entorno inclusivo y comprensivo. Ya sea que estés buscando información educativa, estrategias prácticas o simplemente una comunidad que entienda tus desafíos, este evento está diseñado para brindarte las herramientas y el apoyo que necesitas.</p>';
        modalContent.innerHTML += '<p>¡Únete a nosotros y juntos desafiaremos los límites del TDAH!</p>';

        modalContent.innerHTML += '<form method="post"><input type="hidden" name="id_escondido" value="' + $(this).data('id') + '"><button name="boton_enviar" type="submit" class="boton_participar">Participar</button></form>';

        // Mostrar el modal
        modal.style.display = 'flex';
    });

    // Utilizar addEventListener para el evento 'click' en el botón de cerrar
    closeBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    // Cerrar el modal al hacer clic fuera del contenido
    window.addEventListener('click', function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });

    // Evento de entrada de texto en el buscador
    $('#buscador').on('input', function () {
        var busqueda = $(this).val();
        buscarWorkshops(busqueda);
    });

    $('form').submit(function (e) {
        e.preventDefault(); // Evita el envío predeterminado del formulario
        var busqueda = $('#buscador').val();
        buscarWorkshops(busqueda); // Llama a la función de búsqueda de talleres
    });

    // $('.workshop_container').on('submit', 'form', function (e) {
    //     e.preventDefault(); // Evitar el envío predeterminado del formulario
    
    //     // Obtener el formulario actual y el valor del campo oculto
    //     var form = $(this);
    //     var idEvento = form.find('input[name="id_escondido"]').val();
    
    //     // Realizar la petición AJAX
    //     $.ajax({
    //         url: '../procesamiento_datos/procesar_workshops2.php',
    //         type: 'POST', // O el método que uses en tu backend
    //         data: { id_evento: idEvento }, // Puedes enviar otros datos según tus necesidades
    //         success: function (response) {
    //             // Manejar la respuesta del servidor según sea necesario
    //             console.log(response);
    //         },
    //         error: function (error) {
    //             console.error('Error en la petición AJAX', error);
    //         }
    //     });
    // });

});

// Función para realizar la búsqueda de talleres
function buscarWorkshops(busqueda) {
    $.ajax({
        url: '../procesamiento_datos/procesar_workshops.php',
        type: 'GET',
        data: { buscador: busqueda },
        success: function (response) {
            $('.workshop_container').html(response);
        },
        error: function (error) {
            console.error('Error en la petición AJAX', error);
        }
    });
}

