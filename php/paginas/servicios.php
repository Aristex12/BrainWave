<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/servicios.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../js/nav.js" defer></script>
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
                                session_start();
                                if (isset($_SESSION["usuario"])) {
                                    echo "perfil.php";
                                } else {
                                    echo "login.php";
                                }
                                session_write_close();
                                ?>"><i class="fas fa-user-circle fa-2x" id="color_perfil"></i></a>
                </div>

            </div>

        </div>
    </nav>

    <main>

        <div class="titulo">
            <h1>Servicios</h1>
        </div>

        <div class="section1">
            <div class="inner_section">
                <div class="image_container1">
                </div>
                <div class="text_container">
                    <h2>Psicólogos</h2>
                    <p>Nuestros psicólogos especializados en TDAH brindan apoyo personalizado y efectivo, utilizando estrategias adaptadas a las necesidades individuales. Con empatía y experiencia, guiaremos a cada persona afectada por el TDAH hacia el autodescubrimiento y el desarrollo personal.</p>
                    <a href="psicologos.php"><button class="boton_ver">Ver</button></a>
                </div>
            </div>
        </div>

        <div class="section2">
            <div class="inner_section">
                <div class="text_container">
                    <h2>Workshops</h2>
                    <p>Nuestros talleres especializados ofrecen apoyo y estrategias personalizadas para abordar el TDAH. Con enfoque práctico, brindamos herramientas efectivas para el desarrollo personal y la gestión del trastorno.</p>
                    <a href="workshops.php"><button class="boton_ver">Ver</button></a>
                </div>
                <div class="image_container2">

                </div>
            </div>
        </div>

    </main>

    <footer>
        <div class="container_footer">
            <div class="inner_footer_container">
                <div class="social_media">
                    <h2>Social</h2>
                    <a href="https://www.instagram.com/aristex12/?hl=es"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="https://www.facebook.com/aris.kuhs/"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="https://www.linkedin.com/in/arismaximiliankuhs"><i class="fab fa-linkedin fa-2x"></i></a>
                </div>
                <div class="contact">
                    <h2>Contacto</h2>
                    <div class="inner_contacto">
                        <p><span class="fuerte">Telefono: </span><a href="tel://+34 632707689">+34 632 707 689</a></p>
                        <p><span class="fuerte">Email: </span><a href="mailto:aristex@hotmail.com">aristex@hotmail.com</a></p>
                        <p><span class="fuerte">Direccion: </span><a href="https://maps.app.goo.gl/JZpVZw3dKvSbVxxa9"></a>C. Tajo, s/n, 28670 Villaviciosa de Odón, Madrid</p>
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
                        <a href="https://figueras.legal/condiciones-de-uso-de-la-web/">Disclaimer</a>
                        <a href="https://figueras.legal/condiciones-de-uso-de-la-web/">Politica de privacidad</a>
                        <a href="https://figueras.legal/condiciones-de-uso-de-la-web/">Terminos de Uso</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


</body>

</html>