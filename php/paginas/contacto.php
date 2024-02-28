<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/contacto.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <script src="../../js/contacto.js"></script>
    <title>BrainWave | Contacto</title>
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

    <main>
        <div class="titulo">
            <h1>Contáctanos</h1>
        </div>

        <div class="container2">
            <div class="inner_container2">
                <div class="text_container">
                    <div class="inner_text_container">
                        <p>no dudes en ponerte en contacto con nosotros. Estamos aquí para escucharte y ofrecerte el apoyo que necesitas.
                            Completa el formulario a continuación y nos comunicaremos contigo lo antes posible.</p>
                    </div>
                </div>

                <div class="form_container">
                    <form action="#" method="post" id="contacto_form">
                        <div class="error_general" id="error_general">
                            <p class="text_general"></p>
                        </div>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre y Apellidos">
                        <div class="error_nombre" id="error_nombre">
                            <p class="text_nombre"></p>
                        </div>

                        <input type="email" id="email" name="email" placeholder="Email">
                        <div class="error_email" id="error_email">
                            <p class="text_email"></p>
                        </div>

                        <input type="number" id="telefono" name="telefono" placeholder="Teléfono">
                        <div class="error_telefono" id="error_telefono">
                            <p class="text_telefono"></p>
                        </div>

                        <textarea name="mensaje" id="mensaje" cols="30" rows="10" placeholder="Mensaje"></textarea>
                        <div class="error_mensaje" id="error_mensaje">
                            <p class="text_mensaje"></p>
                        </div>

                        <div class="pack_politicas">
                            <input type="checkbox" id="politicas" name="politicas" class="check">
                            <label for="politicas">Aceptar políticas de privacidad</label>
                        </div>

                        <button type="submit" id="submit">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container_footer">
            <div class="inner_footer_container">
                <div class="social_media">
                    <h2>Social</h2>
                    <i class="fab fa-instagram fa-2x"></i>
                    <i class="fab fa-facebook fa-2x"></i>
                    <i class="fab fa-linkedin fa-2x"></i>
                </div>
                <div class="contact">
                    <h2>Contacto</h2>
                    <p><span class="fuerte">Telefono: </span><a href="tel://+34 632707689">+34 632 707 689</a></p>
                    <p><span class="fuerte">Email: </span><a href="mailto:aristex@hotmail.com">aristex@hotmail.com</a></p>
                    <p><span class="fuerte">Direccion: </span><a href="https://maps.app.goo.gl/JZpVZw3dKvSbVxxa9"></a>C. Tajo, s/n, 28670 Villaviciosa de Odón, Madrid</p>
                </div>
                <div class="links">
                    <h2>Links</h2>
                    <div class="inner_link">
                        <div class="link_piece">
                            <a href="">Servicios</a>
                        </div>
                        <div class="link_piece">
                            <a href="">Recursos</a>
                        </div>
                        <div class="link_piece">
                            <a href="">Nosotros</a>
                        </div>
                        <div class="link_piece">
                            <a href="">Contacto</a>
                        </div>
                        <div class="link_piece">
                            <a href="">Perfil</a>
                        </div>
                        <div class="link_piece">
                            <a href="">Workshops</a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="legal">
                    <div class="copy">
                        brainwave copyright - own elements
                    </div>
                    <div class="disclaimer">
                        <a href="">Disclaimer</a>
                        <a href="">Politica de privacidad</a>
                        <a href="">Terminos de Uso</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    </div>
</body>

</html>