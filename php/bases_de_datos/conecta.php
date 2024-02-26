<?php

function obtenerConexion()
{
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "BrainWave";
    $conexion = mysqli_connect($servername, $username, $password);

    // Verificar si la base de datos 'BrainWave' existe
    $query = "SHOW DATABASES LIKE 'BrainWave'";
    $result = mysqli_query($conexion, $query);

    // Si la base de datos no existe, la creamos
    if (mysqli_num_rows($result) > 0) {
        mysqli_close($conexion);
        $conexion = mysqli_connect($servername, $username, $password, $dbname);
    }

    // Devolver la conexión con o sin el nombre de la base de datos
    return $conexion;
}

function cerrarConexion($conexion)
{
    mysqli_close($conexion);
}
