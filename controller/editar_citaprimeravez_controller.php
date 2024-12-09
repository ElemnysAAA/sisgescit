<?php
require_once "../conexion.php";
$conexion = retornarConexion();

if ($conexion->query($sql) === TRUE) {  
  echo '  
  <script>  
   
      window.location = "../pacientes.php";  
  </script>';  
} else {  
  echo '<script>alert("Ocurrió un error al actualizar.");</script>';  
  die("Error al actualizar: " . $conexion->error);  
  exit();  
}  
 
    
 ?>

