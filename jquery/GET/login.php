<?php
include 'bd.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $employeeNumber = $_GET['employeeNumber'];
        $pass = $_GET['pass'];

        $sql = "SELECT * FROM employees WHERE employeeNumber='$employeeNumber' AND pass='$pass'";
        $result = $bd->query($sql);

        if ($result->rowCount() > 0) {
            session_start();
            $_SESSION["employeeNumber"] = $employeeNumber;
            echo "true";
        }
    }
} catch(Exception $e) {    
    echo "Error con la base de datos".$e->getMessage();
}
?>
