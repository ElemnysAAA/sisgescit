<?php  
require_once("../conexion.php");  
$conexion = retornarConexion();  

header('Content-Type: application/json');  

// Verifica si se está haciendo una solicitud POST para obtener fechas bloqueadas  
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    // Obtiene la cédula del médico y la fecha de la cita  
    $cedulamedico = $_POST['cedulamedico'];  
    $fechaCita = $_POST['fecha']; // Obtiene la fecha también desde la solicitud  
  
    // Consulta para contar el número de citas ya programadas para el médico en la fecha dada  
    $stmt = $conexion->prepare("SELECT COUNT(*) as totalCitas FROM eventos WHERE cedulamedico = ? AND fechacita = ?");  
    $stmt->bind_param("ss", $cedulamedico, $fechaCita);  
    $stmt->execute();  
    $result = $stmt->get_result();  
    $totalCitas = $result->fetch_assoc()['totalCitas'];  
    
    // Puedes especificar cuántas citas se permiten (ejemplo: 15)  
    $maxCitas = 15;  
    $disponibles = $maxCitas - $totalCitas;  
    
    echo json_encode(['totalCitas' => $totalCitas, 'disponibles' => ($disponibles >= 0 ? $disponibles : 0)]); // Devolver el total de citas y disponibles  
    exit; // termina la ejecución para evitar enviar eventos después  
}   

// Consulta para obtener los eventos  
$sql = $conexion->query("SELECT   
    paciente.CedulaPaciente,   
    paciente.nombre1,   
    paciente.apellido1,   
    medico.nom1,   
    medico.ape1,   
    especialidad.color,   
    eventos.fechacita  
FROM eventos   
INNER JOIN paciente ON eventos.CedulaPaciente = paciente.CedulaPaciente  
INNER JOIN medico ON eventos.cedulamedico = medico.cedulamedico  
INNER JOIN especialidad ON medico.codespecialidad = especialidad.codespecialidad");  

$events = [];  
while ($resultado = $sql->fetch_assoc()) {  
    $events[] = [  
        'title' => $resultado['nombre1'] . ' ' . $resultado['apellido1'] . ' - ' . $resultado['nom1'] . ' ' . $resultado['ape1'],  
        'start' => $resultado['fechacita'],  
        'className' => 'bg-' . strtolower($resultado['color']),  
        'extendedProps' => [  
            'medico' => $resultado['nom1'] . ' ' . $resultado['ape1'],  
            'especialidad' => $resultado['color'],  
            'bloqueado' => false  
        ]  
    ];  
}  

echo json_encode($events);  
?>  