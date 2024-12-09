<?php  
include_once("header.php");  
require_once("conexion.php");  
$conexion = retornarConexion();   

// Obtener fechas del formulario, si están definidas  
$startDate = !empty($_GET['startDate']) ? $_GET['startDate'] : null;  
$endDate = !empty($_GET['endDate']) ? $_GET['endDate'] : null;  

// Consultar pacientes atendidos por médico, especialidad y estado de la cita  
$sql = "SELECT medico.cedulamedico, medico.nom1, medico.ape1, especialidad.nomespecialidad,   
            eventos.status, COUNT(eventos.CedulaPaciente) as total_pacientes  
        FROM eventos  
        INNER JOIN paciente ON eventos.CedulaPaciente = paciente.CedulaPaciente   
        INNER JOIN medico ON eventos.cedulamedico = medico.cedulamedico   
        INNER JOIN especialidad ON eventos.codespecialidad = especialidad.codespecialidad  
        WHERE 1=1";   

// Agregar condiciones para el rango de fechas  
if ($startDate && $endDate) {  
    $sql .= " AND eventos.fechacita BETWEEN '$startDate' AND '$endDate'";   
} else {  
    // Si no hay rangos de fechas, podrías definir un rango predeterminado o retornar todos los resultados  
    // $sql .= " AND ... "; // aquí podrías agregar una condición por defecto si lo deseas  
}  

$sql .= " GROUP BY medico.cedulamedico, especialidad.nomespecialidad, eventos.status";  

$result = $conexion->query($sql);  
$chartData = [];  

// Procesar los resultados y preparar datos para el gráfico  
if ($result->num_rows > 0) {  
    while ($row = $result->fetch_assoc()) {  
        $name = $row['nom1'] . ' ' . $row['ape1'] . ' (' . $row['nomespecialidad'] . ', ' . $row['status'] . ')';  
        $chartData[] = [  
            'name' => $name,  
            'y' => (int) $row['total_pacientes']  
        ];  
    }  
}   

$conexion->close();  
?>  

<link rel="stylesheet" href="dist/css/bootstrap.min.css">  

<div class="content-wrapper">  
  <div class="shadow-lg p-3 mb-5 bg-white">  
    <div class="content-header">  
      <div class="container-fluid">  
        <div class="row">  

          <!-- Formulario para filtro de fechas -->  
          <div class="col-12">  
              <form id="filterForm" class="form-inline mb-3">  
                  <div class="form-group">  
                      <label for="startDate">Desde:</label>  
                      <input type="date" id="startDate" name="startDate" class="form-control mx-2">  
                  </div>  
                  <div class="form-group">  
                      <label for="endDate">Hasta:</label>  
                      <input type="date" id="endDate" name="endDate" class="form-control mx-2">  
                  </div>  
                  <button type="submit" class="btn btn-primary">Filtrar</button>  
              </form>  
          </div>  

          <!-- Contenedor para el gráfico -->  
          <div class="col-12">  
            <div id="grafico" style="height: 400px; min-width: 310px;"></div>  
          </div>  

          <!-- Botón para exportar gráficos -->  
          <div class="col-12 text-center mt-3">  
              <button id="exportImage" class="btn btn-success">Descargar Gráfico</button>  
          </div>  
          
        </div>  
      </div>  
    </div>  
  </div>  
</div>  
<script src="js/jquery-3.6.0.min.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>  
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>  
<script src="js/highcharts.js"></script>  
<script src="js/exporting.js"></script>  
<script src="js/export-data.js"></script>  
<script src="js/accessibility.js"></script>  
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>  

<script>  
$(document).ready(function(){  
    // Función para generar el gráfico  
    function generateChart(chartDataArray) {  
        Highcharts.chart('grafico', {  
            chart: {  
                type: 'pie',  
                options3d: {  
                    enabled: true,  
                    alpha: 10,  
                    beta: 10  
                }  
            },  
            title: {  
                text: 'Pacientes atendidos por Médico (en su Especialidad)'  
            },  
            legend: {  
                layout: 'vertical',  
                align: 'right',  
                verticalAlign: 'middle'  
            },  
            series: [{  
                name: 'Pacientes',  
                colorByPoint: true,  
                data: chartDataArray  
            }],  
            tooltip: {  
                pointFormat: '<b>{point.name}: {point.y}</b>'  
            },  
            exporting: {  
                buttons: {  
                    contextButton: {  
                        menuItems: ['downloadPNG', 'downloadJPEG', 'downloadPDF', 'downloadSVG']  
                    }  
                },  
            }  
        });  
    }  

    // Al cargar la página, generamos el gráfico inicial  
    var initialChartData = <?php echo json_encode($chartData); ?>;  
    generateChart(initialChartData);  

    $('#filterForm').on('submit', function(e) {  
        e.preventDefault();  

        var startDate = $('#startDate').val();  
        var endDate = $('#endDate').val();  

        $.ajax({  
            url: '', // La misma página para que maneje la solicitud  
            method: 'GET',  
            data: {  
                startDate: startDate,  
                endDate: endDate  
            },  
            success: function(response) {  
                var newChartData = JSON.parse(response); // Esperamos un JSON válido  
                generateChart(newChartData);  
            },  
            error: function(jqXHR, textStatus, errorThrown) {  
                console.error("Error en la solicitud AJAX:", textStatus, errorThrown); // Manejo de errores  
            }  
        });  
    });  

    // Evento para descargar gráfico  
    $('#exportImage').on('click', function() {  
        var chart = Highcharts.charts[0]; // Asegúrate de capturar el gráfico correcto  
        console.log(chart); // Verifica que esto no sea undefined  
        if (chart) {  
            chart.exportChart(); // Esto usará la configuración de exportación especificada  
        } else {  
            console.error("No hay gráfico disponible para exportar.");  
        }  
    });  
});  
</script>  

<?php  
include_once "footer.php";  
?> 