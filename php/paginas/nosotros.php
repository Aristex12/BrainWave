<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/nosotros.css">
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
                        <div class="fundador_imagen">

                        </div>
                        <div class="fundador_texto">
                            <h3>Maria Rodríguez</h3>
                        </div>
                    </div>
                    <div class="fundador">
                        <div class="fundador_imagen">

                        </div>
                        <div class="fundador_texto">
                            <h3>Maria Rodríguez</h3>
                        </div>
                    </div>
                    <div class="fundador">
                        <div class="fundador_imagen">

                        </div>
                        <div class="fundador_texto">
                            <h3>Maria Rodríguez</h3>
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