<?php
require_once '../bases_de_datos/conecta.php';

session_start();

// Verificar si el método de solicitud es POST y el botón de envío está presente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["boton_enviar"])) {
    // Verificar si hay una sesión iniciada
    if (isset($_SESSION["usuario"])) {
        // Obtener el id del evento desde el campo oculto
        $id_evento = $_POST["id_escondido"];

        // Obtener el id del paciente (supongamos que lo obtienes de alguna manera)
        $id_paciente = obtenerIdPaciente($_SESSION["usuario"]);

        // Verificar si el usuario ya está inscrito en el evento
        if (estaInscrito($id_evento, $id_paciente)) {
            // Retornar un mensaje de error en formato JSON
            $response = array("error" => true, "message" => "El usuario ya está inscrito en este evento");
            echo json_encode($response);
            exit();
        }

        // Insertar datos en la tabla relacion_workshops_usuarios
        if ($id_evento && $id_paciente) {
            $conexion = obtenerConexion();

            $query_insert = "INSERT INTO relacion_workshops_usuarios (id_evento, id_paciente) VALUES ($id_evento, $id_paciente)";
            mysqli_query($conexion, $query_insert);

            cerrarConexion($conexion);

            // Mensaje de éxito u otra lógica después de la inserción
            $response = array("success" => true, "message" => "Te has inscrito correctamente en el evento!");
            echo json_encode($response);
            session_write_close();
        } else {
            // Manejar el caso en que no se puedan obtener los ids necesarios
            $response = array("error" => true, "message" => "Error: No se pudieron obtener los ids necesarios");
            echo json_encode($response);
        }
    } else {
        // Retornar un mensaje de error en formato JSON si el usuario no está logueado
        $response = array("error" => true, "redirect" => "login.php");
        echo json_encode($response);
        exit();
    }
} else {
    // Retornar un mensaje de error en formato JSON si la solicitud no es POST o falta el botón de enviar
    $response = array("error" => true, "message" => "Solicitud incorrecta");
    echo json_encode($response);
    exit();
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

function estaInscrito($id_evento, $id_paciente)
{
    // Verificar si el usuario ya está inscrito en el evento
    $conexion = obtenerConexion();
    $query = "SELECT * FROM relacion_workshops_usuarios WHERE id_evento = $id_evento AND id_paciente = $id_paciente";
    $result = mysqli_query($conexion, $query);

    return mysqli_num_rows($result) > 0;
}
?>
