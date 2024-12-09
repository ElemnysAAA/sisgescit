<?php  
require_once("conexion.php");  
$conexion = retornarConexion();  

$sql = "SELECT eventos.codigo, eventos.fechacita, eventos.tipocita, eventos.status,   
               paciente.CedulaPaciente, paciente.nombre1, paciente.apellido1,   
               medico.nom1, medico.ape1, especialidad.nomespecialidad  
        FROM eventos  
        INNER JOIN paciente ON eventos.CedulaPaciente = paciente.CedulaPaciente   
        INNER JOIN medico ON eventos.cedulamedico = medico.cedulamedico   
        INNER JOIN especialidad ON eventos.codespecialidad = especialidad.codespecialidad";  

$resultado = $conexion->query($sql);  

$data = [];  
while ($row = $resultado->fetch_assoc()) {  
    $data[] = $row; // Almacena cada fila en el array $data  
}  

// Convierte los datos a formato JSON para usar en el frontend  
$json_data = json_encode($data);  
?>  