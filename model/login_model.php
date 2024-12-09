<?php  
require_once ("conexion.php");  
$conexion = retornarConexion();  
session_start();  
if (isset($_SESSION['id_email'])) {  
    // User is already logged in, redirect to index.php  
    header("Location: index.php");  
    exit; // Prevent further code execution  
}  

if (isset($_REQUEST['btn-ingresar'])) {  
    $email = $_POST['email'];  
    $password = $_POST['password'];  

    $sql = "SELECT id, nombre, apellido, usuario FROM usuarios WHERE email= '$email' AND password='$password'"; // también selecciona apellido  
    $ejecutar = $conexion->query($sql);  
    $row = $ejecutar->num_rows;  

    if ($row > 0) {  
        $user_data = $ejecutar->fetch_assoc(); // 
        $_SESSION['id_email'] = $user_data['id'];  
        $_SESSION['usuario'] = $user_data['usuario']; 

        header("Location: index.php"); // codigo que redirige al index cuando se inicia sesion con los datos validos

    } else {  
        echo "<script>  
            alert('Los datos ingresados son inválidos!');  
        </script>";  
    }  
}  

?>  