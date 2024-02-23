<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <script src="../js/login.js"></script>
    <title>BrainWave | Login</title>
</head>

<?php

require_once "conecta.php";
require_once "tablas.php";

?>

<body>
    <div class="container">
        <div class="inner_container">
            <h2>Login</h2>
            <form action="#" method="post" id="login_form">
                <div class="error_general" id="error_general">
                    <p class="text_general"></p>
                </div>
                <label for="username">Username:</label> <br>
                <input type="text" id="username" name="username"> <br>

                <label for="password">Password:</label> <br>
                <input type="password" id="password" name="password">
                <span id="togglePassword" onclick="togglePassword()">
                    <i class="fas fa-eye" id="eyeIcon"></i>
                </span> <br>

                <button type="submit" id="submit">Entra</button> <br>
                ¿No tienes cuenta? <a href="register.php">Pulsa aqui</a>
            </form>
        </div>
    </div>
</body>

</html>