<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../js/nav.js" defer></script>
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
                                session_start();
                                if (isset($_SESSION["tipo"])) {
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
            <h1>Psicólogos</h1>
        </div>

        <div class="section1">
        <div class="volver">
        <a href="servicios.php">
            <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 512 512"><path fill="#ffffff" d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z"/>
            </svg>
            <p>Volver</p>
        </a>
        </div>
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
                    <a href="articulos.php"><button class="boton_articulos">Ver</button></a>
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
                            <p>¡Hola! Soy la Dra. María Rodríguez, psicóloga con más de 10 años de experiencia. Estoy encantada de ser tu guía en este viaje hacia el bienestar emocional. Mi enfoque cálido y empático te brindará el apoyo que necesitas.</p>
                        </div>
                    </div>
                    <div class="psicologo">
                        <div class="psicologo_imagen2">

                        </div>
                        <div class="psicologo_texto">
                            <h3>Carlos Martinez</h3>
                            <p>Saludos, soy el Lic. Carlos Martínez, psicólogo especializado en ansiedad y estrés. Estoy emocionado de trabajar contigo para superar los desafíos emocionales. Juntos, construiremos un camino hacia la tranquilidad y el equilibrio.</p>
                        </div>
                    </div>
                    <div class="psicologo">
                        <div class="psicologo_imagen3">

                        </div>
                        <div class="psicologo_texto">
                            <h3>Laura Gómez</h3>
                            <p>¡Bienvenido! Soy la Dra. Laura Gómez, psicóloga clínica. Estoy emocionada de formar parte de tu proceso de crecimiento personal. Con un enfoque positivo y orientado a soluciones, trabajaremos juntos para alcanzar tus metas emocionales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section4">
            <div class="inner_section4">
                <h1>¿A que esperas?</h1>
                <a href="<?php echo isset($_SESSION["usuario"]) ? 'lista_psicologos.php' : 'login.php'; ?>"><button>Pide cita</button></a>
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