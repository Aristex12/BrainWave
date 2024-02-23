<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/contacto.js"></script>
    <title>BrainWave | Contacto</title>
</head>

<?php

require_once "conecta.php";
require_once "tablas.php";

?>

<body>
    <div class="container">
        <div class="inner_container">
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

                <button type="submit" id="submit">Registrarse</button> <br>
                ¿Quieres volver a la home? <a href="home.php">Pulsa aqui</a>
            </form>
        </div>
    </div>
</body>

</html>