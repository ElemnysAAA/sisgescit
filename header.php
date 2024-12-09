<?php
session_start();
if (!isset($_SESSION['id_email'])) {
    header("Location: login.php");
}

$rol_id = $_SESSION['rol_id'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SISGECIT | USSI</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="dist/img/logo.png" type="image/x-icon">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">


    <link rel="stylesheet" href="plugins/fullcalendar/main.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
<link rel="stylesheet" href="js/jquery.dataTables.min.css">
<link rel="stylesheet" href="dist/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <!--DataTables-->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <?php
    // Definir la página activa basándote en la URL  
    $pagina_actual = basename($_SERVER['PHP_SELF']);
    ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/logo.png" alt="logo" height="100" width="100">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i  
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link text-dark">Inicio</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link text-dark">Contacto</a>
                </li>
            </ul>

            <h5 class="text-center">Bienvenido(a) <?php echo $_SESSION['nombre']; ?> <?php echo ($_SESSION['apellido']); ?></h5>

            <ul class="navbar-nav ml-auto">
                <!-- Mostrar fecha y hora actual -->
                <div class="ml-auto">
                    <h5>
                        <?php
                        date_default_timezone_set('America/Caracas');
                        echo date('d/m/Y H:i'); // Formato de fecha y hora  
                        ?>
                    </h5>
                </div>
            </ul>

        </nav>

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="dist/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">SISGECIT</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="text-white"></div>
                    <div class="info">
                        <a href="#" class="d-block"></a>
                        <form method="post" action="respaldo.php">
                        <?php if ($_SESSION['rol_id'] == '1'): // Verificar si el usuario es administrador 
                        ?>
                            <form method="post" action="respaldo.php">
                                <button type="submit" class="btn btn-info" id="btn-user">Copia de Seguridad</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-sm-12 text-left mb-3">
                    
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">GESTIÓN DE CITAS</li>
                        <?php if ($rol_id == '1' || $rol_id == '2') : ?>
                            <li class="nav-item">
                                <a href="crear_paciente.php" class="nav-link <?php echo ($pagina_actual == 'crear_paciente.php') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-hospital-user text-info"></i>
                                    <p>Registrar Pacientes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="calendario.php" class="nav-link <?php echo ($pagina_actual == 'calendario.php') ? 'active' : ''; ?>">
                                    <i class="nav-icon far fa-calendar-plus text-info"></i>
                                    <p>Calendario de Citas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="citasdiarias.php" class="nav-link <?php echo ($pagina_actual == 'citasdiarias.php') ? 'active' : ''; ?>">
                                    <i class="nav-icon far fa-calendar-check text-info"></i>
                                    <p>Resumen de Citas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="graficos.php" class="nav-link <?php echo ($pagina_actual == 'graficos.php') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-chart-pie text-info"></i>
                                    <p>Graficos</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-header">GESTIÓN DE PACIENTES</li>
                        <li class="nav-item">
                            <?php if ($rol_id == '1' || $rol_id == '2' || $rol_id =='3') : ?>
                                <a href="pacientes.php" class="nav-link <?php echo ($pagina_actual == 'pacientes.php') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-clipboard-list text-info"></i>
                                    <p>Lista de Pacientes</p>
                                </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($rol_id == '1' || $rol_id == '2' || $rol_id =='3') : ?>
                        <li class="nav-item">
                            <a href="consulta_fichas_medicas.php" class="nav-link <?php echo ($pagina_actual == 'consulta_fichas_medicas.php') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-notes-medical text-info"></i>
                                <p>Consulta de Ficha Medica</p>
                            </a>
                        </li>

                    <?php endif; ?>

                    <li class="nav-header">EMERGENCIA</li>
                    <?php if ($rol_id == '1' || $rol_id == '2' || $rol_id =='3') : ?>
                        <li class="nav-item">
                            <a href="crear_ficha_emergencia.php" class="nav-link <?php echo ($pagina_actual == 'crear_ficha_emergencia.php') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-notes-medical text-info"></i>
                                <p>Ficha de Emergencia</p>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <?php if ($rol_id == '1' || $rol_id == '2' || $rol_id =='3') : ?>
                            <a href="emergencia.php" class="nav-link <?php echo ($pagina_actual == 'emergencia.php') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-clipboard-list text-info"></i>
                                <p>Registro de Emergencias</p>
                            </a>
                    </li>
                <?php endif; ?>
                <li class="nav-header">GESTIÓN DE MÉDICOS</li>
                <?php if ($rol_id == '1' || $rol_id == '2' || $rol_id =='3') : ?>
                    <li class="nav-item">
                        <a href="especialidad.php" class="nav-link <?php echo ($pagina_actual == 'especialidad.php') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-file-medical text-info"></i>
                            <p>Registrar Especialidad</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="crear_medico.php" class="nav-link <?php echo ($pagina_actual == 'crear_medico.php') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-user-md text-info"></i>
                            <p>Registrar Medicos</p>
                        </a>
                    </li>
               
                <li class="nav-item">
                    
                        <a href="medicos.php" class="nav-link <?php echo ($pagina_actual == 'medicos.php') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-clipboard-check text-info"></i>
                            <p>Lista de Medicos</p>
                        </a>
                </li>
            <?php endif; ?>

            <li class="nav-header">GESTIÓN DE USUARIOS</li>
            <?php if ($rol_id == '1' || $rol_id == '2') : ?>
                <li class="nav-item">
                    <a href="Crearusuarios.php" class="nav-link <?php echo ($pagina_actual == 'Crearusuarios.php') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-user-plus text-info"></i>
                        <p>Registro de Usuarios</p>
                    </a>
                </li>
                <li class="nav-item">
                   
                        <a href="usuarios.php" class="nav-link <?php echo ($pagina_actual == 'usuarios.php') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-user-check text-info"></i>
                            <p>Lista de Usuarios</p>
                        </a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a href="cerrar.php" class="nav-link" style="<?php echo ($pagina_actual == 'cerrar.php') ? 'background-color: #ddd;' : ''; ?>">
                    <i class="nav-icon fas fa-sign-out-alt text-info"></i>
                    <p>Salir</p>
                </a>
            </li>

                    </ul>
                </nav>
            </div>
        </aside>
    </div>
</body>

<script src="jquery-ui/jquery-ui.min.js"></script>
<script src="js/sweetalert2@11.js"></script>