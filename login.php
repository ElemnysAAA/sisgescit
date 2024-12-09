<?php  
require_once("conexion.php");  
$conexion = retornarConexion();  
session_start();  

if (isset($_SESSION['id_email'])) {  
    header("Location: index.php");  
    exit;  
}  

if (isset($_REQUEST['btn-ingresar'])) {  
    $email = $_POST['email'];  
    $password = $_POST['password'];  
    $ip = $_SERVER['REMOTE_ADDR'];  
    $captcha = $_POST['g-recaptcha-response'];  
    $secretkey = "6LfM0YEqAAAAADHTj500mepXwWipFcEQnOWni_1-";   

    // Verificar que se completó el CAPTCHA  
    if (empty($captcha)) {  
        echo "<script>alert('Por favor completa el CAPTCHA');</script>";  
    } else {  
        // Verificar el CAPTCHA  
        $responde = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");  
        $atributo = json_decode($responde, true);  
        
        // Verificacion que el CAPTCHA fue exitoso
        if (!$atributo['success']) {  
            echo "<script>alert('Verifique el CAPTCHA');</script>";  
            var_dump($atributo); // Para depuración; eliminar en producción  
        } else {  
            // Si el CAPTCHA es válido, proceder a autenticar al usuario  
            $sql = "SELECT id, nombre, apellido, email, rol_id, password FROM usuarios WHERE email='$email'";  
            $ejecutar = $conexion->query($sql);  
            
            if ($ejecutar->num_rows > 0) {  
                $user_data = $ejecutar->fetch_assoc();   
                
                // Verificar la contraseña ingresada con la contraseña encriptada  
                if (password_verify($password, $user_data['password'])) {  
                    $_SESSION['id_email'] = $user_data['id'];  
                    $_SESSION['nombre'] = $user_data['nombre'];  
                    $_SESSION['apellido'] = $user_data['apellido'];   
                    $_SESSION['rol_id'] = $user_data['rol_id'];  
                    
                    header("Location: index.php");  
                    exit; // Evita que se ejecute más código  
                } else {  
                    echo "<script>alert('Los datos ingresados son inválidos!');</script>";  
                }  
            } else {  
                echo "<script>alert('Los datos ingresados son inválidos!');</script>";  
            }  
        }  
    }  
}  
?>   

<!DOCTYPE html>  
<html lang="es">  
<head>  
    <meta charset="utf-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
    <meta name="description" content="">  
    <meta name="author" content="">  
    <title>SISGECIT| LOGIN</title>  
    <link rel="shortcut icon" href="dist/img/logo.png" type="image/x-icon">  
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">  
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">  
    <link href="dist/css/sb-admin-2.min.css" rel="stylesheet">   
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>  
</head>  
<body class="bg-gradient-primary">  
    <div class="container">  
        <div class="row justify-content-center">  
            <div class="col-xl-10 col-lg-12 col-md-9">  
                <div class="card o-hidden border-0 shadow-lg my-5">  
                    <div class="card-body p-0">  
                        <div class="row">  
                            <div class="col-lg-6">  
                                <img src="dist/img/estandarte-ubv.png" class="card-img" alt="...">  
                            </div>  
                            <div class="col-lg-6">  
                                <div class="p-5">  
                                    <div class="text-center">  
                                        <h1 class="h4 text-gray-900 mb-4">Sistema de Gestión de Citas Medica UBV/USSI</h1>  
                                    </div>  
                                    <form class="btn-ingresar" method="post">  
                                        <div class="form-group">  
                                            <input type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Ingrese su correo" name="email">  
                                        </div>  
                                        <div class="form-group">  
                                            <input type="password" class="form-control form-control-user" id="password" placeholder="Ingrese su contraseña" name="password">  
                                        </div>  
                                        <div class="g-recaptcha" data-sitekey="6LfM0YEqAAAAAP11Ggkwo6HoJ2w_sVxFdVR3lV-X"></div>  
                                       <button type="submit" name="btn-ingresar" class="btn btn-primary btn-ingresar btn-block">Iniciar Sesión</button>     
                                    </form>  
                                    <hr>  
                                    <div class="text-center">  
                                        <a class="small" href="olvido_clave.php">Olvidaste tu Contraseña?</a>  
                                    </div>  
                                    <div class="text-center">  
                                        <a class="small" href="registrousuarios.php">Crear nueva cuenta</a>  
                                    </div>  
                                </div>  
                            </div>  
                        </div>  
                    </div>  
                </div>  
            </div>  
        </div>  
    </div>  
    <script src="vendor/jquery/jquery.min.js"></script>  
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>  
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>  
    <script src="js/sb-admin-2.min.js"></script>  
</body>  
</html>