<?php  
require_once "../conexion.php";  
$conexion = retornarConexion();  
$codespecialidad = $_POST['codespecialidad'];  

$sql = $conexion->query("SELECT * FROM medico WHERE codespecialidad = '$codespecialidad'");  

while ($resultado = $sql->fetch_assoc()) {  
    echo "<option value='" . $resultado['cedulamedico'] . "'>" . $resultado['nom1'] . " " . $resultado['ape1'] . "</option>";  
}  
?>  