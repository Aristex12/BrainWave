<?php
require_once '../bases_de_datos/conecta.php';
require_once '../bases_de_datos/tablas.php';

// Verificar si se ha enviado una consulta de búsqueda
if (isset($_GET['buscador'])) {
    $busqueda = $_GET['buscador'];

    // Realizar la consulta para obtener eventos que coincidan con la búsqueda
    $conexion = obtenerConexion();
    $query_eventos = "SELECT * FROM workshops WHERE nombre_evento LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%'";
    $result_eventos = mysqli_query($conexion, $query_eventos);
    
    // Obtener y mostrar los resultados de la búsqueda
    while ($evento = mysqli_fetch_assoc($result_eventos)) {
        echo '<div class="workshop" data-fecha="' . $evento['fecha'] . '" data-hora="' . $evento['hora'] . '" data-lugar-nombre="' . $evento['lugar_nombre'] . '" data-lugar-direccion="' . $evento['lugar_direccion'] . ' " data-id="' . $evento["id_evento"] . '">';
        echo '<h2>' . $evento['nombre_evento'] . '</h2>';
        
        $descripcion_resumen = substr($evento['descripcion'], 0, 150); // Limitar a 150 caracteres, ajusta según tus necesidades
        echo '<p>' . $descripcion_resumen . '...</p>';
        
        // Agregar elemento oculto con el contenido completo
        echo '<div class="contenido-completo-oculto" style="display:none;">' . $evento['descripcion'] . '</div>';
        
        echo '</div>';
    }

    cerrarConexion($conexion);
}
?>
