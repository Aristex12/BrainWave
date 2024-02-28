<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/psicologos.css">
    <title>BrainWave | Servicios</title>
</head>

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
                            <li style="color: #7E42FB;">Servicios</li>
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
            <h1>Psicólogos</h1>
        </div>

        <div class="section1">
            <div class="inner_section">
                <div class="text_container">
                    <i class="fas fa-circle fa-xs" style="margin-right: 10px;"></i>
                    <p>Cómodo</p> <br>
                    <h2>Lo Hacemos Sencillo</h2>
                </div>
                <div class="datos_container">
                    <div class="dato">
                        <span>01</span>
                        <h3>Elige tu psicólogo</h3>
                        <p>Explora la plataforma y selecciona entre una variedad de profesionales.</p>
                    </div>
                    <div class="dato">
                        <span>02</span>
                        <h3>Conócelo Más</h3>
                        <p>Investiga el perfil de tu psicólogo elegido para entender su enfoque y experiencia.</p>
                    </div>
                    <div class="dato">
                        <span>03</span>
                        <h3>Sesión Virtual</h3>
                        <p>Coordina una sesión por videollamada o llamada para discutir preocupaciones y establecer objetivos.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="section2">
            <div class="inner_section2">
                <div class="text_container">
                    <i class="fas fa-circle fa-xs" style="margin-right: 10px;"></i>
                    <p>Leer</p> <br>
                    <h2>Infórmate sobre nuestros articulos</h2>
                </div>
                <div class="boton_container">
                    <a href=""><button class="boton_articulos">Ver</button></a>
                </div>
            </div>
        </div>

        <div class="section3">
            <div class="inner_section3">
                <div class="section_text2">
                    <i class="fas fa-circle fa-xs" style="margin-right: 10px;"></i>
                    <p>Ellos</p> <br>
                    <h2>Nuestros Expertos</h2>
                </div>
                <div class="psicologos_container">
                    <div class="psicologo">
                        <div class="psicologo_imagen1">

                        </div>
                        <div class="psicologo_texto">
                            <h3>Maria Rodríguez</h3>
                            <p></p>
                        </div>
                    </div>
                    <div class="psicologo">
                        <div class="psicologo_imagen2">

                        </div>
                        <div class="psicologo_texto">
                            <h3>Pedro Arroyo</h3>
                            <p></p>
                        </div>
                    </div>
                    <div class="psicologo">
                        <div class="psicologo_imagen3">

                        </div>
                        <div class="psicologo_texto">
                            <h3>Paula Sego</h3>
                            <p></p>
                        </div>
                    </div>
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


</body>

</html>