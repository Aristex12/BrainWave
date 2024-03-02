<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/perfil.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../js/perfil.js" defer></script>
    <title>BrainWave | Perfil</title>
</head>

<?php

require_once '../bases_de_datos/conecta.php';
require_once '../bases_de_datos/tablas.php';
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

                                if (isset($_SESSION["usuario"])) {
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

    // Obtener el nombre de usuario de la sesión
    $username = $_SESSION["usuario"];

    // Obtener información del usuario basada en el nombre de usuario
    $conexion = obtenerConexion();
    $query = "SELECT * FROM usuarios INNER JOIN login ON usuarios.id_paciente = login.id_login WHERE login.username = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);

    // Obtener resultados
    $resultado = mysqli_stmt_get_result($stmt);

    // Verificar si se encontraron resultados
    if ($row = mysqli_fetch_assoc($resultado)) {
        // Almacena la información del usuario en variables
        $nombre = $row['nombre'];
        $apellidos = $row['apellidos'];
        $email = $row['email'];
        // Puedes agregar más campos según sea necesario
    } else {
        // Redirigir si no se encuentra el usuario
        header("Location: login.php");
        exit();
    }

    // Cerrar la conexión
    cerrarConexion($conexion);
    ?>

    <main>
        <div class="titulo">
            <h1>Pedir Cita</h1>
        </div>
        <div class="section1">
            <div class="titulo_section1">
                <i class="fas fa-circle fa-xs" style="margin-right: 10px;"></i>
                <p>SOBRE TI</p> <br>
                <h1>Información Personal</h1>
            </div>
            <div class="inner_section">
                <div class="perfil">
                    <div class="inner_perfil">
                        <div class="imagen">
                        </div>
                        <div class="texto_imagen">
                            <h2><?php echo $nombre . " " . $apellidos ?></h2>
                        </div>
                    </div>
                </div>
                <div class="info_perfil">
                    <div class="box1">
                        <form action="" method="post" class="form_editar">
                            <div class="error">
                                <p class="error_text"></p>
                                <i class="fa fa-exclamation-circle"></i>
                            </div>
                            <div class="succes">
                                <p class="succes_text"></p>
                                <i class="fas fa-check" style="color: black;"></i>
                            </div>
                            <label for="username">Username</label><br>
                            <input type="text" id="username" name="username" value="<?php echo $_SESSION["usuario"] ?>"> <br>

                            <label for="nombre">Nombre</label> <br>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>"> <br>

                            <label for="apellidos">Apellidos</label><br>
                            <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos ?>"><br>

                            <label for="email">Email</label><br>
                            <input type="email" id="email" name="email" value="<?php echo $email ?>"><br>

                            <button type="button" id="editarBtn">Editar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="section2">
            <div class="titulo_section1">
                <i class="fas fa-circle fa-xs" style="margin-right: 10px;"></i>
                <p>RECORDATORIO</p> <br>
                <h1>Tu Semana</h1>
            </div>
            <div class="inner_section2">
                <?php
                // ... (código anterior)

                $conexion = obtenerConexion();

                // Obtener el username de la sesión
                $username = $_SESSION["usuario"];

                // Consulta para obtener el id_login (ID del usuario) a partir del username
                $queryLogin = "SELECT id_login FROM login WHERE username = ?";
                $stmtLogin = mysqli_prepare($conexion, $queryLogin);
                mysqli_stmt_bind_param($stmtLogin, 's', $username);
                mysqli_stmt_execute($stmtLogin);
                mysqli_stmt_bind_result($stmtLogin, $id_login);
                mysqli_stmt_fetch($stmtLogin);
                mysqli_stmt_close($stmtLogin);

                // Verificar si se encontró el usuario
                if (!empty($id_login)) {
                    // Consulta para obtener el id_usuario a partir del id_login
                    $queryUsuario = "SELECT id_paciente FROM relacion_usuarios_login WHERE id_login = ?";
                    $stmtUsuario = mysqli_prepare($conexion, $queryUsuario);
                    mysqli_stmt_bind_param($stmtUsuario, 'i', $id_login);
                    mysqli_stmt_execute($stmtUsuario);
                    mysqli_stmt_bind_result($stmtUsuario, $idUsuario);
                    mysqli_stmt_fetch($stmtUsuario);
                    mysqli_stmt_close($stmtUsuario);

                    // Verificar si se encontró el id_usuario
                    if (!empty($idUsuario)) {
                        // Obtener la fecha actual
                        $fechaActual = date("Y-m-d");

                        // Obtener el primer día de esta semana (lunes)
                        $primerDiaSemana = date("Y-m-d", strtotime('monday this week'));

                        // Consultar eventos de psicólogos para esta semana
                        $queryPsicologos = "SELECT psicologos.nombre AS nombre_psicologo, relacion_psicologos_usuarios.fecha, relacion_psicologos_usuarios.hora
                            FROM relacion_psicologos_usuarios
                            INNER JOIN psicologos ON relacion_psicologos_usuarios.id_psicologo = psicologos.id_psicologo
                            WHERE relacion_psicologos_usuarios.id_paciente = ? AND relacion_psicologos_usuarios.fecha >= ?";

                        $stmtPsicologos = mysqli_prepare($conexion, $queryPsicologos);
                        mysqli_stmt_bind_param($stmtPsicologos, 'is', $idUsuario, $primerDiaSemana);
                        mysqli_stmt_execute($stmtPsicologos);
                        $resultadoPsicologos = mysqli_stmt_get_result($stmtPsicologos);

                        // Consultar eventos de workshops para esta semana
                        $queryWorkshops = "SELECT workshops.nombre_evento AS nombre_evento, workshops.fecha AS fecha_evento, workshops.hora AS hora_evento
                            FROM relacion_workshops_usuarios
                            INNER JOIN workshops ON relacion_workshops_usuarios.id_evento = workshops.id_evento
                            WHERE relacion_workshops_usuarios.id_paciente = ? AND workshops.fecha >= ?";

                        $stmtWorkshops = mysqli_prepare($conexion, $queryWorkshops);
                        mysqli_stmt_bind_param($stmtWorkshops, 'is', $idUsuario, $primerDiaSemana);
                        mysqli_stmt_execute($stmtWorkshops);
                        $resultadoWorkshops = mysqli_stmt_get_result($stmtWorkshops);

                        // Mostrar eventos de workshops
                        // Función para obtener la fecha en formato 'd-m-Y'
                        function obtenerFechaFormateada($fecha)
                        {
                            return date('d-m-Y', strtotime($fecha));
                        }

                        // Mostrar eventos de workshops
                        while ($rowWorkshop = mysqli_fetch_assoc($resultadoWorkshops)) {
                            $fechaEvento = $rowWorkshop['fecha_evento'];
                            $nombreEvento = $rowWorkshop['nombre_evento'];
                            $horaEvento = $rowWorkshop['hora_evento'];

                            // Verificar si la fecha es de esta semana en adelante
                            if (strtotime($fechaEvento) >= strtotime('today')) {
                                echo '<div class="evento">';
                                echo "<div class='inner_evento'>";

                                // Verificar si la fecha supera los 7 días en adelante
                                if (strtotime($fechaEvento) > strtotime('+7 days')) {
                                    echo '<p class="dia">' . obtenerFechaFormateada($fechaEvento) . '</p>';
                                } else {
                                    setlocale(LC_TIME, 'es_ES');
                                    $nombreDia = strftime('%A', strtotime($fechaEvento));
                                    echo '<p class="dia">' . $nombreDia . '</p>';
                                }

                                echo '<p class="texto">Evento: "' . $nombreEvento . '"</p>';
                                echo '</div>';
                                echo "<div class='hora_container'>";
                                echo '<p class="hora">' . $horaEvento . '</p>';
                                echo "</div>";
                                echo '</div>';
                            }
                        }

                        // Mostrar eventos de psicólogos
                        while ($rowPsicologo = mysqli_fetch_assoc($resultadoPsicologos)) {
                            $fechaPsicologo = $rowPsicologo['fecha'];
                            $nombrePsicologo = $rowPsicologo['nombre_psicologo'];
                            $horaPsicologo = $rowPsicologo['hora'];

                            // Verificar si la fecha es de esta semana en adelante
                            if (strtotime($fechaPsicologo) >= strtotime('today')) {
                                echo '<div class="evento">';
                                echo "<div class='inner_evento'>";

                                // Verificar si la fecha supera los 7 días en adelante
                                if (strtotime($fechaPsicologo) > strtotime('+7 days')) {
                                    echo '<p class="dia">' . obtenerFechaFormateada($fechaPsicologo) . '</p>';
                                } else {
                                    setlocale(LC_TIME, 'es_ES');
                                    $nombreDiaPsicologo = strftime('%A', strtotime($fechaPsicologo));
                                    echo '<p class="dia">' . $nombreDiaPsicologo . '</p>';
                                }

                                echo '<p class="texto">Cita con ' . $nombrePsicologo . '</p>';
                                echo '</div>';
                                echo "<div class='hora_container'>";
                                echo '<p class="hora">' . $horaPsicologo . '</p>';
                                echo "</div>";
                                echo '</div>';
                            }
                        }
                    } else {
                        echo "ID del usuario no encontrado";
                    }
                } else {
                    echo "Usuario no encontrado";
                }

                // Cerrar la conexión
                cerrarConexion($conexion);
                ?>


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