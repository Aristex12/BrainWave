<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/satoshi.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <title>Home</title>
</head>

<body>
    <nav>
        <div class="nav_container">

            <div class="nav_inner">

                <div class="logo">
                    <img src="../img/logo.png" alt="">
                </div>
                <div class="lista">

                    <ul>
                        <a href="">
                            <li>Servicios</li>
                        </a>
                        <a href="">
                            <li>Recursos</li>
                        </a>
                        <a href="">
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
                    <a href=""><i class="fas fa-user-circle fa-2x" style="color:white"></i></a>
                </div>

            </div>

        </div>
    </nav>

    <header>
        <h1>Bienvenido a Mi Página</h1>
    </header>

    <section>
        <p>Esta es una página de inicio super básica.</p>
        <a href="login.php"><button>Login</button></a> <a href="register.php"><button>Registro</button></a> <a href="contacto.php"><button>Contacto</button></a>
    </section>

    <?php


    session_start();

    $tipo = $_SESSION["tipo"];
    $username = $_SESSION["usuario"];

    if ($tipo == "registro") {

        echo "<div class='container'>";
        echo "<div class='inner_container'>";
        echo "<p>Te has registrado correctamente!</p>";
        echo "</div>";
        echo "</div>";
    } else {

        echo "<div class='container'>";
        echo "<div class='inner_container'>";
        echo "<p>Bienvenida de vuelta $username!</p>";
        echo "</div>";
        echo "</div>";
    }


    ?>

</body>

</html>