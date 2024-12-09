<?php
include_once "header.php";
?>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- fullCalendar -->
<link rel="stylesheet" href="plugins/fullcalendar/main.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">

<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Calendario</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">  
    <div class="container-fluid">  
        <div class="row">  
            <div class="col-md-3">  
                <div class="sticky-top mb-3">  
                    <div class="card">  
                        <div class="card-header">  
                            <h4 class="card-title">Especialidades</h4>  
                        </div>  
                        <div class="card-body">  
                            <div id="external-events">  
                                <?php  
                                include_once 'conexion.php';  
                                $conexion = retornarConexion();  
                                $sql = "SELECT medico.nom1, medico.ape1, especialidad.nomespecialidad, especialidad.color   
                                        FROM medico  
                                        INNER JOIN especialidad ON medico.codespecialidad = especialidad.codespecialidad";  
                                $result = $conexion->query($sql);  

                                if ($result->num_rows > 0) {  
                                    while ($row = $result->fetch_assoc()) {  
                                        echo '<div class="external-event" style="background-color: ' . htmlspecialchars($row["color"]) . ';">' . htmlspecialchars($row["nomespecialidad"]) . ' ' . htmlspecialchars($row["nom1"]) . ' ' . htmlspecialchars($row["ape1"]) . '</div>';  
                                    }  
                                } else {  
                                    echo "0 resultados";  
                                }  
                                $conexion->close();  
                                ?>  
                            </div>  
                        </div>  
                    </div>  
                </div>  
            </div>  

            <div class="col-md-9">  
                <div class="card card-primary">  
                    <div class="card-body p-0">  
                        <div id="calendar"></div>  
                    </div>  
                </div>  
            </div>  
        </div>  
    </div>  
</section>  
    </div>

<!-- jQuery -->  
<script src="plugins/jquery/jquery.min.js"></script>  
<!-- Bootstrap -->  
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>  
<!-- Moment.js -->  
<script src="plugins/moment/moment.min.js"></script>  
<!-- fullCalendar -->  
<script src="plugins/fullcalendar/main.js"></script>  
<!-- AdminLTE App -->  
<script src="dist/js/adminlte.min.js"></script>  

<script>  
    $(function() {  
        var containerEl = document.getElementById('external-events');  
        var calendarEl = document.getElementById('calendar');  

        // Initialize the calendar  
        var calendar = new FullCalendar.Calendar(calendarEl, {  
            headerToolbar: {  
                left: 'prev,next today',  
                center: 'title',  
                right: 'dayGridMonth,timeGridWeek,timeGridDay'  
            },  
            
            droppable: true,  
            dateClick: function(info) {  
                var selectedDate = info.dateStr;  
                $('#fechacita').val(selectedDate);  
                $('#cedulamedico').prop('disabled', false);  
                console.log("Fecha seleccionada: " + selectedDate);  
            },  
            eventClick: function(info) {  

    // Llenar el formulario solo para mostrar la información del evento seleccionado  
    $('#CedulaPaciente').val(info.event.extendedProps.numeroCedula).prop('disabled', true);  
    $('#nombre1').val(info.event.extendedProps.nombrePaciente).prop('disabled', true);  
    $('#apellido1').val(info.event.extendedProps.apellido1).prop('disabled', true);  
    $('#tipocita').val(info.event.extendedProps.tipoCita).prop('disabled', true);  
    $('#nomespecialidad').val(info.event.extendedProps.codespecialidad).prop('disabled', true);  
    $('#cedulamedico').val(info.event.extendedProps.cedulaMedico).prop('disabled', true);  
    $('#FechaCita').val(info.event.start.toISOString().split('T')[0]).prop('disabled', true);  

    // Mostrar el modal  
    $("#formAgendarCita").modal('show');  
}  ,
            events: function(fetchInfo, successCallback, failureCallback) {  
                $.ajax({  
                    url: 'model/obtener_eventos.php',  
                    method: 'GET',  
                    success: function(data) {  
                        const events = data.map(event => ({  
                            title: event.title,  
                            start: event.start,  
                            className: event.className,  
                            color: event.color,  
                            extendedProps: {  
                                medico: event.medico,  
                                especialidad: event.especialidad,  
                                detalles: event.detalles  
                            }  
                        }));  
                        successCallback(events);  
                    },  
                    error: function() {  
                        failureCallback();  
                    }  
                });  
            },  
            eventDidMount: function(info) {  
                info.el.classList.add(info.event.className);  
                info.el.style.backgroundColor = info.event.color;  
            },  
            themeSystem: 'bootstrap'  
        });  
        calendar.render();

    });
</script>

<?php
include_once "footer.php";
?>