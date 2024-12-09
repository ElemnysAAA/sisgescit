<?php  

require_once "../conexion.php";  
$conexion = retornarConexion();  

// Obtener el nombre de la especialidad desde la solicitud POST  
$nomespecialidad = $_POST['nomespecialidad'];  
$color = $_POST['color'];  

// Verificar si la especialidad ya existe  
$sql_check = "SELECT * FROM especialidad WHERE nomespecialidad = '$nomespecialidad'";  
$result_check = $conexion->query($sql_check);  

if ($result_check->num_rows > 0) {  
    // La especialidad ya existe  
    echo '  
    <script>    
        window.location = "../especialidad.php";  
    </script>';  
} else {  
    // La especialidad no existe, proceder a insertarla  
    $sql = "INSERT INTO especialidad (nomespecialidad, color) VALUES ('$nomespecialidad', '$color')";  
}

require_once("../controller/registrar_especialidad_controller.php");