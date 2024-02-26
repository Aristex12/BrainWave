<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <title>Home</title>
</head>

<?php

require_once "conecta.php";
require_once "tablas.php";

session_start();

?>

<body>
    <nav>
        <div class="nav_container">

            <div class="nav_inner">

                <div class="logo">
                    <a href="home.php">
                        <img src="../img/logo.png" alt="">
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

                                ?>"><i class="fas fa-user-circle fa-2x" id="color_perfil" style="color:white"></i></a>
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

            </div>
            <div class="servicios">
                <div class="tarjeta_servicio">

                </div>
                <div class="tarjeta_servicio">

                </div>
                <div class="tarjeta_servicio">

                </div>
                <div class="tarjeta_servicio">

                </div>
            </div>
        </div>

    </main>

</body>

</html>