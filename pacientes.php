<?php
require_once("conexion.php");
$conexion = retornarConexion();
include_once("header.php");
?>
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- DataTables -->
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">
<link rel="stylesheet" href="js/jquery.dataTables.min.css">
<link rel="stylesheet" href="dist/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" href="dist/css/bootstrap.min.css">

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Lista de Pacientes</h1><br>
          <a href="crear_paciente.php" class="btn btn-primary">Registrar Paciente</a>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
            <li class="breadcrumb-item active">Lista de Pacientes</li>
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
                  <th>Paciente</th>
                  <th>Fecha de Cita</th>
                  <th>Estatus</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once("conexion.php");
                $conexion = retornarConexion();
                $sql = "SELECT paciente.CedulaPaciente, paciente.nombre1, paciente.apellido1, eventos.codigo, eventos.status, eventos.fechacita  
                  FROM eventos  
                     INNER JOIN paciente ON eventos.CedulaPaciente = paciente.CedulaPaciente";
                $ejecutar = $conexion->query($sql);

                if ($ejecutar->num_rows > 0) {
                  while ($fila = $ejecutar->fetch_assoc()) {
                    $cedulaPaciente = htmlspecialchars($fila['CedulaPaciente']);
                    echo "<tr>";  
                    echo "<td>" . htmlspecialchars($fila['nombre1'] . ' ' . $fila['apellido1']) . "</td>";  
                    echo "<td>" . htmlspecialchars($fila['fechacita']) . "</td>";  
                    echo "<td>" . htmlspecialchars($fila['status']) . "</td>";  
                    echo "<td>";  

                    // Inicio del bloque del botón dropdown  
                    echo '<div class="btn-group dropdown">';  
                    echo '<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';  
                    echo 'Acciones <span class="caret"></span>';  
                    echo '</button>';  
                    echo '<div class="dropdown-menu" role="menu">';  
                    echo '<a class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-default-' . $cedulaPaciente . '">Modificar Cita</a>';  
                    echo '<a class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-cancelar-' . $cedulaPaciente . '">Cancelar Cita</a>';  
                    echo '<a class="dropdown-item" href="crear_ficha_medica.php?CedulaPaciente=' . htmlspecialchars($fila['CedulaPaciente']) . '">Crear Ficha</a>';  
                    echo '</div>';  
                    echo '</div>';  
                    // Fin del bloque del botón dropdown  

                    echo "</td>";  
                    echo "</tr>";  

                    // Modal para modificar cita  
                    echo "  
            <div class='modal fade' id='modal-default-$cedulaPaciente' tabindex='-1' role='dialog' aria-labelledby='modal-default-label' aria-hidden='true'>   
                <div class='modal-dialog' role='document'>  
                    <div class='modal-content'>  
                        <div class='modal-header'>  
                            <h5 class='modal-title' id='modal-default-label'>Modificar Cita</h5>  
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>  
                                <span aria-hidden='true'>&times;</span>  
                            </button>  
                        </div>  
                        <form action='model/editar_citaprimeravez_model.php' method='POST'>  
                            <input type='hidden' class='form-control' name='codigo' value='" . htmlspecialchars($fila['codigo']) . "'>  
                            <div class='modal-body'>  
                                
                                <div class='form-group'>  
                                    <label for=''>Nueva Fecha</label>  
                                    <input type='date' class='form-control' name='fechacita' id='fechacita' value='" . htmlspecialchars($fila['fechacita']) . "' required>  
                                </div>  
                                <div class='form-group'>  
                                    <label for=''>Cedula</label>  
                                    <input type='text' class='form-control' name='CedulaPaciente' id='CedulaPaciente' value='" . htmlspecialchars($fila['CedulaPaciente']) . "' readonly>  
                                </div>  
                                <div class='form-group'>  
                                    <label for=''>Nombre</label>  
                                    <input type='text' class='form-control' name='nombre1' id='nombre1' value='" . htmlspecialchars($fila['nombre1']) . "' readonly>  
                                </div>  
                                <div class='form-group'>  
                                    <label for=''>Apellido</label>  
                                    <input type='text' class='form-control' name='apellido1' id='apellido1' value='" . htmlspecialchars($fila['apellido1']) . "' readonly>  
                                </div>  
                            </div>  
                            <div class='modal-footer'>  
                                <button type='submit' class='btn btn-primary' id='btn-user' name='btn-user'>Guardar</button>  
                                <button type='button' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>  
                            </div>  
                        </form>  
                    </div>  
                </div>  
            </div>";

                    // Modal para cancelar cita (actualizado)  
                    echo "  
            <div class='modal fade' id='modal-cancelar-$cedulaPaciente' tabindex='-1' role='dialog' aria-labelledby='modal-cancelar-label-$cedulaPaciente' aria-hidden='true'>  
                <div class='modal-dialog' role='document'>  
                    <div class='modal-content'>  
                        <div class='modal-header'>  
                            <h5 class='modal-title' id='modal-cancelar-label-$cedulaPaciente'>Cancelar Cita</h5>  
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>  
                                <span aria-hidden='true'>&times;</span>  
                            </button>  
                        </div>  
                        <form action='model/cancelar_citas.php' method='POST'>  
                            <div class='modal-body'>  
                                <input type='hidden' name='CedulaPaciente' value='$cedulaPaciente'>  
                                <div class='form-group'>  
                                    <label for='motivo-cancelacion-$cedulaPaciente'>Motivo de la Cancelación</label>  
                                    <textarea class='form-control' id='motivo-$cedulaPaciente' name='motivo' required></textarea>  
                                </div>  
                            </div>  
                            <div class='modal-footer'>  
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>  
                                <button type='submit' class='btn btn-danger' id='btn-cancelar' name='btn-cancelar'>Confirmar Cancelación</button>  
                            </div>  
                        </form>  
                    </div>  
                </div>  
            </div>";
                  }
                } else {
                  echo "<tr><td colspan='4'>No se encontraron resultados.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- /.container-fluid -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<!-- jQuery UI -->

<script src="plugins/jquery/jquery-3.6.0.min.js"></script>
<script src="js/especialidadmed.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.js"></script>
<script src="js/sweetalert2@11.js"></script>
<script src="js/horario.js"></script>

<script src="js/jquery-3.3.1.js"></script>  
<script src="js/jquery.dataTables.min.js"></script>  
<script src="plugins/datatables/dataTables.fixedHeader.min.js"></script>  
<script src="plugins/pdfmake/pdfmake.js"></script>  
<script src="plugins/pdfmake/vfs_fonts.js"></script> 
<script src="js/xlsx.full.min.js"></script> 
<script>
  //boton de bootstrap
  $('#btn-user').click(function() {
    Swal.fire(
      'Exito!',
      'Cita modificada correctamente',
      'success'
    )
  });
  $('#btn-cancelar').click(function() {
    Swal.fire(
      'Atención!',
      'Cita cancelada',
      'danger'
    )
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
      content: [{
          text: 'Reporte de Citas',
          style: 'header'
        },
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
    XLSX.utils.sheet_add_aoa(ws, [headers], {
      origin: "A1"
    });

    // Agregar datos de la tabla  
    $('#example tbody tr').each(function() {
      var row = [];
      $(this).find('td').each(function() {
        row.push($(this).text());
      });
      XLSX.utils.sheet_add_aoa(ws, [row], {
        origin: -1
      }); // -1 para agregar en la siguiente fila  
    });

    XLSX.utils.book_append_sheet(wb, ws, "Citas");
    XLSX.writeFile(wb, "reporte_citas.xlsx");
  }
</script>
<?php
include_once("footer.php");
?>