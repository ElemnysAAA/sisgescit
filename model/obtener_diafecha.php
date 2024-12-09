<?php  
include("../conexion.php");  
$conexion = retornarConexion();  

$fecha_actual = date('Y-m-d'); // O la fecha que desees como límite  

// Query para contar citas por fecha  
$query = "SELECT fechacita, COUNT(*) as total FROM eventos WHERE fechacita >= '$fecha_actual' GROUP BY fechacita HAVING total >= 15";  
$fechas_bloqueadas = $conexion->query($query);  

// Crear un array de fechas bloqueadas  
$fechasBloqueadasArray = [];  
while ($row = $fechas_bloqueadas->fetch_assoc()) {  
    $fechasBloqueadasArray[] = $row['fechacita'];  
}  

$cedulamedico = $_POST['cedulamedico'];  

// Obtener días que atiende el médico  
$diasQuery = $conexion->query("  
    SELECT dia  
    FROM horario  
    WHERE cedulamedico = '$cedulamedico'  
");  

// Obtener fechas disponibles y cupos  
$fechasDisponiblesQuery = $conexion->query("  
    SELECT fechacita, COUNT(*) as totalCitas, cupos_asignados  
    FROM eventos  
    WHERE cedulamedico = '$cedulamedico'  
    GROUP BY fechacita  
");  

// Preparar días para mostrar  
$dias = [];  
while ($row = $diasQuery->fetch_assoc()) {  
    $dias[] = $row['dia'];  
}  
$diasString = implode(', ', $dias);  

// Preparar fechas y cupos disponibles  
$fechasYcupos = [];  
while ($row = $fechasDisponiblesQuery->fetch_assoc()) {  
    $fechasYcupos[] = [  
        'fechacita' => $row['fechacita'],  
        'totalCitas' => $row['totalCitas'],  
        'cupos_asignados' => $row['cupos_asignados'],  
        'cupos_disponibles' => $row['cupos_asignados'] - $row['totalCitas']  
    ];  
}  

// Enviar respuesta JSON  
$response = [  
    'dias' => $diasString,  
    'fechas' => $fechasYcupos  
];  
echo json_encode($response);  
?>  