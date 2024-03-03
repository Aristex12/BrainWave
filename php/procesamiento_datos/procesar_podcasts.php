<?php
// procesar_podcasts.php

require_once '../bases_de_datos/conecta.php';
require_once '../bases_de_datos/tablas.php';

// Obtén el término de búsqueda desde la solicitud AJAX
$busqueda = isset($_GET['buscador']) ? $_GET['buscador'] : '';

// Limpia y escapa la cadena de búsqueda para prevenir inyecciones SQL
$busqueda = mysqli_real_escape_string(obtenerConexion(), $busqueda);

// Realiza la consulta para obtener podcasts con imágenes que coincidan con la búsqueda
$query_podcasts_enlaces = "SELECT podcasts.*, imagenes.ruta AS imagen_ruta 
                        FROM podcasts 
                        JOIN relacion_podcast_imagen ON podcasts.id_podcast = relacion_podcast_imagen.id_podcast 
                        JOIN imagenes ON relacion_podcast_imagen.id_imagen = imagenes.id_imagen
                        WHERE podcasts.titulo LIKE '%$busqueda%' OR podcasts.autor LIKE '%$busqueda%'";

$result_podcasts_enlaces = mysqli_query(obtenerConexion(), $query_podcasts_enlaces);

// Almacena los resultados en un array asociativo
$podcasts_enlaces = mysqli_fetch_all($result_podcasts_enlaces, MYSQLI_ASSOC);

// Cierra la conexión
cerrarConexion(obtenerConexion());

// Construye el HTML para la sección de podcasts
foreach ($podcasts_enlaces as $podcast_enlace) {
    echo '<div class="podcast" style="background-image:url(' . $podcast_enlace['imagen_ruta'] . ')" data-link="' . $podcast_enlace['link'] . '">';
    echo "<div class='inner_podcast'>";
    echo "<div class='box'>";
    echo '<i class="fas fa-play fa-2x"></i>';
    echo '<h2>' . $podcast_enlace['titulo'] . '</h2>';
    echo '<p>' . $podcast_enlace['autor'] . '</p>';
    echo "</div>";
    echo '</div>';
    echo '</div>';
}
?>
