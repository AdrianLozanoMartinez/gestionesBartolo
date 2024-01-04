<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilo.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="login.js"></script>
</head>
<body>
    <form id="formulario">
        <fieldset id="estrechar">
            <legend>L O G I N</legend>
            <label for="employeeNumber">Usuario:</label>
            <input type="text" id="employeeNumber" name="employeeNumber" required><br>
            <br><br>
            <label for="pass">Contraseña:</label>
            <input type="password" id="pass" name="pass" required><br>
            <br><br>
            <div class="centrar">
                <button type="button" onclick="login()">Iniciar sesión</button>
                <div id="result"></div>
            </div>
            <?php if(isset($_GET["err"])) {      
                echo "<p>Usuario o contraseña incorrecta</p>";
            } 
            if(isset($_GET["noLogin"])) {      
                echo "<p>Haga login para continuar</p>";
            } ?>
        </fieldset>
    </form>
</body>
</html>

