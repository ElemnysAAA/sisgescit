<?php

include_once("header.php");
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
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">




</head>

<body class="bg-gradient-primary">

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Paciente</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active">Historia del Paciente</li>
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
          <div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ingresar Datos</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  action="model/editar_paciente_model.php" method="POST">
                <?php
                require_once("conexion.php");
                $conexion = retornarConexion();
                $sql = "SELECT * FROM paciente WHERE CedulaPaciente=" . $_GET['CedulaPaciente'];
                $resultado = $conexion->query($sql);
                $row = $resultado->fetch_assoc();
                ?>
                <!--input para identificar la cedula del paciente que se va a modificar-->
                <input type="Hidden" class="form-control" name="CedulaPaciente" value=" <?php echo $row['CedulaPaciente']; ?>">

                <div class="card-body">
           
                  <div class="form-group">
                    <label for="nombre1">Primer Nombre</label>
                    <input type="text" class="form-control" name="nombre1" id="nombre1" value=" <?php echo $row['nombre1']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="nombre2">Segundo Nombre</label>
                    <input type="text" class="form-control" name="nombre2" id="nombre2" value=" <?php echo $row['nombre2']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="apellido1">Primer Apellido</label>
                    <input type="text" class="form-control" name="apellido1" id="apellido1" value=" <?php echo $row['apellido1']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="apellido2">Segundo Apellido</label>
                    <input type="text" class="form-control" name="apellido2" id="apellido2" value=" <?php echo $row['apellido2']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="lugarnac">Lugar de Nacimiento</label>
                    <input type="text" class="form-control" name="lugarnac" id="lugarnac" value=" <?php echo $row['lugarnac']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="fecha">Fecha de Nacimiento</label>
                    <input type="text" class="form-control" name="fecha" id="fecha" value=" <?php echo $row['fecha']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="edad">Edad</label>
                    <input type="text" class="form-control" name="edad" id="edad" value=" <?php echo $row['edad']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="genero">Genero</label>
                    <input type="text" class="form-control" name="genero" id="genero" value=" <?php echo $row['genero']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="telefono1">Telefono</label>
                    <input type="text" class="form-control" name="telefono1" id="telefono1" value=" <?php echo $row['telefono1']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="telefonoalterno">Telefono Alterno</label>
                    <input type="text" class="form-control" name="telefonoalterno" id="telefonoalterno" value=" <?php echo $row['telefonoalterno']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="correopaciente">Correo</label>
                    <input type="text" class="form-control" name="correopaciente" id="correopaciente" value=" <?php echo $row['correopaciente']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="">Estado</label>
                    <select name="idEstado" class="form-select mb-3 form-control" aria-label="Default select example" id="idEstado">
                      <option select disabled>Seleccione Estado</option>
                      <?php
                      require_once("conexion.php");
                      $conexion = retornarConexion();
                      $CedulaPaciente = $row['CedulaPaciente'];
                      $sql1 = "SELECT * FROM estados";
                      $resultado1 = $conexion->query($sql1);

                      while ($row1 = $resultado1->fetch_assoc()) {
                        $selected = ($row1['idEstado'] == $row['idEstado']) ? 'selected' : '';
                        echo "<option value='" . $row1['idEstado'] . "' $selected>" . $row1['nomestado'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="idMcpio">Municipio</label>
                    <select  class="form-select mb-3 form-control" aria-label="Default select example" name="idMcpio" id="idMcpio">
                      <option select disabled>Seleccione Municipio</option>
                      <?php
                      $sql2 = "SELECT * FROM municipios";
                      $resultado2 = $conexion->query($sql2);
                      while ($row2 = $resultado2->fetch_assoc()) {
                        $selected = ($row2['idMcpio'] == $row['idMcpio']) ? 'selected' : '';
                        echo "<option value='" . $row2['idMcpio'] . "' $selected>" . $row2['nommcipio'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="idPquia">Parroquia</label>
                    <select name="idPquia" class="form-select mb-3 form-control" aria-label="Default select example" id="idPquia">
                      <option select disabled>Seleccione Parroquia</option>
                      <?php
                      $sql3 = "SELECT * FROM parroquias";
                      $resultado3 = $conexion->query($sql3);

                      while ($row3 = $resultado3->fetch_assoc()) {
                        $selected = ($row3['idPquia'] == $row['idPquia']) ? 'selected' : '';
                        echo "<option value='" . $row3['idPquia'] . "' $selected>" . $row3['nompquia'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Direccion</label>
                    <input type="tex" class="form-control" name="direccion" id="direccion" value=" <?php echo $row['direccion']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="">Grado de Instrucción</label>
                    <input type="tex" class="form-control" name="nivel" id="nivel" value=" <?php echo $row['nivel']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="">Estado Civil</label>
                    <input type="tex" class="form-control" name="edocivil" id="edocivil" value=" <?php echo $row['edocivil']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="">Ocupación</label>
                    <input type="tex" class="form-control" name="ocupacion" id="ocupacion" value=" <?php echo $row['ocupacion']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="">Trabajador/Estudiante</label>
                    <input type="tex" class="form-control" name="condicion" id="condicion" value=" <?php echo $row['condicion']; ?>">
                  </div>
                  <hr>
                  <div class="card bg-success text-center text-white">
                    <h5>Contacto Alterno en Caso de Emergencia</h5>
                  </div>
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value=" <?php echo $row['nombre']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" name="apellido" id="apellido"  value=" <?php echo $row['apellido']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="telefono2">Telefono</label>
                    <input type="text" class="form-control" name="telefono2" id="telefono2" value=" <?php echo $row['telefono2']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="parentesco">Parentesco</label>
                    <input type="text" class="form-control" name="parentesco" id="parentesco" value=" <?php echo $row['parentesco']; ?>">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="btn-editar">Modificar</button>
                    <button type="submit" class="btn btn-danger" name="btn-eliminar">Eliminar</button>
                    <a href="pacientes.php" class="btn btn-success">Regresar</a>
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
  </section>
  <!-- /.row -->
  <!-- /.container-fluid -->

  <!-- /.content -->
  </div>
  <?php
  include_once("footer.php");
  ?>