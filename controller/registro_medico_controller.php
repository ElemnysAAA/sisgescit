<?php

require_once "../conexion.php";
$conexion = retornarConexion();

$resultado = mysqli_query($conexion, $sql);


if($resultado = $conexion->query($sql)){
                die("Error al registrar");
            }else{
                  echo '
                  <script>
                      alert("El medico fue registrado exitosamente!");
                      window.location = "../crear_medico.php";
                  </script>';
              exit ();
            }

    
 ?>

