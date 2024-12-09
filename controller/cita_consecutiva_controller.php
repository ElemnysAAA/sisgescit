<?php

require_once "../conexion.php";
$conexion = retornarConexion();

$resultado = mysqli_query($conexion, $sql);


if($resultado = $conexion->query($sql)){
                die("Se registro la cita con exito");
            }else{
                  echo '
                  <script>
                      alert("El paciente se ha registrado correctamente!");
                      window.location = "../pacientes.php";
                  </script>';
              exit ();
            }
    
 ?>