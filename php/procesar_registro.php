<?php

require_once "conecta.php";

$conexion = obtenerConexion();

$datosJSON = $_POST["datos"];

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
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Verificar si ya existe el usuario
    if ($stmt->fetch()) {
        // El usuario ya existe, puedes manejar esto como desees
        echo json_encode(['error' => true, 'mensaje' => 'El usuario ya existe.']);
        exit();
    } else {

        // El usuario no existe, proceder a insertar en perfiles_usuarios
        $stmt->close();

        $sql2 = "SELECT * FROM login WHERE username = ?";
        $stmt2 = $conexion->prepare($sql2);
        $stmt2->bind_param("s", $username);
        $stmt2->execute();

        if($stmt2->fetch()){
            echo json_encode(['error' => true, 'mensaje' => 'El usuario ya existe.']);
            exit();
        }

        $stmt2->close();

        // Insertar en perfiles_usuarios
        $sqlInsert = "INSERT INTO usuarios (nombre, apellidos, email) VALUES (?, ?, ?)";
        $stmtInsert = $conexion->prepare($sqlInsert);
        $stmtInsert->bind_param("sss", $nombre, $apellido, $email);

        $flag1 = $stmtInsert->execute();

        $ultimoIdInsertado = $conexion->insert_id;

        $sqlInsert2 = "INSERT INTO login (username, password) VALUES (?, ?)";
        $stmtInsert2 = $conexion->prepare($sqlInsert2);
        $stmtInsert2->bind_param("ss", $username, $hash);

        $flag2 = $stmtInsert2->execute();

        $ultimoIdInsertado2 = $conexion->insert_id;

        // Ejecutar la inserción
        if ($flag1 && $flag2) {

            $sqlInsert3 = "INSERT INTO relacion_usuarios_login (id_paciente, id_login) VALUES (?, ?)";
            $stmtInsert3 = $conexion->prepare($sqlInsert3);
            $stmtInsert3->bind_param("ii", $ultimoIdInsertado, $ultimoIdInsertado2);

            $flag3 = $stmtInsert3->execute();

            if ($flag3) {
                
                session_start();
                $_SESSION['usuario'] = $username;
                $_SESSION["nombre"] = $nombre;
                $_SESSION["email"] = $email;
                $_SESSION["tipo"] = "registro";
                $_SESSION["mensaje_bienvenida_mostrado"] = false;
                session_write_close();

                echo json_encode(['success' => true, 'mensaje' => 'Se ha creado tu perfil correctamente!', 'redirect' => 'home.php']);
                exit();

            } else {
                echo json_encode(['error' => true, 'mensaje' => 'No se han podido insertar los datos en login_usuarios!']);
                exit();
            }
        } else {
            echo json_encode(['error' => true, 'mensaje' => 'No se ha podido crear el usuario!']);
            exit();
        }

        $stmtInsert->close();
        $stmtInsert2->close();
        $stmtInsert3->close();
    }
} else {

    echo json_encode(['error' => true, 'mensaje' => 'No se han enviado los datos correctamente']);
    exit();
    
}
