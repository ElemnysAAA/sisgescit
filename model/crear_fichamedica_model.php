<?php  
require_once "../conexion.php";  
$conexion = retornarConexion();  

// Obtener datos del formulario y manejar datos vacíos  
$CedulaPaciente = $_POST['CedulaPaciente'];  
$nombre1 = !empty($_POST['nombre1']) ? $_POST['nombre1'] : null;  
$nombre2 = !empty($_POST['nombre2']) ? $_POST['nombre2'] : null;  
$apellido1 = !empty($_POST['apellido1']) ? $_POST['apellido1'] : null;  
$apellido2 = !empty($_POST['apellido2']) ? $_POST['apellido2'] : null;  
$lugarnac = !empty($_POST['lugarnac']) ? $_POST['lugarnac'] : null;  
$fecha = !empty($_POST['fecha']) ? $_POST['fecha'] : null;  
$edad = !empty($_POST['edad']) ? $_POST['edad'] : null;  
$genero = !empty($_POST['genero']) ? $_POST['genero'] : null;  
$telefono1 = !empty($_POST['telefono1']) ? $_POST['telefono1'] : null;  
$telefonoalterno = !empty($_POST['telefonoalterno']) ? $_POST['telefonoalterno'] : null;  
$correopaciente = !empty($_POST['correopaciente']) ? $_POST['correopaciente'] : null;  
$idEstado = !empty($_POST['idEstado']) ? $_POST['idEstado'] : null;  
$idMcpio = !empty($_POST['idMcpio']) ? $_POST['idMcpio'] : null;  
$idPquia = !empty($_POST['idPquia']) ? $_POST['idPquia'] : null;  
$direccion = !empty($_POST['direccion']) ? $_POST['direccion'] : null;  
$nivel = !empty($_POST['nivel']) ? $_POST['nivel'] : null;  
$edocivil = !empty($_POST['edocivil']) ? $_POST['edocivil'] : null;  
$ocupacion = !empty($_POST['ocupacion']) ? $_POST['ocupacion'] : null;  
$condicion = !empty($_POST['condicion']) ? $_POST['condicion'] : null;  
$nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : null;  
$apellido = !empty($_POST['apellido']) ? $_POST['apellido'] : null;  
$telefono2 = !empty($_POST['telefono2']) ? $_POST['telefono2'] : null;  
$parentesco = !empty($_POST['parentesco']) ? $_POST['parentesco'] : null;  

