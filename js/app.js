$(document).ready(function() {  
  // Inicializar DataTable  
  $('#tablaResultados').DataTable();  

  // Ocultar inicialmente el gráfico y la tabla  
  $('#tablaResultados').hide();  
  $('#myChart').parent().hide();  

  $('#consultarBtn').on('click', function() {  
      const tipoVista = $('#tipoVista').val();  
      
      // Limpiar la tabla y el gráfico antes de la consulta  
      $('#tablaResultados').DataTable().clear().draw();  

      // Aquí deberías realizar la consulta y llenar tu tabla con los nuevos datos, luego del AJAX o la lógica que utilices  

      // Mostrar/ocultar según la opción seleccionada  
      if (tipoVista === 'tabla') {  
          $('#tablaResultados').show();  
          $('#myChart').parent().hide();  
      } else if (tipoVista === 'grafico') {  
          $('#tablaResultados').hide();  
          $('#myChart').parent().show();  
      } else if (tipoVista === 'ambos') {  
          $('#tablaResultados').show();  
          $('#myChart').parent().show();  
      }  
  });  

  // Preparar datos para el gráfico (aquí debes hacerlo después de recibir los datos de la consulta)  
  // Por ejemplo, podrías tener un AJAX que obtiene los datos y luego genera el gráfico  
  function crearGrafico(datos) {  
      const labels = [];  
      const dataPoints = [];  

      datos.forEach(item => {  
          const nombreMedico = item.nombreMedico;  // Cambia según tu estructura de datos  
          // Similar a cómo llenamos los datos antes  
          if (!labels.includes(nombreMedico)) {  
              labels.push(nombreMedico);  
              dataPoints.push(1);  
          } else {  
              const index = labels.indexOf(nombreMedico);  
              dataPoints[index]++;  
          }  
      });  

      // Crear gráfico  
      const ctx = document.getElementById('myChart').getContext('2d');  
      const myChart = new Chart(ctx, {  
          type: 'bar',  
          data: {  
              labels: labels,  
              datasets: [{  
                  label: 'Número de Citas',  
                  data: dataPoints,  
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',  
                  borderColor: 'rgba(75, 192, 192, 1)',  
                  borderWidth: 1  
              }]  
          },  
          options: {  
              scales: {  
                  y: {  
                      beginAtZero: true  
                  }  
              }  
          }  
      });  
  }  
});  