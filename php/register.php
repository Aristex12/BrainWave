<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <script src="../js/register.js"></script>
    <title>BrainWave | Registro</title>
</head>

<?php

require_once "conecta.php";
require_once "tablas.php";

?>

<body>

    <nav>
        <div class="nav_container">

            <div class="nav_inner">

                <div class="logo">
                    <a href="home.php">
                        <img src="../img/logo.png" alt="">
                    </a>
                </div>
                <div class="lista">

                    <ul>
                        <a href="servicios.php">
                            <li>Servicios</li>
                        </a>
                        <a href="recursos.php">
                            <li>Recursos</li>
                        </a>
                        <a href="nosotros.php">
                            <li>Nosotros</li>
                        </a>
                        <div class="div_contacto">
                            <a href="contacto.php">
                                <li>Contacto</li>
                            </a>
                        </div>

                    </ul>

                </div>

                <div class="perfil">
                    <a href="<?php

                        if (isset($_SESSION["tipo"])) {
                            echo "perfil.php";
                        } else {
                            echo "login.php";
                        }

                        ?>"><i class="fas fa-user-circle fa-2x" id="color_perfil" style="color:white"></i></a>
                </div>

            </div>

        </div>
    </nav>

    <div class="container_form">
        <div class="inner_container_form">
            <h2>Registro</h2>
            <form action="#" method="post" id="register_form">
                <div class="error_general" id="error_general">
                    <p class="text_general"></p>
                </div>
                <input type="text" id="username" name="username" placeholder="Username">
                <div class="error_username" id="error_username">
                    <p class="text_username"></p>
                </div> <br>

                <input type="text" id="firstName" name="firstName" placeholder="Nombre">
                <div class="error_firstname" id="error_firstname">
                    <p class="text_firstname"></p>
                </div> <br>

                <input type="text" id="lastName" name="lastName" placeholder="Apellidos">
                <div class="error_lastname" id="error_lastname">
                    <p class="text_lastname"></p>
                </div> <br>

                <input type="email" id="email" name="email" placeholder="Email">
                <div class="error_email" id="error_email">
                    <p class="text_email"></p>
                </div> <br>

                <input type="password" id="password" name="password" oninput="verificarFortaleza()" placeholder="Contraseña">
                <span id="togglePassword" onclick="togglePassword()">
                    <i class="fas fa-eye" id="eyeIcon"></i>
                </span>
                <div class="error_password" id="error_password">
                    <p class="text_password"></p>
                </div>

                <button type="submit" id="submit">Registrarse</button>
                ¿Ya tienes cuenta? <a href="login.php">Pulsa aqui</a>
            </form>
        </div>
    </div>
</body>

</html>