$(document).ready(function () {
    // Manejar el evento de entrada de texto en el buscador
    $('#buscador').on('input', function () {
        var busqueda = $(this).val();
        buscarPsicologos(busqueda);
    });

    // Agregar evento para el envío del formulario
    $('#searchForm').on('submit', function (event) {
        // Cancelar el envío del formulario
        event.preventDefault();

        // Obtener el valor del buscador y realizar la búsqueda
        var busqueda = $('#buscador').val();
        buscarPsicologos(busqueda);
    });

    // Función para realizar la búsqueda de psicólogos
    function buscarPsicologos(busqueda) {
        $.ajax({
            url: '../procesamiento_datos/procesar_lista_psicologos.php',
            type: 'POST',
            data: { buscador: busqueda },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    mostrarResultados(response.psicologos);
                } else {
                    console.error('Error en la búsqueda de psicólogos', response.message);
                }
            },
            error: function (error) {
                console.error('Error en la petición AJAX', error);
            }
        });
    }

    // Función para mostrar los resultados de la búsqueda
    function mostrarResultados(psicologos) {
        var container = $('.psicologos_container');
        container.empty(); // Limpiar resultados anteriores

        if (psicologos.length > 0) {
            $.each(psicologos, function (index, psicologo) {
                var psicologoHtml = '<div class="psicologo">';
                psicologoHtml += '<div class="imagen_psicologo" style="background-image:url(' + psicologo.imagen_ruta + ')"></div>';
                psicologoHtml += '<div class="texto_psicologo">';
                psicologoHtml += '<h2>' + psicologo.nombre + '</h2>';
                psicologoHtml += '<a href="pedir_cita.php?id=' + psicologo.id_psicologo + '"><button>Pedir Cita</button></a>';
                psicologoHtml += '</div>';
                psicologoHtml += '</div>';

                container.append(psicologoHtml);
            });
        } else {
            // Mensaje de no se encontraron resultados
            container.append('<p>No se encontraron psicólogos con la búsqueda actual.</p>');
        }
    }
});
