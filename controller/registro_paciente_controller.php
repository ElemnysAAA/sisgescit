<?php

require_once "../conexion.php";
$conexion = retornarConexion();

if ($conexion->query($insertar_paciente) === TRUE) {

    echo '
    <script>
        alert("Paciente registrado correctamente!");
        window.location = "../pacientes.php";
    </script>';
} else {
    echo '
    <script>
        alert("Error al registrar el paciente: ' . $conexion->error . '");
        window.location = "../pacientes.php";
    </script>';
} 

if ($conexion->query($insertar_historia) === TRUE) {
} else {
echo '
<script>
alert("Historia medica registrada correctamente");
window.location = "../pacientes.php";
</script>';
} 




    
 ?>