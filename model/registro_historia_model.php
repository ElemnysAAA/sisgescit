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
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $telefono2 = $_POST['telefono2'];
  $parentesco = $_POST['parentesco'];


  //codigo sql para insertar datos en la tabla: paciente
  $sql = "INSERT INTO historiamedica (CedulaPaciente, nombre1, nombre2, apellido1, apellido2, lugarnac, fecha, edad, genero, telefono1, telefonoalterno, correopaciente, idEstado, idMcpio, idPquia, direccion,  nombre, apellido, telefono2, parentesco) VALUES 
      ('$CedulaPaciente', '$nombre1', '$nombre2', '$apellido1', '$apellido2', '$lugarnac', '$fecha', '$edad', '$genero', '$telefono1', '$telefonoalterno', '$correopaciente', '$idEstado', '$idMcpio', '$idPquia', '$direccion',  '$nombre', '$apellido', '$telefono2', '$parentesco')";




  require_once("../controller/registro_paciente_controller.php");

