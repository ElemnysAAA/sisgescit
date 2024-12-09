<?php
include_once 'header.php';
?>

<title>SISGECIT| Pacientes</title>
<link rel="stylesheet" href="dist/css/bootstrap.min.css">

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registrar Medico </h1><br>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
              Registrar
            </button>
            <a href="pacientes.php" class="btn btn-danger">
              Regresar
            </a>

            <div class="modal fade" id="modal-lg">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Nuevo Registro</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body btn-primary">
                    <h3 class="card-title">Ingresar Datos</h3>
                  </div>
                  <form action="model/crear_medico_model.php" method="post">
                    <div class="card-body">
                      <div class="row g-4"> <!-- apertura de etiqueta div con clases de bootstrap que asigna cuantos intems del formulario pueden estar en fila -->
                        <div class="col-lg-3 text-center"> <!-- apertura de etiqueta div con clases de bootstrap que permite a los items del formulario colocarlos uno al lado del otro -->
                          <label for="cedulamedico">Cédula</label>
                          <div class="input-group">
                            <select name="TipoCedula" id="TipoCedula" class="form-control" style="width: 10px;padding: 0.300rem 0.25rem;">
                              <option value="V">V-</option>
                              <option value="E">E-</option>
                            </select>
                            <input type="text" class="form-control" name="NumeroCedula" id="NumeroCedula" placeholder="Ej.V-12345678" maxlength="8" required>
                          </div>
                      </div>
                      <div class="col-lg-3 text-center">
                        <label for="nom1">Primer nombre</label>
                        <input type="text" class="form-control" name="nom1" placeholder="Primer Nombre" style="text-transform: capitalize;">
                      </div>
                      <div class="col-lg-3 text-center">
                        <label for="nom2">Segundo nombre</label>
                        <input type="text" class="form-control" name="nom2" placeholder="Segundo Nombre" style="text-transform: capitalize;">
                      </div>
                      <div class="col-lg-3 text-center">
                        <label for="ape1">Primer apellido</label>
                        <input type="text" class="form-control" name="ape1" placeholder="Primre Apellido" style="text-transform: capitalize;">
                      </div>
                    </div><br>
                    <div class="row g-4">
                      <div class="col-lg-3 text-center">
                        <label for="ape2">Segundo apellido</label>
                        <input type="text" class="form-control" name="ape2" placeholder="Segundo APellido" style="text-transform: capitalize;">
                      </div>
                      <div class="col-lg-3 text-center">
                        <label for="">Especialidad</label>
                        <select name="codespecialidad" class="form-control">
                          <option selected disabled>Selecciona</option>
                          <?php
                          require_once("conexion.php");
                          $conexion = retornarConexion();
                          $sql = $conexion->query("SELECT * FROM  especialidad");
                          while ($resultado = $sql->fetch_assoc()) {
                            echo "<option value='" . $resultado['codespecialidad'] . "'>" . $resultado['nomespecialidad'] . "</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col-lg-3 text-center">
                        <label for="telefonomedico">Teléfono</label>
                        <div class="input-group">
                    <select name="codigoarea" class="form-control" id="codigoarea">
                      <option value="0416">0416</option>
                      <option value="0426">0426</option>
                      <option value="0424">0424</option>
                      <option value="0414">0414</option>
                      <option value="0412">0412</option>
                    </select>
                        <input type="text" class="form-control" name="telefonomedico" placeholder="0412-000-0000" maxlength="7">
                      </div>
                      </div>
                      <div class="col-lg-3 text-center">
                        <label for="correomedico">Correo</label>
                        <input type="email" class="form-control" name="correomedico" id="correomedico" placeholder="Correo Electrónico" required>
                        <div class="invalid-feedback">
                          Por favor, ingrese un correo electrónico válido.
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="card bg-primary text-center text-white">
                      <h5>Dias de Consulta</h5>
                    </div>
                    <div class="row g-5 mt-3">
                      <div class="col-lg-2 text-center">
                        <label for="">Lunes</label>
                        <input type="checkbox" name="dia[]" value="lunes" id="lunes">
                      </div>
                      <div class="col-lg-2 text-center">
                        <label for="">Martes</label>
                        <input type="checkbox" name="dia[]" value="martes" id="martes">
                      </div>
                      <div class="col-lg-2 text-center">
                        <label for="">Miércoles</label>
                        <input type="checkbox" name="dia[]" value="miercoles" id="miercoles">
                      </div>
                      <div class="col-lg-2 text-center">
                        <label for="">Jueves</label>
                        <input type="checkbox" name="dia[]" value="jueves" id="jueves">
                      </div>
                      <div class="col-lg-2 text-center">
                        <label for="">Viernes</label>
                        <input type="checkbox" name="dia[]" value="viernes" id="viernes">
                      </div>
                    </div>

                    <hr>
                    <div class="card bg-primary text-center text-white">
                      <h5>Contacto Alterno en Caso de Emergencia</h5>
                    </div>
                    <div class="row g-4">
                      <div class="col-lg-3 text-center">
                        <label for="nomalt">Nombre</label>
                        <input type="text" class="form-control" name="nomalt" placeholder="Nombre" style="text-transform: capitalize;" require>
                      </div>
                      <div class="col-lg-3 text-center">
                        <label for="apealt">Apellido</label>
                        <input type="text" class="form-control" name="apealt" placeholder="Apellido" style="text-transform: capitalize;">
                      </div>
                      <div class="col-lg-3 text-center">
                        <label for="tlfalt">Teléfono</label>
                        <input type="text" class="form-control" name="tlfalt" placeholder="Teléfono Alterno" placeholder="0212-000-0000" maxlength="11" require>
                      </div>
                      <div class="col-lg-3 text-center">
                        <label for="relacion">Parentesco</label>
                        <input type="text" class="form-control" name="relacion" placeholder="Parentesco" style="text-transform: capitalize;">
                      </div>
                    </div><br>
                    <div class="modal-footer content">
                      <button type="submit" class="btn btn-user btn-primary" id="btn-user" name="btn-user">Guardar</button>
                      <a href="crear_medico.php" class="btn btn btn-danger" ">Salir</a> 

                      </div>

                    </div>
                    <!-- /.card-body -->
                  </form>
                </div>

              </div>

            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
      </section>
  </div>
 
<script src="plugins/jquery/jquery-3.6.0.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.js"></script>
<script src="js/sweetalert2@11.js"></script>

<script>
  //boton de bootstrap
$('#btn-user').click(function(){
    Swal.fire(
    'Exito!',
    'El medico fue registrado correctamente',
    'success'
    )
});
</script>

  
  <?php
  include_once("footer.php");
  ?>