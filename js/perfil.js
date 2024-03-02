document.addEventListener('DOMContentLoaded', function () {
    // Al cargar el documento, almacenar los valores originales de los campos
    const valoresOriginales = {
        username: document.getElementById('username').value,
        nombre: document.getElementById('nombre').value,
        apellidos: document.getElementById('apellidos').value,
        email: document.getElementById('email').value
    };

    // Manejador de evento para el botón de editar
    document.getElementById('editarBtn').addEventListener('click', function () {
        // Obtener los valores actuales de los campos
        const valoresActuales = {
            username: document.getElementById('username').value,
            nombre: document.getElementById('nombre').value,
            apellidos: document.getElementById('apellidos').value,
            email: document.getElementById('email').value
        };

        // Comprobar si se han hecho cambios
        if (validarCampos(valoresActuales)) {
            // Comprobar si se han hecho cambios
            if (sonIguales(valoresOriginales, valoresActuales)) {
                // No se han hecho cambios
                mostrarError("No se han realizado cambios.");
            } else {
                // Se han hecho cambios, realizar la petición AJAX
                enviarCambios(valoresActuales);
            }
        } else {
            // Mostrar mensaje de error en el div
            mostrarError('Por favor, completa todos los campos correctamente.');
        }
    });

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

        setTimeout(function () {
            location.reload();
        }, 2000);
    }

    function validarCampos(valores) {
        const regexSoloLetras = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s]{2,}$/;
        const regexUsername = /^[a-zA-ZÀ-ÖØ-öø-ÿ0-9\s]{2,}$/;
        const regexFormatoEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!regexUsername.test(valores.username) || !regexSoloLetras.test(valores.nombre) || !regexSoloLetras.test(valores.apellidos) || !regexFormatoEmail.test(valores.email)) {
            return false;
        }

        return true;
    }

    // Función para comprobar si dos objetos son iguales
    function sonIguales(obj1, obj2) {
        return JSON.stringify(obj1) === JSON.stringify(obj2);
    }

    // Función para enviar la petición AJAX con los cambios
    function enviarCambios(valoresActuales) {
        $.ajax({
            type: "POST",
            url: "../procesamiento_datos/procesar_cambios.php",
            dataType: "json",
            data: { datos: JSON.stringify(valoresActuales) },
            success: function (respuesta) {
                console.log(respuesta);
                if (respuesta.success) {
                    // Éxito, puedes hacer algo aquí si es necesario
                    mostrarExito(respuesta.mensaje);
                } else {
                    // Hubo un error
                    mostrarError(respuesta.mensaje);
                }
            },
            error: function (error) {
                console.error("Error en la solicitud AJAX: ", error);
            },
        });
    }
});
