<?php

include_once 'header.php';
?>

<title>SISGECIT| Ficha Medica</title>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Historia Medica</h1>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-lg">
            Apertura de Historia
          </button>
          <a href="consultadehistorias.php" class="btn btn-danger">
            Regresar
          </a>

          <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Historia Medica del Paciente</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body btn-primary">
                  <h3 class="card-title">Datos del Paciente</h3>
                </div>
                <form action="model/historia_paciente_model.php" method="POST">
                  <div class="form-group">
                    <div class="card-body">
                      <div class="row g-4"> <!-- apertura de etiqueta div con clases de bootstrap que asigna cuantos intems del formulario pueden estar en fila -->
                        <div class="form-group">
                          <label for="">Paciente</label>
                          <select class="form-select mb-3 form-control" name="codespecialidad" type="text">
                            <option select disabled-->Seleccionar Paciente--</option>
                            <?php
                            require_once("conexion.php");
                            $conexion = retornarConexion();

                            $sql = "SELECT * FROM paciente WHERE nombre1 LIKE '%$datoBusqueda%' OR apellido1 LIKE '%$datoBusqueda%'";
                            $resultado = $conexion->query($sql);

                            if ($resultado->num_rows > 0) {
                              // Si se encuentra al paciente, mostrar los datos
                              while ($row = $resultado->fetch_assoc()) {
                                echo "ID: " . $row["CedulaPaciente"] . " - Nombre: " . $row["nombre1"] . " " . $row["apellido1"] . "<br>";
                                // Aquí puedes agregar más campos a mostrar
                              }
                            } else {
                              echo "Paciente no encontrado";
                            }
                      ?>
                          </select>
                        </div>
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

                            // Suponiendo que $paciente es el ID del paciente que estás editando
                            $CedulaPaciente = $row['CedulaPaciente']; // Cambia esto según tu lógica
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
                          <select class="form-select mb-3 form-control" aria-label="Default select example" name="idMcpio" id="idMcpio">
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
                          <label for="direccion">Direccion de Habitación</label>
                          <input type="tex" class="form-control" name="direccion" id="direccion" value=" <?php echo $row['direccion']; ?>">
                        </div>lario colocarlos uno al lado del otro -->
                      </div><br>
                      <div class="row g-4">
                        <div class="col-lg-3">
                          <label for="nivel">Grado de Instrucción</label><br>
                          <label for="primaria">Primaria</label>
                          <input type="checkbox" name="" id=""><br>
                          <label for="bachiller">Bachiller</label>
                          <input type="checkbox" name="" id=""><br>
                          <label for="universitario">Universitario</label>
                          <input type="checkbox" name="" id="">
                        </div>
                        <div class="col-lg-3">
                          <label for="civil">Estado Civil</label><br>
                          <label for="soltero">Soltero</label>
                          <input type="checkbox" name="soltero" id="soltero"><br>
                          <label for="casado">Casado</label>
                          <input type="checkbox" name="casado" id="casado"><br>
                          <label for="divorciado">Divorciado</label>
                          <input type="checkbox" name="divorciado" id="divorciado"><br>
                          <label for="viudo">Viudo</label>
                          <input type="checkbox" name="viudo" id="viudo"><br>
                        </div>
                        <div class="col-lg-3">
                          <label for="ocupación">Ocupación</label>
                          <input type="text" class="form-control" name="ocupación" id="ocupación" placeholder="Ingrese la Ocupación">
                        </div>
                        <div class="col-lg-3">
                          <label for="ocupación">Trabajador/Estudiante</label>
                          <input type="text" class="form-control" name="ocupación" id="ocupación" placeholder="Indique si es trabajador o estudiante">
                        </div>
                      </div>

                      <hr>
                      <div class="card bg-primary text-center text-white">
                        <h5>Antecedentes Medicos</h5>
                      </div>
                      <div class="row g-3">
                        <div class="col-lg-4 text-center">
                          <label for="nombre">Peso</label><br>
                          <input type="text" class="form-control" name="peso" id="peso" placeholder="Ingrese el peso">
                        </div>
                        <div class="col-lg-4 text-center">
                          <label for="estatura">Estatura</label>
                          <input type="text" name="estatura" class="form-control" id="estatura" placeholder="Ingrese la estatura">
                        </div>
                        <div class="col-lg-4 text-center">
                          <label for="tipodesangre">Tipo de Sangre</label>
                          <input type="text" name="tipodesangre" class="form-control" id="tipodesangre" placeholder="Ingrese tipo de sangre">
                        </div>
                      </div>
                      <hr>
                      <div class="card bg-primary text-center text-white">
                        <h5>Antecedentes Personales</h5>
                      </div>
                      <div class="row g-6">
                        <div class="col-lg-2 ">
                          <label for="alergia">Alergia</label>
                          <input type="checkbox" name="alergia" id="alergia">
                          <label for="diabetes">Diábetes</label>
                          <input type="checkbox" name="diabetes" id="diabetes">
                          <label for="cirugía">Cirugías</label>
                          <input type="checkbox" name="cirugía" id="cirugía">
                          <label for="protesis">Prótesis</label>
                          <input type="checkbox" name="protesis" id="protesis">
                        </div>
                        <div class="col-lg-2 ">
                          <input type="text" class="form-control btn-xs" style="height:30px; margin:5; width:100px; " name="alergia" id="alergia" placeholder="Tipo de Alergia">
                          <input type="text" class="form-control btn-xs" style="height:30px; margin:5; width:100px; " name="diabetes" id="diabetes" placeholder="Tipo de Diabetes">
                          <input type="text" class="form-control btn-xs" style="height:30px; margin:5; width:100px; " name="cirugía" id="cirugía" placeholder="Cirugía">
                          <input type="text" class="form-control btn-xs" style="height:30px; margin:5; width:100px; " name="protesis" id="protesis" placeholder="Tipo de Protesis">
                        </div>
                        <div class="col-2">
                          <label for="artritis">Artritis</label>
                          <input type="checkbox" name="artritis" id="artritis"><br>
                          <label for="varices">Varices</label>
                          <input type="checkbox" name="varices" id="varices"><br>
                          <label for="asma">Asma</label>
                          <input type="checkbox" name="asma" id="asma"><br>
                          <label for="cancer">Cancer</label>
                          <input type="checkbox" name="cancer" id="cancer"><br>
                        </div>
                        <div class="col-lg-3">
                          <label for="hipertensión">Hipertensión</label>
                          <input type="checkbox" name="hipertensión" id="hipertensión"><br>
                          <label for="astroenteritis">Gastroenteritis</label>
                          <input type="checkbox" name="astroenteritis" id="astroenteritis"><br>
                          <label for="alcohol">Alcohol</label>
                          <input type="checkbox" name="alcohol" id="alcoholhol"><br>
                          <label for="drogas">Drogas</label>
                          <input type="checkbox" name="drogas" id="drogas"><br>
                        </div>
                      </div>
                      <hr>
                      <div class="row g-3">
                        <div class="col-lg-4 text-center">
                          <label for="diagnostico">Diágnostico</label><br>
                          <input type="text" class="form-control" name="diagnostico" id="diagnostico" placeholder="Diágnostico">
                        </div>
                        <div class="col-lg-4 text-center">
                          <label for="medicamentos">Medicamentos</label>
                          <input type="text" name="medicamentos" class="form-control" id="medicamentos" placeholder="Medicamentos">
                        </div>
                        <div class="col-lg-4 text-center">
                          <label for="observaciones">Observaciones</label>
                          <input type="text" name="observaciones" class="form-control" id="observaciones" placeholder="Observaciones">
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="modal-footer ">
                      <button type="submit" class="btn btn-user btn-primary  " name="btn-user">Guardar</button>
                      <a href=""class="btn btn-danger" name="pacientes.php">Salir</a>
                    </div>
                  </div>

              </div>
              <!-- /.card-body -->
              </form>
            </div>

          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
</div>
</div><!-- /.container-fluid -->
</section>

<!-- Main content -->

<!-- /.content -->
</div>

<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
  });
</script>
<script>
  function calculateAge() {
    // Obtén la fecha de nacimiento seleccionada por el usuario
    var birthDate = new Date(document.getElementById("fecha").value);

    // Verifica que la fecha de nacimiento sea válida
    if (isNaN(birthDate)) {
      document.getElementById("edad").value = "Fecha inválida";
      return;
    }

    // Obtén la fecha actual
    var today = new Date();

    // Calcula la diferencia en años
    var age = today.getFullYear() - birthDate.getFullYear();

    // Ajusta la edad si aún no se ha cumplido el cumpleaños este año
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }

    // Muestra la edad calculada en el input correspondiente
    document.getElementById("edad").value = age;
  }
</script>
<?php
include_once 'footer.php';
?>