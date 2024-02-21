<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/register.js"></script>
    <title>BrainWave | Registro</title>
</head>

<?php

require_once "conecta.php";
require_once "tablas.php";

?>

<body>
    <div class="container">
        <div class="inner_container">
            <h2>Registro</h2>
            <form action="#" method="post" id="register_form">
                <div class="error_general" id="error_general">
                    <p class="text_general"></p>
                </div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
                <div class="error_username" id="error_username">
                    <p class="text_username"></p>
                </div>

                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName">
                <div class="error_firstname" id="error_firstname">
                    <p class="text_firstname"></p>
                </div>

                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName">
                <div class="error_lastname" id="error_lastname">
                    <p class="text_lastname"></p>
                </div>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <div class="error_email" id="error_email">
                    <p class="text_email"></p>
                </div>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" oninput="verificarFortaleza()">
                <div class="error_password" id="error_password">
                    <p class="text_password"></p>
                </div>

                <button type="submit" id="submit">Registrarse</button>
            </form>
        </div>
    </div>
</body>

</html>