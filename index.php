<?php
include_once "header.php";
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">
<link rel="stylesheet" href="js/jquery.dataTables.min.css">  
<link rel="stylesheet" href="dist/css/fixedHeader.dataTables.min.css">  

<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <div class="content-header">

    <div class="container-fluid">



      <div class="row mb-6">
        <div class="col-sm-6">
          <h1 class="m-0">Menu Principal</h1>
        </div><!-- /.col -->
        <div class="col-sm-12">

        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-5">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <?php
              require_once("conexion.php");
              $conexion = retornarConexion();
              $sql = "SELECT * FROM paciente";
              $ejecutar = $conexion->query($sql);
              $Pacientes = mysqli_num_rows($ejecutar);
              ?>
              <h3><?php echo $Pacientes; ?></h3>
              <p>Pacientes </p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="pacientes.php" class="small-box-footer">Mas Información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-5">
          <!-- small box -->
          <div class="small-box bg-lightblue">
            <div class="inner">
              <?php
              $sql = "SELECT * FROM historiamedica";
              $ejecutar = $conexion->query($sql);
              $cantidadHistorias = mysqli_num_rows($ejecutar);
              ?>
              <h3><?php echo $cantidadHistorias; ?></h3>
              <p>Historias Registradas</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="consulta_historias.php" class="small-box-footer">Mas Información<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-5">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <?php
              $sql = "SELECT * FROM medico";
              $ejecutar = $conexion->query($sql);
              $cantidadMedicos = mysqli_num_rows($ejecutar);
              ?>
              <h3><?php echo $cantidadMedicos; ?></h3>
              <p>Medicos</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="medicos.php" class="small-box-footer">Mas Información<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-5">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <?php
              $sql = "SELECT * FROM especialidad";
              $ejecutar = $conexion->query($sql);
              $Especialidades = mysqli_num_rows($ejecutar);
              ?>
              <h3><?php echo $Especialidades; ?></h3>

              <p>Especialidades</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="especialidad.php" class="small-box-footer">Mas Información<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-5">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <?php
              $sql = "SELECT * FROM eventos";
              $ejecutar = $conexion->query($sql);
              $Citas = mysqli_num_rows($ejecutar);
              ?>
              <h3><?php echo $Citas; ?></h3>
              <p>Cantidad de Citas</p>

            </div>
            <div class="icon">
              <i class="ion ion-calendar"></i>
            </div>
            <a href="calendario.php" class="small-box-footer">Mas Información<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-12">

          <div class="card-body">
            <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
           
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



<div class="table-container">  
<h4>Pacientes Citados</h4>
<ol class="breadcrumb float-sm-right">
  
<div class="download-buttons">  
    <button id="download-pdf" class="btn btn-danger"><i class="fas fa-file-pdf"></i></button>  
    <button id="download-excel" class="btn btn-success"><i class="fas fa-file-csv"></i></button>  
</div> 
</ol> 
    <table id="example" class="display" style="width:100%">  
        <thead>  
            <tr>  
                <th>Paciente</th>  
                <th>Médico Especialista</th>  
                <th>Fecha de Cita</th>   
                <th>Tipo de Cita y Estatus</th>  
                <th>Asistencia</th>  
            </tr>  
        </thead>  
        <tbody>  
            <?php  
            require_once "conexion.php";  
            $conexion = retornarConexion();  
                      // Consulta para obtener todas las citas  
                      $sql = "SELECT eventos.codigo, eventos.fechacita, eventos.tipocita, eventos.status,   
                      paciente.CedulaPaciente, paciente.nombre1, paciente.apellido1,   
                      medico.cedulamedico, medico.nom1, medico.ape1,   
                      especialidad.nomespecialidad  
               FROM eventos  
               INNER JOIN paciente ON eventos.CedulaPaciente = paciente.CedulaPaciente   
               INNER JOIN medico ON eventos.cedulamedico = medico.cedulamedico   
               INNER JOIN especialidad ON eventos.codespecialidad = especialidad.codespecialidad ORDER BY eventos.fechacita DESC";    

       $ejecutar = $conexion->query($sql); // Ejecutar la consulta  

       if ($ejecutar && $ejecutar->num_rows > 0) {  
           while ($fila = $ejecutar->fetch_assoc()) {  
               echo "<tr>";  
               echo "<td>" . htmlspecialchars($fila['CedulaPaciente']. ' - ' . $fila['nombre1'] . ' ' . $fila['apellido1']) . "</td>";  
               echo "<td>" . htmlspecialchars($fila['nom1'] . ' ' . $fila['ape1'].'-'. $fila['nomespecialidad']) . "</td>";      
               echo "<td>" . htmlspecialchars($fila['fechacita']) . "</td>";   
               echo "<td>" . htmlspecialchars($fila['tipocita'] .'/'. $fila['status']) . "</td>";   
               echo "<td>"; // Comienza la celda de asistencia  
               echo '<form method="POST" action="model/registro_paciente_model.php" style="display:inline;">';  
               echo '<input type="hidden" name="CedulaPaciente" value="' . htmlspecialchars($fila['CedulaPaciente']) . '">';  
               echo '<input type="hidden" name="fechacita" value="' . htmlspecialchars($fila['fechacita']) . '">';  
               echo '<button type="submit" name="status" value="Asistió" class="btn btn-primary swalDefaultSuccess">  
                       <i class="fas fa-check"></i>   
                     </button>';  
               echo '<button type="submit" name="status" value="No Asistió" class="btn btn-danger swalDefaultError">  
                       <i class="fas fa-times"></i>   
                     </button>';  
               echo '</form>';  
               echo "</td>"; // Cierra la celda de asistencia  
               echo "</tr>";  
           }  
       } else {  
           echo "<tr><td colspan='7'>No se encontraron resultados.</td></tr>";  
       }   
       ?>  
   </tbody>
                    </table>
                  </div>
                </div>
           
          </div>
        </div>
        <!-- /.card-body -->
      </div>
  </section>
  <!-- /.row (main row) -->
</div><!-- /.container-fluid -->

<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="js/jquery-3.3.1.js"></script>  
<script src="js/jquery.dataTables.min.js"></script>  
<script src="plugins/datatables/dataTables.fixedHeader.min.js"></script>  
<script src="plugins/pdfmake/pdfmake.js"></script>  
<script src="plugins/pdfmake/vfs_fonts.js"></script>



<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->

<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
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

<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Asistencia Confirmada.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        icon: 'error',
        title: 'El paciente no asistió.'
      })
    });
  });
</script>
<?php
include_once "footer.php";
?>