<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/lista_psicologos.css">
    <title>BrainWave | Elige</title>
</head>

<?php

require_once '../bases_de_datos/conecta.php';
require_once '../bases_de_datos/tablas.php';

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
            <h1>Elige tu experto</h1>
        </div>

        <div class="section1">
            <div class="inner_section">
                <div class="buscador">
                    <form action="" method="GET">
                        <input type="text" name="buscador" id="" placeholder="Buscar" value="<?php if (isset($_GET['buscador'])) echo $_GET['buscador']; ?>"><button type="submit">Enviar</button>
                    </form>
                </div>
                <div class="psicologos_container">

                    <?php
                    $conexion = obtenerConexion();

                    // Verificar si se ha enviado una consulta de búsqueda
                    if (isset($_GET['buscador'])) {
                        $busqueda = $_GET['buscador'];

                        // Realiza la consulta para obtener psicólogos con imágenes que coincidan con la búsqueda
                        $query_psicologos_imagenes = "SELECT psicologos.*, imagenes.ruta AS imagen_ruta 
                        FROM psicologos 
                        JOIN relacion_psicologo_imagen ON psicologos.id_psicologo = relacion_psicologo_imagen.id_psicologo 
                        JOIN imagenes ON relacion_psicologo_imagen.id_imagen = imagenes.id_imagen
                        WHERE psicologos.nombre LIKE '%$busqueda%'";
                    } else {
                        // Consulta sin búsqueda, obtener todos los psicólogos con imágenes
                        $query_psicologos_imagenes = "SELECT psicologos.*, imagenes.ruta AS imagen_ruta 
                        FROM psicologos 
                        JOIN relacion_psicologo_imagen ON psicologos.id_psicologo = relacion_psicologo_imagen.id_psicologo 
                        JOIN imagenes ON relacion_psicologo_imagen.id_imagen = imagenes.id_imagen";
                    }

                    $result_psicologos_imagenes = mysqli_query($conexion, $query_psicologos_imagenes);

                    // Almacena los resultados en un array asociativo
                    $psicologos_imagenes = mysqli_fetch_all($result_psicologos_imagenes, MYSQLI_ASSOC);

                    // Cierra la conexión
                    cerrarConexion($conexion);

                    foreach ($psicologos_imagenes as $psicologo_imagen) {
                        echo '<div class="psicologo">';
                        echo '<div class="imagen_psicologo" style="background-image:url(' . $psicologo_imagen["imagen_ruta"] . ')"></div>';
                        echo '<div class="texto_psicologo">';
                        echo '<h2>' . $psicologo_imagen['nombre'] . '</h2>';
                        echo '<a href="pedir_cita.php?id=' . $psicologo_imagen['id_psicologo'] . '"><button>Pedir Cita</button></a>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>

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