<?php
// procesar_articulos.php

require_once '../bases_de_datos/conecta.php';
require_once '../bases_de_datos/tablas.php';

// Obtén el término de búsqueda desde la solicitud AJAX
$busqueda = isset($_GET['buscador']) ? $_GET['buscador'] : '';

// Limpia y escapa la cadena de búsqueda para prevenir inyecciones SQL
$busqueda = mysqli_real_escape_string(obtenerConexion(), $busqueda);

// Realiza la consulta para obtener artículos que coincidan con la búsqueda
$query_articulos = "SELECT * FROM articulos WHERE titulo LIKE '%$busqueda%' OR autor LIKE '%$busqueda%' OR contenido LIKE '%$busqueda%'";

$result_articulos = mysqli_query(obtenerConexion(), $query_articulos);

// Almacena los resultados en un array asociativo
$articulos = mysqli_fetch_all($result_articulos, MYSQLI_ASSOC);

// Cierra la conexión
cerrarConexion(obtenerConexion());

// Construye el HTML para la sección de artículos
foreach ($articulos as $articulo) {
    echo '<div class="articulo">';
    echo '<h2>' . $articulo['titulo'] . '</h2>';
    $contenido_resumen = substr($articulo['contenido'], 0, 150); // Limitar a 150 caracteres, ajusta según tus necesidades
    echo '<p>' . $contenido_resumen . '...</p>';
    echo '<span>Autor: ' . $articulo["autor"] . '</span>';

    // Agregar elemento oculto con el contenido completo
    echo '<div class="contenido-completo-oculto" style="display:none;">' . $articulo['contenido'] . '</div>';

    echo '</div>';
}
?>
