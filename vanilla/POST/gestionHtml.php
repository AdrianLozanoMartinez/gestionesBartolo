<?php
    include 'bd.php';
    include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión</title>
</head>
<body>
    <h1>Bienvenido a gestiones Bartolo s.a.</h1>
    
    <!-- BUSCADOR -->
    <fieldset style="width: 10%;">
        <legend>Buscador</legend>
        <input type="text" name="buscador" id="buscador" placeholder="firstName o lastName, Sin botón">
        <input type="text" id="ciudad" placeholder="Ciudad, Con botón">
        <br><br>
        <button id="filtrar">Filtrar</button>
    </fieldset>
    <!----------------------------------------------------------- -->
    <br>

<!-- SELECCIONAR CIUDAD/ES - Aparezca lista de ciudades -->
   <fieldset style="width: 10%;">
    <legend><b>Ciudad</b></legend>
   <?php
        $sql = 'SELECT DISTINCT(o.city) FROM employees AS e JOIN offices AS o ON o.officeCode = e.officeCode ORDER BY o.city ASC';
        $employees = $bd->query($sql);
        $result = $employees->fetchAll(PDO::FETCH_ASSOC);
        $total_row = $employees->rowCount();

        foreach($result as $row)
        { ?>
        <div>
            <label><input type="checkbox" class="seleccionar city" name="city[]" value="<?php echo $row['city']; ?>"> <?php echo $row['city']; ?></label>
        </div>
    <?php } ?>
   </fieldset>
<!--------------------------------------------------------->

<br>

<!-- SELECCIONAR Trabajo - Aparezca lista de Trabajo -->
    <fieldset style="width: 10%;">
        <legend>Trabajos</legend>
        <?php
            $sql = 'SELECT DISTINCT(jobTitle) FROM employees ORDER BY jobTitle ASC';
            $employees = $bd->query($sql);
            $result = $employees->fetchAll(PDO::FETCH_ASSOC);
            $total_row = $employees->rowCount();
        ?>
        <select id="selectJobTitle" class="seleccionar jobTitle">
            <option value="" selected>Seleccione una categoría</option>
            <?php foreach($result as $row){ ?>
                <option value="<?php echo $row['jobTitle']; ?>"><?php echo $row['jobTitle']; ?></option>
            <?php } ?>
        </select>

    </fieldset> 
<!--------------------------------------------------------->

<br>

<!-- SELECCIONAR RANGO DE NÚMEROS DE EMPLEADOS -->
<fieldset style="width: 20%;"> 
        <legend>Número de empleado</legend>
        <input type="range" min="1002" max="2000" value="1002" id="employee_range" class="seleccionar" />
        <p id="employee_range_show">1002</p>
    </fieldset>
<!--------------------------------------------------------->

    <div class="VerLista"></div> 
    <a href="../home.php">Home</a>

    <script src="gestion.js"></script>
</body>
</html>
