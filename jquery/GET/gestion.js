$(document).ready(function() {

   VerLista(); 

   
   function VerLista() { 

        var action = 'gestion';
        
//******//BUSCADOR
        var buscador = $('#buscador').val(); //Sin botón
        var ciudad = $('#ciudad').val();     //Con botón
/*************************************************************/

//******//SELECCIONAR CIUDAD/ES
        var city = get_city('seleccionar');
/*************************************************************/

//******//SELECCIONAR Trabajo - Aparezca lista de Trabajo
        var jobTitle = get_jobTitle('jobTitle');
/*************************************************************/

//******//SELECCIONAR RANGO DE NÚMEROS DE EMPLEADOS
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
/*************************************************************/

        var url = 'gestion.php?' + $.param({
            action: action,
            buscador: buscador,
            ciudad: ciudad,
            city: city,
            jobTitle: jobTitle,
            minimum_price: minimum_price,
            maximum_price: maximum_price
        });

        $.ajax({
            url: url,
            method: 'GET',

            success: function(data) {    
                $('.VerLista').html(data);
            },
            error: function() {
                alert('Error en la solicitud AJAX');
            }
        });
    }

//******//BUSCADOR
//Sin botón
    $('#buscador').on('input', function () {
        VerLista();
    });

    //Con botón
    $('#filtrar').on('click', function() {
        VerLista();
    });
/*************************************************************/

//******//SELECCIONAR CIUDAD/ES
    function get_city(param)
    {
        var filter = [];
        $('.'+param+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.seleccionar').on('click', function(){  //Click para ciudad - 
        VerLista();
    });
/*************************************************************/

//******//SELECCIONAR Trabajo - Aparezca lista de Trabajo
    function get_jobTitle(param) {
        var filter = $('#selectJobTitle').val();
        return filter;
    }

    //******//SELECCIONAR Trabajo - Aparezca lista de Trabajo
    $('#selectJobTitle').change(function() {
        VerLista();
    });
/*************************************************************/

//******//SELECCIONAR RANGO DE NÚMEROS DE EMPLEADOS
    $('#price_range').slider({
        range: true,
        min: 1002,
        max: 2000,
        values: [1002, 2000],
        step: 1,
        stop: function(event, ui) {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            VerLista();
        }
    });
/*************************************************************/

});


