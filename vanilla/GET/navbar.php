<?php

session_start();
if(!isset($_SESSION['employeeNumber'])){	
    header("Location: index.php?noLogin=true");
}

$employeeNumber = $_SESSION['employeeNumber'];

//Mostrar opciones si es administrador
$employeeNumber ="SELECT employeeNumber FROM employees WHERE employeeNumber = '$employeeNumber'"; 
$employeeNumber = $bd->query($employeeNumber);
$employeeNumber = $employeeNumber->fetch();
$employeeNumber = $employeeNumber['employeeNumber'];
?>

<nav style='background: lightblue; display:flex; justify-content:center; align-items: center;'>
    <h1>Empleado conectado: <?php echo $employeeNumber ?></h1>
    <div>
        <a href="logout.php" style='text-decoration: none; margin-left: 10px;'><button>Salir</button></a>
        <a href="gestionHtml.php"><button>Gestión</button></a> 
        <!-- Mostrar opciones si es administrador -->
        <?php if($employeeNumber == '1002') {?>
            <hr>
            <a href="gestionHtml.php"><button>Gestión administrador</button></a>
        <?php } ?>
    </div>
</nav>

