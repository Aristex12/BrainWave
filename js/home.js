$(document).ready(function () {
    // Esperar a que el documento esté completamente cargado

    // Al hacer scroll
    $(window).scroll(function () {
        // Obtener la posición actual del scroll
        var scroll = $(window).scrollTop();

        // Determinar cuándo aplicar la transición
        if (scroll > 100) {
            // Si el scroll es mayor que 50px, aplicar la transición
            $(".nav_container").addClass("nav-fixed");
        } else {
            // Si el scroll es menor o igual a 50px, revertir la transición
            $(".nav_container").removeClass("nav-fixed");
        }
    });
});

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