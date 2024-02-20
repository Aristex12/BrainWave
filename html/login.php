<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-acc.css">
    <script src="../js/acc.js"></script>
    <title>BrainWave | Login</title>
</head>

<body>
    <!-- botón para cerrar la página -->
    <button class="btn-close">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
            <path fill="none" d="M0 0h24v24H0V0z" />
            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" fill="var(--c-text-secondary)" />
        </svg>
    </button>
    <!-- Login box -->
    <div class="box">
        <img class="img" src="img/logo-transp.png" alt="">
        <h2 class="login"> <span class="span">L</span><span class="text-wrapper-2">OGIN</span></h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" id="myform2">
            <!-- User input -->
            <div class="user-box">
                <input type="text" name="username" id="username">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" id="password">
                <a href="#" class="toggle-eye" onclick="togglePasswordVisibility()">
                    <img src="../img/eye-close.png" alt="Toggle Password" id="eye-icon">
                </a>
                <label>Password</label>
                <a href="#" class="forgotten-pwd">Contraseña Olvidada?</a>
            </div>
            <span id="error_message" style="text-align:center;color:red"></span>
            <!-- Login btn -->
            <div class="boton-secundario">
                <button type="submit" class="button">ENTRAR</button>
            </div>
        </form>
        <br>
        <!-- "Footer"  -->
        <div class="crea-cuenta-login">
            <p>No tienes una cuenta?</p><a href="#">Crear cuenta</a>
        </div>
        <div class="terms">
            <a href="https://app.privacypolicies.com/wizard/terms-conditions" target="_blank">Términos y Condiciones</a>
        </div> <br>

        <?php

        require_once "conecta.php";
        require_once "tablas.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $username = $_POST["username"];
            $passwd = $_POST["password"];

            if (!empty($username) && !empty($passwd)) {

                // Consulta para buscar al paciente por nombre de usuario
                $query = "SELECT * FROM login WHERE username='$username'";

                // Ejecución de la consulta
                if ($res = mysqli_query(getConexion(), $query)) {

                    // Obtención del primer elemento (fila) del resultado
                    $elemento = mysqli_fetch_assoc($res);

                    // Verificación de existencia del usuario y coincidencia de contraseña
                    if ($elemento && $elemento["password"] == $passwd) {

                        // Redirección a la página del paciente con el nombre de usuario como parámetro
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["password"] = $passwd;

                        header('Location: home.php');

                        exit();
                    } else {
                        // Mensaje de error si la contraseña o el nombre de usuario son incorrectos
                        echo "<div style='all: initial; display: flex; align-items: center; justify-content: center; text-align: center; background-color: rgba(255, 0, 0, 0.5); width: 100%; height: 80px;'>";
                        echo "<p>La contraseña es erronea</p>";
                        echo "</div>";
                    }

                } else {
                    // Mensaje de error si el usuario no existe
                    echo "<span>Usuario no existe</span>";
                }
            } else {
                // Mensaje de error si los campos están vacíos
                echo "<span style='color:red'>Los campos no pueden estar vacíos</span>";
            }
        }

        ?>

    </div>
    </div>

</body>

</html>