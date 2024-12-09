<?php  
require_once "../conexion.php";  
$conexion = retornarConexion();  

// Obtener datos del formulario  
$tipoCedula = $_POST['TipoCedula'];
$numeroCedula = $_POST['NumeroCedula'];
$CedulaPaciente = $tipoCedula . $numeroCedula;
$CedulaPaciente = $_POST['CedulaPaciente'];  
$nombre1 = $_POST['nombre1'];  
$nombre2 = $_POST['nombre2'];  
$apellido1 = $_POST['apellido1'];  
$apellido2 = $_POST['apellido2'];  
$lugarnac = $_POST['lugarnac'];  
$fecha = $_POST['fecha'];  
$edad = $_POST['edad'];  
$genero = $_POST['genero'];  
$codigoarea = $_POST['codigoarea'];
$telefono1 = $codigoarea . $_POST['telefono1'];  
$telefonoalterno = $_POST['telefonoalterno'];  
$correopaciente = $_POST['correopaciente'];  
$idEstado = $_POST['idEstado'];  
$idMcpio = $_POST['idMcpio'];  
$idPquia = $_POST['idPquia'];  
$direccion = $_POST['direccion'];  
$nivel = $_POST['nivel'];  
$edocivil = $_POST['edocivil'];  
$ocupacion = $_POST['ocupacion'];  
$condicion = $_POST['condicion'];  
$nombre = $_POST['nombre'];  
$apellido = $_POST['apellido'];  
$codigoarea = $_POST['codigoarea'];
$telefono2 = $codigoarea . $_POST['telefono2'];
$parentesco = $_POST['parentesco'];  

// Insertar datos en la tabla paciente  
$insertar_paciente = mysqli_query($conexion, "INSERT INTO paciente (CedulaPaciente, nombre1, nombre2, apellido1, apellido2, lugarnac, fecha, edad, genero, telefono1, telefonoalterno, correopaciente, idEstado, idMcpio, idPquia, direccion, nivel, edocivil, ocupacion, condicion, nombre, apellido, telefono2, parentesco) VALUES   
    ('$CedulaPaciente', '$nombre1', '$nombre2', '$apellido1', '$apellido2', '$lugarnac', '$fecha', '$edad', '$genero', '$telefono1', '$telefonoalterno', '$correopaciente', '$idEstado', '$idMcpio', '$idPquia', '$direccion', '$nivel', '$edocivil', '$ocupacion', '$condicion', '$nombre', '$apellido', '$telefono2', '$parentesco')");  

if ($insertar_paciente) {  
    // Verificar si existe la historia médica  
    $resultadoHistoria = mysqli_query($conexion, "SELECT COUNT(*) AS total FROM historiamedica WHERE CedulaPaciente='$CedulaPaciente'");  
    $rowHistoria = mysqli_fetch_assoc($resultadoHistoria);  

    if ($rowHistoria['total'] == 0) {  
        // Recoger datos de historia médica  
        $tensionalta = $_POST['tensionalta'];  
        $tensionbaja = $_POST['tensionbaja'];  
        $hora = $_POST['hora'];  
        $temperatura = $_POST['temperatura'];  
        $peso = $_POST['peso'];  
        $estatura = $_POST['estatura'];  
        $tipodesangre = $_POST['tipodesangre'];  
        $alergia = $_POST['alergia'];  
        $diabetes = $_POST['diabetes'];  
        $cirugia = $_POST['cirugia'];  
        $protesis = $_POST['protesis'];  
        $artritis = $_POST['artritis'];  
        $varices = $_POST['varices'];  
        $asma = $_POST['asma'];  
        $cancer = $_POST['cancer'];  
        $hipertension = $_POST['hipertension'];  
        $gastroenteritis = $_POST['gastroenteritis'];  
        $alcohol = $_POST['alcohol'];  
        $drogas = $_POST['drogas'];  
        $diagnostico = $_POST['diagnostico'];  
        $CedulaPaciente = $tipoCedula . $numeroCedula;
$CedulaPaciente = $_POST['CedulaPaciente'];  

        // Insertar en `historiamedica`  
        $insertar_historia = mysqli_query($conexion, "INSERT INTO historiamedica (tensionalta, tensionbaja, hora, temperatura, peso, estatura, tipodesangre, alergia, diabetes, cirugia, protesis, artritis, varices, asma, cancer, hipertension, gastroenteritis, alcohol, drogas, diagnostico, CedulaPaciente) VALUES  
        ('$tensionalta','$tensionbaja','$hora','$temperatura','$peso','$estatura','$tipodesangre','$alergia','$diabetes','$cirugia','$protesis','$artritis','$varices','$asma','$cancer','$hipertension','$gastroenteritis','$alcohol','$drogas','$diagnostico','$CedulaPaciente')");  

        if (!$insertar_historia) {  
            echo '<script>alert("Error al registrar la historia médica: ' . mysqli_error($conexion) . '");</script>';  
        }  
    }   

    // Ahora registrar la emergencia  
    $codemergencia = $_POST['codemergencia']; // Estos campos deben ser enviados desde tu formulario  
    $tipoemergencia = $_POST['tipoemergencia'];  
    $sintomas = $_POST['sintomas'];  
    $diagnosticoemergencia = $_POST['diagnosticoemergencia'];  
    $protocolo = $_POST['protocolo'];  
    $cedulamedico = $_POST['cedulamedico'];  
    $codespecialidad = $_POST['codespecialidad'];  
    $CedulaPaciente = $tipoCedula . $numeroCedula;
$CedulaPaciente = $_POST['CedulaPaciente'];  

    $insertar_emergencia = mysqli_query($conexion, "INSERT INTO emergencia (codemergencia, tipoemergencia, sintomas, diagnosticoemergencia, protocolo, cedulamedico, codespecialidad, CedulaPaciente) VALUES   
    ('$codemergencia', '$tipoemergencia', '$sintomas', '$diagnosticoemergencia', '$protocolo', '$cedulamedico', '$codespecialidad', '$CedulaPaciente')");  

    if ($insertar_emergencia) {  
        echo '<script> window.location = "../pacientes.php";</script>';  
    } else {  
        echo '<script>alert("Error al registrar la emergencia: ' . mysqli_error($conexion) . '"); window.location = "../pacientes.php";</script>';  
    }  

} else {  
    echo '<script>alert("Error al registrar el paciente: ' . mysqli_error($conexion) . '"); window.location = "../pacientes.php";</script>';  
}  

// Cerrar la conexión  
mysqli_close($conexion);  
?>