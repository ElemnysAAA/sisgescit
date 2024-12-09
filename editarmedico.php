<?php
include_once("header.php");
?>

<title>SISGECIT| Usuario</title>


<link rel="stylesheet" href="dist/css/bootstrap.min.css">
<link rel="stylesheet" href="js/jquery.dataTables.min.css">
<link rel="stylesheet" href="dist/css/fixedHeader.dataTables.min.css">
<body class="bg-gradient-primary">

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar datos del médico</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active">Editar datos de Medicos</li>
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
                <h3 class="card-title">Ingresar Datos</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="model/editar_medico_model.php" method="post">
                <!--Codigo sql que permite la consulta de datos registrdos con la cedula seleccionada-->
                <?php
                require_once("conexion.php");
                $conexion = retornarConexion();
                if (isset($_GET['cedulamedico'])) {
                  $cedulaMedico = mysqli_real_escape_string($conexion, $_GET['cedulamedico']);
                  $sql = "SELECT * FROM medico WHERE cedulamedico='$cedulaMedico'";
                  $resultado = $conexion->query($sql);
                  $row = $resultado->fetch_assoc();
                }

                ?>
                <!--input para identificar la cedula del medico que se va a modificar-->
                <input type="Hidden" class="form-control" name="cedulamedico" value=" <?php echo $row['cedulamedico']; ?>">

                <div class="card-body">
                  <div class="form-group">
                    <label for="cedulamedico">Cédula</label>
                    <input type="text" class="form-control" name="cedulamedico" value="<?php echo $row['cedulamedico']; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nom1">Primer Nombre</label>
                    <input type="text" class="form-control" name="nom1" value="<?php echo $row['nom1']; ?> " readonly>
                  </div>
                  <div class="form-group">
                    <label for="nom2">Segundo Nombre</label>
                    <input type="text" class="form-control" name="nom2" value="<?php echo $row['nom2']; ?> " readonly>
                  </div>
                  <div class="form-group">
                    <label for="ape1">Primer Apellido</label>
                    <input type="text" class="form-control" name="ape1" value="<?php echo $row['ape1']; ?> " readonly>
                  </div>
                  <div class="form-group">
                    <label for="ape2">Segundo Apellido</label>
                    <input type="text" class="form-control" name="ape2" value="<?php echo $row['ape2']; ?> " readonly>
                  </div>
                  <div class="form-group">
                    <label for="">Especialidad</label>
                    <select class="form-select mb-3 form-control" name="codespecialidad" id="nomespecialidad">
                      <option select disabled>Seleccionar Especialidad</option>
                      <?php
                      require_once "conexion.php";
                      $conexion = retornarConexion();
                      $sql = $conexion->query("SELECT * FROM especialidad  ");
                      while ($resultado = $sql->fetch_assoc()) {
                        echo "<option value='" . $resultado['codespecialidad'] . "'>" . $resultado['nomespecialidad'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="telefonomedico">Telefono</label>
                    <input type="text" class="form-control" name="telefonomedico" value="<?php echo $row['telefonomedico']; ?> ">
                  </div>
                  <div class="form-group">
                    <label for="correomedico">Correo</label>
                    <input type="text" class="form-control" name="correomedico" value="<?php echo $row['correomedico']; ?> ">
                  </div>
                  <div class="card bg-primary text-center text-white">
                    <h5>Contacto Alterno en Caso de Emergencia</h5>
                  </div>
                  <div class="form-group">
                    <label for="nomalt">Nombre</label>
                    <input type="text" class="form-control" name="nomalt" value="<?php echo $row['nomalt']; ?> ">

                    <div class="form-group">
                      <label for="apealt">Apellido</label>
                      <input type="text" class="form-control" name="apealt" value="<?php echo $row['apealt']; ?> ">
                      <div class="form-group">
                        <label for="tlfalt">Telefono</label>
                        <input type="text" class="form-control" name="tlfalt" value="<?php echo $row['tlfalt']; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Parentesco</label>
                        <input type="text" class="form-control" name="relacion" value="<?php echo $row['relacion']; ?> ">
                      </div>
                      <div class="card bg-purple text-center text-white">
                      <h5>Dias que atiende el médico</h5>
                    </div>
                      <?php
                  require_once("conexion.php");
                  $conexion = retornarConexion();
                  // Codigo php que muestra en el formulario los dias que atiende cada medico
                  $cedulaMedico = mysqli_real_escape_string($conexion, $_GET['cedulamedico']);
                  $sql = "SELECT horario.dia FROM horario INNER JOIN medico ON horario.cedulamedico = medico.cedulamedico WHERE medico.cedulamedico = '$cedulaMedico'";
                  $resultado = $conexion->query($sql);

                  $dias = []; // Este array es para almacenar los días

                  if ($resultado) {
                    while ($row = $resultado->fetch_assoc()) {
                      $dias[] = $row['dia']; // Agregar cada día al array
                    }
                    // Unir los días en una sola cadena
                    $diasString = implode(', ', $dias);
                    echo "<input type='text' class='form-control' name='dias' value='" . htmlspecialchars($diasString) . "'>";
                  } else {
                    echo "Error en la consulta: " . $conexion->error;
                  }
                  ?>

                        <br>
                        <div class="card bg-primary text-center text-white">
                          <h5>Modificar dias de atención</h5>
                        </div>
                        <div class="form-group">
                          <label><input type="checkbox" name="dias[]" value="Lunes"> Lunes</label>
                          <label><input type="checkbox" name="dias[]" value="Martes"> Martes</label>
                          <label><input type="checkbox" name="dias[]" value="Miércoles"> Miércoles</label>
                          <label><input type="checkbox" name="dias[]" value="Jueves"> Jueves</label>
                          <label><input type="checkbox" name="dias[]" value="Viernes"> Viernes</label>
                        </div>
                        <hr>
                        <div class="form-group">
                          <button type="submit" class="btn btn-warning" id="btn-editar" name="btn-editar">Modificar</button>
                          
                          <a href="medicos.php" class="btn btn-primary">Regresar</a>
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
    </section>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
  <script src="plugins/jquery/jquery-3.6.0.min.js"></script>
<script src="js/sweetalert2@11.js"></script>

<script>
  $('#btn-editar').click(function() {
    Swal.fire(
      'Atención!',
      'Los datos se modificaron correctamente',
      'danger'
    )
  });
</script>
  <?php
  include_once("footer.php");
  ?>