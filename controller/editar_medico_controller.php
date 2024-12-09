<?php

require_once "../conexion.php";
$conexion = retornarConexion();

$resultado = mysqli_query($conexion, $sql);


if($resultado = $conexion->query($sql)){
  echo '
                  <script>
                      alert("Los datos fueron modificados exitosamente!");
                      window.location = "../medicos.php";
                  </script>';
                
            }else{
                  die("Error al registrar");
              exit ();
            }

    
 ?>

