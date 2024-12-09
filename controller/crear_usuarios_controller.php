<?php
require_once "../conexion.php";
$conexion = retornarConexion();


// Verificar si el usuario ya existe  
$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario'");  

if(mysqli_num_rows($verificar_usuario) > 0) { // Esto es una condicional para que los usuarios no se repitan en la BD  
    echo '  
        <script>  
            alert("Este usuario ya está registrado.");  
            window.location = "../usuarios.php";  
        </script>  
    ';  
    exit();  
}  

// Ejecutar la consulta de inserción  
if(mysqli_query($conexion, $sql)) {  
        echo '  
        <script>  
            alert("Usuario registrado exitosamente");  
            window.location = "../usuarios.php";  
        </script>  
        ';  
    } else {  
        echo '  
        <script>  
            alert("Error al registrar el usuario: ' . mysqli_error($conexion) . '");  
            window.location = "../usuarios.php";  
        </script>  
        ';  
    }  

?>