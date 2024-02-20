<?php
require_once 'conecta.php';

$query = "SHOW DATABASES LIKE 'BrainWave'";
$res = mysqli_query(getConexion(), $query);

if (mysqli_num_rows($res) <= 0) {
    $sqlCreateDB = "CREATE DATABASE BrainWave";
    $res2 = mysqli_query(getConexion(), $sqlCreateDB);

    if ($res2) {
        // Definiciones de tablas
        $perfiles_personas = "CREATE TABLE perfiles_personas (
                id_paciente INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(100),
                nombre VARCHAR(255),
                apellidos VARCHAR(255),
                email VARCHAR(255)
            )";

        $login = "CREATE TABLE login (
                id_login INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255),
                password VARCHAR(255)
            )";

        $pacientes_login = "CREATE TABLE pacientes_login (
                id_relacion INT AUTO_INCREMENT PRIMARY KEY,
                id_paciente INT,
                id_login INT,
                FOREIGN KEY (id_paciente) REFERENCES perfiles_personas(id_paciente),
                FOREIGN KEY (id_login) REFERENCES login(id_login)
            )";

        $datos_psicologos = "CREATE TABLE datos_psicologos (
                id_psicologo INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(255),
                apellidos VARCHAR(255)
                -- Otros campos relevantes para la información del psicólogo
            )";

        $psicologos_pacientes = "CREATE TABLE psicologos_pacientes (
                id_relacion INT AUTO_INCREMENT PRIMARY KEY,
                id_psicologo INT,
                id_paciente INT,
                FOREIGN KEY (id_psicologo) REFERENCES datos_psicologos(id_psicologo),
                FOREIGN KEY (id_paciente) REFERENCES perfiles_personas(id_paciente)
            )";

        $administradores = "CREATE TABLE administradores (
                id_admin INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(255),
                apellidos VARCHAR(255)
                -- Otros campos relevantes para la información del administrador
            )";

        $eventos_talleres = "CREATE TABLE eventos_talleres (
                id_evento INT AUTO_INCREMENT PRIMARY KEY,
                nombre_evento VARCHAR(255),
                fecha DATE
                -- Otros campos relevantes para la información del evento
            )";

        $eventos_pacientes = "CREATE TABLE eventos_pacientes (
                id_relacion INT AUTO_INCREMENT PRIMARY KEY,
                id_evento INT,
                id_paciente INT,
                FOREIGN KEY (id_evento) REFERENCES eventos_talleres(id_evento),
                FOREIGN KEY (id_paciente) REFERENCES perfiles_personas(id_paciente)
            )";

        // Ejecutar las consultas de creación de tablas
        mysqli_query(getConexion(), $perfiles_personas);
        mysqli_query(getConexion(), $login);
        mysqli_query(getConexion(), $pacientes_login);
        mysqli_query(getConexion(), $datos_psicologos);
        mysqli_query(getConexion(), $psicologos_pacientes);
        mysqli_query(getConexion(), $administradores);
        mysqli_query(getConexion(), $eventos_talleres);
        mysqli_query(getConexion(), $eventos_pacientes);

        if($perfiles_personas && $login && $pacientes_login && $datos_psicologos && $psicologos_pacientes && $administradores && $eventos_talleres && $eventos_pacientes){

            $insert_perfiles_personas = "INSERT INTO perfiles_personas (username, nombre, apellidos, email) VALUES
            ('username1', 'Juan', 'Pérez', 'juan.perez@gmail.com'),
            ('username2', 'María', 'Gómez', 'maria.gomez@yahoo.com'),
            ('username3', 'Carlos', 'Martínez', 'carlos.martinez@hotmail.com'),
            ('username4', 'Laura', 'Rodríguez', 'laura.rodriguez@hotmail.com'),
            ('username5', 'Paula', 'Moure', 'paula.moure@gmail.com');";

            $insert_login = "INSERT INTO login (username, password) VALUES
            ('usuario1', 'password1'),
            ('usuario2', 'password2'),
            ('usuario3', 'password3'),
            ('usuario4', 'password4'),
            ('usuario5', 'password5');";

            $insert_pacientes_login = "INSERT INTO pacientes_login (id_paciente, id_login) VALUES
            (1, 1),
            (2, 2),
            (3, 3),
            (4, 4),
            (5, 5);";

            $insert_datos_psicologos = "INSERT INTO datos_psicologos (nombre, apellidos) VALUES
            ('Ana', 'López'),
            ('Pedro', 'García'),
            ('Sofía', 'Martínez'),
            ('David', 'Hernández'),
            ('Aris', 'Kuhs');";

            $insert_psicologos_pacientes = "INSERT INTO psicologos_pacientes (id_psicologo, id_paciente) VALUES
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

            $insert_eventos_talleres = "INSERT INTO eventos_talleres (nombre_evento, fecha) VALUES
            ('Taller A', '2024-02-01'),
            ('Conferencia B', '2024-03-15'),
            ('Sesión de Grupo C', '2024-04-20'),
            ('Evento D', '2024-05-10'),
            ('Videocall', '2024-07-15');";

            $insert_eventos_pacientes = "INSERT INTO eventos_pacientes (id_evento, id_paciente) VALUES
            (1, 1),
            (2, 2),
            (3, 3),
            (4, 4),
            (5, 5);";

            mysqli_query(getConexion(), $insert_perfiles_personas);
            mysqli_query(getConexion(), $insert_login);
            mysqli_query(getConexion(), $insert_pacientes_login);
            mysqli_query(getConexion(), $insert_datos_psicologos);
            mysqli_query(getConexion(), $insert_psicologos_pacientes);
            mysqli_query(getConexion(), $insert_administradores);
            mysqli_query(getConexion(), $insert_eventos_talleres);
            mysqli_query(getConexion(), $insert_eventos_pacientes);
        }

        // Cerrar la conexión
        getConexion()->close();
    } else {
        echo "Error al crear la base de datos: " . mysqli_error(getConexion());
    }
}
?>
