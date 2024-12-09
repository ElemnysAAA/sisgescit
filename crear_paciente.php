<?php

include_once "header.php";

?>
<link rel="stylesheet" href="dist/css/bootstrap.min.css">

<title>SISGECIT| Pacientes</title>



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-7">
          <h1>Registrar Paciente</h1><br>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
            Registrar Paciente
          </button>
          <a href="pacientes.php" class="btn btn-danger">
            Regresar
          </a>


          <!-- /.modal-content -->
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
          <h4 class="modal-title">Agendar Cita</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body btn-primary">
          <h3 class="card-title">Ingresar Datos</h3>
        </div>
        <form action="model/crear_paciente_model.php" method="POST">
          <div class="form-group">
            <div class="card-body">
              <div class="row g-4"> <!-- apertura de etiqueta div con clases de bootstrap que asigna cuantos intems del formulario pueden estar en fila -->
                <div class="col-lg-3 text-center">
                  <label for="CedulaPaciente">Cédula</label>
                  <div class="input-group">
                    <select name="TipoCedula" id="TipoCedula" class="form-control" style="width: 10px;padding: 0.300rem 0.25rem;">
                      <option value="V">V-</option>
                      <option value="E">E-</option>
                    </select>
                    <input type="text" class="form-control" name="NumeroCedula" id="NumeroCedula" placeholder="Ej.V-12345678" maxlength="8" required>
                  </div>
                </div>
                <div class="col-lg-3 text-center">
                  <label for="nombre1">Primer Nombre</label>
                  <input type="text" class="form-control" name="nombre1" id="nombre1" placeholder="Primer Nombre" style="text-transform: capitalize;">
                </div>
                <div class="col-lg-3 text-center">
                  <label for="apellido1">Primer Apellido</label>
                  <input type="text" class="form-control" name="apellido1" id="apellido1" placeholder="Primer Apellido" style="text-transform: capitalize;">
                </div>
                <div class="col-lg-3 text-center">
                  <label for="telefono1">Teléfono</label>
                  <div class="input-group">
                    <select name="codigoarea" class="form-control" id="codigoarea">
                      <option value="0416">0416</option>
                      <option value="0426">0426</option>
                      <option value="0424">0424</option>
                      <option value="0414">0414</option>
                      <option value="0412">0412</option>
                    </select>
                    <input type="text" class="form-control" name="telefono1" placeholder="000-0000" maxlength="7">
                  </div>
                </div>
              </div><br>
              <div class="card bg-primary text-center text-white">
                <h5>Agendar Cita</h5>
              </div>
              <div class="row g-4">
                <div class="col-lg-3 text-center">
                  <label for="tipocita">Tipo de Cita</label>
                  <select class="form-control" name="tipocita" id="tipocita">
                    <option value="" disabled selected>Seleccionar</option>
                    <option value="Primera_vez">Primera Vez</option>
                  </select>
                </div>
                <div class="col-lg-3 text-center">
                  <label for="">Especialidad</label>
                  <select class="form-select mb-3 form-control" name="codespecialidad" id="nomespecialidad" type="text">
                    <option select disabled-->Seleccionar Especialidad--</option>
                    <?php
                    require_once("conexion.php");
                    $conexion = retornarConexion();
                    $sql = $conexion->query("SELECT * FROM especialidad");
                    while ($resultado = $sql->fetch_assoc()) {
                      echo "<option value='" . $resultado['codespecialidad'] . "'>" . $resultado['nomespecialidad'] . "</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="col-lg-3 text-center">
                  <label for="">Médico</label>
                  <select class="form-select mb-3 form-control" name="cedulamedico" id="cedulamedico" type="text" disabled>
                    <option select disabled>-- Médico --</option>
                  </select>
                </div>
                <div class="col-lg-3 text-center">
                  <label for="">Días de Atención</label>
                  <input type="text" class="form-control" name="dias" id="dias" readonly>
                </div>
                <div class="col-lg-3 text-center">
                  <label for="">Fechas Disponibles</label>
                  <select class="form-control" id="fecha" name="fecha">
                    <option value="" disabled selected>Seleccionar Fecha</option>
                    <!-- Se llenará dinámicamente -->
                  </select>
                </div>
                <div class="ol-lg-3 text-center">
                  <label for="">Fecha de la Cita</label>
                  <input type="date" class="form-control" name="fechacita" id="fechacita" value=" <?php echo $row['CedulaPaciente']; ?>">
                </div>
                <div class="col-lg-3 text-center">
                  <label for="">Correo</label>
                  <input type="text" class="form-control" id="correopaciente" name="correopaciente" placeholder="Ingrese el correo" require>
                </div>
              </div>
            </div><br>
            <div class="card bg-primary text-center text-white">
              <h5>Contacto Alterno en Caso de Emergencia</h5>
            </div>
            <div class="row g-4">
              <div class="col-lg-3 text-center">
                <label for="">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre" style="text-transform: capitalize;" require>
              </div>
              <div class="col-lg-3 text-center">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" name="apellido" placeholder="Apellido" style="text-transform: capitalize;">
              </div>
              <div class="col-lg-3 text-center">
                <label for="">Telefono</label>
                 <div class="input-group">
                    <select name="codigoarea" class="form-control" id="codigoarea">
                      <option value="0416">0416</option>
                      <option value="0426">0426</option>
                      <option value="0424">0424</option>
                      <option value="0414">0414</option>
                      <option value="0412">0412</option>
                    </select>
                <input type="text" class="form-control" name="telefono2" placeholder="Teléfono" maxlength="11" style="text-transform: capitalize;" require>
              </div>
              </div>
              <div class="col-lg-3 text-center">
                <label for="">Parentesco</label>
                <input type="text" class="form-control" name="parentesco" placeholder="Parentesco" style="text-transform: capitalize;">
              </div>
            </div>
            <input type="hidden" name="status" value="Pendiente">
            <br>
            <div class="modal-footer ">
              <button type="submit" class="btn btn-user btn-primary  " id="btn-user" name="btn-user">Guardar</button>
              <a href="crear_paciente.php" class="btn btn-danger">Salir</a>
            </div>
          
      </div>
      </form>
    </div>
  </div>
</div>
</div>
<script src="plugins/jquery/jquery-3.6.0.min.js"></script>
<script src="js/especialidadmed.js"></script>
<script src="js/horario.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.js"></script>
<script src="js/sweetalert2@11.js"></script>

<script>
  //boton de bootstrap
$('#btn-user').click(function(){
    Swal.fire(
    'Exito!',
    'Cita agendada',
    'success'
    )
});
</script>


<script>  
$(document).ready(function() {  
    // Cargar médicos cuando se selecciona una especialidad  
    $('#nomespecialidad').on('change', function() {  
        const codespecialidad = $(this).val();  
        $.post('model/get_medicos.php', {  
            codespecialidad: codespecialidad  
        }, function(data) {  
            $('#cedulamedico').html(data);  
            $('#cedulamedico').prop('disabled', false);  
        });  
    });  

    // Al seleccionar un médico  
    $('#cedulamedico').on('change', function() {  
        const cedulamedico = $(this).val();  
        if (cedulamedico) {  
            $.post('model/obtener_diafecha.php', {  
                cedulamedico: cedulamedico  
            }, function(data) {  
                const result = JSON.parse(data);  
                $('#dias').val(result.dias);  
                $("#fecha").html("");  
                result.fechas.forEach(function(fecha) {  
                    $("#fecha").append(`<option value="${fecha.fechacita}">${fecha.fechacita} - Cupos Disponibles: ${fecha.cupos_disponibles} de 15</option>`);  
                });  
            });  
        } else {  
            $('#dias').val("");  
            $("#fecha").html("");  
        }  
    });  
});  
</script> 
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const inputFechacita = document.getElementById('fechacita');
    const fechasBloqueadas = <?php echo json_encode($fechasBloqueadasArray); ?>;

    inputFechacita.setAttribute('min', new Date().toISOString().split("T")[0]); // Establecer la fecha mínima  

    // Bloquea las fechas disponibles  
    for (let fecha of fechasBloqueadas) {
      let formattedDate = new Date(fecha).toISOString().slice(0, 10); // Formato YYYY-MM-DD  
      let option = document.createElement('option');
      option.value = formattedDate;
      inputFechacita.addEventListener('change', function() {
        if (this.value === formattedDate) {
          alert('Esta fecha está completamente ocupada. Por favor, elija otra fecha.');
          this.value = '';
        }
      });
    }
  });
</script>

<?php
include_once "footer.php";
?>