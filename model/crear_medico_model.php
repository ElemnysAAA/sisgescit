<?php  
require_once('../conexion.php');  
$conexion = retornarConexion();  

// Recoger datos del formulario  
$tipoCedula = $_POST['TipoCedula'];
$numeroCedula = $_POST['NumeroCedula'];
$cedulamedico = $tipoCedula . $numeroCedula;
$nom1 = $_POST['nom1'];  
$nom2 = $_POST['nom2'];  
$ape1 = $_POST['ape1'];  
$ape2 = $_POST['ape2'];  
$codespecialidad = $_POST['codespecialidad'];  
$codigoarea = $_POST['codigoarea'];
$telefonomedico = $codigoarea . $_POST['telefonomedico'];
$correomedico = $_POST['correomedico'];  
$dia = $_POST['dia'];  

// Registrar médico en la tabla medico  
$queryMedico = $conexion->prepare("INSERT INTO medico (cedulamedico, nom1, nom2, ape1, ape2, codespecialidad, telefonomedico, correomedico) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");  
$queryMedico->bind_param("ssssssss", $cedulamedico, $nom1, $nom2, $ape1, $ape2, $codespecialidad, $telefonomedico, $correomedico);  
$registrarMedico = $queryMedico->execute();  

if ($registrarMedico) {  
    // Registrar los días de consulta del médico  
    foreach ($dia as $dia) {  
        $queryHorario = $conexion->prepare("INSERT INTO horario (dia, cedulamedico) VALUES (?, ?)");  
        if ($queryHorario) {  
            $queryHorario->bind_param("ss", $dia, $cedulamedico);  
        $queryHorario->execute();  
    }  
}
    echo '<script> window.location = "../medicos.php";</script>';  
} else {  
    echo '<script> alert("Error al registrar médico: ' . mysqli_error($conexion) . '"); window.location = "../medicos.php";</script>';  
 }  


// Cerrar conexiones  
$queryMedico->close();  
$conexion->close();  
?>  