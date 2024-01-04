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
        if (isset($_POST["buscador"])) {
            $sql .= "AND (e.firstName LIKE '%" . $_POST["buscador"] . "%' OR e.lastName LIKE '%" . $_POST["buscador"] . "%')"; //Añadimos e. para que sepa que proviene de LEFT JOIN employees AS r ON e.reportsTo = r.employeeNumber
        }

        //Con botón
        if(isset($_POST["ciudad"])) {
            $ciudad = strtolower($_POST["ciudad"]);
            $sql .= "AND LOWER(city) LIKE '%" . $ciudad . "%'";
        }
/*************************************************************/

//******//SELECCIONAR CIUDAD/ES
		if(isset($_POST["city"]))
		{
			$ciudad_filter = implode("','", $_POST["city"]); //Implode espera un array
			$sql .= "AND city IN ('$ciudad_filter')";
		}
/*************************************************************/
 
//******//SELECCIONAR Trabajo/s - Aparezca lista de Trabajo/s
        if(isset($_POST["jobTitle"]) && $_POST["jobTitle"] != '')
        {
            // Si solo hay una opción seleccionada, no necesitas usar implode
            $job_filter = is_array($_POST["jobTitle"]) ? implode("','", $_POST["jobTitle"]) : $_POST["jobTitle"];
            $sql .= "AND e.jobTitle IN ('$job_filter')"; //Añadimos e. para que sepa que proviene de LEFT JOIN employees AS r ON e.reportsTo = r.employeeNumber
        }
/*************************************************************/


//******//SELECCIONAR RANGO DE NÚMEROS DE EMPLEADOS
        if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
        {
            $sql .= "AND e.employeeNumber BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'"; //Añadimos e. para que sepa que proviene de LEFT JOIN employees AS r ON e.reportsTo = r.employeeNumber
        }
/*************************************************************/

//******//PAGINACION - Elegir número de registro a mostrar
    $limit = isset($_POST['num_registros']) ? $_POST['num_registros'] : 10; // Número de registros, si está marcado se usa, sino 10
    $paginaActual = isset($_POST['paginaActual']) ? $_POST['paginaActual'] : 1; // Moverse - En caso de que no exista la página, la ponemos a 1

    if (!$paginaActual) { // Si no existe la página o página = 0
        $inicio = 0;
        $paginaActual = 1;
    } else {
        $inicio = ($paginaActual  - 1) * $limit;  //Si la página es 5, al quitarle 1 sería la 4. Al multiplicarlo por 10, cogería a partir del registro 40. Restamos 1 porque
                                           //si estamos en la 1º página al restarle 1 da 0 y multiplicar por 10 es 0, el inicio del registro comienza en 0
    }

    $sql .= " LIMIT $inicio, $limit";
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