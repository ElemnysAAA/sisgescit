<?php  
require_once("conexion.php");  
$conexion = retornarConexion();  
include_once("header.php");  
?>  


<link rel="stylesheet" href="js/jquery.dataTables.min.css">  
<link rel="stylesheet" href="dist/css/fixedHeader.dataTables.min.css">  

<div class="content-wrapper"> 
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Lista de Emergencias Registradas</h1><br>
          <a href="Crearusuarios.php" class="btn btn-primary">Crear nueva ficha de emergencia</a>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
            <li class="breadcrumb-item active">Emergencia</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>  
    <section class="content-header">  
        <div class="container-fluid">  
            <div class="row mb-2">  
                <div class="col-sm-12">  
                    <style>  
                        /* Estilos para la tabla */  
                        table th {  
                            background-color: #f4141e ;  
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
                        <button id="download-pdf" class="btn btn-danger"><i class="fas fa-file-pdf"></i></button>  
                        <button id="download-excel" class="btn btn-success"><i class="fas fa-file-csv"></i></button>  
                    </div>  

                    <div class="table-container">  
                        <table id="example" class="display" style="width:100%">  
                            <thead>  
                                <tr>  
                                    <th>Codigo de Emergencia</th>  
                                    <th>Médico</th>  
                                    <th>Paciente</th>  
                                    <th>Fecha de Emergencia</th>  
                                    
                                </tr>  
                            </thead>  
                            <tbody>  
                                <?php  
                                $sql = "SELECT  eventos.codigo, eventos.fechacita, eventos.tipocita, eventos.status, paciente.CedulaPaciente, paciente.nombre1, paciente.apellido1, medico.cedulamedico, medico.nom1, medico.ape1, especialidad.nomespecialidad  
                                FROM eventos  
                                INNER JOIN paciente ON eventos.CedulaPaciente = paciente.CedulaPaciente   
                                INNER JOIN medico ON eventos.cedulamedico = medico.cedulamedico   
                                INNER JOIN especialidad ON eventos.codespecialidad = especialidad.codespecialidad   
                                WHERE 1=1";   

                                $ejecutar = $conexion->query($sql);  

                                if ($ejecutar->num_rows > 0) {  
                                    while ($fila = $ejecutar->fetch_assoc()) {  
                                        echo "<tr>";  
                                        echo "<td>" . htmlspecialchars($fila['codigo']) . "</td>";    
                                        echo "<td>" . htmlspecialchars($fila['cedulamedico'] . ' - ' . $fila['nom1'] . ' ' . $fila['ape1']) . "</td>";  
                                        echo "<td>" . htmlspecialchars($fila['CedulaPaciente']. ' - ' . $fila['nombre1'] . ' ' . $fila['apellido1']) . "</td>";    
                                        echo "<td>" . htmlspecialchars ($fila['fechacita']) . "</td>";  
                                        echo "</tr>";  
                                    }  
                                } else {  
                                    echo "<tr><td colspan='5'>No se encontraron resultados.</td></tr>";  
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

<script src="js/jquery-3.3.1.js"></script>  
<script src="js/jquery.dataTables.min.js"></script>  
<script src="plugins/datatables/dataTables.fixedHeader.min.js"></script>  
<script src="plugins/pdfmake/pdfmake.js"></script>  
<script src="plugins/pdfmake/vfs_fonts.js"></script> 
<script src="js/xlsx.full.min.js"></script> 

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