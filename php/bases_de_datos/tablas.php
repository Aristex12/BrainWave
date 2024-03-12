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
        contenido LONGTEXT NOT NULL
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
        ('El Arte de la Guerra', 'Sun Tzu', 'https://www.casadellibro.com/libro-el-arte-de-la-guerra/9788494709203/7925837'),
        ('Cien Años de Soledad', 'Gabriel García Márquez', 'https://www.casadellibro.com/libro-cien-anos-de-soledad-edicion-aniversario/9788466373531/14452357'),
        ('1984', 'George Orwell', 'https://www.casadellibro.com/libro-1984/9788499890944/2034881'),
        ('El Principito', 'Antoine de Saint-Exupéry', 'https://www.casadellibro.com/libro-el-principito/9788478887194/795940'),
        ('Don Quijote de la Mancha', 'Miguel de Cervantes', 'https://www.casadellibro.com/libro-don-quijote-de-la-mancha-clasicos-adaptados/9788431673963/978896'),
        ('Pensar Rápido, Pensar Despacio', 'Daniel Kahneman', 'https://www.casadellibro.com/libro-pensar-rapido-pensar-despacio/9788483068618/1989599')";

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
('Cómo manejar el TDAH en niños', 'Ana López', 'El manejo del Trastorno por Déficit de Atención e Hiperactividad (TDAH) puede representar un desafío significativo para los padres, quienes desempeñan un papel crucial en la creación de un entorno propicio para el bienestar de sus hijos. En numerosas instancias, es fundamental adoptar un enfoque integral que involucre tanto a la familia como a los educadores, estableciendo así una red de apoyo sólida.
En este contexto, se aconseja encarecidamente la implementación de rutinas estructuradas en el día a día del niño con TDAH, ya que la previsibilidad y la consistencia pueden brindar un sentido de seguridad y estabilidad. Asimismo, la creación de un entorno de estudio tranquilo y libre de distracciones se revela como un elemento crucial para fomentar la concentración y el rendimiento académico.
No menos importante es la colaboración estrecha con profesionales de la salud mental, quienes poseen la experiencia necesaria para ofrecer estrategias adicionales y personalizadas que se ajusten a las necesidades específicas de cada niño afectado por el TDAH. Estas estrategias pueden incluir intervenciones conductuales, terapia cognitivo-conductual o incluso el uso adecuado de medicamentos, siempre bajo la supervisión y orientación de expertos.
Es crucial recordar que cada caso de TDAH es único, con sus propias características y desafíos particulares. Por lo tanto, la atención individualizada se convierte en un pilar fundamental en el proceso de manejo y tratamiento. En última instancia, el entendimiento y la empatía por parte de la familia, educadores y profesionales de la salud son clave para brindar el apoyo necesario y cultivar el desarrollo integral de cada niño afectado por este trastorno.'),

('Consejos para el rendimiento académico en jóvenes con TDAH', 'David García', 'Cuando nos enfrentamos al desafío de apoyar el rendimiento académico de jóvenes con Trastorno por Déficit de Atención e Hiperactividad (TDAH), es crucial adoptar un enfoque integral que trascienda las limitaciones para destacar las habilidades individuales de cada estudiante. En lugar de focalizarnos exclusivamente en las dificultades académicas asociadas al TDAH, es imperativo reconocer y capitalizar las fortalezas únicas que cada joven posee.
La personalización del entorno educativo emerge como una estrategia fundamental. Ajustar la dinámica de aprendizaje para adaptarse a las habilidades particulares de cada estudiante no solo facilita su participación, sino que también potencia su rendimiento. Al implementar técnicas de estudio específicas y proporcionar un apoyo individualizado, se abre un espacio para el desarrollo académico y personal, permitiendo que los jóvenes con TDAH exploren y maximicen su potencial.
La creación de un ambiente inclusivo se revela como un pilar esencial en este proceso. Al fomentar la comprensión y la aceptación en el entorno educativo, se generan condiciones propicias para que los estudiantes se sientan respaldados y motivados. La empatía y la sensibilidad por parte de docentes y compañeros contribuyen significativamente a cultivar un ambiente en el que la diversidad de habilidades sea celebrada.
La colaboración estrecha con los profesionales de la educación y los docentes se torna indispensable. Trabajar conjuntamente para desarrollar estrategias adaptativas y efectivas permite abordar las necesidades específicas de cada estudiante con TDAH. La comunicación abierta y la retroalimentación continua se convierten en herramientas valiosas para ajustar las metodologías y garantizar un enfoque educativo que se adapte dinámicamente a las cambiantes necesidades de los jóvenes afectados por el TDAH.
En conclusión, mejorar el rendimiento académico en jóvenes con TDAH va más allá de identificar las dificultades; implica reconocer y potenciar las fortalezas individuales, personalizar el entorno educativo, fomentar la inclusión y colaborar estrechamente con los profesionales de la educación. Con un enfoque holístico, podemos crear un camino educativo que no solo aborda los desafíos del TDAH, sino que también cultiva un ambiente en el que cada estudiante puede florecer y alcanzar su máximo potencial.
'),

('Impacto del TDAH en la vida diaria', 'Elena Sánchez', 'El Trastorno por Déficit de Atención e Hiperactividad (TDAH) ejerce su influencia en diversas esferas de la vida cotidiana, desplegando efectos que abarcan desde la organización personal hasta las complejidades de las relaciones interpersonales. En la búsqueda de un abordaje integral para superar estos desafíos, resulta imperativo desplegar estrategias diseñadas meticulosamente para fortalecer las habilidades fundamentales de autorregulación y gestión del tiempo.
La implementación de técnicas específicas que potencien la autorregulación no solo implica enfrentar las dificultades inmediatas asociadas al TDAH, sino también proporcionar a los individuos las herramientas necesarias para desenvolverse con éxito en distintos ámbitos de su vida diaria. La gestión del tiempo se erige como una competencia crucial, y la introducción de estrategias efectivas puede marcar la diferencia en la capacidad de los afectados para organizar y completar tareas de manera eficiente.
Adicionalmente, la terapia cognitivo-conductual se posiciona como un recurso valioso en este proceso. Dirigida no solo a mitigar los síntomas del TDAH, sino también a mejorar la autoestima y la toma de decisiones, esta forma de terapia contribuye a cultivar una mentalidad positiva y proactiva. Al trabajar en la percepción personal y en la gestión de las emociones, se crea un terreno fértil para el desarrollo integral de la persona afectada por el TDAH.
En el ámbito social, la promoción de la empatía y la comprensión emerge como un componente esencial para construir entornos más compasivos y solidarios. Al fomentar la sensibilización sobre las particularidades del TDAH, se establece un marco que propicia la aceptación y el apoyo mutuo. La educación y la creación de conciencia en la comunidad pueden desempeñar un papel clave en la eliminación de estigmas y en la construcción de relaciones más enriquecedoras.
En resumen, abordar los desafíos asociados al TDAH implica la implementación de estrategias que fortalezcan las habilidades de autorregulación y gestión del tiempo, la utilización de la terapia cognitivo-conductual para el crecimiento personal, y la promoción activa de la empatía y la comprensión en el ámbito social. A través de este enfoque holístico, podemos trabajar hacia la creación de entornos más inclusivos y brindar un apoyo significativo a aquellos afectados por el TDAH en su jornada diaria.'),

('Tratamientos actuales para el TDAH', 'Pedro González', 'En la abordaje del Trastorno por Déficit de Atención e Hiperactividad (TDAH), la amplia variedad de enfoques terapéuticos disponibles destaca la necesidad de una evaluación individualizada al considerar el tratamiento más adecuado. La elección de la estrategia terapéutica concreta puede depender de múltiples factores, entre los cuales se encuentran la gravedad de los síntomas y las preferencias específicas del individuo afectado.
Entre las opciones terapéuticas, las terapias psicológicas emergen como elementos esenciales en el abordaje del TDAH. La terapia conductual, enfocada en la modificación de comportamientos, y la terapia cognitivo-conductual, que se dirige tanto a patrones de pensamiento como a conductas, son abordajes fundamentales para el desarrollo de habilidades cruciales, tales como el afrontamiento y la autorregulación. Estas terapias no solo apuntan a mitigar los síntomas, sino que también buscan empoderar al individuo con herramientas efectivas para enfrentar los desafíos diarios asociados al TDAH.
Además, la inclusión de medicamentos en el plan de tratamiento es una opción valiosa. Tanto los estimulantes como los no estimulantes han demostrado eficacia en el control de los síntomas del TDAH. Estos medicamentos ofrecen un soporte farmacológico que complementa las intervenciones terapéuticas, contribuyendo a establecer un equilibrio integral en el manejo del trastorno.
La intervención temprana se destaca como un principio rector crucial en el tratamiento del TDAH. La identificación y abordaje de los síntomas desde etapas iniciales de la vida no solo posibilita un manejo más efectivo, sino que también establece bases sólidas para el desarrollo a largo plazo. En este sentido, la colaboración interdisciplinaria entre profesionales de la salud mental, educadores y otros expertos se erige como un elemento clave para una atención integral y coordinada.
En conclusión, el tratamiento del TDAH requiere un enfoque multifacético que tome en cuenta la singularidad de cada individuo. Desde terapias psicológicas hasta el uso de medicamentos, la elección de la estrategia terapéutica se basa en una evaluación cuidadosa de factores específicos. La intervención temprana y la colaboración interdisciplinaria proporcionan el cimiento esencial para un manejo efectivo del TDAH, garantizando una atención integral y adaptada a las necesidades individuales.'),

('Mitigando los desafíos sociales del TDAH', 'Silvia Fernández', 'Las personas que conviven con el Trastorno por Déficit de Atención e Hiperactividad (TDAH) a menudo se encuentran con desafíos sociales que influyen significativamente en su vida diaria y en las dinámicas de sus relaciones interpersonales. Para abordar estos desafíos y fortalecer las habilidades sociales, se sugiere encarecidamente participar en programas especializados de entrenamiento social y llevar a cabo prácticas estructuradas en situaciones sociales.
La participación activa en programas de entrenamiento social proporciona un espacio propicio para el desarrollo y la mejora de las habilidades sociales esenciales. Estos programas ofrecen un enfoque estructurado que permite a las personas con TDAH practicar y perfeccionar sus habilidades de interacción social, abordando de manera específica las áreas que puedan representar mayores desafíos.
La empatía y la comprensión son elementos clave en el proceso de apoyo a quienes enfrentan el TDAH. La disposición de amigos, familiares y compañeros para comprender las complejidades del trastorno y mostrar empatía contribuye significativamente a crear un entorno de apoyo vital. La paciencia y la adaptabilidad en las relaciones sociales son valiosas, ya que permiten a quienes tienen TDAH desenvolverse de manera más efectiva en diversas situaciones sociales.
Fomentar un entorno de apoyo más amplio y promover la aceptación son acciones fundamentales para contrarrestar el estigma asociado al TDAH. La educación y la concienciación en la comunidad desempeñan un papel esencial en la reducción de prejuicios y malentendidos. Al crear una atmósfera de aceptación, se facilita el fortalecimiento de las habilidades sociales y se propicia un mayor bienestar emocional y social para quienes viven con el TDAH.
En última instancia, mejorar la calidad de vida de las personas con TDAH implica un enfoque integral que aborde los desafíos sociales. A través de programas de entrenamiento social, la comprensión empática de aquellos en su entorno cercano, y la creación de un entorno de apoyo inclusivo, podemos contribuir de manera significativa a superar los obstáculos sociales asociados al TDAH y fomentar relaciones más enriquecedoras y satisfactorias.






');";




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
