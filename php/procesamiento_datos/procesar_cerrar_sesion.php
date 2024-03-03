<?php
// Inicia la sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destruye la sesión
session_destroy();

echo json_encode(['success' => true, 'mensaje' => 'Se ha cerrado la sesión correctamente!']);

exit();
?>
