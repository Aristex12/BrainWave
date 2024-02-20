<?php

require_once "conecta.php";

$conexion = obtenerConexion();

$datosJSON = $_POST["datos"];

echo var_dump($datosJSON);

if (isset($datosJSON)) {

    $datos = json_decode($datosJSON, true);

    // Obtener datos específicos
    $nombre = $datos["nombre"];
    $apellido = $datos["apellido"];
    $email = $datos["email"];
    $passwd = $datos["passwd"];
    $hash = password_hash($passwd, PASSWORD_BCRYPT);
    $username = $datos["username"];

    // Verificar si el usuario ya existe en perfiles_personas
    $sql = "SELECT id_paciente FROM perfiles_personas WHERE username = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id);

    // Verificar si ya existe el usuario
    if ($stmt->fetch()) {
        // El usuario ya existe, puedes manejar esto como desees
        echo json_encode(['error' => true, 'mensaje' => 'El usuario ya existe.']);
    } else {
        // El usuario no existe, proceder a insertar en perfiles_usuarios
        $stmt->close();

        // Insertar en perfiles_usuarios
        $sqlInsert = "INSERT INTO perfiles_personas (nombre, apellido, email, passwd) VALUES (?, ?, ?, ?)";
        $stmtInsert = $conexion->prepare($sqlInsert);
        $stmtInsert->bind_param("ssss", $nombre, $apellido, $email, $hash);

        // Ejecutar la inserción
        if ($stmtInsert->execute()) {
            echo json_encode(['error' => false, 'mensaje' => 'Se ha creado tu perfil correctamente!']);
        } else {
            echo json_encode(['error' => true, 'mensaje' => 'No se ha podido crear el usuario!']);
        }

        $stmtInsert->close();
    }

} else {

    echo json_encode(['error' => true, 'mensaje' => 'No se han enviado los datos correctamente!']);

}
