<?php 

require_once("../conexion.php");  
$conexion = retornarConexion();  
$cedulamedico = $_POST['cedulamedico'];  

// Obtener días de atención  
$dia = $conexion->query("  
    SELECT DISTINCT fecha   
    FROM horario   
    WHERE cedulamedico = '$cedulaMedico' AND disponible = 1  
");  

// Guardar los días de atención y fechas disponibles  
$availableDates = [];  
while ($row = $dia->fetch_assoc()) {  
    $availableDates[] = $row['fecha'];  
}  

// Puedes definir aquí la lógica de los días de atención   
// Por ejemplo, puedes definir que si el médico trabaja lunes, miércoles y viernes, deberías tener en cuenta eso.  

echo json_encode([  
    'available_dates' => $availableDates,  
    'dias_atencion' => ['dia'] 
]);  

if (isset($_GET['medico'])) {  
    $medicoId = mysqli_real_escape_string($conexion, $_GET['medico']);  
    
    // Obtener días de atención  
    $sqlDias = "SELECT horario.dia FROM horario   
                INNER JOIN medico ON horario.cedulamedico = medico.cedulamedico   
                WHERE medico.cedulamedico = '$cedulamedico'";  
    $resultadoDias = $conexion->query($sqlDias);  
    $dia = [];  

    while ($row = $resultadoDias->fetch_assoc()) {  
        $dias[] = $row['dia'];  
    }  

    // Aquí podrías definir tu lógica para obtener fechas disponibles según el horario  
    $fechasDisponibles = []; // Un array que contendrá las fechas disponibles  
    // Ejemplo de cómo agregar fechas. Cambia esto según tu lógica.  
    $fechasDisponibles[] = date('Y-m-d', strtotime('+1 day')); // Fecha del día siguiente  
    $fechasDisponibles[] = date('Y-m-d', strtotime('+2 days')); // Fecha dos días después  

    echo json_encode(['dias' => $dias, 'fechas' => $fechasDisponibles]);  
}  