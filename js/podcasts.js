document.addEventListener('DOMContentLoaded', function () {
    var podcastDivs = document.querySelectorAll('.podcast');

    podcastDivs.forEach(function (podcastDiv) {
        podcastDiv.addEventListener('click', function () {
            var link = podcastDiv.getAttribute('data-link');

            var modal = document.getElementById('myModal');
            var modalContent = document.getElementById('modalContent');
            var closeBtn = document.getElementById('closeBtn');

            // Mostrar iframe con el enlace del podcast
            modalContent.innerHTML = '<iframe width="560" height="315" src="' + link + '" frameborder="0" allowfullscreen></iframe>';

            // Mostrar el modal
            modal.style.display = 'flex';

            // Cerrar el modal al hacer clic en el botón de cierre
            closeBtn.addEventListener('click', function () {
                modal.style.display = 'none';
                modalContent.innerHTML = ''; // Limpiar el contenido del iframe
            });

            // Cerrar el modal al hacer clic fuera del contenido
            window.addEventListener('click', function (event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                    modalContent.innerHTML = ''; // Limpiar el contenido del iframe
                }
            });
        });
    });
});
