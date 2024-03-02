<?php

require_once "../bases_de_datos/conecta.php";

$conexion = obtenerConexion();

$datosJSON = $_POST["datos"];

if (isset($datosJSON)) {
    $datos = json_decode($datosJSON, true);

    $username = $datos["username"];
    $nombre = $datos["nombre"];
    $apellidos = $datos["apellidos"];
    $email = $datos["email"];

    session_start();
    $username_viejo = $_SESSION["usuario"];
    session_write_close();

    // Obtener id_login directamente sin subconsulta
    $stmt = $conexion->prepare("SELECT id_login FROM login WHERE username = ?");
    $stmt->bind_param("s", $username_viejo);
    $stmt->execute();
    $stmt->bind_result($id_login);
    $stmt->fetch();
    $stmt->close();

    // Actualizar datos en la tabla usuarios
    $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, email = ? WHERE id_paciente = ?");
    $stmt->bind_param("sssi", $nombre, $apellidos, $email, $id_login);

    if ($stmt->execute()) {
        // Actualizar el username en la tabla login
        $stmt2 = $conexion->prepare("UPDATE login SET username = ? WHERE id_login = ?");
        $stmt2->bind_param("si", $username, $id_login);

        if ($stmt2->execute()) {
            echo json_encode(['success' => true, 'mensaje' => 'Información actualizada correctamente']);
            exit();
        } else {
            echo json_encode(['error' => true, 'mensaje' => 'Error al actualizar el username']);
            exit();
        }

        $stmt2->close();
    } else {
        // Error al actualizar
        echo json_encode(['error' => true, 'mensaje' => 'Error al actualizar la información']);
        exit();
    }

    $stmt->close();
}

// Cerrar la conexión al finalizar
cerrarConexion($conexion);
?>
