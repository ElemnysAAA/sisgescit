<?php  
require_once("../conexion.php");  
$conexion = retornarConexion();  

if (isset($_GET['id']) && isset($_GET['estado'])) {  
    $id = intval($_GET['id']); // Asegúrate de que el id sea un entero  
    $estado = intval($_GET['estado']);  

    // Actualizar el estado en la base de datos  
    $sql = "UPDATE usuarios SET estado = $estado WHERE id = $id";  
    if ($conexion->query($sql) === TRUE) {  
        echo '<script>
        window.location = "../usuarios.php";
        </script>';  
    } else {  
        echo '<script> 
        alert("Error al actualizar el estado: ' . $conexion->error . '"); window.location = "../usuarios.php";
        </script>';  
    }  
} else {  
    // Redirigir o mostrar un error si no se recibe el id o estado  
    echo '<script>alert("ID o estado no recibido."); window.location = "../usuarios.php";</script>';  
}  
?>  