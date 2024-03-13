$(document).ready(function () {

    function mostrarError(mensaje) {
        const errorDiv = document.querySelector('.error');
        const errorText = document.querySelector('.error_text');
        const exitoDiv = document.querySelector('.succes');
        
        // Mostrar el mensaje de error y hacer visible el div
        errorText.textContent = mensaje;
        errorDiv.style.display = 'flex';
        exitoDiv.style.display = 'none';

    }

    function mostrarExito(mensaje) {
        const exitoDiv = document.querySelector('.succes');
        const exitoText = document.querySelector('.succes_text');
        const errorDiv = document.querySelector('.error');
    
        // Agregar el icono de "check" de Font Awesome
        exitoText.innerHTML = mensaje;
    
        // Mostrar el mensaje de éxito y hacer visible el div
        exitoDiv.style.display = 'flex';
        errorDiv.style.display = 'none';
    }

    function esconderMensajes(){
        const errorDiv = document.querySelector('.error');
        const exitoDiv = document.querySelector('.succes');

        errorDiv.style.display = "none";
        exitoDiv.style.display = "none";

    }

    function buscarWorkshops(busqueda) {
        // Valida el input con una expresión regular
        var inputValor = document.getElementById("buscador").value;
        var regex = /^[a-zA-Z0-9\s]*$/;
        if (!regex.test(inputValor)) {
            mostrarError('El valor introducido no es válido. Solo se permiten letras, números y espacios.');
            return;
        } else {
            esconderMensajes();
        }

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

    function enviarInscripcion(idEvento) {
        $.ajax({
            url: '../procesamiento_datos/procesar_workshops2.php',
            type: 'POST',
            dataType: 'json',
            data: { id_escondido: idEvento, boton_enviar: true },
            success: function (response) {
                // Puedes manejar la respuesta según tus necesidades
                console.log(response);
                
                if(response.success){
                    mostrarExito(response.message);
                }

                if(response.error){
                    mostrarError(response.message);
                }

                // Verificar si la respuesta contiene una redirección
                if (response.redirect) {
                    // Redirigir a la página de inicio de sesión
                    window.location.href = response.redirect;
                }
            },
            error: function (error) {
                console.error('Error en la petición AJAX', error);
            }
        });
    }

    var modal = $('#myModal');
    var modalContent = $('#modalContent');
    var closeBtn = $('#closeBtn');

    // Utilizar la delegación de eventos en el contenedor .workshop_container
    $('.workshop_container').on('click', '.workshop', function () {
        // Obtener datos del taller
        var nombreEvento = $(this).find('h2').text();
        var contenidoCompleto = $(this).find('.contenido-completo-oculto').text();

        // Mostrar datos en el modal
        modalContent.html('<h2>' + nombreEvento + '</h2>');
        modalContent.append('<p>' + contenidoCompleto + '</p>');

        // Mostrar detalles comunes a todos los eventos
        var detallesComunes = '<ul class="lista2">';
        detallesComunes += '<li><span class="fuerte">Fecha:</span> ' + $(this).data('fecha') + '</li>';
        detallesComunes += '<li><span class="fuerte">Hora:</span> ' + $(this).data('hora') + '</li>';
        detallesComunes += '<li><span class="fuerte">Lugar:</span> ' + $(this).data('lugar-nombre') + ', ' + $(this).data('lugar-direccion') + '</li>';
        detallesComunes += '</ul>';
        modalContent.append(detallesComunes);

        // Mostrar actividades
        var actividades = '<h2>Lo que haremos</h2>';
        actividades += '<ul class="lista_actividades">';
        actividades += '<li><span class="fuerte">Sesiones Educativas:</span> Sumérgete en sesiones informativas dirigidas por expertos en TDAH, donde exploraremos la neurobiología, diagnóstico, tratamiento y manejo del TDAH en diferentes etapas de la vida.</li>';
        actividades += '<li><span class="fuerte">Talleres Interactivos:</span> Participa en talleres prácticos diseñados para enseñar estrategias y habilidades de afrontamiento tanto para aquellos que viven con TDAH como para sus familiares y cuidadores.</li>';
        actividades += '<li><span class="fuerte">Red de Apoyo:</span> Conecta con otras personas afectadas por el TDAH, comparte experiencias y construye una red de apoyo sólida y comprensiva.</li>';
        actividades += '<li><span class="fuerte">Recursos Útiles:</span> Descubre una variedad de recursos locales y nacionales disponibles para aquellos que enfrentan desafíos relacionados con el TDAH, incluyendo servicios de salud mental, grupos de apoyo y organizaciones comunitarias.</li>';
        actividades += '</ul>';
        modalContent.append(actividades);

        // Mostrar razones para participar
        var razonesParticipar = '<h2>Por qué deberías participar</h2>';
        razonesParticipar += '<p>"' + nombreEvento + '" no es solo un evento, es una oportunidad para aprender, conectarte y encontrar apoyo en un entorno inclusivo y comprensivo. Ya sea que estés buscando información educativa, estrategias prácticas o simplemente una comunidad que entienda tus desafíos, este evento está diseñado para brindarte las herramientas y el apoyo que necesitas.</p>';
        razonesParticipar += '<p>¡Únete a nosotros y juntos desafiaremos los límites del TDAH!</p>';
        modalContent.append(razonesParticipar);

        // Mostrar el formulario
        var formulario = '<form id="inscripcionForm"><input type="hidden" name="id_escondido" value="' + $(this).data('id') + '"><button type="button" class="boton_participar">Participar</button></form>';
        modalContent.append(formulario);

        // Mostrar el modal con animación
        modal.fadeIn();
    });

    // Utilizar delegación de eventos para el botón de cerrar
    closeBtn.on('click', function () {
        // Ocultar el modal con animación
        modal.fadeOut();
    });

    // Cerrar el modal al hacer clic fuera del contenido
    $(window).on('click', function (event) {
        if (event.target == modal[0]) {
            // Ocultar el modal con animación
            modal.fadeOut();
        }
    });

    // Evento de entrada de texto en el buscador
    $('#buscador').on('input', function () {
        var busqueda = $(this).val();
        if (typeof buscarWorkshops === 'function') {
            buscarWorkshops(busqueda);
        }
    });

    // Evento click para el botón "Participar"
    modalContent.on('click', '.boton_participar', function (e) {
        e.preventDefault(); // Evita el comportamiento predeterminado del formulario

        // Captura el ID del evento
        var idEvento = $('#modalContent').find('form input[name="id_escondido"]').val();

        // Realiza la inscripción
        enviarInscripcion(idEvento);

        // Cierra el modal (o realiza las acciones necesarias)
        modal.fadeOut();
    });

    $(document).ready(function () {
        $('form').submit(function (e) {
            e.preventDefault(); // Evita el envío predeterminado del formulario
        });
    });

});




