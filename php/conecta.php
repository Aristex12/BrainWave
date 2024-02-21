<?php

function obtenerConexion()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "BrainWave";
    $conexion = mysqli_connect($servername, $username, $password);

    // Verificar si la base de datos 'BrainWave' existe
    $query = "SHOW DATABASES LIKE 'BrainWave'";
    $result = mysqli_query($conexion, $query);

    // Si la base de datos no existe, la creamos
    if (mysqli_num_rows($result) <= 0) {
        $sqlCreateDB = "CREATE DATABASE BrainWave";
        $resultCreateDB = mysqli_query($conexion, $sqlCreateDB);
    }

    // Cerrar la conexión temporal sin seleccionar la base de datos
    mysqli_close($conexion);

    // Devolver la conexión con o sin el nombre de la base de datos
    $conexion = mysqli_connect($servername, $username, $password, $dbname);
    return $conexion;
}

function cerrarConexion($conexion)
{
    mysqli_close($conexion);
}
