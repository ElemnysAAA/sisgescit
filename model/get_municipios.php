<?php  
require_once "../conexion.php";  
$conexion = retornarConexion();  
$idEstado = $_POST['idEstado'];  

$sql = $conexion->query("SELECT * FROM municipios WHERE idEstado = '$idEstado'");  

while ($resultado = $sql->fetch_assoc()) {  
    echo "<option value='" . $resultado['idMcpio'] . "'>" . $resultado['nommcipio'] . "</option>";  
}  
?>  