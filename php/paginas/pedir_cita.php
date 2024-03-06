<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/pedir_cita.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../js/nav.js" defer></script>
    <script src="../../js/pedir_cita.js" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <title>BrainWave | Pedir Cita</title>
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

    <?php
    $conexion = obtenerConexion();

    // Inicializa las variables
    $psicologos_imagenes = [];

    // Verificar si se ha enviado una consulta de búsqueda
    if (isset($_GET['id'])) {
        $id_psicologo = $_GET['id'];

        // Consulta con búsqueda, obtener los datos del psicólogo específico con su imagen
        $query_psicologo_imagen = "SELECT psicologos.*, imagenes.ruta AS imagen_ruta 
                FROM psicologos 
                JOIN relacion_psicologo_imagen ON psicologos.id_psicologo = relacion_psicologo_imagen.id_psicologo 
                JOIN imagenes ON relacion_psicologo_imagen.id_imagen = imagenes.id_imagen
                WHERE psicologos.id_psicologo = $id_psicologo";
        $result_psicologo_imagen = mysqli_query($conexion, $query_psicologo_imagen);

        // Almacena el resultado en el array
        $psicologos_imagenes = mysqli_fetch_assoc($result_psicologo_imagen);
    }

    // Cierra la conexión
    cerrarConexion($conexion);

    // Ahora, $psicologos_imagenes contiene un array asociativo con los datos del psicólogo e imagen.
    ?>

    <main>

        <div class="titulo">
            <h1>Pedir Cita</h1>
        </div>

        <div class="section1">
            <div class="volver">
                <a href="lista_psicologos.php">
                    <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 512 512">
                        <path fill="#ffffff" d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z" />
                    </svg>
                    <p>Volver</p>
                </a>
            </div>
            <div class="inner_section">
                <div class="psicologo">
                    <?php echo '<input id="id_psicologo" type="hidden" value="' . $id_psicologo . '">'; ?>
                    <div class="inner_psicologo">
                        <div class="imagen" style="background-image: url('<?php echo $psicologos_imagenes["imagen_ruta"] ?>');">
                        </div>
                        <div class="texto_imagen">
                            <h2><?php echo $psicologos_imagenes["nombre"] ?></h2>
                        </div>
                    </div>
                </div>
                <div class="info_psicologo">
                    <div class="box1">
                        <h2>Descripción</h2>
                        <p><?php echo $psicologos_imagenes["descripcion"] ?></p>
                        <h2>Especialización</h2>
                        <ul>
                            <?php
                            $especializacion_comas = $psicologos_imagenes["especialista"];
                            $especializacion_sin_comas = explode(",", $especializacion_comas);

                            foreach ($especializacion_sin_comas as $valor) {
                                echo "<li>$valor</li>";
                            }
                            ?>
                        </ul>
                        <h2>Formación</h2>
                        <ul>
                            <?php
                            $formacion_comas = $psicologos_imagenes["formacion"];
                            $formacion_sin_comas = explode(",", $formacion_comas);

                            foreach ($formacion_sin_comas as $valor) {
                                echo "<li>$valor</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="section2">
            <div class="error">
                <p class="error_text"></p>
                <i class="fa fa-exclamation-circle"></i>
            </div>
            <div class="succes">
                <p class="succes_text"></p>
                <i class="fas fa-check" style="color: black;"></i>
            </div>
            <div class="inner_section2">
                <div class="error">
                    <p class="texto_error">Tienes que elegir una hora</p>
                </div>
                <div class="wrapper">
                    <header>
                        <p class="current-date"></p>
                        <div class="icons">
                            <span id="prev" class="material-symbols-rounded">chevron_left</span>
                            <span id="next" class="material-symbols-rounded">chevron_right</span>
                        </div>
                    </header>
                    <div class="calendar">
                        <ul class="weeks">
                            <li>Sun</li>
                            <li>Mon</li>
                            <li>Tue</li>
                            <li>Wed</li>
                            <li>Thu</li>
                            <li>Fri</li>
                            <li>Sat</li>
                        </ul>
                        <ul class="days"></ul>
                    </div>
                </div>
                <div class="horas_container">

                    <div class="inner_horas">

                        <div class="hora selectable-hour"><span id="hour1" data-hour="09:30:00">9.30 AM</span></div>
                        <div class="hora selectable-hour"><span id="hour2" data-hour="10:30:00">10.30 AM</span></div>
                        <div class="hora selectable-hour"><span id="hour3" data-hour="11:30:00">11.30 AM</span></div>
                        <div class="hora selectable-hour"><span id="hour4" data-hour="12:30:00">12.30 PM</span></div>
                        <div class="hora selectable-hour"><span id="hour5" data-hour="13:30:00">13.30 PM</span></div>
                        <div class="hora selectable-hour"><span id="hour6" data-hour="14:30:00">14.30 PM</span></div>
                        <div class="hora selectable-hour"><span id="hour7" data-hour="15:30:00">15.30 PM</span></div>
                        <div class="hora selectable-hour"><span id="hour8" data-hour="16:30:00">16.30 PM</span></div>

                        <div class="form">
                            <button class="boton_enviar" onclick="enviarCita()">Pedir Cita</button>
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