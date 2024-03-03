<?php
require_once '../bases_de_datos/conecta.php';
require_once '../bases_de_datos/tablas.php';

// Verificar si el método de solicitud es POST y el campo 'id_evento' está presente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_evento"])) {

    // Verificar si hay una sesión iniciada
    if (isset($_SESSION["usuario"])) {
        // Obtener el id del evento desde la solicitud
        $id_evento = $_POST["id_evento"];

        // Obtener el id del paciente (supongamos que lo obtienes de alguna manera)
        $id_paciente = obtenerIdPaciente($_SESSION["usuario"]);

        // Insertar datos en la tabla relacion_workshops_usuarios
        if ($id_evento && $id_paciente) {
            $conexion = obtenerConexion();

            $query_insert = "INSERT INTO relacion_workshops_usuarios (id_evento, id_paciente) VALUES ($id_evento, $id_paciente)";
            mysqli_query($conexion, $query_insert);

            cerrarConexion($conexion);

            // Mensaje de éxito u otra lógica después de la inserción
            echo "Inserción exitosa en la tabla relacion_workshops_usuarios";
        } else {
            // Manejar el caso en que no se puedan obtener los ids necesarios
            echo "Error: No se pudieron obtener los ids necesarios";
        }
    } else {
        // Manejar el caso en que no haya una sesión iniciada
        echo "Error: No hay una sesión iniciada";
    }
} else {
    // Manejar el caso en que la solicitud no sea POST o falte el campo 'id_evento'
    echo "Error: Solicitud no válida";
}

function obtenerIdPaciente($username)
{
    // Obtener el id del paciente según el nombre de usuario (implementa según tu lógica)
    // Puedes realizar una consulta a la base de datos para obtener el id del paciente asociado al username
    // Este es solo un ejemplo de cómo podría ser, ajusta según tu estructura de la base de datos
    $conexion = obtenerConexion();
    $query = "SELECT id_paciente FROM relacion_usuarios_login WHERE id_login = (SELECT id_login FROM login WHERE username = '$username')";
    $result = mysqli_query($conexion, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row["id_paciente"];
    }

    return null; // Otra lógica si no se puede obtener el id del paciente
}
?>
