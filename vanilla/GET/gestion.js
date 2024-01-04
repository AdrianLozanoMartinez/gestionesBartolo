document.addEventListener("DOMContentLoaded", function () {
    VerLista();

    function VerLista() {
        var buscador = document.getElementById('buscador').value;
        var ciudad = document.getElementById('ciudad').value;
        var jobTitle = get_jobTitle();
        var city = get_selectedcity();
        var employeeRange = document.getElementById('employee_range').value;

        var url = 'gestion.php?action=gestion';
        url += '&buscador=' + encodeURIComponent(buscador);
        url += '&ciudad=' + encodeURIComponent(ciudad);
        url += '&jobTitle=' + encodeURIComponent(jobTitle);
        url += '&city=' + encodeURIComponent(city.join(',')); // Convertir array a cadena
        url += '&employeeRange=' + encodeURIComponent(employeeRange);

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.querySelector('.VerLista').innerHTML = xhr.responseText;
            }
        };

        xhr.open('GET', url, true);
        xhr.send();
    }

    // Sin botón
    document.getElementById('buscador').addEventListener('input', function () {
        VerLista();
    });

    // Con botón
    document.getElementById('filtrar').addEventListener('click', function () {
        VerLista();
    });
    
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

    //******//SELECCIONAR Trabajo - Aparezca lista de Trabajo
    document.getElementById('selectJobTitle').addEventListener('change', function() {
        VerLista();
    });

    function get_jobTitle() {
        var filter = document.getElementById('selectJobTitle').value;
        return filter;
    }

    //******//SELECCIONAR Trabajo - Aparezca lista de Trabajo
    document.getElementById('employee_range').addEventListener('input', function() {
        document.getElementById('employee_range_show').innerText = this.value;
        VerLista();
    });
});
