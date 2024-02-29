<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/libros.css">
    <title>BrainWave | Libros</title>
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
            <h1>Libros</h1>
        </div>

        <div class="section1">
            <div class="inner_section">
                <div class="buscador">
                    <form action="" method="GET">
                        <input type="text" name="buscador" id="" placeholder="Buscar" value="<?php if (isset($_GET['buscador'])) echo $_GET['buscador']; ?>"><button type="submit">Enviar</button>
                    </form>
                </div>
                <div class="libros_container">

                    <?php

                    $conexion = obtenerConexion();

                    // Verificar si se ha enviado una consulta de búsqueda
                    if (isset($_GET['buscador'])) {
                        $busqueda = $_GET['buscador'];

                        // Realiza la consulta para obtener libros con imágenes que coincidan con la búsqueda
                        $query_libros_imagenes = "SELECT libros.*, imagenes.ruta AS imagen_ruta 
                        FROM libros 
                        JOIN relacion_libro_imagen ON libros.id_libro = relacion_libro_imagen.id_libro 
                        JOIN imagenes ON relacion_libro_imagen.id_imagen = imagenes.id_imagen
                        WHERE libros.titulo LIKE '%$busqueda%' OR libros.autor LIKE '%$busqueda%'";
                                    } else {
                                        // Consulta sin búsqueda, obtener todos los libros con imágenes
                                        $query_libros_imagenes = "SELECT libros.*, imagenes.ruta AS imagen_ruta 
                        FROM libros 
                        JOIN relacion_libro_imagen ON libros.id_libro = relacion_libro_imagen.id_libro 
                        JOIN imagenes ON relacion_libro_imagen.id_imagen = imagenes.id_imagen";
                    }

                    $result_libros_imagenes = mysqli_query($conexion, $query_libros_imagenes);

                    // Almacena los resultados en un array asociativo
                    $libros_imagenes = mysqli_fetch_all($result_libros_imagenes, MYSQLI_ASSOC);

                    // Cierra la conexión
                    cerrarConexion($conexion);

                    foreach ($libros_imagenes as $libro_imagen) {
                        echo '<div class="libro">';
                        echo '<div class="imagen_libro" style="background-image:url(' . $libro_imagen["imagen_ruta"] . ')">';
                        echo '</div>';
                        echo '<div class="texto_libro">';
                        echo '<h2>' . $libro_imagen['titulo'] . '</h2>';
                        echo '<p>' . $libro_imagen['autor'] . '</p>';
                        echo '<a href="' . $libro_imagen['link'] . '" target="_blank"><button>Comprar</button></a>';
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