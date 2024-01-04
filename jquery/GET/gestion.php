<?php
include 'bd.php';
try {
    $sql = "SELECT e.employeeNumber AS employeeNumber, e.lastName AS lastName, e.firstName AS firstName, e.extension AS extension, e.email AS email, 
        o.city AS city, r.firstName AS reportsTo, e.jobTitle AS jobTitle, e.pass AS pass
        FROM employees AS e
        JOIN offices AS o ON o.officeCode = e.officeCode
        LEFT JOIN employees AS r ON e.reportsTo = r.employeeNumber #Mostrar el nombre del reportsTo
        WHERE e.employeeNumber > 0 ";  //Incluido para poder usar AND y añadir otras operaciones, ponemos > 0 porque no existe nada menor de 0 y así coger todos los elementos

//******//BUSCADOR
        //Sin botón
        if (isset($_GET["buscador"])) {
            $sql .= "AND (e.firstName LIKE '%" . $_GET["buscador"] . "%' OR e.lastName LIKE '%" . $_GET["buscador"] . "%')"; //Añadimos e. para que sepa que proviene de LEFT JOIN employees AS r ON e.reportsTo = r.employeeNumber
        }

        //Con botón
        if(isset($_GET["ciudad"])) {
            $ciudad = strtolower($_GET["ciudad"]);
            $sql .= "AND LOWER(city) LIKE '%" . $ciudad . "%'";
        }
/*************************************************************/

//******//SELECCIONAR CIUDAD/ES
        if (isset($_GET["city"]) && is_array($_GET["city"])) {
            $ciudad_filter = implode("','", $_GET["city"]);
            $sql .= "AND city IN ('$ciudad_filter')";
        }
/*************************************************************/
 
//******//SELECCIONAR Trabajo/s - Aparezca lista de Trabajo/s
    if (isset($_GET["jobTitle"]) && $_GET["jobTitle"] != '') {
        $job_filter = $_GET["jobTitle"];
        $sql .= "AND e.jobTitle IN ('$job_filter')"; //Añadimos e. para que sepa que proviene de LEFT JOIN employees AS r ON e.reportsTo = r.employeeNumber
    }
/*************************************************************/

//******//SELECCIONAR RANGO DE NÚMEROS DE EMPLEADOS
        if(isset($_GET["minimum_price"], $_GET["maximum_price"]) && !empty($_GET["minimum_price"]) && !empty($_GET["maximum_price"]))
        {
            $sql .= "AND e.employeeNumber BETWEEN '".$_GET["minimum_price"]."' AND '".$_GET["maximum_price"]."'"; //Añadimos e. para que sepa que proviene de LEFT JOIN employees AS r ON e.reportsTo = r.employeeNumber
        }
/*************************************************************/

    //PARTE EN COMÚN CON BUSCADOR
    $employees = $bd->query($sql);
    $result = $employees->fetchAll(PDO::FETCH_ASSOC);
    $total_row = $employees->rowCount();
        $output = '';

        if($total_row > 0)
        {
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

            foreach($result as $row)
            {
            $output .= '
                    <tr>
						<td>'.$row['employeeNumber'].'</td>
						<td>'.$row['lastName'].'</td>
						<td>'.$row['firstName'].'</td>
						<td>'.$row['email'].'</td>
						<td>'.$row['city'].'</td>
						<td>'.$row['reportsTo'].'</td>
						<td>'.$row['jobTitle'].'</td>
					</tr>';
            }

            $output .= '</table>';
        }else {
            $output = 'No Data Found';
        }
        echo $output;    
    
} catch (PDOException $e) {
   echo $e->getMessage();
}

?>