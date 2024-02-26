function login() {
  let flag = false; // Reinicia flag en cada llamada
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;

  // Declaración de variables fuera del bloque if
  var div_general = document.getElementById("error_general");
  var general_error_message = document.querySelector(".text_general");

  // Verifica que el nombre y apellido solo contengan letras y tengan al menos 2 caracteres

  if (username == "" || password == "") {
    div_general.className = "clase_modificada";
    general_error_message.textContent = "Todos los campos son obligatorios.";
    flag = true;
    return flag;
  } else {
    div_general.className = "clase_original";
    general_error_message.textContent = "";
  }

  // Permitir nombres de usuario alfanuméricos de al menos 3 caracteres
  var usernameRegex = /^[a-zA-Z0-9]{3,}$/;
  if (!usernameRegex.test(username)) {
    div_general.className = "clase_modificada";
    general_error_message.textContent =
      "Username o contraseña esta mal";
      alert("VINA");
    flag = true;
  } else {
    div_general.className = "clase_original";
    general_error_message.textContent = "";
  }

  var passwordRegex = /^[a-zA-Z0-9]{7,}$/;
  if (!passwordRegex.test(password)) {
    div_general.className = "clase_modificada";
    general_error_message.textContent =
      "Username o contraseña esta mal";
    flag = true;
  } else {
    div_general.className = "clase_original";
    general_error_message.textContent = "";
  }

  return flag; // Devuelve el estado de validez del formulario
}

function togglePassword() {
  var passwordInput = document.getElementById("password");
  var eyeIcon = document.getElementById('eyeIcon');

  if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      eyeIcon.classList.remove('fa-eye-slash');
      eyeIcon.classList.add('fa-eye');
  } else {
      passwordInput.type = 'password';
      eyeIcon.classList.remove('fa-eye');
      eyeIcon.classList.add('fa-eye-slash');
  }
}

function enviarFormulario() {
  var datosUsuario = {
    username: document.getElementById("username").value.trim(),
    passwd: document.getElementById("password").value.trim()
  };

  var datosJSON = JSON.stringify(datosUsuario);

  $.ajax({
    type: "POST",
    url: "../php/procesamiento_datos/procesar_login.php",
    dataType: "json",
    data: { datos: datosJSON },
    success: function (respuesta) {
      console.log(respuesta);
      if (respuesta.success) {
        if (respuesta.redirect) {
          window.location.href = respuesta.redirect; // Redirige a la página indicada en el JSON
      }
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
    .getElementById("login_form")
    .addEventListener("submit", function (event) {
      event.preventDefault();
      // Verificar fortaleza y validez
      var esValido = login();

      if (esValido) {
        // Detiene el envío del formulario si no cumple con las condiciones
        return;
      }
      // Si cumple con las condiciones, llamar a enviarFormulario
      enviarFormulario();
    });
});
