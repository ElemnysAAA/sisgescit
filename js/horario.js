document.addEventListener("DOMContentLoaded", function () {  
    document.getElementById("nomespecialidad").addEventListener("change", function () {  
        const especialidadId = this.value;  
        
        // Aquí harás una llamada AJAX para obtener los médicos basados en la especialidad  
        fetch(`getMedicos.php?especialidad=${especialidadId}`)  
            .then(response => response.json())  
            .then(data => {  
                const medicoSelect = document.getElementById("cedulamedico");  
                medicoSelect.innerHTML = "<option select disabled>-- Médico --</option>"; // Limpiar opciones  
                
                data.forEach(medico => {  
                    medicoSelect.innerHTML += `<option value="${medico.cedulamedico}">${medico.nom1}</option>`;  
                });  

                medicoSelect.disabled = false; // Habilitar el select de médicos  
            });  
    });  

    document.getElementById("cedulamedico").addEventListener("change", function () {  
        const cedulamedico = this.value;  

        // Llamada AJAX para obtener días de atención  
        fetch(`../obtener_horario.php?medico=${cedulamedico}`)  
            .then(response => response.json())  
            .then(data => {  
                document.getElementById("dias").value = data.dias.join(", ");  
                populateFechasDisponibles(data.fechas); // Llamar a función para llenar fechas  
            });  
    });  

    function populateFechasDisponibles(fechas) {  
        const fechasSelect = document.getElementById("fechasDisponibles");  
        fechasSelect.innerHTML = "<option select disabled>-- Fechas Disponibles --</option>"; // Limpiar opciones  

        fechas.forEach(fecha => {  
            fechasSelect.innerHTML += `<option value="${fecha}">${fecha}</option>`;  
        });  

        fechasSelect.disabled = false; // Habilitar el select de fechas  
    }  
});  