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