document.addEventListener("DOMContentLoaded", function() {
    VerLista();

    function VerLista() {
        var xhr = new XMLHttpRequest();
        var buscador = document.getElementById('buscador').value;
        var ciudad = document.getElementById('ciudad').value;
        var jobTitle = get_jobTitle();
        var city = get_selectedcity();
        var employeeRange = document.getElementById('employee_range').value;
    
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.querySelector('.VerLista').innerHTML = xhr.responseText;
            }
        };
        
        xhr.open('POST', 'gestion.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('action=gestion&buscador=' + buscador + '&ciudad=' + ciudad + '&jobTitle=' + jobTitle + '&city=' + city + '&employeeRange=' + employeeRange);
    }
    

//******//BUSCADOR
    // Sin botón
    document.getElementById('buscador').addEventListener('input', function () {
        VerLista();
    });

    // Con botón
    document.getElementById('filtrar').addEventListener('click', function() {
        VerLista();
    });
/*************************************************************/

//******//SELECCIONAR CIUDAD/ES
function get_selectedcity() {
    var selectedcity = [];
    var cityCheckboxes = document.querySelectorAll('.city:checked');

    cityCheckboxes.forEach(function (checkbox) {
        selectedcity.push(checkbox.value);
    });

    return selectedcity;
}

//Actualiza lista por cada checkbox clickeado
document.querySelectorAll('.city').forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        VerLista();
    });
});

/*************************************************************/

//******//SELECCIONAR Trabajo - Aparezca lista de Trabajo
    document.getElementById('selectJobTitle').addEventListener('change', function() {
        VerLista();
    });

    function get_jobTitle() {
        var filter = document.getElementById('selectJobTitle').value;
        return filter;
    }
/*************************************************************/

//******//SELECCIONAR Trabajo - Aparezca lista de Trabajo
    document.getElementById('employee_range').addEventListener('input', function() {
        document.getElementById('employee_range_show').innerText = this.value;
        VerLista();
    });
/*************************************************************/

});
