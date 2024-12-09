<?php

function retornarConexion() {
    $server = "localhost";
    $usuario = "irene";
    $clave = "1234";
    $base = "bdussi2024";
    $conexion = mysqli_connect($server, $usuario, $clave, $base) or die("Problemas de conexión");
    mysqli_set_charset($conexion, 'utf8');
    return $conexion;
}

?>