document.addEventListener('DOMContentLoaded', function () {
    var workshops = document.querySelectorAll('.workshop');

    workshops.forEach(function (workshop) {
        workshop.addEventListener('click', function () {
            var modal = document.getElementById('myModal');
            var modalContent = document.getElementById('modalContent');
            var closeBtn = document.getElementById('closeBtn');

            // Obtener datos del taller
            var nombreEvento = workshop.querySelector('h2').textContent;

            // Obtener contenido completo desde el elemento oculto
            var contenidoCompleto = workshop.querySelector('.contenido-completo-oculto').textContent;

            // Mostrar datos en el modal
            modalContent.innerHTML = '<h2>' + nombreEvento + '</h2>';
            modalContent.innerHTML += '<p>' + contenidoCompleto + '</p>';

            // Mostrar detalles comunes a todos los eventos
            modalContent.innerHTML += '<ul class="lista">';
            modalContent.innerHTML += '<li><span class="fuerte">Fecha:</span> ' + workshop.getAttribute('data-fecha') + '</li>';
            modalContent.innerHTML += '<li><span class="fuerte">Hora:</span> ' + workshop.getAttribute('data-hora') + '</li>';
            modalContent.innerHTML += '<li><span class="fuerte">Lugar:</span> ' + workshop.getAttribute('data-lugar-nombre') + ', ' + workshop.getAttribute('data-lugar-direccion') + '</li>';
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
            modalContent.innerHTML += '<p>"'+nombreEvento+'" no es solo un evento, es una oportunidad para aprender, conectarte y encontrar apoyo en un entorno inclusivo y comprensivo. Ya sea que estés buscando información educativa, estrategias prácticas o simplemente una comunidad que entienda tus desafíos, este evento está diseñado para brindarte las herramientas y el apoyo que necesitas.</p>';
            modalContent.innerHTML += '<p>¡Únete a nosotros y juntos desafiaremos los límites del TDAH!</p>';

            modalContent.innerHTML += '<form method="post"><input type="hidden" name="id_escondido" value="'+ workshop.getAttribute('data-id') +'"><button name="boton_enviar" type="submit" class="boton_participar">Participar</button></form>';

            // Mostrar el modal
            modal.style.display = 'flex';

            // Utilizar addEventListener para el evento 'click'
            closeBtn.addEventListener('click', function () {
                modal.style.display = 'none';
            });

            // Cerrar el modal al hacer clic fuera del contenido
            window.addEventListener('click', function (event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        });
    });
});