// Actualizar los datos del paciente  
if ($stmt = $conexion->prepare("UPDATE paciente SET   
    nombre1=?, nombre2=?, apellido1=?, apellido2=?,   
    lugarnac=?, fecha=?, edad=?, genero=?,   
    telefono1=?, telefonoalterno=?, correopaciente=?,   
    idEstado=?, idMcpio=?, idPquia=?, direccion=?,   
    nivel=?, edocivil=?, ocupacion=?, condicion=?,   
    nombre=?, apellido=?, telefono2=?, parentesco=?   
    WHERE CedulaPaciente=?")) {  
    
    // Enlazar los parámetros  
    $stmt->bind_param("ssssssssssssssssssssssss",   
        $nombre1, $nombre2, $apellido1, $apellido2,   
        $lugarnac, $fecha, $edad, $genero,   
        $telefono1, $telefonoalterno, $correopaciente,   
        $idEstado, $idMcpio, $idPquia, $direccion,   
        $nivel, $edocivil, $ocupacion, $condicion,   
        $nombre, $apellido, $telefono2, $parentesco,   
        $CedulaPaciente);  
    
    // Ejecutar la consulta  
    if ($stmt->execute()) {  
        // Verificar si se necesita insertar un nuevo historial médico  
        $resultadoHistoria = mysqli_query($conexion, "SELECT COUNT(*) AS total FROM historiamedica WHERE CedulaPaciente='$CedulaPaciente'");  
        $rowHistoria = mysqli_fetch_assoc($resultadoHistoria);  

        if ($rowHistoria['total'] == 0) {  
            // Obtener datos del historial médico y permitir campos opcionales  
            $tensionalta = !empty($_POST['tensionalta']) ? $_POST['tensionalta'] : null;  
            $tensionbaja = !empty($_POST['tensionbaja']) ? $_POST['tensionbaja'] : null;  
            $hora = !empty($_POST['hora']) ? $_POST['hora'] : null;  
            $temperatura = !empty($_POST['temperatura']) ? $_POST['temperatura'] : null;  
            $peso = !empty($_POST['peso']) ? $_POST['peso'] : null;  
            $estatura = !empty($_POST['estatura']) ? $_POST['estatura'] : null;  
            $tipodesangre = !empty($_POST['tipodesangre']) ? $_POST['tipodesangre'] : null;  
            $alergia = !empty($_POST['alergia']) ? $_POST['alergia'] : null;  
            $diabetes = !empty($_POST['diabetes']) ? $_POST['diabetes'] : null;  
            $cirugia = !empty($_POST['cirugia']) ? $_POST['cirugia'] : null;  
            $protesis = !empty($_POST['protesis']) ? $_POST['protesis'] : null;  
            $artritis = !empty($_POST['artritis']) ? $_POST['artritis'] : null;  
            $varices = !empty($_POST['varices']) ? $_POST['varices'] : null;  
            $asma = !empty($_POST['asma']) ? $_POST['asma'] : null;  
            $cancer = !empty($_POST['cancer']) ? $_POST['cancer'] : null;  
            $hipertension = !empty($_POST['hipertension']) ? $_POST['hipertension'] : null;  
            $gastroenteritis = !empty($_POST['gastroenteritis']) ? $_POST['gastroenteritis'] : null;  
            $alcohol = !empty($_POST['alcohol']) ? $_POST['alcohol'] : null;  
            $drogas = !empty($_POST['drogas']) ? $_POST['drogas'] : null;  
            $diagnostico = !empty($_POST['diagnostico']) ? $_POST['diagnostico'] : null;  

            // Insertar el historial médico  
            if ($stmtHistorial = $conexion->prepare("INSERT INTO historiamedica (tensionalta, tensionbaja, hora, peso, estatura, tipodesangre, alergia, diabetes, cirugia, protesis, artritis, varices, asma, cancer, hipertension, gastroenteritis, alcohol, drogas, diagnostico, CedulaPaciente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {  
                
                // Enlazar los parámetros  
                $stmtHistorial->bind_param("ssssssssssssssssssss",   
                    $tensionalta, $tensionbaja, $hora, $peso,   
                    $estatura, $tipodesangre, $alergia, $diabetes,   
                    $cirugia, $protesis, $artritis, $varices,   
                    $asma, $cancer, $hipertension, $gastroenteritis,   
                    $alcohol, $drogas, $diagnostico,   
                    $CedulaPaciente);  
                
                // Ejecutar el insertar  
                if ($stmtHistorial->execute()) {  
                    echo '<script> window.location = "../pacientes.php";</script>';  
                } else {  
                    echo '<script>alert("Error al insertar historia médica: ' . mysqli_error($conexion) . '"); window.location = "../pacientes.php";</script>';  
                }  

                $stmtHistorial->close();  
            } else {  
                echo '<script>alert("Error al preparar la inserción de historia médica: ' . mysqli_error($conexion) . '"); window.location = "../pacientes.php";</script>';  
            }  
        } else {  
            echo '<script>alert("La historia médica ya existe para este paciente."); window.location = "../pacientes.php";</script>';  
        }  
    } else {  
        echo '<script>alert("Error al actualizar los datos del paciente: ' . mysqli_error($conexion) . '"); window.location = "../pacientes.php";</script>';  
    }  

    $stmt->close();  
} else {  
    echo '<script>alert("Error al preparar la actualización del paciente: ' . mysqli_error($conexion) . '"); window.location = "../pacientes.php";</script>';  
}  

// Cerrar conexión  
$conexion->close();  
?>  