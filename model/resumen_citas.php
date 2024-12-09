<?php  
require_once "../conexion.php";  
$conexion = retornarConexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    // Procesar datos del formulario  
    $codespecialidad = $_POST['codespecialidad'];  
    $cedulamedico = $_POST['cedulamedico']; 
    $tipoCita = $_POST['tipoCita'];  
    $fecha_inicio = $_POST['fecha_inicio'];  
    $fecha_fin = $_POST['fecha_fin'];  
    $tipo_vista = $_POST['tipo_vista'];  

    // Consulta a la base de datos  
    $sql = "SELECT * FROM eventos WHERE codespecialidad = ? AND fechacita BETWEEN ? AND ?";  
    $stmt = $conexion->prepare($sql);  
    $stmt->bind_param("sss", $codespecialidad, $fecha_inicio, $fecha_fin);  
    $stmt->execute();  
    $result = $stmt->get_result();  

    if ($result->num_rows > 0) {  
        if ($tipo_vista == "tabla") {  
            // Mostrar resultados en una tabla  
            echo '<table class="table table-bordered">';  
            echo '<thead><tr><th>Paciente</th><th>Médico</th><th>Especialidad</th><th>Fecha de Cita</th><th>Tipo de Cita</th></tr></thead>';  
            echo '<tbody>';  
            while ($fila = $result->fetch_assoc()) {  
                
                echo "<tr>";  
                echo "<td>" . $fila['CedulaPaciente'] . "</td>"; // Cambia según tu esquema de base de datos  
                echo "<td>" . $fila['cedulamedico'] . "</td>"; // Ajusta esto  
                echo "<td>" . $fila['codespecialidad'] . "</td>"; // Ajusta esto  
                echo "<td>" . $fila['fechacita'] . "</td>"; // Ajusta esto  
                echo "<td>" . $fila['tipocita'] . "</td>"; // Ajusta esto  
                echo "</tr>";  
            }  
            echo '</tbody></table>';  
        } elseif ($tipo_vista == "grafico") {  
            // Procesar datos para el gráfico  
            $labels = [];  
            $dataPoints = [];  
            while ($fila = $result->fetch_assoc()) {  
                $labels[] = $fila['cedulamedico']; // Cambia según el campo que desees mostrar  
                $dataPoints[] = $fila['tipocita'] == 'tipocita' ? 1 : 0; // Puedes ajustar según lo que quieras graficar  
            }  
        
            // Convertir arrays a formato JSON para JavaScript  
            $labelsJson = json_encode($labels);  
            $dataPointsJson = json_encode($dataPoints);  
            
            echo "              <canvas id='myChart'></canvas>  
            <script>  
                const ctx = document.getElementById('myChart').getContext('2d');  
                const myChart = new Chart(ctx, {  
                    type: 'bar', // Cambia el tipo si lo deseas  
                    data: {  
                        labels: $labelsJson,  
                        datasets: [{  
                            label: '# de Citas',  
                            data: $dataPointsJson,  
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
}  
?>  