<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/contacto.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <script src="../../js/contacto.js"></script>
    <title>BrainWave | Contacto</title>
</head>

<?php

require_once "../bases_de_datos/conecta.php";
require_once "../bases_de_datos/tablas.php";

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

                                ?>"><i class="fas fa-user-circle fa-2x" id="color_perfil" style="color:white"></i></a>
                </div>

            </div>

        </div>

    </nav>

    <main>
        <div class="container_form">
            <div class="inner_container_form">
                <h2>Contacto</h2>
                <form action="#" method="post" id="contacto_form">
                    <div class="error_general" id="error_general">
                        <p class="text_general"></p>
                    </div>
                    <label for="nombre">Nombre y Apellidos:</label><br>
                    <input type="text" id="nombre" name="nombre">
                    <div class="error_nombre" id="error_nombre">
                        <p class="text_nombre"></p>
                    </div> <br>

                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email">
                    <div class="error_email" id="error_email">
                        <p class="text_email"></p>
                    </div> <br>

                    <label for="telefono">Telefono:</label><br>
                    <input type="number" id="telefono" name="telefono">
                    <div class="error_telefono" id="error_telefono">
                        <p class="text_telefono"></p>
                    </div> <br>

                    <label for="telefono">Mensaje:</label> <br>
                    <textarea name="mensaje" id="mensaje" cols="30" rows="10"></textarea>
                    <div class="error_mensaje" id="error_mensaje">
                        <p class="text_mensaje"></p>
                    </div> <br>

                    <button type="submit" id="submit">Enviar</button>
                </form>
            </div>
    </main>

    </div>
</body>

</html>