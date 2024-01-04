function login() {
    var employeeNumber = document.getElementById('employeeNumber').value;
    var pass = document.getElementById('pass').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'login.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

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

    // Construye la cadena de datos para enviar
    var data = 'employeeNumber=' + encodeURIComponent(employeeNumber) + '&pass=' + encodeURIComponent(pass);

    // Envía la solicitud
    xhr.send(data);
}
