<?php
require_once("conexion.php");

$conexion = retornarConexion();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Registrar Nuevo Usuario</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="dist/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="dist/img/estandarte-ubv.png" class="card-img" alt="...">
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Crear Nuevo Usuario!</h1>
                            </div>
                            <form action="model/registro_usuario_model.php" class="btn-user" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="cedula"
                                            placeholder="Ingrese su cedula" name="cedula">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="nombre"
                                            placeholder="Ingrese su Nombre" name="nombre">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="apellido"
                                            placeholder="Ingrese su Apellido" name="apellido">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="cargo"
                                            placeholder="Ingrese su Cargo" name="cargo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="usuario"
                                            placeholder="Ingrese su Usuario" name="usuario">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="">Rol</label>
                                        <select class="form-control" name="rol_id" required>
                                            <option value="" disabled selected>Seleccionar Rol</option>
                                            <?php
                                            require_once("conexion.php");
                                            $conexion = retornarConexion();
                                            $sqlRoles = "SELECT * FROM rol";
                                            $ejecutarRoles = $conexion->query($sqlRoles);
                                            while ($rol = $ejecutarRoles->fetch_assoc()) {
                                                echo "<option value='" . $rol['id'] . "'>" . $rol['rol'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" class="form-control form-control-user" id="email"
                                            placeholder="Email" name="email">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="password" placeholder="Password" name="password">
                                    </div>
                                </div>
                                <button type="submit" name="btn-user" class="btn btn-primary btn-user btn-block">Registrar</button>
                                <hr>
                            </form>

                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Olvidaste tu Contraseña?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Ya tienes una Cuenta? Inicia Sesión!</a>
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