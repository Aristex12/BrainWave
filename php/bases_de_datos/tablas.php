<?php

require_once 'conecta.php';

$conexion = obtenerConexion();

$query = "SHOW DATABASES LIKE 'BrainWave'";
$res = mysqli_query($conexion, $query);

if (mysqli_num_rows($res) <= 0) {

    $query = "CREATE DATABASE BrainWave";
    mysqli_query($conexion, $query);
    cerrarConexion($conexion);

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
        apellidos VARCHAR(255),
        descripcion VARCHAR(255)
            -- Otros campos relevantes para la información del psicólogo
        )";

    $psicologos_pacientes = "CREATE TABLE relacion_psicologos_usuarios (
        id_relacion INT AUTO_INCREMENT PRIMARY KEY,
        id_psicologo INT,
        id_paciente INT,
        FOREIGN KEY (id_psicologo) REFERENCES psicologos(id_psicologo),
        FOREIGN KEY (id_paciente) REFERENCES usuarios(id_paciente)
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

    $contacto = "CREATE TABLE contacto (
        id_contacto INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255),
        email VARCHAR(255),
        telefono VARCHAR(20),
        mensaje VARCHAR(255)
        )";

    $imagenes = "CREATE TABLE imagenes (
    id_imagen INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    ruta VARCHAR(255)
    )";

    $libros = "CREATE TABLE libros (
        id_libro INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(255),
        autor VARCHAR(255),
        link VARCHAR(255)
    )";

    $podcasts = "CREATE TABLE podcasts (
        id_podcast INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(255),
        autor VARCHAR(255),
        link VARCHAR(255)
    )";

    $relacion_libro_imagen = "CREATE TABLE relacion_libro_imagen (
        id_relacion INT AUTO_INCREMENT PRIMARY KEY,
        id_libro INT,
        id_imagen INT,
        FOREIGN KEY (id_libro) REFERENCES libros(id_libro),
        FOREIGN KEY (id_imagen) REFERENCES imagenes(id_imagen)
    )";

    $relacion_podcast_imagen = "CREATE TABLE relacion_podcast_imagen (
        id_relacion INT AUTO_INCREMENT PRIMARY KEY,
        id_podcast INT,
        id_imagen INT,
        FOREIGN KEY (id_podcast) REFERENCES podcasts(id_podcast),
        FOREIGN KEY (id_imagen) REFERENCES imagenes(id_imagen)
    )";

    $relacion_usuario_imagen = "CREATE TABLE relacion_usuario_imagen (
        id_relacion INT AUTO_INCREMENT PRIMARY KEY,
        id_usuario INT,
        id_imagen INT,
        FOREIGN KEY (id_usuario) REFERENCES usuarios(id_paciente),
        FOREIGN KEY (id_imagen) REFERENCES imagenes(id_imagen)
    )";

    // Ejecutar las consultas de creación de tablas
    mysqli_query($conexion, $perfiles_personas);
    mysqli_query($conexion, $login);
    mysqli_query($conexion, $pacientes_login);
    mysqli_query($conexion, $datos_psicologos);
    mysqli_query($conexion, $psicologos_pacientes);
    mysqli_query($conexion, $eventos_talleres);
    mysqli_query($conexion, $eventos_pacientes);
    mysqli_query($conexion, $contacto);
    mysqli_query($conexion, $imagenes);
    mysqli_query($conexion, $libros);
    mysqli_query($conexion, $podcasts);
    mysqli_query($conexion, $relacion_libro_imagen);
    mysqli_query($conexion, $relacion_podcast_imagen);
    mysqli_query($conexion, $relacion_usuario_imagen);



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

    $insert_contacto = "INSERT INTO contacto (nombre, email, telefono, mensaje) VALUES
        ('Ana Rodríguez', 'ana.rodriguez@gmail.com', '123456789', 'Consulta sobre productos'),
        ('David López', 'david.lopez@yahoo.com', '987654321', 'Solicitud de información'),
        ('Marta González', 'marta.gonzalez@hotmail.com', '5544332211', 'Comentarios generales'),
        ('Pedro Ramírez', 'pedro.ramirez@gmail.com', '1122334455', 'Pedido pendiente'),
        ('Laura García', 'laura.garcia@yahoo.com', '6677889900', 'Mensaje de prueba');";

    $insert_libros = "INSERT INTO libros (titulo, autor, link) VALUES
        ('El Arte de la Guerra', 'Sun Tzu', 'https://www.amazon.es/Arte-guerra-Sun-Tzu/dp/198768973X/'),
        ('Cien Años de Soledad', 'Gabriel García Márquez', 'https://www.amazon.es/Cien-a%C3%B1os-soledad-Gabriel-M%C3%A1rquez/dp/8420471838/'),
        ('1984', 'George Orwell', 'https://www.amazon.es/1984-Edici%C3%B3n-Especial-Coleccionista-1984/dp/8423346814/'),
        ('El Principito', 'Antoine de Saint-Exupéry', 'https://www.amazon.es/Principito-Cl%C3%A1sicos-juveniles-Antoine-Saint-Exup%C3%A9ry/dp/8426124243/'),
        ('Don Quijote de la Mancha', 'Miguel de Cervantes', 'https://www.amazon.es/Quijote-Mancha-Miguel-Cervantes-Saavedra/dp/1548444514/'),
        ('Pensar Rápido, Pensar Despacio', 'Daniel Kahneman', 'https://www.amazon.es/Pensar-r%C3%A1pido-despacio-Bolsillo-No-Ficci%C3%B3n/dp/8425219563/')";

    $insert_podcasts = "INSERT INTO podcasts (titulo, autor, link) VALUES
        ('The Joe Rogan Experience', 'Joe Rogan', 'https://youtu.be/HuF7OPG61Ww?si=MfaxchW8ypLwyvCF'),
        ('Serial', 'Sarah Koenig', 'https://youtu.be/HuF7OPG61Ww?si=uxwjJI7dxTsKEhWh'),
        ('The Daily', 'The New York Times', 'https://youtu.be/P1x13ntninc?si=B5XU3pHUgY5EMVBi'),
        ('How I Built This', 'Guy Raz', 'https://youtu.be/lZDXprVT8bY?si=A6exh2ZyQT7frtwo'),
        ('TED Talks Daily', 'TED', 'https://youtu.be/n5SaHkzv468?si=fizLzWA6BLbCWJXN'),
        ('Science Vs', 'Wondery', 'https://youtu.be/QIo-ESOav8Y?si=v2Fz70jlDH_YLkno')";

    // Inserts para relacion_libro_imagen
    $insert_relacion_libro_imagen = "INSERT INTO relacion_libro_imagen (id_libro, id_imagen) VALUES
        (1, 1),
        (2, 2),
        (3, 3),
        (4, 4),
        (5, 5),
        (6, 6);";

    // Inserts para relacion_podcast_imagen
    $insert_relacion_podcast_imagen = "INSERT INTO relacion_podcast_imagen (id_podcast, id_imagen) VALUES
        (7, 7),
        (8, 8),
        (9, 9),
        (10, 10),
        (11, 11),
        (12, 12);";




    $ruta_directorio = '../../img_web';

    // Comprobar si el directorio existe
    if (is_dir($ruta_directorio)) {

        // Abrir el directorio
        if ($dh = opendir($ruta_directorio)) {

            // Preparar la sentencia SQL con bind_param
            $insert_query = "INSERT INTO imagenes (nombre, ruta) VALUES (?, ?)";
            $stmt = mysqli_prepare($conexion, $insert_query);

            // Vincular parámetros
            mysqli_stmt_bind_param($stmt, 'ss', $nombre_imagen, $ruta_imagen);

            // Recorrer el directorio
            while (($archivo = readdir($dh)) !== false) {

                // Excluir los directorios "." y ".."
                if ($archivo != "." && $archivo != "..") {

                    // Obtener la ruta completa del archivo
                    $ruta_imagen = $ruta_directorio . '/' . $archivo;

                    // Obtener el nombre del archivo sin extensión
                    $nombre_imagen = pathinfo($archivo, PATHINFO_FILENAME);

                    // Ejecutar la sentencia preparada
                    mysqli_stmt_execute($stmt);
                }
            }

            // Cerrar el directorio
            closedir($dh);

            // Cerrar la sentencia preparada
            mysqli_stmt_close($stmt);
        }
    }


    mysqli_query($conexion, $insert_perfiles_personas);
    mysqli_query($conexion, $insert_login);
    mysqli_query($conexion, $insert_pacientes_login);
    mysqli_query($conexion, $insert_datos_psicologos);
    mysqli_query($conexion, $insert_psicologos_pacientes);
    mysqli_query($conexion, $insert_eventos_talleres);
    mysqli_query($conexion, $insert_eventos_pacientes);
    mysqli_query($conexion, $insert_contacto);
    mysqli_query($conexion, $insert_libros);
    mysqli_query($conexion, $insert_podcasts);
    mysqli_query($conexion, $insert_relacion_libro_imagen);
    mysqli_query($conexion, $insert_relacion_podcast_imagen);
    
}


// Cerrar la conexión
cerrarConexion($conexion);
