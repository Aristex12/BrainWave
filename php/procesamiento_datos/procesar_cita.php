<?php
require_once '../bases_de_datos/conecta.php';

$conexion = obtenerConexion();

$datosJSON = $_POST["datos"];

if (isset($datosJSON)) {

    $datos = json_decode($datosJSON, true);

    // Obtener datos específicos
    $fecha = $datos["fecha"];
    $hora = $datos["hora"];
    $idPsicologo = $datos["id"];

    // Obtener el ID del usuario a partir del nombre de usuario
    session_start();
    $username = $_SESSION["usuario"];
    session_write_close();

    $sqlGetUserId = "SELECT id_paciente FROM relacion_usuarios_login WHERE id_login = (SELECT id_login FROM login WHERE username = ?)";
    $stmtGetUserId = $conexion->prepare($sqlGetUserId);
    $stmtGetUserId->bind_param("s", $username);
    $stmtGetUserId->execute();
    $resultGetUserId = $stmtGetUserId->get_result();

    if ($resultGetUserId->num_rows > 0) {
        // Usuario encontrado, obtener el ID
        $row = $resultGetUserId->fetch_assoc();
        $idPaciente = $row['id_paciente'];

        // Verificar si el paciente ya tiene una cita programada con cualquiera de los psicólogos en el futuro
        $sqlCitaProgramada = "SELECT * FROM relacion_psicologos_usuarios WHERE id_paciente = ? AND fecha >= CURDATE() AND hora >= CURTIME()";
        $stmtCitaProgramada = $conexion->prepare($sqlCitaProgramada);
        $stmtCitaProgramada->bind_param("i", $idPaciente);
        $stmtCitaProgramada->execute();
        $resultCitaProgramada = $stmtCitaProgramada->get_result();

        if ($resultCitaProgramada->num_rows > 0) {
            // El paciente ya tiene una cita programada en el futuro
            echo json_encode(['error' => true, 'mensaje' => 'Ya tienes una cita programada']);
            exit();
        }

        $stmtCitaProgramada->close();
    } else {
        // Usuario no encontrado
        echo json_encode(['error' => true, 'mensaje' => 'No se ha encontrado el usuario.']);
        exit();
    }

    $stmtGetUserId->close();

    // Verificar si el psicólogo y la fecha están disponibles
    $sqlDisponibilidad = "SELECT * FROM relacion_psicologos_usuarios WHERE id_psicologo = ? AND fecha = ? AND hora = ?";
    $stmtDisponibilidad = $conexion->prepare($sqlDisponibilidad);
    $stmtDisponibilidad->bind_param("iss", $idPsicologo, $fecha, $hora);
    $stmtDisponibilidad->execute();
    $resultDisponibilidad = $stmtDisponibilidad->get_result();

    if ($resultDisponibilidad->num_rows > 0) {
        // El psicólogo ya tiene una cita programada para esa fecha y hora
        echo json_encode(['error' => true, 'mensaje' => 'El psicólogo ya tiene una cita programada para esa fecha y hora.']);
        exit();
    }

    // Insertar la cita en la tabla relacion_psicologos_usuarios
    $sqlInsertCita = "INSERT INTO relacion_psicologos_usuarios (id_psicologo, id_paciente, fecha, hora) VALUES (?, ?, ?, ?)";
    $stmtInsertCita = $conexion->prepare($sqlInsertCita);
    $stmtInsertCita->bind_param("iiss", $idPsicologo, $idPaciente, $fecha, $hora);
    $flagCita = $stmtInsertCita->execute();

    if ($flagCita) {
        echo json_encode(['success' => true, 'mensaje' => 'Cita programada correctamente.']);
        exit();
    } else {
        echo json_encode(['error' => true, 'mensaje' => 'No se ha podido programar la cita.']);
        exit();
    }

    $stmtDisponibilidad->close();
    $stmtInsertCita->close();
} else {
    echo json_encode(['error' => true, 'mensaje' => 'No se han enviado los datos correctamente']);
    exit();
}

cerrarConexion($conexion);
?>
