<?php  
require_once("../conexion.php");  

$conexion = retornarConexion();  


if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    $especialidad = $_POST['codespecialidad'];  
    $medico = $_POST['cedulamedico'] ?? null; // Obtener el ID del médico seleccionado si está habilitado  
    $tipoCita = $_POST['tipoCita'];  
    $fechaInicio = $_POST['fecha_inicio'];  
    $fechaFin = $_POST['fecha_fin'];  
    $tipoVista = $_POST['tipo_vista'];  

    // Prepara la consulta  
    $stmt = $conexion->prepare("SELECT * FROM eventos WHERE codespecialidad = ? AND cedulamedico = ? AND tipocita = ? AND fechacita BETWEEN ? AND ?");  
    $stmt->bind_param("sssss", $especialidad, $medico, $tipoCita, $fechaInicio, $fechaFin);  
    $stmt->execute();  
    $resultado = $stmt->get_result();  

    if ($tipoVista === 'tabla') {  
        // Generar tabla  
        echo '<table class="table table-bordered">';  
        echo '<thead><tr><th>ID</th><th>Código Especialidad</th><th>Cedula Médico</th><th>Tipo Cita</th><th>Fecha Cita</th></tr></thead>';  
        echo '<tbody>';  
        while ($row = $resultado->fetch_assoc()) {  
            echo '<tr>';  
            echo '<td>' . $row['id'] . '</td>';  
            echo '<td>' . $row['codespecialidad'] . '</td>';  
            echo '<td>' . $row['cedulamedico'] . '</td>';  
            echo '<td>' . $row['tipocita'] . '</td>';  
            echo '<td>' . $row['fechacita'] . '</td>';  
            echo '</tr>';  
        }  
        echo '</tbody>';  
        echo '</table>';  
    } elseif ($tipoVista === 'grafico') {  
        // Generar gráfico  
        echo '<canvas id="myChart"></canvas>';  
        echo "<script>  
            var ctx = document.getElementById('myChart').getContext('2d');  
            var myChart = new Chart(ctx, {  
                type: 'bar',  
                data: {  
                    labels: [], // Aquí las etiquetas que necesites  
                    datasets: [{  
                        label: 'Asistencia de Citas',  
                        data: [], // Datos a graficar  
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',  
                        borderColor: 'rgba(75, 192, 192, 1)',  
                        borderWidth: 1  
                    }]  
                },  
                options: {  
                    scales: {  
                        y: {  
                            beginAtZero: true  
                        }  
                    }  
                }  
            });  
        </script>";  
    }  
}  

if (isset($_POST['btnDescargarCSV'])) {  
    $especialidad = $_POST['codespecialidad'];  
    $medico = $_POST['cedulamedico'];  
    $tipoCita = $_POST['tipoCita'];  
    $fechaInicio = $_POST['fecha_inicio'];  
    $fechaFin = $_POST['fecha_fin'];  

    header('Content-Type: text/csv');  
    header('Content-Disposition: attachment; filename="datos.csv"');  

    $output = fopen('php://output', 'w');  
    fputcsv($output, array('ID', 'Código Especialidad', 'Cedula Médico', 'Tipo Cita', 'Fecha Cita'));  

    $stmt = $conexion->prepare("SELECT * FROM eventos WHERE codespecialidad = ? AND cedulamedico = ? AND tipocita = ? AND fechacita BETWEEN ? AND ?");  
    $stmt->bind_param("sssss", $especialidad, $medico, $tipoCita, $fechaInicio, $fechaFin);  
    $stmt->execute();  
    $resultado = $stmt->get_result();  

    while ($row = $resultado->fetch_assoc()) {  
        fputcsv($output, $row);  
    }  
    fclose($output);  
    exit();  
}  

?>  
<script>
$(document).ready(function() {  
    // Inicializar DataTable  
    $('#tablaResultados').DataTable();  
  
    // Ocultar inicialmente el gráfico y la tabla  
    $('#tablaResultados').hide();  
    $('#myChart').parent().hide();  
  
    $('#consultarBtn').on('click', function() {  
        const tipoVista = $('#tipoVista').val();  
        
        // Limpiar la tabla y el gráfico antes de la consulta  
        $('#tablaResultados').DataTable().clear().draw();  
  
        // Aquí deberías realizar la consulta y llenar tu tabla con los nuevos datos, luego del AJAX o la lógica que utilices  
  
        // Mostrar/ocultar según la opción seleccionada  
        if (tipoVista === 'tabla') {  
            $('#tablaResultados').show();  
            $('#myChart').parent().hide();  
        } else if (tipoVista === 'grafico') {  
            $('#tablaResultados').hide();  
            $('#myChart').parent().show();  
        } else if (tipoVista === 'ambos') {  
            $('#tablaResultados').show();  
            $('#myChart').parent().show();  
        }  
    });  
  
    // Preparar datos para el gráfico (aquí debes hacerlo después de recibir los datos de la consulta)  
    // Por ejemplo, podrías tener un AJAX que obtiene los datos y luego genera el gráfico  
    function crearGrafico(datos) {  
        const labels = [];  
        const dataPoints = [];  
  
        datos.forEach(item => {  
            const nombreMedico = item.nombreMedico;  // Cambia según tu estructura de datos  
            // Similar a cómo llenamos los datos antes  
            if (!labels.includes(nombreMedico)) {  
                labels.push(nombreMedico);  
                dataPoints.push(1);  
            } else {  
                const index = labels.indexOf(nombreMedico);  
                dataPoints[index]++;  
            }  
        });  
  
        // Crear gráfico  
        const ctx = document.getElementById('myChart').getContext('2d');  
        const myChart = new Chart(ctx, {  
            type: 'bar',  
            data: {  
                labels: labels,  
                datasets: [{  
                    label: 'Número de Citas',  
                    data: dataPoints,  
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',  
                    borderColor: 'rgba(75, 192, 192, 1)',  
                    borderWidth: 1  
                }]  
            },  
            options: {  
                scales: {  
                    y: {  
                        beginAtZero: true  
                    }  
                }  
            }  
        });  
    }  
  });  
  </script>
  <script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/jquery/jquery-3.6.0.min.js"></script>
<script src="js/especialidadmed.js"></script>

<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="js/chart.js"></script>