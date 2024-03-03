<?php
// procesar_libros.php

require_once '../bases_de_datos/conecta.php';
require_once '../bases_de_datos/tablas.php';

// Obtén el término de búsqueda desde la solicitud AJAX
$busqueda = isset($_GET['buscador']) ? $_GET['buscador'] : '';

// Limpia y escapa la cadena de búsqueda para prevenir inyecciones SQL
$busqueda = mysqli_real_escape_string(obtenerConexion(), $busqueda);

// Realiza la consulta para obtener libros con imágenes que coincidan con la búsqueda
$query_libros_imagenes = "SELECT libros.*, imagenes.ruta AS imagen_ruta 
                            FROM libros 
                            JOIN relacion_libro_imagen ON libros.id_libro = relacion_libro_imagen.id_libro 
                            JOIN imagenes ON relacion_libro_imagen.id_imagen = imagenes.id_imagen
                            WHERE libros.titulo LIKE '%$busqueda%' OR libros.autor LIKE '%$busqueda%'";

$result_libros_imagenes = mysqli_query(obtenerConexion(), $query_libros_imagenes);

// Almacena los resultados en un array asociativo
$libros_imagenes = mysqli_fetch_all($result_libros_imagenes, MYSQLI_ASSOC);

// Cierra la conexión
cerrarConexion(obtenerConexion());

// Construye el HTML para la sección de libros
foreach ($libros_imagenes as $libro_imagen) {
    echo '<div class="libro">';
    echo '<div class="imagen_libro" style="background-image:url(' . $libro_imagen["imagen_ruta"] . ')">';
    echo '</div>';
    echo '<div class="texto_libro">';
    echo '<h2>' . $libro_imagen['titulo'] . '</h2>';
    echo '<p>' . $libro_imagen['autor'] . '</p>';
    echo '<a href="' . $libro_imagen['link'] . '" target="_blank"><button>Comprar</button></a>';
    echo '</div>';
    echo '</div>';
}
?>
