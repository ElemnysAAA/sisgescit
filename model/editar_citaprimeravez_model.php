<?php  
require_once("../conexion.php");  
$conexion = retornarConexion();  

// Verifica si se han enviado datos  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    // Obtener los datos del formulario  
    $fechacita = $_POST['fechacita'];  
    $codigo = $_POST['codigo']; // Cambiar a 'codigo' si es el identificador único  
 

    // Actualizar la fecha de la cita  
    $sql = "UPDATE eventos SET fechacita = ? WHERE codigo = ?"; // Preparar la consulta  

    if ($stmt = $conexion->prepare($sql)) { // sentencias preparadas para evitar inyeccion SQL
        $stmt->bind_param("si", $fechacita, $codigo); 
        
        // Ejecutar la consulta  
        if ($stmt->execute()) {  
           
            echo '  
            <script>  
                window.location = "../pacientes.php";  
            </script>';   
        } else {  
            echo '<script>alert("Ocurrió un error al actualizar.");</script>';  
            die("Error al actualizar: " . $stmt->error);  
        }  

        // Cerrar la declaración  
        $stmt->close();  
    } else {  
        echo '<script>alert("Ocurrió un error al preparar la consulta.");</script>';  
        die("Error al preparar consulta: " . $conexion->error);  
    }  

    // Cerrar la conexión  
    $conexion->close();  
}  
     