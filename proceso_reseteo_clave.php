<?php  
require_once("conexion.php");  
$conexion = retornarConexion();  

if (isset($_POST['username']) && isset($_POST['new_password'])  && isset($_POST['cedula']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['rol'])) {  
    $username = $_POST['username'];  
    $new_password = $_POST['new_password'];  
    $nombre = $_POST['nombre'];  
    $apellido = $_POST['apellido'];  
    $email = $_POST['email'];  
    $rol = $_POST['rol'];  
    
    // Verificar si el usuario existe y validar otros datos
    $sql = "SELECT id FROM usuarios WHERE usuario = '$usuario' AND cedula= '$cedula' AND nombre = '$nombre' AND apellido = '$apellido' AND email = '$email' AND rol = '$rol'";  
    $result = $conexion->query($sql);  
    
    if ($result->num_rows > 0) {  
        // Actualizar la contraseña  
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT); // Asegúrate de usar un hash seguro
        $sql = "UPDATE usuarios SET password = '$hashed_password' WHERE username = '$username'";  
        $conexion->query($sql);  
        
        echo "La contraseña ha sido actualizada exitosamente.";  
    } else {  
        echo "Los datos proporcionados no coinciden con ningún usuario registrado.";  
    }  
}  
?>