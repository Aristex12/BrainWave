function login() {
    var flag = false;
    var username = document.getElementById("username").value;
    var pswd = document.getElementById("password").value;
    var errorMessage = document.getElementById("error-message");

    if(username == "" || pswd == ""){
        errorMessage.textContent = "Los campos no pueden estar vacíos";
        flag = true;
        return;
    }
  
    var usernameRegex = /^[a-zA-Z0-9]+$/;
    if (!usernameRegex.test(username)) {
      errorMessage.textContent = "El nombre de usuario solo puede contener letras y números.";
      flag = true;
      return;
    }

    var passwordRegex = /^(?=.*[A-Z])(?=.*\d).{7,}$/;
    if (!passwordRegex.test(password)) {
        errorMessage.textContent = "La contraseña debe tener al menos una letra en mayúscula, un número y ser de 7 caracteres como mínimo.";
        flag = true;
        return;
    }

    if (flag) {
        errorMessage.style.display = "block";
        // No cambiar errorMessage.textContent aquí ya que el último error debe mostrarse
    } else {
        errorMessage.textContent = "";
        errorMessage.style.display = "none";
    }

    return flag;
}

function togglePasswordVisibility() {
    var passwordInput = document.querySelector('input[type="password"]');
    var eyeIcon = document.getElementById("eye-icon");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.src = "../img/eye-open.png";
    } else {
        passwordInput.type = "password";
        eyeIcon.src = "../img/eye-close.png";
    }
}

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('myForm2').addEventListener('submit', function(event) {
        // Llama a registro() y prevenir el envío del formulario si es necesario
        if (login()) {
            event.preventDefault(); // Detiene el envío del formulario
        }
    });
});