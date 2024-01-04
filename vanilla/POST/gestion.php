<?php
include 'bd.php';

try {
    $sql = "SELECT e.employeeNumber AS employeeNumber, e.lastName AS lastName, e.firstName AS firstName, e.extension AS extension, e.email AS email, 
        o.city AS city, r.firstName AS reportsTo, e.jobTitle AS jobTitle, e.pass AS pass
        FROM employees AS e
        JOIN offices AS o ON o.officeCode = e.officeCode
        LEFT JOIN employees AS r ON e.reportsTo = r.employeeNumber
        WHERE e.employeeNumber > 0 ";

//******//BUSCADOR
        //Sin botón
        if (isset($_POST["buscador"])) {
            $sql .= "AND (e.firstName LIKE '%" . $_POST["buscador"] . "%' OR e.lastName LIKE '%" . $_POST["buscador"] . "%')";
        }

        //Con botón
        if(isset($_POST["ciudad"])) {
            $ciudad = strtolower($_POST["ciudad"]);
            $sql .= "AND LOWER(city) LIKE '%" . $ciudad . "%'";
        }
/*************************************************************/

//******//SELECCIONAR CIUDAD/ES
        if (isset($_POST["city"]) && ($_POST["city"] != '')) {

            //Si $_POST["city"] es una cadena, conviértela en un array
            $selectedCities = is_array($_POST["city"]) ? $_POST["city"] : explode(",", $_POST["city"]);

            $ciudad_filter = implode("','", $selectedCities);
            $sql .= "AND city IN ('$ciudad_filter')";
        }
/*************************************************************/

//******//SELECCIONAR Trabajo/s - Aparezca lista de Trabajo/s
        if (isset($_POST["jobTitle"]) && $_POST["jobTitle"] != '') {
            // Si solo hay una opción seleccionada, no necesitas usar implode
            $job_filter = is_array($_POST["jobTitle"]) ? implode("','", $_POST["jobTitle"]) : $_POST["jobTitle"];
            $sql .= "AND e.jobTitle IN ('$job_filter')"; // Añadimos e. para que sepa que proviene de LEFT JOIN employees AS r ON e.reportsTo = r.employeeNumber
        }
/*************************************************************/

//******//SELECCIONAR RANGO DE NÚMEROS DE EMPLEADOS
if(isset($_POST["employeeRange"]) && !empty($_POST["employeeRange"]))
{
    $employeeRange = $_POST["employeeRange"];
    $sql .= "AND e.employeeNumber >= '$employeeRange' ORDER BY e.employeeNumber ASC";
}
/*************************************************************/

    $employees = $bd->query($sql);
    $result = $employees->fetchAll(PDO::FETCH_ASSOC);
    $total_row = $employees->rowCount();
    $output = '';

    if ($total_row > 0) {
        $output .= '<table border="1">
                    <tr>
                        <th>Employee Number</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Reports To</th>
                        <th>Job Title</th>
                    </tr>';

        foreach ($result as $row) {
            $output .= '
                    <tr>
                        <td>' . $row['employeeNumber'] . '</td>
                        <td>' . $row['lastName'] . '</td>
                        <td>' . $row['firstName'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['city'] . '</td>
                        <td>' . $row['reportsTo'] . '</td>
                        <td>' . $row['jobTitle'] . '</td>
                    </tr>';
        }

        $output .= '</table>';
        // echo $sql;
    } else {
        $output = 'No Data Found';
    }
    echo $output;
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
