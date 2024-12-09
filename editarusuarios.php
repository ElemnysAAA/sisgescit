<?php 
require_once ("conexion.php");
$conexion = retornarConexion();
include_once("header.php");

@$id=$_REQUEST['id'];
$sql=  "SELECT * FROM usuarios WHERE id= '$id' ";

$ejecutar= $conexion->query($sql);
while ($row = mysqli_fetch_array($ejecutar)) {
  $id= $row['0'];
  $nombre= $row['1'];
  $apellido= $row['2'];
  $cargo=$row['3'];
  $email= $row['4'];
  $usuario= $row['5'];
  $contraseña= $row['6'];
}

if (isset($_REQUEST['btn-editar'])) {
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $cargo = $_POST['cargo'];
  $email= $_POST['email'];
  $usuario= $_POST['usuario'];
  $password= md5($_POST['password']);

        $sql = "UPDATE usuarios SET
                nombre = '$nombre',
                apellido = '$apellido',
                cargo = '$cargo',
                email = '$email',
                usuario ='$usuario',
                password ='$password' WHERE id = '$id' ";

        $ejecutar = $conexion->query($sql);

           

          if ($ejecutar > 0) {
            echo "<script>
            alert('El usuario fue modificado!');
            </script>";
          }else{
            echo "<script>
            alert('Hubo un error al modificar!');
            </script>";
          }
     }

//Eliminar Ususario//
if (isset($_REQUEST['btn-eliminar'])) {
  $id= $_POST['id'];

  $sql= "DELETE FROM usuarios WHERE id= '$id'";
  $ejecutar= $conexion->query($sql);
  if ($ejecutar > 0) {
    echo "<script>
    alert('El usuario fue eliminado!');
    window.location = 'usuarios.php';
    </script>";
  }else{
    echo "<script>
    alert('Hubo un error al eliminar!');
    window.location = 'editarusuarios.php';
    </script>";
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

    <title>SISGECIT| Usuario</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">



</head>

<body class="bg-gradient-primary">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Usuario</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active">Editar de Usuario</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Actualizar los datos del usuario</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="btn-editar" method="post">
                <div class="card-body">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" id="id" placeholder="ID del Usuario" name="id" value="<?php echo $id;?>">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="<?php echo $nombre;?>">
                  </div>
                  <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido" value="<?php echo $apellido;?>">
                  </div>
                  <div class="form-group">
                    <label for="cargo">Cargo</label>
                    <input type="text" class="form-control" id="cargo" placeholder="Cargo" name="cargo" value="<?php echo $cargo;?>">
                  </div>
                  <div class="form-group">
                    <label for="email">Correo</label>
                    <input type="email" class="form-control" id="email" placeholder="Correo" name="email" value="<?php echo $email;?>">
                  </div>
                  <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" id="usuario" placeholder="Ingrese un usuario" name="usuario" value="<?php echo $usuario;?>">
                  </div>
                  
                  <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" placeholder="ingrese una Contraseña" name="password" >
                  </div>
                 
                  <div class="form-group">
                  <button type="submit" class="btn btn-primary" name="btn-editar">Modificar</button>
                  
                    <a href="usuarios.php" class="btn btn-success">Regresar</a>
                </div>
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
              </form>
            </div>
            <!-- /.card -->

            
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php 
include_once("footer.php");
?>