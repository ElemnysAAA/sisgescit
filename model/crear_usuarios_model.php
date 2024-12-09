<?php   
require_once "../conexion.php";  
$conexion = retornarConexion();  

// Variables que se reciben del formulario para ser insertadas en la base de datos   
$cedula = $_POST['cedula'];  
$nombre = $_POST['nombre'];  
$apellido = $_POST['apellido'];  
$cargo = $_POST['cargo'];  
$usuario = $_POST['usuario'];  
$rol = $_POST['rol']; // Obtener el rol seleccionado  
$email = $_POST['email'];  
$password = $_POST['password'];  

function validarContrasena($password) {  
    if (strlen($password) < 8) {  
        return false;  
    }  
    if (!preg_match('/[A-Z]/', $password)) {  
        return false;  
    }  
    if (!preg_match('/[0-9]/', $password)) {  
        return false;  
    }  
    if (!preg_match('/[\W_]/', $password)) {  
        return false;  
    }  
    return true;  
}  

// Validar la contraseña  
if (!validarContrasena($password)) {  
    echo '  
        <script>  
        Swal.fire("La contraseña no cumple con los parametros requeridos!");
            window.location = "../usuarios.php";  
        </script>  
    ';  
    exit();  
}  

// codigo que permite verificar si el usuario ya existe  
$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario= '$usuario' AND id = '$id' AND cedula = '$cedula' ");  

if(mysqli_num_rows($verificar_usuario) > 0) {  
    echo '  
        <script>  
            alert("Este usuario ya está registrado.");  
            window.location = "../usuarios.php";  
        </script>  
    ';  
    exit();  
}  

// Encriptar la contraseña  
$password_encriptada = password_hash($password, PASSWORD_DEFAULT);  

// Preparar la consulta de inserción con consultas preparadas  
$sql = "INSERT INTO usuarios (cedula, nombre, apellido, cargo, email, usuario, password, rol_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";  
$stmt = $conexion->prepare($sql);  
$stmt->bind_param('ssssssss', $cedula, $nombre, $apellido, $cargo, $email, $usuario, $password_encriptada, $rol_id);  

// Ejecutar la consulta de inserción  
if($stmt->execute()) {  
    echo '  
        <script>    
            window.location = "../usuarios.php";  
        </script>  
    ';  
} else {  
    echo '  
        <script>  
            alert("Error al registrar el usuario: ' . $conexion->error . '");  
            window.location = "../usuarios.php";  
        </script>  
    ';  
}  

// Cerrar la declaración  
$stmt->close();  
$conexion->close();  
?>  