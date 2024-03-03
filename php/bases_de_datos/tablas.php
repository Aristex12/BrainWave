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
        descripcion VARCHAR(255),
        especialista VARCHAR(500),
        formacion VARCHAR(500)
        )";

    $psicologos_pacientes = "CREATE TABLE relacion_psicologos_usuarios (
        id_relacion INT AUTO_INCREMENT PRIMARY KEY,
        id_psicologo INT,
        id_paciente INT,
        fecha DATE NOT NULL,
        hora TIME NOT NULL,
        FOREIGN KEY (id_psicologo) REFERENCES psicologos(id_psicologo),
        FOREIGN KEY (id_paciente) REFERENCES usuarios(id_paciente)
        )";

    $eventos_talleres = "CREATE TABLE workshops (
        id_evento INT AUTO_INCREMENT PRIMARY KEY,
        nombre_evento VARCHAR(255) NOT NULL,
        fecha DATE NOT NULL,
        hora TIME NOT NULL,
        lugar_nombre VARCHAR(255) NOT NULL,
        lugar_direccion VARCHAR(500) NOT NULL,
        descripcion TEXT NOT NULL
    );";

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

    $relacion_psicologo_imagen = "CREATE TABLE relacion_psicologo_imagen (
        id_relacion INT AUTO_INCREMENT PRIMARY KEY,
        id_psicologo INT,
        id_imagen INT,
        FOREIGN KEY (id_psicologo) REFERENCES psicologos(id_psicologo),
        FOREIGN KEY (id_imagen) REFERENCES imagenes(id_imagen)
    )";

    $articulos = "CREATE TABLE articulos (
        id_articulo INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(255) NOT NULL,
        autor VARCHAR(255) NOT NULL,
        contenido TEXT NOT NULL
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
    mysqli_query($conexion, $articulos);
    mysqli_query($conexion, $relacion_libro_imagen);
    mysqli_query($conexion, $relacion_podcast_imagen);
    mysqli_query($conexion, $relacion_usuario_imagen);
    mysqli_query($conexion, $relacion_psicologo_imagen);


    $insert_perfiles_personas = "INSERT INTO usuarios (nombre, apellidos, email) VALUES
        ('Juan', 'Pérez', 'juan.perez@gmail.com'),
        ('María', 'Gómez', 'maria.gomez@yahoo.com'),
        ('Carlos', 'Martínez', 'carlos.martinez@hotmail.com'),
        ('Laura', 'Rodríguez', 'laura.rodriguez@hotmail.com'),
        ('Paula', 'Moure', 'paula.moure@gmail.com');";

    $insert_login = "INSERT INTO login (username, password) VALUES
        ('usuario1', '" . password_hash('password1', PASSWORD_DEFAULT) . "'),
        ('usuario2', '" . password_hash('password2', PASSWORD_DEFAULT) . "'),
        ('usuario3', '" . password_hash('password3', PASSWORD_DEFAULT) . "'),
        ('usuario4', '" . password_hash('password4', PASSWORD_DEFAULT) . "'),
        ('usuario5', '" . password_hash('password5', PASSWORD_DEFAULT) . "')";

    $insert_pacientes_login = "INSERT INTO relacion_usuarios_login (id_paciente, id_login) VALUES
        (1, 1),
        (2, 2),
        (3, 3),
        (4, 4),
        (5, 5);";

    $insert_psicologos = "INSERT INTO psicologos (nombre, descripcion, especialista, formacion) VALUES
        ('Ana Rodríguez', 'Terapeuta con diez años de dedicación a la psicología. Me complace ser tu guía en este viaje hacia el equilibrio emocional. Mi estilo cercano y comprensivo te brindará el respaldo necesario en este camino.', 'Trastornos en Niños y Adolescentes, Depresión, Trastorno de Ansiedad', 'Psicología en la Universidad Nacional Autónoma de México (2010), Máster de Psicología en TDAH (2015), Psicoterapeuta y especialista en Medicina Familiar'),
        ('Marta González', 'Terapeuta con una década de dedicación a la psicología. Estoy encantada de acompañarte en este recorrido hacia el equilibrio emocional. Mi estilo cercano y comprensivo te proporcionará el respaldo necesario en este camino.', 'Trastornos en Niños y Adolescentes, Depresión, Trastorno de Ansiedad', 'Psicología en la Universidad Complutense de Madrid (2010), Máster de Psicología en TDAH (2015), Psicoterapeuta y especialista en Medicina Familiar'),
        ('David Pérez', 'Terapeuta con diez años de dedicación a la psicología. Es un placer para mí ser tu guía en este viaje hacia el equilibrio emocional. Mi estilo cercano y comprensivo te brindará el respaldo necesario en este camino.', 'Trastornos en Niños y Adolescentes, Depresión, Trastorno de Ansiedad', 'Psicología en la Universidad de Barcelona (2010), Máster de Psicología en TDAH (2015), Psicoterapeuta y especialista en Medicina Familiar'),
        ('Patricia López', 'Terapeuta con una década de dedicación a la psicología. Estoy encantada de acompañarte en este recorrido hacia el equilibrio emocional. Mi estilo cercano y comprensivo te proporcionará el respaldo necesario en este camino.', 'Trastornos en Niños y Adolescentes, Depresión, Trastorno de Ansiedad', 'Psicología en la Universidad Complutense de Madrid (2010), Máster de Psicología en TDAH (2015), Psicoterapeuta y especialista en Medicina Familiar'),
        ('Carlos Rodríguez', 'Terapeuta con diez años de dedicación a la psicología. Es un placer para mí ser tu guía en este viaje hacia el equilibrio emocional. Mi estilo cercano y comprensivo te brindará el respaldo necesario en este camino.', 'Trastornos en Niños y Adolescentes, Depresión, Trastorno de Ansiedad', 'Psicología en la Universidad Nacional Autónoma de México (2010), Máster de Psicología en TDAH (2015), Psicoterapeuta y especialista en Medicina Familiar'),
        ('Laura Martínez', 'Terapeuta con una década de dedicación a la psicología. Estoy encantada de acompañarte en este recorrido hacia el equilibrio emocional. Mi estilo cercano y comprensivo te proporcionará el respaldo necesario en este camino.', 'Trastornos en Niños y Adolescentes, Depresión, Trastorno de Ansiedad', 'Psicología en la Universidad Complutense de Madrid (2010), Máster de Psicología en TDAH (2015), Psicoterapeuta y especialista en Medicina Familiar')";

    $insert_psicologos_pacientes = "INSERT INTO relacion_psicologos_usuarios (id_psicologo, id_paciente, fecha, hora) VALUES
    (3, 4, '2024-03-12', '12:00:00'),
    (4, 2, '2024-03-13', '10:15:00'),
    (5, 1, '2024-03-14', '15:30:00'),
    (1, 5, '2024-03-15', '09:45:00'),
    (2, 3, '2024-03-16', '18:00:00');";

    $insert_eventos_talleres = "INSERT INTO workshops (nombre_evento, fecha, hora, lugar_nombre, lugar_direccion, descripcion) VALUES
        ('Desafiando Límites: Un Encuentro sobre el TDAH', '2024-05-15', '09:00:00', 'Plaza de Margaritas', '123 Calle Principal', 'Bienvenido a Desafiando Límites! Únete a nosotros para explorar estrategias prácticas, compartir experiencias y descubrir nuevas formas de apoyar a quienes viven con Trastorno por Déficit de Atención e Hiperactividad (TDAH). Este evento contará con sesiones educativas a cargo de expertos, talleres interactivos, una red de apoyo para establecer conexiones significativas, y recursos útiles para la comunidad.'),
        ('Explorando Estrategias para el TDAH en Niños', '2024-06-10', '14:30:00', 'Ayuntamiento de Madrid', '456 Avenida Secundaria', 'Descubre técnicas efectivas para ayudar a niños con TDAH a alcanzar su máximo potencial. Este taller incluirá sesiones educativas adaptadas para padres y educadores, así como talleres interactivos diseñados específicamente para niños, fomentando habilidades de afrontamiento y autoestima.'),
        ('Círculo de Apoyo para Familias con TDAH', '2024-07-20', '18:00:00', 'IFEMA', '789 Camino Residencial', 'Únete a nuestro círculo de apoyo dedicado a familias afectadas por el TDAH. Comparte experiencias, obtén apoyo emocional y encuentra estrategias efectivas para enfrentar los desafíos cotidianos. Aunque no habrá talleres interactivos, se facilitará la conexión y el intercambio de recursos valiosos.'),
        ('Estrategias de Autogestión para Adultos con TDAH', '2024-08-15', '10:45:00', 'PLaza de Sol', '101 Plaza del Sol', 'Aprende técnicas prácticas para la gestión del tiempo, la organización y la concentración. Este taller se centra en proporcionar estrategias efectivas para adultos con TDAH, fomentando la independencia y el empoderamiento en diversas áreas de la vida.'),
        ('Recursos Locales para Personas con TDAH', '2024-09-05', '16:00:00', 'Ayuntamiento de Zamora', '222 Paseo del Parque', 'Explora servicios y organizaciones locales que ofrecen apoyo y recursos para personas con TDAH. Aunque no habrá sesiones educativas ni talleres interactivos en este evento, proporcionará información valiosa sobre las opciones disponibles en la comunidad para aquellos que buscan apoyo y orientación.');";



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
        ('The Joe Rogan Experience', 'Joe Rogan', 'https://www.youtube.com/embed/HuF7OPG61Ww?si=Go78xLHjVWCD7JJ5'),
        ('Serial', 'Sarah Koenig', 'https://www.youtube.com/embed/P1x13ntninc?si=RdFTwWrwCVUAhgUG'),
        ('The Daily', 'The New York Times', 'https://www.youtube.com/embed/9uNDojHF804?si=YcpK4L7ZjnIPTj41'),
        ('How I Built This', 'Guy Raz', 'https://www.youtube.com/embed/TjqrualxgkI?si=4Jk95PYUbgdKo_4P'),
        ('TED Talks Daily', 'TED', 'https://www.youtube.com/embed/n5SaHkzv468?si=E9k1QKxkKhY1xuhG'),
        ('Science Vs', 'Wondery', 'https://www.youtube.com/embed/QIo-ESOav8Y?si=vMoeeETEo71CJV07')";

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
        (1, 7),
        (2, 8),
        (3, 9),
        (4, 10),
        (5, 11),
        (6, 12);";

    $insert_relacion_psicologos_imagen = "INSERT INTO relacion_psicologo_imagen(id_psicologo, id_imagen) VALUES
        (1, 13),
        (2, 14),
        (3, 15),
        (4, 16),
        (5, 17),
        (6, 18);";

    $insert_articulos = "INSERT INTO articulos (titulo, autor, contenido) VALUES
