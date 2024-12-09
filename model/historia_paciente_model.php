<?php  
require_once "../conexion.php";  
$conexion = retornarConexion();  

$CedulaPaciente = $_POST['CedulaPaciente'];  
$nombre1 = $_POST['nombre1'];  
$nombre2 = $_POST['nombre2'];  
$apellido1 = $_POST['apellido1'];  
$apellido2 = $_POST['apellido2'];  
$lugarnac = $_POST['lugarnac'];  
$fecha = $_POST['fecha'];  
$edad = $_POST['edad'];  
$genero = $_POST['genero'];  
$telefono1 = $_POST['telefono1'];  
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
$telefono2 = $_POST['telefono2'];  
$parentesco = $_POST['parentesco'];    
$cedulamedico= $_POST['cedulamedico'];

// Actualizar los datos del paciente  
$actualizar_paciente = mysqli_query($conexion, "UPDATE paciente SET   
    nombre1='$nombre1',   
    nombre2='$nombre2',   
    apellido1='$apellido1',   
    apellido2='$apellido2',   
    lugarnac='$lugarnac',   
    fecha='$fecha',   
    edad='$edad',   
    genero='$genero',   
    telefono1='$telefono1',   
    telefonoalterno='$telefonoalterno',   
    correopaciente='$correopaciente',   
    idEstado='$idEstado',   
    idMcpio='$idMcpio',   
    idPquia='$idPquia',   
    direccion='$direccion',   
    nivel='$nivel',   
    edocivil='$edocivil',   
    ocupacion='$ocupacion',   
    condicion='$condicion',   
    nombre='$nombre',   
    apellido='$apellido',   
    telefono2='$telefono2',   
    parentesco='$parentesco',
    cedulamedico = '$cedulamedico' 
WHERE CedulaPaciente='$CedulaPaciente'");  



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

$actualizar_historia = mysqli_query($conexion, "UPDATE historiamedica SET   
    peso = '$peso',  
    estatura = '$estatura',  
    tipodesangre = '$tipodesangre',  
    alergia = '$alergia',  
    diabetes = '$diabetes',  
    cirugia = '$cirugia',  
    protesis = '$protesis',  
    artritis = '$artritis',  
    varices = '$varices',  
    asma = '$asma',  
    cancer = '$cancer',  
    hipertension = '$hipertension',  
    gastroenteritis = '$gastroenteritis',  
    alcohol = '$alcohol',  
    drogas = '$drogas',  
    diagnostico = '$diagnostico'   
WHERE codhistoria = '$codhistoria'");  

if ($actualizar_paciente && $actualizar_historia) {  
    echo '<script>alert("Los datos del paciente e historia médica se actualizaron correctamente!"); window.location = "../consulta_historias.php";</script>';  
} else {  
    echo '<script>alert("Error al actualizar los datos: ' . mysqli_error($conexion) . '"); window.location = "../consulta_historias.php";</script>';  
}  
?> ;