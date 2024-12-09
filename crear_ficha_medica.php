<?php

include_once "header.php";

?>

<title>SISGECIT| Pacientes</title>


<link rel="stylesheet" href="dist/css/bootstrap.min.css">
<link rel="stylesheet" href="js/jquery.dataTables.min.css">
<link rel="stylesheet" href="dist/css/fixedHeader.dataTables.min.css">

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Registrar Paciente</h1><br>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
            Aperturar Ficha Medica
          </button>
          <a href="pacientes.php" class="btn btn-danger">
            Regresar
          </a>

        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </div>
  </section>
  <section class="content-header">
  <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo Registro</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body btn-primary">
          <h3 class="card-title">Ingresar todos los datos en el formulario</h3>
        </div>
        <form action="model/crear_fichamedica_model.php" method="POST">
          <?php
          require_once("conexion.php");
          $conexion = retornarConexion();
          if (isset($_GET['CedulaPaciente'])) {
            $cedulaPaciente = mysqli_real_escape_string($conexion, $_GET['CedulaPaciente']);
            $sql = "SELECT * FROM paciente WHERE CedulaPaciente='$cedulaPaciente'";
            $resultado = $conexion->query($sql);
            $row = $resultado->fetch_assoc();
          }

          ?>
          <input class="form-control" type="Hidden" name="CedulaPaciente" value=" <?php echo $row['CedulaPaciente']; ?>">
          <div class="row g-5">
            <div class="form-group">
              <div class="card-body">
                <div class="row g-4"> <!-- apertura de etiqueta div con clases de bootstrap que asigna cuantos intems del formulario pueden estar en fila -->
                  <div class="col-lg-3 text-center"> <!-- apertura de etiqueta div con clases de bootstrap que permite a los items del formulario colocarlos uno al lado del otro -->
                    <label for="CedulaPaciente">Cédula</label>
                    <input type="text" class="form-control" name="CedulaPaciente" value="<?php echo $row['CedulaPaciente']; ?>" readonly>
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="nombre1">Primer Nombre</label>
                    <input type="text" class="form-control" name="nombre1" id="nombre1" value=" <?php echo $row['nombre1']; ?>" style="text-transform: capitalize;" >
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="nombre2">Segundo Nombre</label>
                    <input type="text" class="form-control" name="nombre2" placeholder="Segundo Nombre" style="text-transform: capitalize;" >
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="apellido1">Primer Apellido</label>
                    <input type="text" class="form-control" name="apellido1" id="apellido1" value=" <?php echo $row['apellido1']; ?>" style="text-transform: capitalize;" >
                  </div>
                </div><br>
                <div class="row g-4">
                  <div class="col-lg-3 text-center">
                    <label for="apellido2">Segundo Apellido</label>
                    <input type="text" class="form-control" name="apellido2" placeholder="Segundo Apellido" style="text-transform: capitalize;" >
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="lugarnac">Lugar de Nacimiento</label>
                    <input type="text" class="form-control" name="lugarnac" placeholder="Lugar de Nacimiento" style="text-transform: capitalize;" >
                  </div>

                  <div class="col-sm-3 text-center">
                    <label for="fecha">Fecha de Nacimiento</label>
                    <input type="date" name="fecha" id="fecha" onchange="calculateAge()" class="form-control">
                  </div>
                  <div class="col-sm-3 text-center">
                    <label for="edad">Edad</label>
                    <input type="text" name="edad" id="edad" readonly class="form-control">
                  </div>
                </div><br>
                <div class="row g-4">
                  <div class="col-lg-3 text-center"> <!-- apertura de etiqueta div con clases de bootstrap que permite a los items del formulario colocarlos uno al lado del otro -->
                    <label for="">Genero</label>
                    <select name="genero" class="form-control"><!-- etiqueta label que esta vinculada un input -->
                      <option value="">Selecciona</option>
                      <option value="femenino">Femenino</option>
                      <option value="masculino">Masculino</option>
                    </select>
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="">Teléfono</label>
                    <input type="text" class="form-control" name="telefono1" placeholder="(04241234567)" maxlength="11" value=" <?php echo $row['telefono1']; ?>">
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="">Telefono Alterno</label>
                    <input type="text" class="form-control" name="telefonoalterno" placeholder="(04241234567)" maxlength="11">
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="">Correo Electrónico</label>
                    <input class="form-control" type="email" name="correopaciente" placeholder="Correo Electrónico">
                  </div>
                </div><br>
                <div class="row g-4 text-center">
                  <div class="col-lg-3 text-center">
                    <label for="">Estado</label>
                    <select class="form-select mb-3 form-control" name="idEstado" id="nomestado" type="text">
                      <option select disabled>-- Estados --</option>
                      <?php
                      require_once "conexion.php";
                      $conexion = retornarConexion();
                      $sql = $conexion->query("SELECT * FROM estados");
                      while ($resultado = $sql->fetch_assoc()) {
                        echo "<option value='" . $resultado['idEstado'] . "'>" . $resultado['nomestado'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="">Municipio</label>
                    <select class="form-select mb-3 form-control" name="idMcpio" id="nommcipio" type="text" disabled>
                      <option value="" disabled selected>Seleccionar</option>
                      <option select disabled>-- Municipios --</option>
                    </select>
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="">Parroquia</label>
                    <select class="form-select mb-3 form-control" name="idPquia" id="nompquia" type="text" disabled>
                      <option value="" disabled selected>Seleccionar</option>
                      <option select disabled>-- Parroquias --</option>
                    </select>
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control" name="direccion" placeholder="Complete la direccion">
                  </div> <!-- cierre de etiqueta div que permite a los items del formulario colocarlos uno al lado del otro -->
                </div><br>
                <div class="row g-4">
                  <div class="col-lg-3 ">
                    <label for="nivel">Grado de Instrucción</label><br>
                    <select name="nivel" id="nivel" class="form-control">
                      <option value="primaria">Primaria</option>
                      <option value="bachiller">Bachiller</option>
                      <option value="universitario">Universitario</option>
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <label for="edocivil">Estado Civil</label><br>
                    <select name="edocivil" id="edocivil" class="form-control">
                      <option value="soltero(a)">Soltero(a)</option>
                      <option value="casado(a)">Casado(a)</option>
                      <option value="divorciado(a)">Divorciado(a)</option>
                      <option value="viudo(a)">Viuda(a)</option>
                    </select>
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="ocupacion">Ocupación</label>
                    <input type="text" class="form-control" name="ocupacion" id="ocupacion" placeholder="Ingrese la Ocupación">
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="condicion">Trabajador/Estudiante</label>
                    <select name="condicion" id="condicion" class="form-control">
                      <option value="Trabajador">Trabajador</option>
                      <option value="Estudiante">Estudiante</option>
                    </select>

                  </div>
                </div>
                <hr>
                <div class="card bg-primary text-center text-white">
                  <h5>Contacto Alterno en Caso de Emergencia</h5>
                </div>
                <div class="row g-4">
                  <div class="col-lg-3 text-center">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value=" <?php echo $row['nombre']; ?>" placeholder="Nombre" style="text-transform: capitalize;">
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" value=" <?php echo $row['apellido']; ?>" placeholder="Apellido" style="text-transform: capitalize;">
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="telefono2">Telefono</label>
                    <input type="phone" class="form-control" name="telefono2" id="telefono2" value=" <?php echo $row['telefono2']; ?>" placeholder="Telefono Alterno" maxlength="11">
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="parentesco">Parentesco</label>
                    <input type="phone" class="form-control" name="parentesco" id="parentesco" value=" <?php echo $row['parentesco']; ?>" placeholder="Parentesco" style="text-transform: capitalize;">
                  </div>
                </div>
                <hr>
                <div class="card bg-primary text-center text-white">
                  <h5>Antecedentes Medicos | Solo de uso en Enfermería</h5>
                </div>
                <div class="row g-3">
                  <div class="col-lg-5 text-center">
                    <label for="">Presion Arterial</label><br>
                    <div class="input-group">
                      <input type="text" class="form-control" name="tensionalta" id="tensionalta" placeholder="Sistólica (Alta)"  >
                      <input type="text" class="form-control" name="tensionbaja" id="tensionbaja" placeholder="Diastólica (Baja)"  >
                    </div>
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="">Temperatura</label><br>
                    <input type="text" class="form-control" name="temperatura" id="temperatura" placeholder="Temp °C" >
                  </div>
                  <div class="col-lg-3 text-center">
                    <label for="hora">Registro de Hora</label><br>
                    <input type="time" class="form-control" name="hora" id="hora" >
                  </div>
                </div><br>
                <div class="row g-3">
                  <div class="col-lg-4 text-center">
                    <label for="peso">Peso</label><br>
                    <input type="text" class="form-control" name="peso" id="peso" placeholder="Ej: 70" >
                    <small class="text-muted" disabled>Ejemplo: 70 (en Kg)</small>
                  </div>
                  <div class="col-lg-4 text-center">
                    <label for="estatura">Estatura</label>
                    <input type="text" name="estatura" class="form-control" id="estatura" placeholder="Ej: 1.75" >
                    <small class="text-muted">Ejemplo: 1.75 (en Mtrs)</small>
                  </div>
                  <div class="col-lg-4 text-center">
                    <label for="tipodesangre">Tipo de Sangre</label>
                    <select name="tipodesangre" class="form-control" id="tipodesangre" >
                      <option value="" disabled selected>Seleccione</option>
                      <option value="A+">A+</option>
                      <option value="A-">A-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                      <option value="O+">O+</option>
                      <option value="O-">O-</option>
                      <option value="No_Sabe">No Sabe</option>
                    </select>
                  </div>
                </div>
                <br>
                <div class="row g-6">
                  <div class="col-lg-3">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="alergia" id="alergia" >
                      <label class="form-check-label" for="alergia">Alergia</label>
                    </div>
                    <input type="text" class="form-control mt-2" name="tipoAlergia" placeholder="Tipo de Alergia" > <br>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="artritis" id="artritis" >
                      <label class="form-check-label" for="artritis">Artritis</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="varices" id="varices" >
                      <label class="form-check-label" for="varices">Varices</label>
                    </div>
                  </div>
                  <div class="col-lg-3">

                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="protesis" id="protesis" disable>
                      <label class="form-check-label" for="protesis">Prótesis</label>
                    </div>
                    <input type="text" class="form-control mt-2" name="tipoProtesis" placeholder="Tipo de Prótesis" disable> <br>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="asma" id="asma" disable>
                      <label class="form-check-label" for="asma">Asma</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="cancer" id="cancer" disable>
                      <label class="form-check-label" for="cancer">Cáncer</label>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="cirugia" id="cirugia" >
                      <label class="form-check-label" for="cirugia">Cirugías</label>
                    </div>
                    <input type="text" class="form-control mt-2" name="tipoCirugia" placeholder="Cirugía" > <br>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="hipertension" id="hipertension" >
                      <label class="form-check-label" for="hipertension">Hipertensión</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="gastroenteritis" id="gastroenteritis">
                      <label class="form-check-label" for="gastroenteritis">Gastroenteritis</label>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="diabetes" id="diabetes" >
                      <label class="form-check-label" for="diabetes">Diabetes</label>
                    </div>
                    <input type="text" class="form-control mt-2" name="tipoDiabetes" placeholder="Tipo de Diabetes" > <br>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="alcohol" id="alcohol" >
                      <label class="form-check-label" for="alcohol">Alcohol</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="drogas" id="drogas" >
                      <label class="form-check-label" for="drogas">Drogas</label>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="card bg-purple disabled text-center text-white">
                  <h5>Solo de Uso Médico</h5>
                </div>
                <div class="row g-3">
                  <div class="col-4 text-center">
                    <label for="diagnostico">Diágnostico</label><br>
                    <textarea class="form-control" row="6" name="diagnostico" id="diagnostico"  placeholder="Diagnostico"></textarea>
                  </div>
                  <div class="col-lg-4 text-center">
                    <label for="">Medicamentos</label>
                    <input type="text" class="form-control" name="medicamentos"  placeholder="Medicamentos">
                  </div>
                  <div class="col-lg-4 text-center">
                    <label for="">Observaciones</label>
                    <input type="text" class="form-control" name="observaciones"  placeholder="Observaciones">
                  </div>
                </div>
              </div>
           
              <div class="modal-footer">
                <button type="submit" class="btn btn-user btn-primary" name="btn-user">Guardar</button>
                <a href="crear_ficha_medica.php.php" class="btn btn-danger">Salir</a>
              </div>
            </div>
            </div>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
  </section>
</div>

<script src="js/sweetalert2@11.js"></script>
<script src="plugins/jquery/jquery-3.6.0.min.js"></script>
<script>
  //boton de bootstrap
  $('#btn-user').click(function() {
    Swal.fire(
      'Exito!',
      'Ficha creada correctamente',
      'success'
    )
  });
</script>

<script>
  //Script que permite calcular la edad automaticamente se ingrese la fecha de nacimiento
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
<script src="plugins/jquery/jquery-3.6.0.min.js"></script>
<script src="js/sweetalert2@11.js"></script>

<script>
  //Script que permite relacionar los estados con su municipios y parroquias
  $(document).ready(function() {
    $("#nomestado").change(function() {
      var estadoId = $(this).val();
      // Limpiar y deshabilitar los selects de municipio y parroquia  
      $("#nommcipio").empty().append('<option select disabled>-- Municipios --</option>').prop('disabled', true);
      $("#nompquia").empty().append('<option select disabled>-- Parroquias --</option>').prop('disabled', true);
      if (estadoId) {
        $.ajax({
          url: 'model/get_municipios.php',
          type: 'POST',
          data: {
            idEstado: estadoId
          },
          success: function(data) {
            $("#nommcipio").html(data).prop('disabled', false);

            // Verificar si solo hay un municipio  
            if ($("#nommcipio option").length === 2) { // 1 option + 1 disabled option  
              $("#nommcipio").prop('selectedIndex', 1).change(); // Seleccionar el único municipio  
            }
          }
        });
      }
    });
    $("#nommcipio").change(function() {
      var municipioId = $(this).val();
      // Limpiar el select de parroquia  
      $("#nompquia").empty().append('<option select disabled>-- Parroquias --</option>').prop('disabled', true);
      if (municipioId) {
        $.ajax({
          url: 'model/get_parroquias.php',
          type: 'POST',
          data: {
            idMcpio: municipioId
          },
          success: function(data) {
            $("#nompquia").html(data).prop('disabled', false);
            // Verificar si solo hay una parroquia  
            if ($("#nompquia option").length === 2) { // 1 option + 1 disabled option  
              $("#nompquia").prop('selectedIndex', 1); // Seleccionar la única parroquia  
            }
          }
        });
      }
    });
  });
</script>
<?php
include_once "footer.php";
?>