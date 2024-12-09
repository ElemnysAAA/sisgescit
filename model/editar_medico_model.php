<?php  
require_once("../conexion.php");  
$conexion = retornarConexion();  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    // Procesar la actualización del médico  
    $cedulamedico = $_POST['cedulamedico'];  
    $nom1 = $_POST['nom1'];  
    $nom2 = $_POST['nom2'];  
    $ape1 = $_POST['ape1'];  
    $ape2 = $_POST['ape2'];  
    $codespecialidad = $_POST['codespecialidad'];  
    $telefonomedico = $_POST['telefonomedico'];  
    $correomedico = $_POST['correomedico'];  
    $nomalt = $_POST['nomalt'];  
    $apealt = $_POST['apealt'];  
    $tlfalt = $_POST['tlfalt'];  
    $relacion = $_POST['relacion'];  

    // Actualizar información del médico  
    $sql = "UPDATE medico SET  
                nom1 = ?,  
                nom2 = ?,  
                ape1 = ?,  
                ape2 = ?,  
                codespecialidad = ?,  
                telefonomedico = ?,  
                correomedico = ?,  
                nomalt = ?,  
                apealt = ?,  
                tlfalt = ?,  
                relacion = ?  
            WHERE cedulamedico = ?";  
    
    // Usando prepared statements para evitar inyecciones SQL  
    $stmt = $conexion->prepare($sql);  
    $stmt->bind_param('ssssssssssss', $nom1, $nom2, $ape1, $ape2, $codespecialidad, $telefonomedico, $correomedico, $nomalt, $apealt, $tlfalt, $relacion, $cedulamedico);  
    
    if ($stmt->execute()) {  
        // Actualizar o insertar los días de atención  
        $conexion->query("DELETE FROM horario WHERE cedulamedico = '$cedulamedico'"); // Opcional: Eliminar días anteriores primero  
        
        if (isset($_POST['dias'])) {  
            $dias = $_POST['dias'];  
            foreach ($dias as $dia) {  
                $stmt = $conexion->prepare("INSERT INTO horario (cedulamedico, dia) VALUES (?, ?)");  
                $stmt->bind_param('ss', $cedulamedico, $dia); // Preparar para la inserción  
                $stmt->execute();  
            }  
        }  
        
        echo '<script> window.location = "../medicos.php";</script>';  
    } else {  
        echo "Error al actualizar el médico: " . $conexion->error;  
    }  
}  

// Cargar datos del médico al cargar la página  
$cedulamedico = $_GET['cedulamedico'];  
$sql = "SELECT * FROM medico WHERE cedulamedico = ?";  
$stmt = $conexion->prepare($sql);  
$stmt->bind_param('s', $cedulamedico);  
$stmt->execute();  
$result = $stmt->get_result();  
$medico = $result->fetch_assoc();  
?>  