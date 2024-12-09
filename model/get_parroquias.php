<?php  
require_once "../conexion.php";  
$conexion = retornarConexion();  
$idMcpio = $_POST['idMcpio'];  

$sql = $conexion->query("SELECT * FROM parroquias WHERE idMcpio = '$idMcpio'");  

while ($resultado = $sql->fetch_assoc()) {  
    echo "<option value='" . $resultado['idPquia'] . "'>" . $resultado['nompquia'] . "</option>";  
}  
?>  