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

    // Verificar si la sesión está iniciada
    if (!isset($_SESSION["usuario"])) {
        // Redirigir a la página de inicio de sesión si no hay sesión iniciada
        header("Location: login.php");
        exit();
    }

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
                                <i class="fa fa-exclamation-circle"></i>
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