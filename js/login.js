function login() {
  let flag = false; // Reinicia flag en cada llamada
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;

  // Declaración de variables fuera del bloque if
  var div_general = document.getElementById("error_general");
  var general_error_message = document.querySelector(".text_general");

  var div_username = document.getElementById("error_username");
  var username_error_message = document.querySelector(".text_username");

  // Verifica que el nombre y apellido solo contengan letras y tengan al menos 2 caracteres

  if (username == "" || password == "") {
    div_general.className = "clase_modificada";
    general_error_message.textContent = "Todos los campos son obligatorios.";
    return;
  } else {
    div_general.className = "clase_original";
    general_error_message.textContent = "";
  }

  // Permitir nombres de usuario alfanuméricos de al menos 3 caracteres
  var usernameRegex = /^[a-zA-Z0-9]{3,}$/;
  if (!usernameRegex.test(username)) {
    div_username.className = "clase_modificada";
    username_error_message.textContent =
      "El nombre de usuario debe tener al menos 3 caracteres alfanuméricos.";
    flag = true;
  } else {
    div_username.className = "clase_original";
    username_error_message.textContent = "";
  }

  var div_password = document.getElementById("error_password");
  var password_error_message = document.querySelector(".text_password");
  var password = document.getElementById("password").value;
  var passwordRegex = '/^[a-zA-Z]{7,}$/';

  if (!passwordRegex.test(password)) {
    div_password.className = "clase_modificada";
    password_error_message.textContent =
      "La contraseña no sigue nuestros estándares";
    flag = true;
  }

  return flag; // Devuelve el estado de validez del formulario
}

function enviarFormulario() {
  var datosUsuario = {
    username: document.getElementById("username").value.trim(),
    passwd: document.getElementById("password").value.trim(),
  };

  var datosJSON = JSON.stringify(datosUsuario);

  $.ajax({
    type: "POST",
    url: "../php/procesar_login.php",
    dataType: "json",
    data: { datos: datosJSON },
    success: function (respuesta) {
      console.log(respuesta);
      if (respuesta.error) {
        document.getElementById("error_general").className = "clase_modificada";
        document.querySelector(".text_general").textContent = respuesta.mensaje; 
      }
    },
    error: function (error) {
      console.error("Error en la solicitud AJAX: ", error);
    },
  });
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("register_form")
    .addEventListener("submit", function (event) {
      event.preventDefault();
      // Verificar fortaleza y validez
      var esFuerte = verificarFortaleza();
      var esValido = registro();

      if (esValido) {
        // Detiene el envío del formulario si no cumple con las condiciones
        return;
      }
      // Si cumple con las condiciones, llamar a enviarFormulario
      enviarFormulario();
    });
});
