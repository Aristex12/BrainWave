document.addEventListener('DOMContentLoaded', function () {
    // Obtener todos los elementos con la clase "tarjeta_servicio"
    const serviciosDivs = document.querySelectorAll('.tarjeta_servicio');

    // Asignar un evento de clic a cada div
    serviciosDivs.forEach(div => {
        div.addEventListener('click', function () {
            // Obtener el id del div clicado
            const divId = this.id;

            // Redirigir a la página correspondiente
            switch (divId) {
                case 'psicologo':
                    window.location.href = 'psicologos.php';
                    break;
                case 'workshops':
                    window.location.href = 'workshops.php';
                    break;
                case 'articulos':
                    window.location.href = 'articulos.php';
                    break;
                case 'libros':
                    window.location.href = 'libros.php';
                    break;
                default:
                    // Manejar cualquier otro caso si es necesario
                    break;
            }
        });
    });
});