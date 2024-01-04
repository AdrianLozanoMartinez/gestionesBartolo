<?php
    include 'bd.php';
    include 'navbar.php';

//Mostrar opciones si es administrador / LO COMENTO PORQUE COMOE S EL MISMO AQUÍ LO COGE DEL NAVBAR
// $employeeNumber ="SELECT employeeNumber FROM employees WHERE employeeNumber = '$employeeNumber'"; 
// $employeeNumber = $bd->query($employeeNumber);
// $employeeNumber = $employeeNumber->fetch();
// $employeeNumber = $employeeNumber['employeeNumber'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $employeeNumber ?></title>
</head>
<body>
    <a href="gestionHtml.php">Gestión</a> 
    <!-- Mostrar opciones si es administrador -->
    <?php if($employeeNumber == '1002') {?>
        <hr>
        <a href="gestionHtml.php">Gestión administrador</a>
    <?php } ?>
</body>
</html>


