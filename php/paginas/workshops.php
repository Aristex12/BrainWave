<?php
require_once '../bases_de_datos/conecta.php';
require_once '../bases_de_datos/tablas.php';

session_start();

// Verificar si el método de solicitud es POST y el botón de envío está presente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["boton_enviar"])) {

    // Verificar si hay una sesión iniciada
    if (isset($_SESSION["usuario"])) {
        // Obtener el id del evento desde el campo oculto
        $id_evento = $_POST["id_escondido"];

        // Obtener el id del paciente (supongamos que lo obtienes de alguna manera)
        $id_paciente = obtenerIdPaciente($_SESSION["usuario"]);

        // Insertar datos en la tabla relacion_workshops_usuarios
        if ($id_evento && $id_paciente) {
            $conexion = obtenerConexion();

            $query_insert = "INSERT INTO relacion_workshops_usuarios (id_evento, id_paciente) VALUES ($id_evento, $id_paciente)";
            mysqli_query($conexion, $query_insert);

            cerrarConexion($conexion);

            // Mensaje de éxito u otra lógica después de la inserción
            echo "Inserción exitosa en la tabla relacion_workshops_usuarios";
            session_write_close();
        } else {
            // Manejar el caso en que no se puedan obtener los ids necesarios
            echo "Error: No se pudieron obtener los ids necesarios";
        }
    } else {
        // Redirige a la página de inicio de sesión si no hay una sesión iniciada
        header("Location: login.php");
        exit(); // Asegúrate de salir después de la redirección
    }
}

function obtenerIdPaciente($username)
{
    // Obtener el id del paciente según el nombre de usuario (implementa según tu lógica)
    // Puedes realizar una consulta a la base de datos para obtener el id del paciente asociado al username
    // Este es solo un ejemplo de cómo podría ser, ajusta según tu estructura de la base de datos
    $conexion = obtenerConexion();
    $query = "SELECT id_paciente FROM relacion_usuarios_login WHERE id_login = (SELECT id_login FROM login WHERE username = '$username')";
    $result = mysqli_query($conexion, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row["id_paciente"];
    }

    return null; // Otra lógica si no se puede obtener el id del paciente
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/workshops.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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