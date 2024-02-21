<?php

require_once "conecta.php";

$conexion = obtenerConexion();

$datosJSON = $_POST["datos"];

if (isset($datosJSON)) {

    $datos = json_decode($datosJSON, true);

    $username = $datos["username"];
    $password = $datos["password"];

    // Obtener el hash almacenado para el usuario
    $stmt = $conexion->prepare("SELECT password FROM login WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hash);
    
    if ($stmt->fetch() && password_verify($password, $hash)) {
        // Contraseña correcta
        session_start();
        $_SESSION['usuario'] = $username;
        $_SESSION["tipo"] = "login";

        // Redirigir a la página de inicio después del login
        header("Location: home.php");
        exit();
    } else {
        // Contraseña incorrecta
        echo json_encode(['error' => true, 'mensaje' => 'Credenciales incorrectas.']);
        exit();
    }

    $stmt->close();

}
