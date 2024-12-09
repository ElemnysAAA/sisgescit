<?php  
require_once("../conexion.php");  
$conexion = retornarConexion();  

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    // Obtener datos del formulario  
  
    $CedulaPaciente = $_POST['CedulaPaciente'] ?? ''; 
    $nombre1 = $_POST['nombre1'] ?? '';  
    $apellido1 = $_POST['apellido1'] ?? '';  
    $codigoarea = $_POST['codigoarea'] ?? '';  
    $telefono1 = $codigoarea . ($_POST['telefono1'] ?? '');  
    $correopaciente = $_POST['correopaciente'] ?? '';  
    $nombre = $_POST['nombre'] ?? '';  
    $apellido = $_POST['apellido'] ?? '';  
    $telefono2 = $_POST['telefono2'] ?? '';  
    $parentesco = $_POST['parentesco'] ?? '';  
    $fechacita = $_POST['fechacita'] ?? '';  
    $tipocita = $_POST['tipocita'] ?? '';  
    $codespecialidad = $_POST['codespecialidad'] ?? '';  
    $cedulamedico = $_POST['cedulamedico'] ?? '';  
    $status = $_POST['status'] ?? 'Pendiente';  

    // Validar datos  
    if (empty($fechacita) || empty($tipocita) || empty($codespecialidad) || empty($cedulamedico)) {  
        die("Todos los campos obligatorios deben ser llenados.");  
    }  

    // Consultar cuántas citas están registradas para el médico en esa fecha  
    $query = $conexion->query("SELECT COUNT(*) as total FROM eventos WHERE cedulamedico = '$cedulamedico' AND fechacita = '$fechacita'");  
    $row = $query->fetch_assoc();  

    // Verificar si el número total de citas es menor a 15  
    if ($row['total'] < 15) {  
        // Intentar insertar el paciente  
        $sqlPaciente = "INSERT INTO paciente (CedulaPaciente, nombre1, apellido1, telefono1, correopaciente, nombre, apellido, telefono2, parentesco) VALUES ('$CedulaPaciente', '$nombre1', '$apellido1', '$telefono1', '$correopaciente', '$nombre', '$apellido', '$telefono2', '$parentesco')";  

        if ($conexion->query($sqlPaciente) === TRUE) {  
            // Registra la cita  
            $sqlCita = "INSERT INTO eventos (fechacita, tipocita, codespecialidad, cedulamedico, CedulaPaciente, status) VALUES ('$fechacita', '$tipocita', '$codespecialidad', '$cedulamedico', '$CedulaPaciente', '$status')";  

            if ($conexion->query($sqlCita) === TRUE) {  
                echo '<script>  
                        alert("Cita agendada registrada correctamente!");  
                        window.location = "../consulta_fichas_medicas.php";  
                      </script>';  
            } else {  
                echo "Error al registrar la cita: " . $conexion->error;  
            }  
        } else {  
            echo "Error al registrar el paciente: " . $conexion->error;  
        }  
    } else {  
        echo "El médico ya tiene el máximo de citas agendadas para esa fecha.";  
    }  
}  
$conexion->close(); // Cerrar la conexión  
?>