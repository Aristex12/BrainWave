document.addEventListener('DOMContentLoaded', function () {
    var articulos = document.querySelectorAll('.articulo');

    articulos.forEach(function (articulo) {
        articulo.addEventListener('click', function () {
            var modal = document.getElementById('myModal');
            var modalContent = document.getElementById('modalContent');
            var closeBtn = document.getElementById('closeBtn');

            // Obtener datos del artículo
            var titulo = articulo.querySelector('h2').textContent;
            var contenidoResumen = articulo.querySelector('p').textContent;

            // Obtener contenido completo oculto
            var contenidoCompleto = articulo.querySelector('.contenido-completo-oculto').textContent;

            // Mostrar datos en el modal
            modalContent.innerHTML = '<h2>' + titulo + '</h2><p>' + contenidoResumen + '</p><p class="contenido-completo">' + contenidoCompleto + '</p>';

            // Mostrar el modal
            modal.style.display = 'block';

            // Cerrar el modal al hacer clic en el botón de cerrar
            closeBtn.onclick = function () {
                modal.style.display = 'none';
            };

            // Cerrar el modal al hacer clic fuera del contenido
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            };
        });
    });
});
