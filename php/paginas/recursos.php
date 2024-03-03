<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/recursos.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../js/nav.js" defer></script>
    <title>BrainWave | Recursos</title>
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
                            <li style="color: #7E42FB;">Recursos</li>
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
            <h1>Recursos</h1>
        </div>

        <div class="section1">
            <div class="inner_section">
                <div class="image_container1">
                </div>
                <div class="text_container">
                    <h2>Libros</h2>
                    <p>Te extendemos una cordial invitación a explorar una cuidadosa selección de libros especialmente concebidos para ofrecer un respaldo significativo a aquellas personas que enfrentan el Trastorno por Déficit de Atención e Hiperactividad (TDAH)</p>
                    <a href="libros.php"><button class="boton_ver">Ver</button></a>
                </div>
            </div>
        </div>

        <div class="section2">
            <div class="inner_section">
                <div class="text_container">
                    <h2>Podcasts</h2>
                    <p>Descubre una amplia variedad de episodios informativos y entretenidos que te proporcionarán una comprensión más completa y enriquecedora de este tema crucial. ¡Explora, aprende y disfruta!</p>
                    <a href="podcasts.php"><button class="boton_ver">Ver</button></a>
                </div>
                <div class="image_container2">

                </div>
            </div>
        </div>

        <div class="section3">
            <div class="inner_section">
                <div class="image_container3">

                </div>
                <div class="text_container">
                    <h2>Artículos</h2>
                    <p>Extendemos una cálida invitación para que te sumerjas en nuestra cuidadosa selección de libros, meticulosamente diseñados con el propósito de proporcionar no solo apoyo tangible, sino también una fuente constante de inspiración y un vasto caudal de conocimiento.</p>
                    <a href="articulos.php"><button class="boton_ver">Ver</button></a>
                </div>
            </div>
        </div>

    </main>

    <footer>
        <div class="container_footer">
            <div class="inner_footer_container">
                <div class="social_media">
                    <h2>Social</h2>
                    <a href=""><i class="fab fa-instagram fa-2x"></i></a>
                    <a href=""><i class="fab fa-facebook fa-2x"></i></a>
                    <a href=""><i class="fab fa-linkedin fa-2x"></i></a>
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