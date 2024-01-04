function login() {
    var employeeNumber = document.getElementById('employeeNumber').value;
    var pass = document.getElementById('pass').value;

    // Construye la cadena de parámetros para enviar
    var params = 'employeeNumber=' + encodeURIComponent(employeeNumber) + '&pass=' + encodeURIComponent(pass);

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'login.php?' + params, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                var response = xhr.responseText.trim();
                if (response === 'true') {
                    window.location.href = "home.php";
                } else {
                    window.location.href = "index.php?err=true";
                }
            } else {
                alert('Error en la solicitud AJAX');
            }
        }
    };

    // Envía la solicitud
    xhr.send();
}
