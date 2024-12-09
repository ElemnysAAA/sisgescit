<?php  
require_once("../conexion.php");  
$conexion = retornarConexion();  


if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    $CedulaPaciente = $_POST['CedulaPaciente'];  
    $motivo = $_POST['motivo'];  

    // Con esto se actualiza el status de la cita y se guardará el motivo  
    $sql = "UPDATE eventos SET status = 'Cancelada', motivo = ? WHERE CedulaPaciente = ?"; 
    $stmt = $conexion->prepare($sql);  

    if (!$stmt) {  
        die("Error en la consulta: " . $conexion->error);  
    }  

    $stmt->bind_param("ss", $motivo, $CedulaPaciente);  

    if ($stmt->execute()) {   
        echo '  
        <script>  
           
            window.location = "../pacientes.php";  
        </script>';  
    } else {  
        echo "Error al cancelar la cita: " . $stmt->error;  
    }  

    $stmt->close();  
} 
?>  