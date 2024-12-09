<?php
include_once("header.php");
?>

<link rel="stylesheet" href="dist/css/bootstrap.min.css">
<link rel="stylesheet" href="js/jquery.dataTables.min.css">  
<link rel="stylesheet" href="dist/css/fixedHeader.dataTables.min.css">  

  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Consulta de Ficha Medica</h1><br>
              <a href="crear_paciente.php" class="btn btn-primary">Cita por primera vez</a>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item active">Consulta</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <style>
                /* Estilos para la tabla */
                table th {
                  background-color: #4b99eb;
                  color: white;
                }

                /* Estilos para el contenedor de la tabla */
                .table-container {
                  width: 100%;
                  overflow-x: auto;
                  margin-top: 20px;
                  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                  border-radius: 8px;
                  background: white;
                  padding: 15px;
                }
              </style>
              <div class="download-buttons">
                <ol class="breadcrumb float-sm-right">
                  <button id="download-pdf" class="btn btn-danger"><i class="fas fa-file-pdf"></i></button>
                  <button id="download-excel" class="btn btn-success"><i class="fas fa-file-csv"></i></button>
              </div> <br>

              <div class="table-container">
                <table id="example" class="display" style="width:100%">
                  <thead>
                    <tr>
                      <th>Codigo de Historia</th>
                      <th>Paciente</th>
                      <th>Fecha de Apertura</th>
                      <th>Opción</th>
                    </tr>
                  
                    <tbody>
                      <?php
                      require_once "conexion.php";
                      $conexion = retornarConexion();
                      $sql = "SELECT paciente.CedulaPaciente, paciente.nombre1, paciente.apellido1, historiamedica.codhistoria, historiamedica.fechaApertura
                        FROM historiamedica
                        INNER JOIN paciente  ON historiamedica.CedulaPaciente = paciente.CedulaPaciente
                         ";

                      $ejecutar = $conexion->query($sql);

                      if ($ejecutar->num_rows > 0) {
                        while ($fila = $ejecutar->fetch_assoc()) {
                          $cedulaPaciente = htmlspecialchars($fila['CedulaPaciente']);
                          echo "<tr>";
                          echo "<td>" . htmlspecialchars($fila['codhistoria']) . "</td>";
                          echo "<td>" . htmlspecialchars($fila['CedulaPaciente'] . ' ' . $fila['nombre1'] . ' ' . $fila['apellido1']) . "</td>";
                          echo "<td>" . htmlspecialchars($fila['fechaApertura']) . "</td>";
                          echo "<td>";

                          // Botones para agendar y cancelar cita 
                          echo '<div class="btn-group">';  
                          echo '<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';  
                          echo 'Acciones <span class="caret"></span>'; // Etiqueta para el botón dropdown  
                          echo '</button>';  
                          echo '<div class="dropdown-menu" role="menu">';  
                          echo '<a class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-default-' . $cedulaPaciente . '">Agendar Cita</a>';  
                          echo '<a class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-cancelar-' . $cedulaPaciente . '">Cancelar Cita</a>';  
                          echo '<a class="dropdown-item" href="ficha_paciente.php?codhistoria=' . htmlspecialchars($fila['codhistoria']) . '">Ver Ficha</a>';  
                          echo '</div>';  
                          
                          echo "</td>";
                          echo "</tr>";

                          // Modal para Agendar Cita  
                          echo '<div class="modal fade" id="modal-default-' . $cedulaPaciente . '" tabindex="-1" role="dialog" aria-labelledby="modal-default-label" aria-hidden="true">';
                          echo '  <div class="modal-dialog modal-lg">';
                          echo '    <div class="modal-content">';
                          echo '      <div class="modal-header">';
                          echo '        <h4 class="modal-title">Agendar Cita</h4>';
                          echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                          echo '          <span aria-hidden="true">&times;</span>';
                          echo '        </button>';
                          echo '      </div>';
                          echo '      <form action="model/cita_consecutiva_model.php" method="POST">';
                          echo '        <input type="hidden" class="form-control" name="CedulaPaciente" value="' . $cedulaPaciente . '">';
                          echo '        <div class="modal-body">';
                          echo '          <div class="card-body">';
                          echo '            <div class="row g-3">';
                          echo '              <div class="col-lg-4 text-center">';
                          echo '                <label for="">Cedula</label>';
                          echo '                <input type="text" class="form-control" name="CedulaPaciente" value="' . $cedulaPaciente . '" readonly>';
                          echo '              </div>';
                          echo '              <div class="col-lg-4 text-center">';
                          echo '                <label for="">Nombre</label>';
                          echo '                <input type="text" class="form-control" name="nombre1" value="' . htmlspecialchars($fila['nombre1']) . '" readonly>';
                          echo '              </div>';
                          echo '              <div class="col-lg-4 text-center">';
                          echo '                <label for="">Apellido</label>';
                          echo '                <input type="text" class="form-control" name="apellido1" value="' . htmlspecialchars($fila['apellido1']) . '" readonly>';
                          echo '              </div>';
                          echo '            </div>';

                          echo '            <div class="row g-3">';
                          echo '              <div class="col-lg-4 text-center">';
                          echo '                <label for="tipocita">Tipo de Cita</label>';
                          echo '                <select class="form-control" name="tipocita" id="tipocita">';
                          echo '                  <option value="" disabled selected>Seleccionar</option>';
                          echo '                  <option value="sucesiva_control">Sucesiva</option>';
                          echo '                </select>';
                          echo '              </div>';
                          echo '              <div class="col-lg-4 text-center">';
                          echo '                <label for="">Especialidad</label>';
                          echo '                <select class="form-select mb-3 form-control" name="codespecialidad" id="nomespecialidad">';
                          echo '                  <option value="" disabled selected>Seleccionar Especialidad</option>';

                          require_once("conexion.php");
                          $conexion = retornarConexion();
                          $sqlEspecialidades = $conexion->query("SELECT * FROM especialidad");
                          while ($resultado = $sqlEspecialidades->fetch_assoc()) {
                            echo "<option value='" . $resultado['codespecialidad'] . "'>" . htmlspecialchars($resultado['nomespecialidad']) . "</option>";
                          }
                          echo '                </select>';
                          echo '              </div>';
                          echo '              <div class="col-lg-4 text-center">';
                          echo '                <label for="">Médico</label>';
                          echo '                <select class="form-select mb-3 form-control" name="cedulamedico" id="cedulamedico" disabled>';
                          echo '                  <option value="" disabled selected>-- Seleccionar --</option>';
                          echo '                  <option value="" disabled>-- Médico --</option>';
                          echo '                </select>';
                          echo '              </div>';
                          echo '            </div>';

                          echo '            <div class="row g-3">';
                          echo '              <div class="col-lg-4 text-center">';
                          echo '                <label for="">Días de Atención</label>';
                          echo '                <input type="text" class="form-control" name="dias" id="dias" readonly>';
                          echo '              </div>';
                          echo '              <div class="col-lg-4 text-center">';
                          echo '                <label for="">Fechas Disponibles</label>';
                          echo '                <select class="form-control" id="fecha" name="fecha">';
                          echo '                  <option value="" disabled selected>Seleccionar Fecha</option>';
                          echo '                  <!-- Se llenará dinámicamente -->';
                          echo '                </select>';
                          echo '              </div>';
                          echo '              <div class="col-lg-4 text-center">';
                          echo '                <label for="">Nueva Fecha</label>';
                          echo '                <input type="date" class="form-control" name="fechacita" id="fechacita">';
                          echo '              </div>';
                          echo '            </div>';
                          echo '            <hr>';
                          echo '            <input type="hidden" name="status" value="Pendiente">';
                          echo '            <div class="modal-footer">';
                          echo '              <button type="submit" class="btn btn-primary">Guardar</button>';
                          echo '              <a href="consulta_fichas_medicas.php" class="btn btn-danger">Salir</a>';
                          echo '            </div>';
                          echo '          </div>';
                          echo '        </div>';
                          echo '      </form>';
                          echo '    </div>';
                          echo '  </div>';
                          echo '</div>'; // Cierre del modal  

                          // Modal para Cancelar Cita  
                          echo '<div class="modal fade" id="modal-cancelar-' . $cedulaPaciente . '" tabindex="-1" role="dialog" aria-labelledby="modal-cancelar-label" aria-hidden="true">';
                          echo '  <div class="modal-dialog" role="document">';
                          echo '    <div class="modal-content">';
                          echo '      <div class="modal-header">';
                          echo '        <h5 class="modal-title" id="modal-cancelar-label">Cancelar Cita</h5>';
                          echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                          echo '          <span aria-hidden="true">&times;</span>';
                          echo '        </button>';
                          echo '      </div>';
                          echo '      <form action="model/cancelar_citas.php" method="POST">';
                          echo '        <div class="modal-body">';
                          echo '          <input type="hidden" name="CedulaPaciente" value="' . $cedulaPaciente . '">';
                          echo '          <div class="form-group">';
                          echo '            <label for="motivo-cancelacion">Motivo de la Cancelación</label>';
                          echo '            <textarea class="form-control" id="motivo-cancelacion" name="motivo" required></textarea>';
                          echo '          </div>';
                          echo '        </div>';
                          echo '        <div class="modal-footer">';
                          echo '          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
                          echo '          <button type="submit" class="btn btn-danger">Confirmar Cancelación</button>';
                          echo '        </div>';
                          echo '      </form>';
                          echo '    </div>';
                          echo '  </div>';
                          echo '</div>'; // Cierre del modal cancelar  

                        } // Cierre del while  
                      } else {
                        echo "<tr><td colspan='4'>No se encontraron resultados.</td></tr>";
                      }
                      ?>
                    </tbody>
                    <
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </section>
          <!-- /.col -->
    </div>
        <!-- /.row -->
    </div>


