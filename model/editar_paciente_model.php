<?php 
require_once "../conexion.php";
$conexion = retornarConexion();

$CedulaPaciente =  $_POST['CedulaPaciente'];
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
$nivel= $_POST['nivel'];
$edocivil = $_POST['edocivil'];
$ocupacion= $_POST['ocupacion'];
$condicion = $_POST['condicion'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono2 = $_POST['telefono2'];
$parentesco = $_POST['parentesco'];


$sql = "UPDATE paciente SET
        nombre1 =         '$nombre1',
        nombre2 =         '$nombre2',
        apellido1=        '$apellido1',
        apellido2=        '$apellido2',
        lugarnac =        '$lugarnac',
        fecha =           '$fecha',
        edad=             '$edad',
        genero =          '$genero',
        telefono1 =       '$telefono1',
        telefonoalterno = '$telefonoalterno',
        correopaciente=   '$correopaciente',
        idEstado=         '$idEstado',
        idMcpio =         '$idMcpio',
        idPquia =         '$idPquia',
        direccion =       '$direccion',
        nivel=            '$nivel',
        edocivil =        '$edocivil',
        ocupacion=        '$ocupacion',
        condicion =       '$condicion',
        nombre=           '$nombre',
        apellido=         '$apellido',
        telefono2=        '$telefono2',
        parentesco =      '$parentesco' WHERE paciente.CedulaPaciente  = '$CedulaPaciente'";


require_once "../controller/editar_paciente_controller.php";

?>