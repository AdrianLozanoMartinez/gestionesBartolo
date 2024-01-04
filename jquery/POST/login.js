function login() {
    var employeeNumber = $('#employeeNumber').val();
    var pass = $('#pass').val();

    $.ajax({
        type: 'POST',
        url: 'login.php',
        data: {
            employeeNumber: employeeNumber, 
            pass: pass
        },
        success: function(response) {
            if(response.trim() === 'true') {
                window.location.href = "home.php";
            } else {
                window.location.href = "index.php?err=true";
            }
        },
        error: function() {
            alert('Error en la solicitud AJAX');
        }
    });
}
