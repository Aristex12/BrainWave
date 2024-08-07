<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../js/nav.js" defer></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <script src="../../js/register.js"></script>
    <title>BrainWave | Registro</title>
</head>

<?php

require_once "../bases_de_datos/conecta.php";
require_once "../bases_de_datos/tablas.php";

?>

<body>

    <nav>
        <div class="nav_container">

            <div class="nav_inner">

                <div class="logo">
                    <a href="home.php">
                        <img src="../../img/logo.png" alt="">
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

                                ?>"><i class="fas fa-user-circle fa-2x" id="color_perfil"></i></a>
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
                    <i class="fa fa-exclamation-circle icono"></i>
                </div>
                <input type="text" id="username" name="username" placeholder="Username">
                <div class="error_username" id="error_username">
                    <p class="text_username"></p>
                    <i class="fa fa-exclamation-circle icono"></i>
                </div> <br>

                <input type="text" id="firstName" name="firstName" placeholder="Nombre">
                <div class="error_firstname" id="error_firstname">
                    <p class="text_firstname"></p>
                    <i class="fa fa-exclamation-circle icono"></i>
                </div> <br>

                <input type="text" id="lastName" name="lastName" placeholder="Apellidos">
                <div class="error_lastname" id="error_lastname">
                    <p class="text_lastname"></p>
                    <i class="fa fa-exclamation-circle icono"></i>
                </div> <br>

                <input type="email" id="email" name="email" placeholder="Email">
                <div class="error_email" id="error_email">
                    <p class="text_email"></p>
                    <i class="fa fa-exclamation-circle icono"></i>
                </div> <br>

                <input type="password" id="password" name="password" oninput="verificarFortaleza()" placeholder="Contraseña">
                <span id="togglePassword" onclick="togglePassword()">
                    <i class="fas fa-eye-slash" id="eyeIcon"></i>
                </span>
                <div class="error_password" id="error_password">
                    <ul class="text_password"></ul>
                </div>

                <button type="submit" id="submit">Registrarse</button>
                ¿Ya tienes cuenta? <a href="login.php" class="pulsa">Pulsa aqui</a>
            </form>
        </div>
    </div>

    <footer>
        <div class="container_footer">
            <div class="inner_footer_container">
                <div class="social_media">
                    <h2>Social</h2>
                    <a href="https://www.instagram.com/aristex12/?hl=es" target="_blank"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="https://www.facebook.com/aris.kuhs/" target="_blank"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="https://www.linkedin.com/in/arismaximiliankuhs" target="_blank"><i class="fab fa-linkedin fa-2x"></i></a>
                </div>
                <div class="contact">
                    <h2>Contacto</h2>
                    <div class="inner_contacto">
                        <p><span class="fuerte">Telefono: </span><a href="tel://+34 632707689">+34 632 707 689</a></p>
                        <p><span class="fuerte">Email: </span><a href="mailto:aristex@hotmail.com">aristex@hotmail.com</a></p>
                        <p><span class="fuerte">Direccion: </span><a href="https://maps.app.goo.gl/JZpVZw3dKvSbVxxa9" target="_blank">C. Tajo, s/n, 28670 Villaviciosa de Odón, Madrid</a></p>
                    </div>
                </div>
                <div class="links">
                    <h2>Links</h2>
                    <div class="inner_link">
                        <div class="link_piece">
                            <a href="servicios.php">Servicios</a>
                        </div>
                        <div class="link_piece">
                            <a href="recursos.php">Recursos</a>
                        </div>
                        <div class="link_piece">
                            <a href="nosotros.php">Nosotros</a>
                        </div>
                        <div class="link_piece">
                            <a href="contacto.php">Contacto</a>
                        </div>
                        <div class="link_piece">
                            <a href="perfil.php">Perfil</a>
                        </div>
                        <div class="link_piece">
                            <a href="workshops.php">Workshops</a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="legal">
                    <div class="copy">
                        brainwave copyright - own elements
                    </div>
                    <div class="disclaimer">
                        <a href="https://figueras.legal/condiciones-de-uso-de-la-web/" target="_blank">Disclaimer</a>
                        <a href="https://figueras.legal/condiciones-de-uso-de-la-web/" target="_blank">Politica de privacidad</a>
                        <a href="https://figueras.legal/condiciones-de-uso-de-la-web/" target="_blank">Terminos de Uso</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>