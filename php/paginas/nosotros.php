<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/nosotros.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../js/nav.js" defer></script>
    <title>BrainWave | Nosotros</title>
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
                            <li>Servicios</li>
                        </a>
                        <a href="recursos.php">
                            <li>Recursos</li>
                        </a>
                        <a href="nosotros.php">
                            <li style="color: #7E42FB;">Nosotros</li>
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
            <h1>Sobre Nosotros</h1>
        </div>

        <div class="section1">
            <div class="inner_section">
                <div class="text_container">
                    <h2>Más que un centro de ayuda</h2>
                    <p>Somos personas que tienen el mismo objetivo que tu y quienes les une la misma pasión.</p>
                </div>
                <div class="image_container1">
                </div>
            </div>
        </div>

        <div class="section2">
            <div class="inner_section2">

                <div class="section_image">

                </div>
                <div class="section_text">
                    <h2>¿Quienes Somos?</h2>
                    <p>Fundada en 2013, Brainwave surge con la misión de ofrecer un enfoque integral y altamente personalizado en el diagnóstico, tratamiento y apoyo a aquellos individuos que enfrentan el desafío del Trastorno por Déficit de Atención e Hiperactividad (TDAH). </p>
                </div>

            </div>
        </div>

        <div class="section3">
            <div class="inner_section3">
                <div class="section_text2">
                    <h1>Fundadores</h1>
                    <p>DE UNA INQUETUD HASTA UNA GRAN EMPRESA</p>
                </div>
                <div class="fundadores">
                    <div class="fundador">
                        <div class="fundador_imagen1">

                        </div>
                        <div class="fundador_texto">
                            <h3>Maria Rodríguez</h3>
                        </div>
                    </div>
                    <div class="fundador">
                        <div class="fundador_imagen2">

                        </div>
                        <div class="fundador_texto">
                            <h3>Pedro Arroyo</h3>
                        </div>
                    </div>
                    <div class="fundador">
                        <div class="fundador_imagen3">

                        </div>
                        <div class="fundador_texto">
                            <h3>Paula Sego</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section4">
            <div class="inner_section4">
                <div class="text_section4">
                    <i class="fas fa-circle fa-xs" style="margin-right: 10px;"></i>
                    <p>MOTIVACIÓN</p>
                    <h2>Nuestra Comunidad</h2>
                </div>
                <div class="datos">
                    <div class="dato">
                        <h2>100K</h2>
                        <p>Usuarios</p>
                    </div>
                    <div class="dato">
                        <h2>1K</h2>
                        <p>Psicólogos</p>
                    </div>
                    <div class="dato">
                        <h2>55</h2>
                        <p>Patrocinadores</p>
                    </div>
                    <div class="dato">
                        <h2>12</h2>
                        <p>Premios</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="section5">
            <h3>día a día en la búsqueda de un mundo más comprensivo y solidario en torno al TDAH</h3>
        </div>

    </main>

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