function validarContacto() {
    let flag = false;
    var nombre = document.getElementById("nombre").value;
    var email = document.getElementById("email").value;
    var telefono = document.getElementById("telefono").value;
    var mensaje = document.getElementById("mensaje").value;

    // Declaración de variables fuera del bloque if
    var div_general = document.getElementById("error_general");
    var general_error_message = document.querySelector(".text_general");

    var div_nombre = document.getElementById("error_nombre");
    var nombre_error_message = document.querySelector(".text_nombre");

    var div_email = document.getElementById("error_email");
    var email_error_message = document.querySelector(".text_email");

    var div_telefono = document.getElementById("error_telefono");
    var telefono_error_message = document.querySelector(".text_telefono");

    var div_mensaje = document.getElementById("error_mensaje");
    var mensaje_error_message = document.querySelector(".text_mensaje");

    // Verificar que los campos no estén vacíos
    if (nombre == "" || email == "" || telefono == "" || mensaje == "") {
        div_general.className = "clase_modificada";
        general_error_message.textContent = "Todos los campos son obligatorios.";
        flag = true;
        return;
    } else {
        div_general.className = "clase_original";
        general_error_message.textContent = "";
    }

    // Permitir nombres que contengan letras y acentos, de al menos 2 caracteres
    var nameRegex = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s]{2,}$/;
    if (!nameRegex.test(nombre)) {
        div_nombre.className = "clase_modificada";
        nombre_error_message.textContent =
            "El nombre solo puede contener letras y debe tener al menos 2 letras.";
        flag = true;
    } else {
        div_nombre.className = "clase_original";
        nombre_error_message.textContent = "";
    }

    // Validar formato de correo electrónico
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        div_email.className = "clase_modificada";
        email_error_message.textContent = "El correo electrónico no es válido.";
        flag = true;
    } else {
        div_email.className = "clase_original";
        email_error_message.textContent = "";
    }

    // Validar formato de número de teléfono
    var telefonoRegex = /^\d{7,15}$/;
    if (!telefonoRegex.test(telefono)) {
        div_telefono.className = "clase_modificada";
        telefono_error_message.textContent = "El número de teléfono no es válido.";
        flag = true;
    } else {
        div_telefono.className = "clase_original";
        telefono_error_message.textContent = "";
    }

    // Validar que el mensaje no contenga caracteres especiales
    var mensajeRegex = /^[a-zA-Z0-9\s]+$/;
    if (!mensajeRegex.test(mensaje)) {
        div_mensaje.className = "clase_modificada";
        mensaje_error_message.textContent = "El mensaje no puede contener caracteres especiales.";
        flag = true;
    } else {
        div_mensaje.className = "clase_original";
        mensaje_error_message.textContent = "";
    }

    return flag; // Devuelve el estado de validez del formulario
}

function enviarFormulario() {
    var datosContacto = {
        nombre: document.getElementById("nombre").value.trim(),
        email: document.getElementById("email").value.trim(),
        telefono: document.getElementById("telefono").value.trim(),
        mensaje: document.getElementById("mensaje").value.trim(),
    };

    var datosJSON = JSON.stringify(datosContacto);

    $.ajax({
        type: "POST",
        url: "../php/procesar_contacto.php",
        dataType: "json",
        data: { datos: datosJSON },
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta.success) {
                // Éxito
                document.getElementById("error_general").className = "clase_modificada_correcto";
                document.querySelector(".text_general").textContent = respuesta.mensaje; 
            } else {
                // Hubo un error
                document.getElementById("error_general").className = "clase_modificada";
                document.querySelector(".text_general").textContent = respuesta.mensaje; // Limpiar mensaje de error
            }
        },
        error: function (error) {
            console.error("Error en la solicitud AJAX: ", error);
        },
    });
}

document.addEventListener("DOMContentLoaded", function () {
    document
        .getElementById("contacto_form")
        .addEventListener("submit", function (event) {
            event.preventDefault();
            // Verificar validez
            var esValido = validarContacto();

            if (esValido) {
                // Detiene el envío del formulario si no cumple con las condiciones
                return;
            }
            // Si cumple con las condiciones, llamar a enviarFormulario
            enviarFormulario();
        });
});
