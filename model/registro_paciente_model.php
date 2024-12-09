<?php  
// Archivo de conexión con la base de datos  
require_once "../conexion.php";   
$conexion = retornarConexion();   

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    //Se obtienen los datos del formulario  
    $CedulaPaciente = $_POST['CedulaPaciente'];  
    $fechacita = $_POST['fechacita'];   
    $status = $_POST['status'];  

    // Aquí asumimos que el estado anterior es "Pendiente" o "Programado"  
    // Cambia esto según tu lógica de negocio  
    $estadoAnterior = "Pendiente"; // Cambia esto según corresponda  

    // Preparar la consulta SQL para actualizar el estado del paciente  
    $sql = "UPDATE eventos SET status = ? WHERE CedulaPaciente = ? AND fechacita = ? AND status = ?";  
    $stmt = $conexion->prepare($sql);  
    $stmt->bind_param("ssss", $status, $CedulaPaciente, $fechacita, $estadoAnterior); // Vincular parámetros  

    // Ejecutar la consulta  
    if ($stmt->execute()) {  
        // Ruta que dirige a la pagina de la tabla  
        header("Location: ../index.php");  
        exit();   
    } else {  
        // Manejo de errores  
        echo "Error al actualizar el estado: " . $stmt->error;  // Cambiado para mostrar el error del statement  
    }  

    // Cierre de la declaración y la conexión  
    $stmt->close();  
}  
$conexion->close();  
?>  