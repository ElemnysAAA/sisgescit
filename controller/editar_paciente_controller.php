<?php
require_once "../conexion.php";
$conexion = retornarConexion();

$resultado = mysqli_query($conexion, $sql);
if ($resultado) {
    echo '
    <script>
        alert("Los datos se actualizaron correctamente!");
        window.location = "../pacientes.php";
    </script>';
} else {
    echo '
    <script>
        alert("Ocurrió un error al registrar: ' . mysqli_error($conexion) . '");
        window.location = "../pacientes.php";
    </script>';
}


?>







   