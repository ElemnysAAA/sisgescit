<?php  
require_once("../conexion.php");  
$conexion = retornarConexion();  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Obtener datos del formulario  
$tipoCedula = $_POST['TipoCedula'];
$numeroCedula = $_POST['NumeroCedula'];
$CedulaPaciente = $tipoCedula . $numeroCedula;
$nombre1 = $_POST['nombre1'];
$apellido1 = $_POST['apellido1'];
$codigoarea = $_POST['codigoarea'];
$telefono1 = $codigoarea . $_POST['telefono1'];
$correopaciente = $_POST['correopaciente'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono2 = $_POST['telefono2'];
$parentesco = $_POST['parentesco'];
$fechacita = $_POST['fechacita'];
$tipocita = $_POST['tipocita'];
$codespecialidad = $_POST['codespecialidad'];
$cedulamedico = $_POST['cedulamedico'];
$status = $_POST['status'];

// Consultar cuántas citas están registradas para el médico en esa fecha  
$query = $conexion->query("SELECT COUNT(*) as total FROM eventos WHERE cedulamedico = '$cedulamedico' AND fechacita = '$fechacita'");
$row = $query->fetch_assoc();

if ($row['total'] < 15) {
    // Intentar insertar el paciente  
    $sqlPaciente = "INSERT INTO paciente (CedulaPaciente, nombre1, apellido1, telefono1, correopaciente, nombre, apellido, telefono2, parentesco) VALUES ('$CedulaPaciente', '$nombre1', '$apellido1', '$telefono1', '$correopaciente', '$nombre', '$apellido', '$telefono2', '$parentesco')";

    if ($conexion->query($sqlPaciente) === TRUE) {
        // Registra la cita  
        $sqlCita = "INSERT INTO eventos (fechacita, tipocita, codespecialidad, cedulamedico, CedulaPaciente, status) VALUES ('$fechacita', '$tipocita', '$codespecialidad', '$cedulamedico', '$CedulaPaciente', '$status')";
            
            if ($conexion->query($sqlCita) === TRUE) {  
                echo '  
                <script>  
                    alert("Cita agenda registrada correctamente!");  
                    window.location = "../pacientes.php";  
                </script>';  
            } else {  
                echo '  
                <script>  
                    alert("Error al registrar la cita: ' . $conexion->error . '");  
                    window.location = "cita_primeravez_model.php";  
                </script>';  
            }  
        } else {  
            echo '  
            <script>  
                alert("Error al registrar el paciente: ' . $conexion->error . '");  
                window.location = "cita_primeravez_model.php";  
            </script>';  
        }  
    } else {  
        echo '  
        <script>  
            alert("No hay cupos disponibles para esta especialidad en la fecha seleccionada.");  
            window.location = "cita_primeravez_model.php";  
        </script>';  
    }  
} else {  
    echo '  
    <script>  
        alert("Error en la consulta: ' . $conexion->error . '");  
        window.location = "cita_primeravez_model.php";  
    </script>';  
}  

$conexion->close();  
?>  