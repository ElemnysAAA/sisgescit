<?php
require_once("../conexion.php");
// Cargar las clases de PHPMailer 
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$conexion = retornarConexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener información del formulario  
    $tipoCedula = $_POST['TipoCedula'] ?? '';
    $numeroCedula = $_POST['NumeroCedula'] ?? '';
    $CedulaPaciente = $tipoCedula . $numeroCedula;
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
    $status = $_POST['status'] ?? '';

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
                // Enviar correo de confirmación  
                function enviarCorreoConfirmacion($correopaciente, $nombre, $apellido, $fechacita, $tipocita, $cedulamedico, $codespecialidad ) {
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';  // Reemplaza con el host de tu proveedor de correo
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->Username = 'elemnysaguayo28@gmail.com'; // Reemplaza con tu correo
                    $mail->Password = 'hahw sjnt fbnd iptk'; // Reemplaza con tu contraseña
                    $mail->SMTPSecure = 'tls';
                    $mail->CharSet ='UTF-8';
                    $mail->Encoding = 'quoted-printable';
                
                    // Destinatario
                    $mail->setFrom('no-reply@tudominio.com', 'Unidad de Servicios de Salud Integral "Dr Jesus Saturno Canelon"');
                    $mail->addAddress($correopaciente);
                
                    // Contenido del correo
                    $mail->isHTML(true);
                    $mail->Subject = 'Confirmación de su cita médica';
                    $mail->Subject = '=?UTF-8?B?Q29uZmlybWFjaW9uIGRlIHN1IGNpcGEgbWVkaWNh?=';
                    $mensaje = '
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <meta charset="UTF-8">
                            <style>
                                /* Tus estilos CSS aquí */
                                body { font-family: Arial, sans-serif; }
                                .container { background-color: #f2f2f2; padding: 20px; }
                                .header { background-color: #333; color: #fff; padding: 10px; }
                                .content { padding: 20px; }
                            </style>
                        </head>
                        <body>
                            <div class="container">
                                <div class="header">
                                    <h2>Unidad de Servicios de Salud Integral "Dr Jesus Saturno Canelon"</h2>
                                </div>
                                <div class="content">
                                    <p>Estimado/a ' . $nombre . ' ' . $apellido . ',</p>
                                    <p>Su cita ha sido agendada con éxito.</p>
                                    <ul>
                                        <li><strong>Fecha:</strong> ' . $fechacita . '</li>
                                        <li><strong>Tipo de cita:</strong> ' . $tipocita . '</li>
                                        <li><strong>Médico:</strong> ' . $cedulamedico . '</li>
                                        <li><strong>Especialidad:</strong> ' . $codespecialidad . '</li>
                                    </ul>
                                    <p>Gracias por confiar en nosotros.</p>
                                </div>
                            </div>
                        </body>
                        </html>
                        ';
                    $mail->Body = $mensaje;

                    try {
                        $mail->send();
                        return true;
                    } catch (Exception $e) {
                        echo "Error al enviar el correo: {$mail->ErrorInfo}";
                        return false;
                    }
                }
                
                if (enviarCorreoConfirmacion($correopaciente, $nombre1, $apellido1, $fechacita, $tipocita, $cedulamedico, $codespecialidad)) {
                    echo '  
                    <script>  
                        Swal.fire({
                            title: "Éxito!",
                            text: "Cita agendada y correo enviado correctamente!",
                            icon: "success"
                        }).then(function() {
                            window.location = "../pacientes.php";
                        });
                    </script>';  
                } else {
                    echo '  
                    <script>  
                        Swal.fire({
                            title: "Error!",
                            text: "Cita agendada, pero hubo un error al enviar el correo.",
                            icon: "warning"
                        }).then(function() {
                            window.location = "../pacientes.php";
                        });
                    </script>';  
                }
            } else {
                echo '  
                <script>  
                    Swal.fire({
                        title: "Error!",
                        text: "Error al registrar la cita: ' . $conexion->error . '",
                        icon: "error"
                    }).then(function() {
                        window.location = "../pacientes.php";
                    });
                </script>';  
            }
        } else {
            echo '  
            <script>  
                Swal.fire({
                    title: "Error!",
                    text: "Error al registrar el paciente: ' . $conexion->error . '",
                    icon: "error"
                }).then(function() {
                    window.location = "../pacientes.php";
                });
            </script>';  
        }
    } else {
        echo '  
        <script>  
            Swal.fire({
                title: "Sin cupos!",
                text: "El médico ya no tiene cupos para esta fecha.",
                icon: "info"
            }).then(function() {
                window.location = "../pacientes.php";
            });
        </script>';  
    }
} else {
    echo '  
    <script>  
        Swal.fire({
            title: "Error!",
            text: "Error en la consulta: ' . $conexion->error . '",
            icon: "error"
        }).then(function() {
            window.location = "cita_primeravez_model.php";
        });
    </script>';  
}

$conexion->close();
?>


