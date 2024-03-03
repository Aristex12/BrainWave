<?php
require_once '../bases_de_datos/conecta.php';
require_once '../bases_de_datos/tablas.php';

// Inicializar el array de respuesta
$response = array();

// Verificar si el método de solicitud es POST y el campo 'buscador' está presente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["buscador"])) {
    // Obtener el término de búsqueda desde la solicitud
    $busqueda = $_POST["buscador"];

    // Realiza la consulta para obtener psicólogos con imágenes que coincidan con la búsqueda
    $conexion = obtenerConexion();
    $query_psicologos_imagenes = "SELECT psicologos.*, imagenes.ruta AS imagen_ruta 
        FROM psicologos 
        JOIN relacion_psicologo_imagen ON psicologos.id_psicologo = relacion_psicologo_imagen.id_psicologo 
        JOIN imagenes ON relacion_psicologo_imagen.id_imagen = imagenes.id_imagen
        WHERE psicologos.nombre LIKE '%$busqueda%'";

    $result_psicologos_imagenes = mysqli_query($conexion, $query_psicologos_imagenes);

    // Almacena los resultados en un array asociativo
    $psicologos_imagenes = mysqli_fetch_all($result_psicologos_imagenes, MYSQLI_ASSOC);

    // Cierra la conexión
    cerrarConexion($conexion);

    // Añade los resultados al array de respuesta
    $response['status'] = 'success';
    $response['psicologos'] = $psicologos_imagenes;
} else {
    // Mensaje de error si la solicitud no es POST o falta el campo 'buscador'
    $response['status'] = 'error';
    $response['message'] = 'Error: Solicitud no válida';
}

// Devolver la respuesta en formato JSON
echo json_encode($response);
exit();
?>