<!-- ./wrapper -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<!-- jQuery UI -->

<script src="plugins/jquery/jquery-3.6.0.min.js"></script>
<script src="js/especialidadmed.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.js"></script>
<script src="js/sweetalert2@11.js"></script>
<script src="js/horario.js"></script>
<script src="plugins/bootstrap/js/bootstrap.js"></script>
<script src="js/jquery-3.3.1.js"></script>  
<script src="js/jquery.dataTables.min.js"></script>  
<script src="plugins/datatables/dataTables.fixedHeader.min.js"></script>  
<script src="plugins/pdfmake/pdfmake.js"></script>  
<script src="plugins/pdfmake/vfs_fonts.js"></script> 
<script src="js/xlsx.full.min.js"></script> 
<script src="js/especialidadmed.js"></script>
<script src="js/horario.js"></script> 
<script>
  //boton de bootstrap
  $('#btn-user').click(function() {
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

    // Al seleccionar un médico  se mostraran los dias que atiende cada medc
    $('#cedulamedico').on('change', function() {
      const cedulamedico = $(this).val();
      if (cedulamedico) {
        $.post('model/obtener_diafecha.php', {
          cedulamedico: cedulamedico
        }, function(data) {
          const result = JSON.parse(data);
          $('#dias').val(result.dias); // Mostrar días  
          $("#fecha").html(""); // Limpiar fechas anteriores  
          result.fechas.forEach(function(fecha) {
            $("#fecha").append(`<option value="${fecha.fechacita}">${fecha.fechacita} - Cupos Disponibles ${fecha.cupos_disponibles} de 15</option>`);
          });
        });
      } else {
        $('#dias').val(""); // Limpiar días si no hay médico seleccionado  
        $("#fecha").html(""); // Limpiar fechas  
      }
    });
  });
