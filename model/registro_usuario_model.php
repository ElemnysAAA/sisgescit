<?php
    require_once ("../conexion.php");
    $conexion = retornarConexion();
        if (isset($_REQUEST['btn-user'])) {  
            $cedula = $_POST['cedula'];  
            $nombre = $_POST['nombre'];  
            $apellido = $_POST['apellido'];  
            $cargo = $_POST['cargo']; 
            $usuario = $_POST['usuario']; 
            $email = $_POST['email'];  
            $password = $_POST['password'];  
            function validarContrasena($password) {  
                // Verifica que la contraseña tenga al menos 8 caracteres  
                if (strlen($password) < 8) {  
                    return false;  
                }  
                // Verifica que contenga al menos una letra mayúscula  
                if (!preg_match('/[A-Z]/', $password)) {  
                    return false;  
                }  
                // Verifica que contenga al menos un número  
                if (!preg_match('/[0-9]/', $password)) {  
                    return false;  
                }  
                // Verifica que contenga al menos un carácter especial  
                if (!preg_match('/[\W_]/', $password)) {  
                    return false;  
                }  
                return true;  
            }  
            $rol_id = $_POST['rol_id']; // Obtener el rol seleccionado  
            // Verificar si el usuario ya existe  
            $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE usuario = ? OR email = ?");  
            $stmt->bind_param("ss", $usuario, $email);  
            $stmt->execute();  
            $result = $stmt->get_result();  
            
            if ($result->num_rows > 0) {  
                echo '<script>alert("Usuario o email ya se encuentra registrado!"); window.location = "../login.php";</script>'; 
            } else {  
                // Hasheando la contraseña  
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  
        
                // Inserción del nuevo usuario  
                $stmt = $conexion->prepare("INSERT INTO usuarios (cedula, nombre, apellido, cargo, usuario, rol_id, email, password) VALUES (?, ?, ?, ?, ?, ?, ?,?)");  
                $stmt->bind_param("ssssssss", $cedula, $nombre, $apellido, $cargo, $usuario, $rol_id, $email,  $hashedPassword);  
                $stmt->execute();  
        
                if ($stmt->affected_rows > 0) {  
                    echo '<script>alert("Usuario registrado con éxito!"); window.location = "../login.php";</script>';  
                } else {  
                    echo '<script>alert("Ocurrió un error al registrar!");window.location = "../registrousuarios.php";</script>';  
                }  
            }  
        }

     