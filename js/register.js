function registro() {
  let flag = false; // Reinicia flag en cada llamada
  var username = document.getElementById("username").value;
  var firstName = document.getElementById("firstName").value;
  var lastName = document.getElementById("lastName").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;

  // Declaración de variables fuera del bloque if
  var div_general = document.getElementById("error_general");
  var general_error_message = document.querySelector(".text_general");

  var div_username = document.getElementById("error_username");
  var username_error_message = document.querySelector(".text_username");

  var div_firstname = document.getElementById("error_firstname");
  var firstname_error_message = document.querySelector(".text_firstname");

  var div_lastname = document.getElementById("error_lastname");
  var lastname_error_message = document.querySelector(".text_lastname");

  var div_email = document.getElementById("error_email");
  var email_error_message = document.querySelector(".text_email");

  // Verifica que el nombre y apellido solo contengan letras y tengan al menos 2 caracteres

  if (
    username == "" ||
    firstName == "" ||
    lastName == "" ||
    email == "" ||
    password == ""
  ) {
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

  // Permitir nombres que contengan letras y acentos, de al menos 2 caracteres
  var nameRegex = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s]{2,}$/;
  if (!nameRegex.test(firstName)) {
    div_firstname.className = "clase_modificada";
    firstname_error_message.textContent =
      "El nombre solo puede contener letras y debe tener al menos 2 letras.";
    flag = true;
  } else {
    div_firstname.className = "clase_original";
    firstname_error_message.textContent = "";
  }

  // Permitir apellidos que contengan letras y acentos
  if (!nameRegex.test(lastName)) {
    div_lastname.className = "clase_modificada";
    lastname_error_message.textContent =
      "El apellido solo puede contener letras.";
    flag = true;
  } else {
    div_lastname.className = "clase_original";
    lastname_error_message.textContent = "";
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

  return flag; // Devuelve el estado de validez del formulario
}

function verificarFortaleza() {
  var div_password = document.getElementById("error_password");
  var password_error_message = document.querySelector(".text_password");
  var password = document.getElementById("password").value;
  var passwordRegex = /^(?=.*[A-Z])(?=.*\d).{7,}$/;
  let flag = false;

  if (!passwordRegex.test(password)) {
    div_password.className = "clase_modificada";
    password_error_message.textContent =
      "La contraseña es debil! La contraseña debe tener al menos una letra en mayúscula, un número y ser de 7 caracteres como mínimo.";
    flag = true;
  } else {
    div_password.className = "clase_modificada_correcto";
    password_error_message.textContent = "La contraseña es fuerte";
    flag = false;
  }

  return flag;
}

function enviarFormulario() {

  var datosUsuario = {
    username: document.getElementById("username").value.trim(),
    nombre: document.getElementById("firstName").value.trim(),
    apellido: document.getElementById("lastName").value.trim(),
    email: document.getElementById("email").value.trim(),
    passwd: document.getElementById("password").value.trim(),
  };

  var datosJSON = JSON.stringify(datosUsuario);

  $.ajax({
    type: "POST",
    url: "../php/procesamiento_datos/procesar_registro.php",
    dataType: "json",
    data: { datos: datosJSON },
    success: function (respuesta) {
      console.log(respuesta);
      if (respuesta.success) {
        // Éxito
        if (respuesta.redirect) {
          window.location.href = respuesta.redirect; // Redirige a la página indicada en el JSON
      } // Limpiar mensaje de éxito
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

document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("register_form")
    .addEventListener("submit", function (event) {
      event.preventDefault();
      // Verificar fortaleza y validez
      var esFuerte = verificarFortaleza();
      var esValido = registro();

      if (esFuerte || esValido) {
        // Detiene el envío del formulario si no cumple con las condiciones
        return;
      }
      // Si cumple con las condiciones, llamar a enviarFormulario
      enviarFormulario();
    });
});
