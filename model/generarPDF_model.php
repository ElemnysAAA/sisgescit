<?php  
require_once("../conexion.php");  
$conexion = retornarConexion();  


header('Content-Type: application/pdf');  
header('Content-Disposition: attachment; filename="documento.pdf"');  
// Obtener datos  
$sql = "SELECT   
            eventos.codigo, eventos.fechacita, eventos.tipocita, eventos.status,   
            paciente.CedulaPaciente, paciente.nombre1, paciente.apellido1,   
            medico.cedulamedico, medico.nom1, medico.ape1,   
            especialidad.nomespecialidad  
        FROM eventos  
        INNER JOIN paciente ON eventos.CedulaPaciente = paciente.CedulaPaciente   
        INNER JOIN medico ON eventos.cedulamedico = medico.cedulamedico   
        INNER JOIN especialidad ON eventos.codespecialidad = especialidad.codespecialidad   
        WHERE 1=1";   

$ejecutar = $conexion->query($sql);  

// Generar contenido HTML  
$html = '<h2>Listado de Citas</h2>';  
$html .= '<table border="1" cellspacing="0" cellpadding="5">  
              <tr>  
                  <th>Especialidad</th>  
                  <th>Médico</th>  
                  <th>Paciente</th>  
                  <th>Tipo de Cita</th>  
                  <th>Estatus de Cita</th>  
              </tr>';  

while ($fila = $ejecutar->fetch_assoc()) {  
    $html .= '<tr>';  
    $html .= '<td>' . htmlspecialchars($fila['nomespecialidad']) . '</td>';  
    $html .= '<td>' . htmlspecialchars($fila['cedulamedico'] . ' - ' . $fila['nom1'] . ' ' . $fila['ape1']) . '</td>';  
    $html .= '<td>' . htmlspecialchars($fila['CedulaPaciente']. ' - ' . $fila['nombre1'] . ' ' . $fila['apellido1']) . '</td>';  
    $html .= '<td>' . htmlspecialchars($fila['tipocita']) . '</td>';  
    $html .= '<td>' . htmlspecialchars($fila['status']) . '</td>';  
    $html .= '</tr>';  
}  
$html .= '</table>';  

// Forzar descarga del PDF  
header("Content-Type: application/pdf");  
header("Content-Disposition: attachment; filename=listado_citas.pdf");  
header("Content-Length: " . strlen($html));  

// Usa la función para convertir HTML a PDF  
// Impresión simple al navegador como PDF  
echo $html;  

exit();  