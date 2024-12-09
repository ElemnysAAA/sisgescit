<?php

function retornarConexion() {
    $server = "localhost";
    $usuario = "root";
    $clave = "";
    $base = "bdussi2024";
    $conexion = mysqli_connect($server, $usuario, $clave, $base) or die("Problemas de conexión");
    mysqli_set_charset($conexion, 'utf8');
    return $conexion;
}

function hacerCopiaDeSeguridad($conexion) {
    // Nombre del archivo de copia de seguridad
    $backupFile = 'C:\xampp\htdocs\SISGECIT\backup-' . date("Y-m-d-H-i-s") . '.sql';
    
    // Abre el archivo para escribir
    $fp = fopen($backupFile, 'w');
    if (!$fp) {
        die("No se pudo abrir el archivo para escribir.");
    }

    // Obtener todas las tablas de la base de datos
    $tablas = mysqli_query($conexion, "SHOW TABLES");
    while ($tabla = mysqli_fetch_array($tablas)) {
        $nombreTabla = $tabla[0];

        // Escribir la estructura de la tabla
        $createTable = mysqli_query($conexion, "SHOW CREATE TABLE $nombreTabla");
        $row = mysqli_fetch_row($createTable);
        fwrite($fp, $row[1] . ";\n\n");

        // Obtener los datos de la tabla
        $datos = mysqli_query($conexion, "SELECT * FROM $nombreTabla");
        while ($fila = mysqli_fetch_assoc($datos)) {
            $valores = array_map(function($valor) {
                return "'" . mysqli_real_escape_string($GLOBALS['conexion'], $valor) . "'";
            }, $fila);
            $valores = implode(", ", $valores);
            fwrite($fp, "INSERT INTO $nombreTabla VALUES ($valores);\n");
        }
        fwrite($fp, "\n\n");
    }

    fclose($fp);
    
    // Mensaje de éxito y redirección
    echo "
    <script>
    $('#btn-user').click(function() {
        Swal.fire({
            title: 'Copia de seguridad creada exitosamente',
            text: 'Puedes descargarla aquí: <a href=\"$backupFile\" download>$backupFile</a>',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = 'index.php'; // Redirige a index.php
            }
        }
        });
    </script>
    ";  
}

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = retornarConexion();
    hacerCopiaDeSeguridad($conexion);
    mysqli_close($conexion);
} else {
    echo "Acceso no permitido.";
}
?>