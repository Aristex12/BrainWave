<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <script src="../../js/home.js" defer></script>
    <title>BrainWave | Home</title>
</head>

<?php

require_once "../bases_de_datos/conecta.php";
require_once "../bases_de_datos/tablas.php";

session_start();

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

    <?php

    if (isset($_SESSION["usuario"])) {

        $tipo = $_SESSION["tipo"];
        $username = $_SESSION["usuario"];
        $mensaje = $_SESSION["mensaje_bienvenida_mostrado"];

        if ($tipo == "registro" && $mensaje == false) {

            echo "<div class='container'>";
            echo "<div class='inner_container'>";
            echo "<p>Te has registrado correctamente!</p>";
            echo "</div>";
            echo "</div>";

            $_SESSION["mensaje_bienvenida_mostrado"] = true;
        } elseif ($tipo == "login" && $mensaje == false) {

            echo "<div class='container'>";
            echo "<div class='inner_container'>";
            echo "<p>Bienvenido de vuelta $username!</p>";
            echo "</div>";
            echo "</div>";

            $_SESSION["mensaje_bienvenida_mostrado"] = true;
        }
    }


    ?>

    <main>
        <div class="banner">
            <div class="titulo">
                <h1>Welcome to <span class="letra_brainwave">Brainwave</span></h1>
                <p>¡No te cortes! Desata tu creatividad <span class="letra_limites">sin límites</span></p>
                <a href="register.php">
                    <button class="boton_registro">REGISTRO</button>
                </a>
            </div>
        </div>

        <div class="section_1">
            <div class="inner_section1">
                <div class="image_section1">
                    <div class="inner_image_section1">

                    </div>
                </div>

                <div class="text_section1">
                    <div class="inner_text_section1">
                        <i class="fas fa-circle fa-xs" style="margin-right: 10px;"></i>
                        <p>FUTURO</p> <br>
                        <h3>Nuestra Visión</h3>
                        <p>En Brainwave, trabajamos para construir un mundo más comprensivo y solidario al cambiar la narrativa en torno al TDAH. Nos esforzamos por transformar este trastorno de un estigma a una fuerza única, creando conexiones más profundas, aumentando la conciencia social y brindando un apoyo efectivo para enfrentar el día a día.</p> <br>
                        <button class="boton_tarjeta">Ver</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="section_2">
            <div class="titulo_section2">
                <i class="fas fa-circle fa-xs" style="margin-right: 10px;"></i>
                <p>¿QUE PUEDES HACER?</p> <br>
                <h3>Todo lo que te ofrecemos</h3>
            </div>
            <div class="servicios">
                <div class="tarjeta_servicio">
                    <img src="../../img/shape2.svg" alt="">
                    <h3>Psicólogos</h3>
                    <p>Destacamos por ofrecer productos/servicios de calidad inigualable. Desde el inicio hasta el final.</p>
                </div>
                <div class="tarjeta_servicio">
                    <img src="../../img/shape3.svg" alt="">
                    <h3>Workshops</h3>
                    <p>Destacamos por ofrecer productos/servicios de calidad inigualable. Desde el inicio hasta el final.</p>
                </div>
                <div class="tarjeta_servicio">
                    <img src="../../img/shape4.svg" alt="">
                    <h3>Artículos</h3>
                    <p>Destacamos por ofrecer productos/servicios de calidad inigualable. Desde el inicio hasta el final.</p>
                </div>
                <div class="tarjeta_servicio">
                    <img src="../../img/shape5.svg" alt="">
                    <h3>Libros</h3>
                    <p>Destacamos por ofrecer productos/servicios de calidad inigualable. Desde el inicio hasta el final.</p>
                </div>
            </div>
        </div>

        <div class="section_3">
            <div class="titulo_section3">
                <i class="fas fa-circle fa-xs" style="margin-right: 10px;"></i>
                <p>PATROCINADORES</p> <br>
                <h3>Nuestros amigos</h3>
            </div>
            <div class="image_section3">

            </div>
        </div>

        <div class="section_4">
            <div class="inner_section4">
                <div class="titulo_section4">
                    <i class="fas fa-circle fa-xs" style="margin-right: 10px;"></i>
                    <p>DESTACAR</p> <br>
                    <h3>Nuestra Prioridad</h3>
                </div>
                <div class="card_container">
                    <div class="card">
                        <i class="fas fa-circle fa-lg" style="color: #F05A54;" id="circulo"></i>
                        <h2>Calidad</h2>
                        <hr>
                        <p>Destacamos por ofrecer productos/servicios de calidad inigualable. Desde el inicio hasta el final, nos esforzamos por superar tus expectativas.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-circle fa-lg" style="color: #2B9AFF;" id="circulo"></i>
                        <h2>Experiencia</h2>
                        <hr>
                        <p>En Brainwave, con años de liderazgo en salud, brindamos servicios perfeccionados. Confía en nuestra experiencia para una atención destacada y dedicada.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-circle fa-lg" style="color: #47DF9F;" id="circulo"></i>
                        <h2>Precio</h2>
                        <hr>
                        <p>Priorizamos la calidad sin elevar los costos. Ofrecemos servicios de alta calidad a precios accesibles, garantizando un valor excepcional en cada experiencia.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-circle fa-lg" style="color: magenta;" id="circulo"></i>
                        <h2>Innovación</h2>
                        <hr>
                        <p>Destacamos por integrar tecnología e innovación de vanguardia en todos nuestros procesos, Desde soluciones tecnológicas avanzadas hasta enfoques innovadores.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="section_5">
            <div class="inner_section5">
                <div class="titulo_section5">
                    <i class="fas fa-circle fa-xs" style="margin-right: 10px;"></i>
                    <p>RESULTADOS</p> <br>
                    <h3>Logros</h3>
                </div>
                <div class="circulos_container">
                    <div class="circulo">
                        <div class="outer">
                            <div class="inner">
                                <div id="number">
                                    50%
                                </div>
                            </div>
                        </div>
                        <h3>Mejora en la Concentración</h3>
                    </div>
                    <div class="circulo">
                        <div class="outer">
                            <div class="inner">
                                <div id="number">
                                    75%
                                </div>
                            </div>
                        </div>
                        <h3>Desarrollo de habilidades organizativas</h3>
                    </div>
                    <div class="circulo">
                        <div class="outer">
                            <div class="inner">
                                <div id="number">
                                    90%
                                </div>
                            </div>
                        </div>
                        <div>
                        <h3>Reducción del Estrés y la Ansiedad</h3>
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