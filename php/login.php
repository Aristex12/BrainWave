<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
            <form action="#" method="post" id="register_form">
                <div class="error_general" id="error_general">
                    <p class="text_general"></p>
                </div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
                <div class="error_username" id="error_username">
                    <p class="text_username"></p>
                </div>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" oninput="verificarFortaleza()">
                <div class="error_password" id="error_password">
                    <p class="text_password"></p>
                </div>

                <button type="submit" id="submit">Entra</button>
            </form>
        </div>
    </div>
</body>

</html>