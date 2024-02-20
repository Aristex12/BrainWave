<?php

function obtenerConexion() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "BrainWave";

    // Conexión a la base de datos
    $conexion = mysqli_connect($servername, $username, $password, $dbname) or die("Error de conexión a la base de datos");

    return $conexion;
}

function cerrarConexion($conexion) {
    mysqli_close($conexion);
}

?>