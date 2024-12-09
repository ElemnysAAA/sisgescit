<?php

include_once("header.php");

?>


<title>SISGECIT| Pacientes</title>
<link rel="stylesheet" href="dist/css/bootstrap.min.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-4">

          <!-- form start -->
          <form action="model/crear_especialidad_model.php" method="post">

            <div class="card-body">
              <div class="form-group">
                <label for="">Especialidad</label>
                <input type="text" class="form-control" name="nomespecialidad" id="nomespecialidad" placeholder="Ingrese la Especialidad" style="text-transform: capitalize;">
              </div>
              <div class="form-group">
                <label for="color">Color para la especialidad</label>
                <select class="form-control" name="color" id="color">
                  <option value="seleccione">Seleccione</option>
                  <option value="blue">Azul</option>
                  <option value="green">Verde</option>
                  <option value="yellow">Amarillo</option>
                  <option value="red">Rojo</option>
                  <option value="orange">Naranja</option>
                  <option value="purple">Púrpura</option>
                  <option value="pink">Rosa</option>
                  <option value="gray">Gris</option>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-user btn btn-primary" id="btn-user" name="btn-user">Guardar</button>
                <a href="especialidad.php" type="submit" class="btn btn btn-danger" name="especialidad.php">Salir</a>
              </div>
            </div>
          </form>
        </div>
        <!-- /.modal -->
      </div>
    </div>
  </section>
</div>
<script src="plugins/jquery/jquery-3.6.0.min.js"></script>
<script src="js/sweetalert2@11.js"></script>

<script>
  //boton de bootstrap
  $('#btn-user').click(function() {
    Swal.fire(
      'Exito!',
      'Especialidad Registrada',
      'success'
    )
  });
</script>

<?php
include_once("footer.php");
?>