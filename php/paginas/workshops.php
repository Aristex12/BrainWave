<?php
require_once '../bases_de_datos/conecta.php';
require_once '../bases_de_datos/tablas.php';

session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/workshops.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../js/nav.js" defer></script>
    <script src="../../js/workshops.js" defer></script>
    <title>BrainWave | Workshops</title>
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
            <h1>Workshops</h1>
        </div>

        <div class="section1">
            <div class="volver">
                <a href="servicios.php">
                    <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 512 512">
                        <path fill="#ffffff" d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z" />
                    </svg>
                    <p>Volver</p>
                </a>
            </div>
            <div class="error">
                <p class="error_text"></p>
                <i class="fa fa-exclamation-circle"></i>
            </div>
            <div class="succes">
                <p class="succes_text"></p>
                <i class="fas fa-check" style="color: black;"></i>
            </div>
            <div class="inner_section">
                <div class="buscador">
                    <form>
                        <input type="text" name="buscador" id="buscador" placeholder="Buscar" value="<?php if (isset($_GET['buscador'])) echo $_GET['buscador']; ?>" oninput="buscarWorkshops()">
                    </form>
                </div>
                <div class="workshop_container">

                    <?php
                    $conexion = obtenerConexion();

                    // Verificar si se ha enviado una consulta de búsqueda
                    if (isset($_GET['buscador'])) {
                        $busqueda = $_GET['buscador'];

                        // Realiza la consulta para obtener eventos que coincidan con la búsqueda
                        $query_eventos = "SELECT * FROM workshops WHERE nombre_evento LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%'";
                    } else {
                        // Consulta sin búsqueda, obtener todos los eventos
                        $query_eventos = "SELECT * FROM workshops";
                    }

                    $result_eventos = mysqli_query($conexion, $query_eventos);

                    // Cierra la conexión
                    cerrarConexion($conexion);

                    while ($evento = mysqli_fetch_assoc($result_eventos)) {
                        echo '<div class="workshop" data-fecha="' . $evento['fecha'] . '" data-hora="' . $evento['hora'] . '" data-lugar-nombre="' . $evento['lugar_nombre'] . '" data-lugar-direccion="' . $evento['lugar_direccion'] . ' " data-id="' . $evento["id_evento"] . '"">';
                        echo '<h2>' . $evento['nombre_evento'] . '</h2>';

                        $descripcion_resumen = substr($evento['descripcion'], 0, 150); // Limitar a 150 caracteres, ajusta según tus necesidades
                        echo '<p>' . $descripcion_resumen . '...</p>';

                        // Agregar elemento oculto con el contenido completo
                        echo '<div class="contenido-completo-oculto" style="display:none;">' . $evento['descripcion'] . '</div>';

                        echo '</div>';
                    }
                    session_write_close();
                    ?>


                </div>
            </div>
        </div>
        <div id="myModal" class="modal">
            <i class="fas fa-times fa-2x" id="closeBtn"></i>
            <div class="modal-content" id="modalContent">
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