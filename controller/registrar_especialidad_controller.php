
<?php  
require_once "../conexion.php";  
$conexion = retornarConexion();  

if ($conexion->query($sql) === TRUE) {  
    echo '  
    <script>   
        window.location = "../especialidad.php";  
    </script>';  
} else {  
    echo '  
    <script>  
        window.location = "../especialidad.php";  
    </script>';  
}  
  

?>  