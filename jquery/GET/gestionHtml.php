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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>
<body>
    <h1>Bienvenido a gestiones Bartolo s.a.</h1>

<!-- BUSCADOR -->
    <fieldset style="width: 10%;">
        <legend>Buscador</legend>
        <input type="text" name="buscador" id="buscador" placeholder="firstName o lastName, Sin botón">
        <input type="text" id="ciudad" placeholder="Ciudad, Con botón" />
        <br><br>
        <button id="filtrar">Filtrar</button>
    </fieldset>
<!--------------------------------------------------------->

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
            <label><input type="checkbox" class="seleccionar city" value="<?php echo $row['city']; ?>"> <?php echo $row['city']; ?></label>
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
    <option value="" selected >Seleccione una categoría o Aquí para ver todas</option>
    <?php foreach ($result as $row) { ?>
        <option value="<?php echo $row['jobTitle']; ?>"><?php echo $row['jobTitle']; ?></option>
    <?php } ?>
</select>

</fieldset> 
<!--------------------------------------------------------->

<br>

<!-- SELECCIONAR RANGO DE NÚMEROS DE EMPLEADOS -->
    <fieldset style="width: 5%;"> 
        <legend>Número de empleado</legend>
        <input type="hidden" id="hidden_minimum_price" value="1002" />
        <input type="hidden" id="hidden_maximum_price" value="2000" />
        <p id="price_show">1002 - 2000</p>
        <!-- <div id="price_range" style="width: 5%;"></div> --> <!--Sino se usa el fieldset-->
        <div id="price_range"></div> <!--Si se usa el fieldset-->
    </fieldset>
<!--------------------------------------------------------->

<br>
    <div class="VerLista"></div> 

    <a href="../home.php">Home</a>

    <script src="gestion.js"></script>
</body>
</html>
