
  $(document).ready(function() {
    $('#nomespecialidad').on('change', function() {
      var codespecialidad = $(this).val();

      $.ajax({
        url: 'model/obtener_medicos.php',
        data: {
          codespecialidad: codespecialidad
        },
        type: 'POST',
        success: function(data) {
          $('#cedulamedico').html(data);
          $('#cedulamedico').prop('disabled', false); // Habilitar el selector de médicos  
        }
      });
    });
  });


  $('#cedulamedico').change(function() {  
    const medicoId = $(this).val();  
    const fechaCita = $('#fechacita').val();  
    $.ajax({  
      url: 'model/obtener_horario.php',  
      type: 'POST',  
      data: { medicoId: medicoId, fechaCita: fechaCita },  
      success: function(data) {  
        // Aquí puedes tomar la respuesta (slots disponibles) y mostrarlos  
        $('#disponibilidad').html(data);  
      }  
    });  
  });  

  $('#fechacita').change(function() {  
    const medicoId = $('#cedulamedico').val();  
    const fechaCita = $(this).val();  
    if (medicoId && fechaCita) {  
      $.ajax({  
        url: 'model/obtener_horario.php',  
        type: 'POST',  
        data: { medicoId: medicoId, fechaCita: fechaCita },  
        success: function(data) {  
          $('#disponibilidad').html(data);  
        }  
      });  
    }  
  });  