</script>
<script>  
$(document).ready(function() {  
    var table = $('#example').DataTable({  
       orderCellsTop: true,  
       fixedHeader: true   
    });  

    // Evento para la descarga del PDF  
    $('#download-pdf').click(function() {  
        generarPDF();  
    });  

    // Evento para la descarga del Excel  
    $('#download-excel').click(function() {  
        generarExcel(); // Llama a la función de generación de Excel  
    });  

    $('#example thead tr').clone(true).appendTo('#example thead');  

    $('#example thead tr:eq(1) th').each(function(i) {  
        var title = $(this).text();   
        $(this).html('<input type="text" placeholder="Buscar...' + title + '" />');  

        $('input', this).on('keyup change', function() {  
            if (table.column(i).search() !== this.value) {  
                table  
                    .column(i)  
                    .search(this.value)  
                    .draw();  
            }  
        });  
    });  
});  

// Función para generar PDF  
function generarPDF() {  
    var rows = [];  
    $('#example tbody tr').each(function() {  
        var row = [];  
        $(this).find('td').each(function() {  
            row.push($(this).text());  
        });  
        rows.push(row);  
    });  

    var docDefinition = {  
        content: [  
            { text: 'Reporte de Citas', style: 'header' },  
            {  
                table: {  
                    headerRows: 1,  
                    widths: ['*', '*', '*', '*', '*'],  
                    body: [  
                        ['Especialidad', 'Médico', 'Paciente', 'Tipo de Cita', 'Estatus de Cita'], // Encabezado  
                        ...rows // Aquí se agregan las filas de datos  
                    ]  
                }  
            }  
        ],  
        styles: {  
            header: {  
                fontSize: 18,  
                bold: true,  
                margin: [0, 20, 0, 20] // Margen: [izquierda, arriba, derecha, abajo]  
            }  
        }  
    };  

    pdfMake.createPdf(docDefinition).download('reporte_citas.pdf');  
}  

// Función para generar y descargar archivo Excel  
function generarExcel() {  
    var wb = XLSX.utils.book_new();  
    var ws = XLSX.utils.aoa_to_sheet([]);  
    
    // Crear encabezados  
    var headers = ['Especialidad', 'Médico', 'Paciente', 'Tipo de Cita', 'Estatus de Cita'];  
    XLSX.utils.sheet_add_aoa(ws, [headers], { origin: "A1" });  

    // Agregar datos de la tabla  
    $('#example tbody tr').each(function() {  
        var row = [];  
        $(this).find('td').each(function() {  
            row.push($(this).text());  
        });  
        XLSX.utils.sheet_add_aoa(ws, [row], { origin: -1 }); // -1 para agregar en la siguiente fila  
    });  

    XLSX.utils.book_append_sheet(wb, ws, "Citas");  
    XLSX.writeFile(wb, "reporte_citas.xlsx");  
}  
</script>  
<?php
include_once("footer.php");
?>