('Cómo manejar el TDAH en niños', 'Ana López', 'El Trastorno por Déficit de Atención e Hiperactividad (TDAH) puede ser desafiante para los padres. En muchos casos, es importante adoptar un enfoque comprensivo que involucre tanto a la familia como a los educadores. Se recomienda establecer rutinas estructuradas y proporcionar un entorno de estudio tranquilo. Además, trabajar en colaboración con profesionales de la salud mental puede ofrecer estrategias adicionales para abordar las necesidades específicas de cada niño con TDAH. Recordemos que cada caso es único y requiere una atención individualizada.'),

('Consejos para el rendimiento académico en jóvenes con TDAH', 'David García', 'Los estudiantes con TDAH pueden enfrentar dificultades académicas que afectan su rendimiento escolar. En lugar de centrarse únicamente en las limitaciones, es fundamental identificar las fortalezas de cada estudiante y adaptar el entorno educativo para aprovechar esas habilidades. Implementar técnicas de estudio específicas, proporcionar apoyo individualizado y fomentar un ambiente inclusivo pueden marcar la diferencia. Es esencial trabajar en colaboración con los docentes y los profesionales de la educación para desarrollar estrategias efectivas.'),

('Impacto del TDAH en la vida diaria', 'Elena Sánchez', 'El TDAH puede afectar diversas áreas de la vida diaria, desde la organización personal hasta las relaciones interpersonales. Para abordar estos desafíos, es crucial implementar estrategias que fortalezcan las habilidades de autorregulación y gestión del tiempo. Además, la terapia cognitivo-conductual puede ser beneficiosa para mejorar la autoestima y la toma de decisiones. En el ámbito social, fomentar la empatía y la comprensión puede contribuir a la creación de entornos más compasivos y solidarios.'),

