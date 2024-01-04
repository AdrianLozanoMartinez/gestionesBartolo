$(document).ready(function() {
    // Esta función se ejecuta cuando el DOM está completamente cargado

    //******//PAGINACION - Elegir número de registro a mostrar
    document.getElementById("num_registros").addEventListener("change", VerLista);

    let paginaActual = 1;
    /*************************************************************/

    // M O S T R A R   T A B L A
   VerLista(); 

   
   function VerLista() { 
        //******//PAGINACION - Elegir número de registro a mostrar 
        let num_registros = document.getElementById("num_registros").value;
        /*************************************************************/

        //Icono de carga mientras carga la tabla, que es sustituida usando lo mismo cambiando el contenido html(...)
       $('.VerLista').html('<div id="loading"></div>'); //Ponemos . por ser clase y # si es id
       
       //Meter datos que vaya al archivo.php
        var action = 'gestion';
        
//******//BUSCADOR
        var buscador = $('#buscador').val(); //Sin botón
        var ciudad = $('#ciudad').val();     //Con botón
/*************************************************************/

//******//SELECCIONAR CIUDAD/ES
        var city = get_city('city');
/*************************************************************/

//******//SELECCIONAR Trabajo - Aparezca lista de Trabajo
        var jobTitle = get_jobTitle('jobTitle');
/*************************************************************/

//******//SELECCIONAR RANGO DE NÚMEROS DE EMPLEADOS
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
/*************************************************************/

        $.ajax({
            url: 'gestion.php',
            method: 'POST',
            data:{
                action:action, 
                buscador:buscador, //Sin botón
                ciudad: ciudad,    //Con botón
                city:city,
                jobTitle:jobTitle,
                minimum_price:minimum_price, 
                maximum_price:maximum_price,
                num_registros:num_registros, //Paginacion - Elegir número de registro a mostrar
                paginaActual:paginaActual                 //Paginación - Moverse
            },

            // Si la RESPUESTA es positiva
            success: function(data) {    
                $('.VerLista').html(data);

                // Actualiza la variable de paginación con el valor recibido del servidor
                // paginacion = data.paginacion;
            },
            //Si da error en la petición
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

//******//PAGINACION
// Botones de paginación
$('.paginacion').on('click', function() {
    var direction = $(this).data('direction');
    if (direction === 'prev' && paginaActual > 1) { 
        paginaActual--; 
    } else if (direction === 'next') {
        paginaActual++;
    }
    VerLista();
});

/*************************************************************/
});


