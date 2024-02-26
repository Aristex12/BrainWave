<?php

require_once "../bases_de_datos/conecta.php";

$conexion = obtenerConexion();

$datosJSON = $_POST["datos"];

if (isset($datosJSON)) {

    $datos = json_decode($datosJSON, true);

    // Obtener datos específicos
    $nombre = $datos["nombre"];
    $email = $datos["email"];
    $telefono = $datos["telefono"];
    $mensaje = $datos["mensaje"];

    // Verificar si el email ya existe en la tabla contacto
    $sql = "SELECT * FROM contacto WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Verificar si ya existe el email
    if ($stmt->fetch()) {
        // El email ya existe
        echo json_encode(['error' => true, 'mensaje' => 'Ya existe un registro con este correo electrónico.']);
        exit();
    } else {
        // El email no existe, proceder a insertar en la tabla contacto
        $stmt->close();

        // Insertar en la tabla contacto
        $sqlInsert = "INSERT INTO contacto (nombre, email, telefono, mensaje) VALUES (?, ?, ?, ?)";
        $stmtInsert = $conexion->prepare($sqlInsert);
        $stmtInsert->bind_param("ssss", $nombre, $email, $telefono, $mensaje);

        if ($stmtInsert->execute()) {
            echo json_encode(['success' => true, 'mensaje' => 'Se han enviado tus datos de contacto!']);
            exit();
        } else {
            echo json_encode(['error' => true, 'mensaje' => 'No se ha podido insertar el contacto.']);
            exit();
        }

        $stmtInsert->close();
    }
} else {
    echo json_encode(['error' => true, 'mensaje' => 'No se han enviado los datos correctamente']);
    exit();
}
?>
