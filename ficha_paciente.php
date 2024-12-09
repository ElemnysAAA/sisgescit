<?php
include_once("header.php");
require_once("conexion.php");
$conexion = retornarConexion();

if (!isset($_GET['codhistoria'])) {
  echo "Historia no válida.";
  exit();
}

$sql = "SELECT * FROM historiamedica   
        INNER JOIN paciente ON historiamedica.CedulaPaciente = paciente.CedulaPaciente   
        WHERE codhistoria = " . $_GET['codhistoria'];
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
?>

<body class="bg-gradient-primary">

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ficha Medica del Paciente</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active">Editar datos del Paciente</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-10">
            <div class="card card-primary text-center">
              <div class="card-header">
                <h3 class="card-title">Actualizar Datos</h3>
              </div><br>
              <form class="container" action="model/historia_paciente_model.php" method="POST">
                <input type="hidden" name="codhistoria" value="<?php echo $row['codhistoria']; ?>">

                <div class="row g-5">
                  <div class="col-lg-2 text-center">
                    <label for="">Cedula</label>
                    <input class="form-control" type="text" name="CedulaPaciente" value="<?php echo $row['CedulaPaciente']; ?>" maxlength="8" readonly>
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Primer Nombre</label>
                    <input class="form-control" type="text" name="nombre1" value="<?php echo $row['nombre1']; ?>" readonly>
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Segundo Nombre</label>
                    <input type="text" class="form-control" name="nombre2" value=" <?php echo $row['nombre2']; ?>" readonly>
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Primer Apellido</label>
                    <input class="form-control" type="text" name="apellido1" value=" <?php echo $row['apellido1']; ?>" readonly>
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Segundo Apellido</label>
                    <input class="form-control" type="text" name="apellido2" value=" <?php echo $row['apellido2']; ?>" readonly>
                  </div>
                </div><br>

                <div class="row g-5">
                  <div class="col-lg-2 text-center">
                    <label for="">Lugar de Nacimiento</label>
                    <input class="form-control" type="text" name="lugarnac" value=" <?php echo $row['lugarnac']; ?>" readonly>
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Fecha de Nacimiento</label>
                    <input type="text" class="form-control" name="fecha" value=" <?php echo $row['fecha']; ?>" readonly>
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Edad</label>
                    <input type="text" class="form-control" name="edad" value=" <?php echo $row['edad']; ?>" readonly>
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Genero</label>
                    <input type="text" class="form-control" name="genero" value=" <?php echo $row['genero']; ?>" readonly>
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Telefono</label>
                    <input type="text" class="form-control" name="telefono1" value=" <?php echo $row['telefono1']; ?>" maxlength="11">
                  </div>
                </div><br>
                <div class="row g-5">
                  <div class="col-lg-2 text-center">
                    <label for="">Telefono Alterno</label>
                    <input type="number" class="form-control" name="telefonoalterno" value=" <?php echo $row['telefonoalterno']; ?>" maxlength="11">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Correo</label>
                    <input type="text" class="form-control" name="correopaciente" value=" <?php echo $row['correopaciente']; ?>">
                  </div>

                  <div class="col-lg-2 text-center">
                    <label for="">Estado</label>
                    <select class="form-select mb-3 form-control" name="idEstado" id="nomestado">
                      <option selected disabled>-- Estados --</option>
                      <?php
                      require_once "conexion.php";
                      $conexion = retornarConexion();
                      $sql = $conexion->query("SELECT * FROM estados");
                      while ($resultado = $sql->fetch_assoc()) {
                        // Preseleccionar el estado del paciente  
                        $selected = ($resultado['idEstado'] == $row['idEstado']) ? "selected" : "";
                        echo "<option value='" . $resultado['idEstado'] . "' $selected>" . htmlspecialchars($resultado['nomestado']) . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Municipios</label>
                    <select name="idMcpio" class="form-control">
                      <option selected disabled>Selecciona</option>
                      <?php
                      $sql_municipios = $conexion->query("SELECT * FROM municipios WHERE idEstado = {$row['idEstado']}");
                      while ($resultado = $sql_municipios->fetch_assoc()) {
                        // Preseleccionar el municipio del paciente  
                        $selected = ($resultado['idMcpio'] == $row['idMcpio']) ? "selected" : "";
                        echo "<option value='" . $resultado['idMcpio'] . "' $selected>" . htmlspecialchars($resultado['nommcipio']) . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Parroquia</label>
                    <select name="idPquia" class="form-control">
                      <option selected disabled>Selecciona</option>
                      <?php
                      $sql_parroquias = $conexion->query("SELECT * FROM parroquias WHERE idMcpio = {$row['idMcpio']}");
                      while ($resultado = $sql_parroquias->fetch_assoc()) {
                        // Preseleccionar la parroquia del paciente  
                        $selected = ($resultado['idPquia'] == $row['idPquia']) ? "selected" : "";
                        echo "<option value='" . $resultado['idPquia'] . "' $selected>" . htmlspecialchars($resultado['nompquia']) . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row g-5">
                  <div class="col-lg-2 text-center">
                    <label for="">Direccion</label>
                    <input type="text" class="form-control" name="direccion" value=" <?php echo $row['direccion']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Grado de Intruccion </label>
                    <input type="text" class="form-control" name="nivel" value=" <?php echo $row['nivel']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Estado Civil</label>
                    <input type="tex" class="form-control" name="edocivil" value=" <?php echo $row['edocivil']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Ocupación</label>
                    <input type="tex" class="form-control" name="ocupacion" value=" <?php echo $row['ocupacion']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Trabajador/Estudiante</label>
                    <input type="tex" class="form-control" name="condicion" value=" <?php echo $row['condicion']; ?>">
                  </div>
                </div><br>
                <div class="card bg-primary text-center text-white">
                  <h5>Contacto Alterno en Caso de Emergencia</h5>
                </div>
                <div class="row g-5">
                  <div class="col-lg-2 text-center">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value=" <?php echo $row['nombre']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" value=" <?php echo $row['apellido']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="telefono2">Telefono</label>
                    <input type="phone" class="form-control" name="telefono2" id="telefono2" value=" <?php echo $row['telefono2']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="parentesco">Parentesco</label>
                    <input type="phone" class="form-control" name="parentesco" id="parentesco" value=" <?php echo $row['parentesco']; ?>">
                  </div>
                </div>
                <hr>
                <div class="card bg-primary text-center text-white">
                  <h5>Atencedentes Medicos</h5>
                </div>
                <!--Codigo php para mostrar los datos en la interfaz de los datos del paciente y su historia medica-->
                <?php
                $sql = "SELECT * FROM historiamedica WHERE codhistoria = " . $_GET['codhistoria'];
                $resultado = $conexion->query($sql);
                $row = $resultado->fetch_assoc();
                ?>
                <div class="row g-5">
                  <div class="col-lg-2 text-center">
                    <label for="">Tensión Alta</label>
                    <input type="text" class="form-control" name="tensionalta" value="<?php echo $row['tensionalta']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Tensión Baja</label>
                    <input type="text" class="form-control" name="estatura" value="<?php echo $row['tensionbaja']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Temperatura</label>
                    <input type="text" class="form-control" name="temperatura" value="<?php echo $row['temperatura']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Hora</label>
                    <input type="text" class="form-control" name="hora" value="<?php echo $row['hora']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Peso</label>
                    <input type="text" class="form-control" name="peso" value="<?php echo $row['peso']; ?>">
                  </div>
                </div><br>
                <div class="row g-5">
                  <div class="col-lg-2 text-center">
                    <label for="">Estatura</label>
                    <input type="text" class="form-control" name="estatura" value="<?php echo $row['estatura']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Tipo de Sangre</label>
                    <input type="text" class="form-control" name="tipodesangre" value="<?php echo $row['tipodesangre']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Alergia</label>
                    <input type="text" class="form-control" name="alergia" value="<?php echo $row['alergia']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Diabetes</label>
                    <input type="text" class="form-control" name="diabetes" value="<?php echo $row['diabetes']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Cirugia</label>
                    <input type="text" class="form-control" name="cirugia" value="<?php echo $row['cirugia']; ?>">
                  </div>
                </div><br>
                <div class="row g-5">
                  <div class="col-lg-2 text-center">
                    <label for="">Protesis</label>
                    <input type="text" class="form-control" name="protesis" value="<?php echo $row['protesis']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Artrítis</label>
                    <input type="text" class="form-control" name="artritis" value="<?php echo $row['artritis']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Varices</label>
                    <input type="text" class="form-control" name="varices" value="<?php echo $row['varices']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Asma</label>
                    <input type="text" class="form-control" name="asma" value="<?php echo $row['asma']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Cancer</label>
                    <input type="text" class="form-control" name="cancer" value="<?php echo $row['cancer']; ?>">
                  </div>
                </div><br>
                <div class="row g-5">

                  <div class="col-lg-2 text-center">
                    <label for="">Hipertension</label>
                    <input type="text" class="form-control" name="hipertension" value="<?php echo $row['hipertension']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Gastroenteritis</label>
                    <input type="text" class="form-control" name="gastroenteritis" value="<?php echo $row['gastroenteritis']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Alcohol</label>
                    <input type="text" class="form-control" name="alcohol" value="<?php echo $row['alcohol']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Drogas</label>
                    <input type="text" class="form-control" name="drogas" value="<?php echo $row['drogas']; ?>">
                  </div>
                </div><br>
                <div class="row g-5">
                  <div class="col-lg-2 text-center">
                    <label for="">Diagnostico</label>
                    <textarea row="3" class="form-control" name="diagnostico" value="<?php echo $row['diagnostico']; ?>"></textarea>
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Medicamentos</label>
                    <input type="text" class="form-control" name="medicamentos" value="<?php echo $row['medicamentos']; ?>">
                  </div>
                  <div class="col-lg-2 text-center">
                    <label for="">Observaciones</label>
                    <input type="text" class="form-control" name="observaciones" value="<?php echo $row['observaciones']; ?>">
                  </div>
                </div><br>

                  <div class="card bg-primary text-center text-white">
                    <h5>Medico Tratatante</h5>
                  </div>
                  <div class="row g-3">
                    <div class="col-lg-3 text-center">
                      <label for="">Especialidad</label>
                      <select class="form-select mb-3 form-control" name="codespecialidad">
                        <option select disabled>Seleccionar Especialidad</option>
                        <?php
                        $sqlEspecialidad = $conexion->query("SELECT * FROM especialidad");
                        while ($resultado = $sqlEspecialidad->fetch_assoc()) {
                          // Mantener seleccionado al médico tratado del paciente, si existe  
                          $selected = ($resultado['codespecialidad'] == $consulta['codespecialidad']) ? "selected" : "";
                          echo "<option value='" . $resultado['codespecialidad'] . "'>" . $resultado['nomespecialidad'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-lg-3 text-center">
                      <label for="">Médico Tratante</label>
                      <select class="form-select mb-3 form-control" name="cedulamedico">
                        <option select disabled>Seleccionar Médico</option>
                        <?php
                        $sqlMedico = $conexion->query("SELECT * FROM medico");
                        while ($resultado = $sqlMedico->fetch_assoc()) {
                          // Mantener seleccionado al médico tratado del paciente, si existe  
                          $selected = ($resultado['cedulamedico'] == $consulta['cedulamedico']) ? "selected" : "";
                          echo "<option value='" . $resultado['cedulamedico'] . "' $selected>" . $resultado['nom1'] . " " . $resultado['ape1'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-lg-2 text-center">
                      <label for="">Fecha de Apertura</label>
                      <input type="text" class="form-control" name="fechaApertura" value="<?php echo $row['fechaApertura']; ?>">
                    </div>
                    <div>
                    <?php
                  $sql = "SELECT eventos.fechacita FROM eventos 
                  INNER JOIN historiamedica ON historiamedica.codigo = eventos.codigo 
                  WHERE codhistoria = " . $_GET['codhistoria'] . " ORDER BY eventos.fechacita DESC";
                  $resultado = $conexion->query($sql);

                  if ($resultado->num_rows > 0) {
                    echo "<div class='col-lg-12'>";
                    echo "<label for=''>Historial de Citas</label>";
                    echo "<ul class='list-group'>";

                    // Iterar sobre todas las citas  
                    while ($row = $resultado->fetch_assoc()) {
                      echo "<li class='list-group-item'>" . $row['fechacita'] . "</li>";
                    }

                    echo "</ul>";
                    echo "</div>";
                  } else {
                    echo "<div class='col-lg-12'>";
                    echo "<label for=''>Historial de Citas</label>";
                    echo "<p>No hay citas registradas.</p>";
                    echo "</div>";
                  }
                  ?>
</div>
                  </div>

                  <hr>
                  <div class="form-group">
                    <button type="submit" class="btn btn-warning" name="btn-editar">Modificar</button>
                    <a href="consulta_historias.php" class="btn btn-primary">Regresar</a>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


  <!--Script controlador de seleccion de estado coincincida con su municipio y a su vez cada municipio coincida con su prroquia-->

  <?php
  include_once("footer.php");
  ?>