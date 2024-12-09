<?php

require_once "../conexion.php";
$conexion = retornarConexion();

$resultado = mysqli_query($conexion, $sql);


if($resultado = $conexion->query($sql)){
                die("Error al registrar");
            }else{
                  echo '
                  <script>
                      alert("El paciente fue registrado con exito!");
                      window.location = "../crear_medico.php";
                  </script>';
              exit ();
            }

    
 ?>