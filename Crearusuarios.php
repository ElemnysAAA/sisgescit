<?php
include_once("header.php");

?>

<link rel="stylesheet" href="dist/css/bootstrap.min.css">

<body class="bg-gradient-primary">

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registro de Usuarios</h1><br>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
              Registrar Usuario
            </button>
            <a href="usuarios.php" class="btn btn-danger">
              Regresar
            </a>
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
    </section>

    <div class="modal fade" id="modal-lg">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Nuevo Registro de Usuario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body btn-primary">
            <h3 class="card-title">Ingresar Datos</h3>
          </div>
          <form action="model/crear_usuarios_model.php" method="post">
            <div class="form-group">
              <div class="card-body">
                <div class="row g-4"> <!-- apertura de etiqueta div con clases de bootstrap que asigna cuantos intems del formulario pueden estar en fila -->
                  <div class="col-lg-3 text-center">
                    <label for="nombre1">Cedula</label>
                    <input type="text" class="form-control" id="cedula" placeholder="Ingrese la cedula" name="cedula" require maxlength="8">
                  </div>
                  <div class="col-lg-3 text-center"> <!-- apertura de etiqueta div con clases de bootstrap que permite a los items del formulario colocarlos uno al lado del otro -->
                    <label for="CedulaPaciente">Primer Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre" name="nombre" require style="text-transform: capitalize;">
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="nombre1">Primer Apellido</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Ingrese el apellido" name="apellido" require style="text-transform: capitalize;">
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="apellido1">Correo</label>
                    <input type="email" class="form-control" id="email" placeholder="Ingrese el correo" name="email">
                  </div>

                </div><br>
                <div class="row g-4">
                  <div class="col-lg-3 text-center">
                    <label for="">Cargo</label>
                    <input type="text" class="form-control" id="cargo" placeholder="Ingrese el cargo" name="cargo" require style="text-transform: capitalize;">
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" id="usuario" placeholder="Ingrese nombre de usuario" name="usuario" require>
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="rol">Rol</label>
                    <select class="form-control" id="rol" name="rol" required>
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
                  <div class="col-lg-3 text-center">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password"
                      data-toggle="tooltip"
                      data-placement="top"
                      title="Mínimo 8 caracteres, 1 mayúscula, 1 número, 1 carácter especial"
                      placeholder="Ingrese la contraseña"
                      name="password" required>
                  </div>
                </div><br>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" id="btn-user" name="btn-user">Guardar</button>
                  <a href="Crearusuarios.php" class="btn btn-danger">Salir</a>
                </div>
              </div>
            </div>

        </div>
        <!-- /.card-body -->
        </form>
      </div>

    </div>

  </div>
  <script src="plugins/jquery/jquery-3.6.0.min.js"></script>
  <script src="js/sweetalert2@11.js"></script>

  <script>
    //boton de bootstrap
    $('#btn-user').click(function() {
      Swal.fire(
        'Exito!',
        'Usuario registrado correctamente',
        'success'
      )
    });
  </script>
<script>  
    $(document).ready(function(){  
        $('[data-toggle="tooltip"]').tooltip();   
    });  
</script>  
  <?php
  include_once("footer.php");
  ?>