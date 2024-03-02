document.addEventListener('DOMContentLoaded', function () {
    var articulos = document.querySelectorAll('.articulo');

    articulos.forEach(function (articulo) {
        articulo.addEventListener('click', function () {
            var modal = document.getElementById('myModal');
            var modalContent = document.getElementById('modalContent');
            var closeBtn = document.getElementById('closeBtn');

            // Obtener datos del artículo
            var titulo = articulo.querySelector('h2').textContent;

            // Obtener contenido completo oculto
            var contenidoCompleto = articulo.querySelector('.contenido-completo-oculto').textContent;

            // Mostrar datos en el modal
            modalContent.innerHTML = '<h2>' + titulo + '</h2><p class="contenido-completo">' + contenidoCompleto + '</p>';

            // Mostrar el modal
            modal.style.display = 'flex';

            // Cambiado: Utilizar addEventListener para el evento 'click'
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