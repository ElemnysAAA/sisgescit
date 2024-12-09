<?php
    require_once ("../conexion.php");
    $conexion = retornarConexion();

    $ejecutar = $conexion->query($sql);


    $sql = "SELECT id, nombre FROM usuarios WHERE usuario= '$usuario'";
        $ejecutar= $conexion->query($sql);
        $row = $ejecutar->num_rows;

        if ($row > 0) {
            echo "<script>
                alert('Usuario ya se encuentra registrado!');
                 </script>";
        }else {
            
            $sql = "INSERT INTO usuarios(nombre, apellido, cargo, email, usuario, password, confirmarpassword) VALUES ('$nombre', '$apellido, '$cargo','$email','$usuario','$password','$confirmarpassword')";
            $ejecutar = $conexion->query($sql);

            if ($row > 0) {
                echo "<script>
                alert('Registro con éxito!');
                window.location = 'login.php';
                 </script>";

            }else{
                echo "<script>
                alert('Ocurrio un error al registrar!');
                window.location = 'registrousuarios.php';
                 </script>";
            }
        }
    
    ?>