('Tratamientos actuales para el TDAH', 'Pedro González', 'Existen diferentes enfoques para tratar el TDAH, y la elección del tratamiento puede depender de diversos factores, como la gravedad de los síntomas y las preferencias del individuo. Las opciones incluyen terapias psicológicas, como la terapia conductual y la terapia cognitivo-conductual, que se centran en desarrollar habilidades de afrontamiento y autorregulación. Además, algunos pacientes pueden beneficiarse de medicamentos, como los estimulantes y no estimulantes, que ayudan a controlar los síntomas. La intervención temprana y la colaboración interdisciplinaria son clave en el manejo efectivo del TDAH.'),

('Mitigando los desafíos sociales del TDAH', 'Silvia Fernández', 'Las personas con TDAH a menudo enfrentan desafíos sociales que pueden afectar su vida cotidiana y sus relaciones. Para mejorar las habilidades sociales, es recomendable participar en programas de entrenamiento social y practicar situaciones sociales de manera estructurada. La empatía y la comprensión por parte de amigos, familiares y compañeros son fundamentales. Fomentar un entorno de apoyo y promover la aceptación puede ayudar a reducir el estigma asociado al TDAH y mejorar la calidad de vida de quienes lo experimentan.');";




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
    mysqli_query($conexion, $insert_psicologos);
    mysqli_query($conexion, $insert_psicologos_pacientes);
    mysqli_query($conexion, $insert_eventos_talleres);
    mysqli_query($conexion, $insert_eventos_pacientes);
    mysqli_query($conexion, $insert_contacto);
    mysqli_query($conexion, $insert_libros);
    mysqli_query($conexion, $insert_podcasts);
    mysqli_query($conexion, $insert_articulos);
    mysqli_query($conexion, $insert_relacion_libro_imagen);
    mysqli_query($conexion, $insert_relacion_podcast_imagen);
    mysqli_query($conexion, $insert_relacion_psicologos_imagen);
}


// Cerrar la conexión
cerrarConexion($conexion);
