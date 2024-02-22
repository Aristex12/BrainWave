<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <title>Home</title>
</head>

<body>
    <header>
        <h1>Bienvenido a Mi Página</h1>
    </header>

    <section>
        <p>Esta es una página de inicio super básica.</p>
        <button>Botón Morado</button>
    </section>

    <?php


        session_start();

        $tipo = $_SESSION["tipo"];

        if($tipo == "registro"){

            echo "<div class='container'>";
            echo "<div class='inner_container'>";
            echo "<p>Te has registrado correctamente!</p>";
            echo "</div>";
            echo "</div>";

        }


    ?>

</body>

</html>