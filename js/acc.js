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

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('myForm2').addEventListener('submit', function(event) {
        // Llama a registro() y prevenir el envío del formulario si es necesario
        if (login()) {
            event.preventDefault(); // Detiene el envío del formulario
        }
    });
});

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

function registro() {
    var flag = false; // Reinicia flag en cada llamada
    var username = document.getElementById("username").value;
    var firstName = document.getElementById("nombre").value;
    var lastName = document.getElementById("apellido").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var errorMessage = document.getElementById("error_message");

    // Verifica que el nombre y apellido solo contengan letras y tengan al menos 2 caracteres

    if(username == "" || firstName == "" || lastName == "" || email == "" || password == ""){
        errorMessage.textContent = "Los campos no pueden estar vacíos";
        return;
    }

    var usernameRegex = /^[a-zA-Z0-9]{3,}$/;
    if (!usernameRegex.test(username)) {
        errorMessage.textContent = "El nombre de usuario debe tener al menos 3 caracteres";
        flag = true;
        return;
    }

    var nameRegex = /^[a-zA-Z]{2,}$/;
    if (!nameRegex.test(firstName)) {
        errorMessage.textContent = "El nombre solo pueden contener letras y debe de tener almenos 2 letras.";
        flag = true;
        return;
    }

    if (!nameRegex.test(lastName)) {
        errorMessage.textContent = "El apellido solo pueden contener letras.";
        flag = true;
        return;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        errorMessage.textContent = "El correo electrónico no es válido.";
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

    return flag; // Devuelve el estado de validez del formulario
}

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('myForm').addEventListener('submit', function(event) {
        // Llama a registro() y prevenir el envío del formulario si es necesario
        if (registro()) {
            event.preventDefault(); // Detiene el envío del formulario
        }
    });
});

