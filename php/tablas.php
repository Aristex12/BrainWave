<?php

    require_once 'conecta.php';

    $conexion = obtenerConexion();

    $perfiles_personas = "CREATE TABLE usuarios (
        id_paciente INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255),
        apellidos VARCHAR(255),
        email VARCHAR(255)
    )";

    $login = "CREATE TABLE login (
        id_login INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255),
        password VARCHAR(255)
    )";

    $pacientes_login = "CREATE TABLE relacion_usuarios_login (
        id_relacion INT AUTO_INCREMENT PRIMARY KEY,
        id_paciente INT,
        id_login INT,
        FOREIGN KEY (id_paciente) REFERENCES usuarios(id_paciente),
        FOREIGN KEY (id_login) REFERENCES login(id_login)
    )";

    $datos_psicologos = "CREATE TABLE psicologos (
        id_psicologo INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255),
        apellidos VARCHAR(255)
        -- Otros campos relevantes para la información del psicólogo
    )";

    $psicologos_pacientes = "CREATE TABLE relacion_psicologos_usuarios (
        id_relacion INT AUTO_INCREMENT PRIMARY KEY,
        id_psicologo INT,
        id_paciente INT,
        FOREIGN KEY (id_psicologo) REFERENCES psicologos(id_psicologo),
        FOREIGN KEY (id_paciente) REFERENCES usuarios(id_paciente)
    )";

    $administradores = "CREATE TABLE administradores (
        id_admin INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255),
        apellidos VARCHAR(255)
        -- Otros campos relevantes para la información del administrador
    )";

    $eventos_talleres = "CREATE TABLE workshops (
        id_evento INT AUTO_INCREMENT PRIMARY KEY,
        nombre_evento VARCHAR(255),
        fecha DATE
        -- Otros campos relevantes para la información del evento
    )";

    $eventos_pacientes = "CREATE TABLE relacion_workshops_usuarios (
        id_relacion INT AUTO_INCREMENT PRIMARY KEY,
        id_evento INT,
        id_paciente INT,
        FOREIGN KEY (id_evento) REFERENCES workshops(id_evento),
        FOREIGN KEY (id_paciente) REFERENCES usuarios(id_paciente)
    )";

    // Ejecutar las consultas de creación de tablas
    mysqli_query($conexion, $perfiles_personas);
    mysqli_query($conexion, $login);
    mysqli_query($conexion, $pacientes_login);
    mysqli_query($conexion, $datos_psicologos);
    mysqli_query($conexion, $psicologos_pacientes);
    mysqli_query($conexion, $administradores);
    mysqli_query($conexion, $eventos_talleres);
    mysqli_query($conexion, $eventos_pacientes);

if ($perfiles_personas && $login && $pacientes_login && $datos_psicologos && $psicologos_pacientes && $administradores && $eventos_talleres && $eventos_pacientes) {

    $insert_perfiles_personas = "INSERT INTO usuarios (nombre, apellidos, email) VALUES
        ('Juan', 'Pérez', 'juan.perez@gmail.com'),
        ('María', 'Gómez', 'maria.gomez@yahoo.com'),
        ('Carlos', 'Martínez', 'carlos.martinez@hotmail.com'),
        ('Laura', 'Rodríguez', 'laura.rodriguez@hotmail.com'),
        ('Paula', 'Moure', 'paula.moure@gmail.com');";

    $insert_login = "INSERT INTO login (username, password) VALUES
            ('usuario1', 'password1'),
            ('usuario2', 'password2'),
            ('usuario3', 'password3'),
            ('usuario4', 'password4'),
            ('usuario5', 'password5');";

    $insert_pacientes_login = "INSERT INTO relacion_usuarios_login (id_paciente, id_login) VALUES
            (1, 1),
            (2, 2),
            (3, 3),
            (4, 4),
            (5, 5);";

    $insert_datos_psicologos = "INSERT INTO psicologos (nombre, apellidos) VALUES
            ('Ana', 'López'),
            ('Pedro', 'García'),
            ('Sofía', 'Martínez'),
            ('David', 'Hernández'),
            ('Aris', 'Kuhs');";

    $insert_psicologos_pacientes = "INSERT INTO relacion_psicologos_usuarios (id_psicologo, id_paciente) VALUES
            (1, 1),
            (2, 2),
            (3, 3),
            (4, 4),
            (5, 5);";

    $insert_administradores = "INSERT INTO administradores (nombre, apellidos) VALUES
            ('Admin1', 'Apellido1'),
            ('Admin2', 'Apellido2'),
            ('Admin3', 'Apellido3'),
            ('Admin4', 'Apellido4'),
            ('Admin5', 'Apellido5');";

    $insert_eventos_talleres = "INSERT INTO workshops (nombre_evento, fecha) VALUES
            ('Taller A', '2024-02-01'),
            ('Conferencia B', '2024-03-15'),
            ('Sesión de Grupo C', '2024-04-20'),
            ('Evento D', '2024-05-10'),
            ('Videocall', '2024-07-15');";

    $insert_eventos_pacientes = "INSERT INTO relacion_workshops_usuarios (id_evento, id_paciente) VALUES
            (1, 1),
            (2, 2),
            (3, 3),
            (4, 4),
            (5, 5);";

    mysqli_query($conexion, $insert_perfiles_personas);
    mysqli_query($conexion, $insert_login);
    mysqli_query($conexion, $insert_pacientes_login);
    mysqli_query($conexion, $insert_datos_psicologos);
    mysqli_query($conexion, $insert_psicologos_pacientes);
    mysqli_query($conexion, $insert_administradores);
    mysqli_query($conexion, $insert_eventos_talleres);
    mysqli_query($conexion, $insert_eventos_pacientes);
}

// Cerrar la conexión
cerrarConexion($conexion);
