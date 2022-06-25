<?php
	$msg = $_GET['msg'];
    session_start();
?>

<?php include('../templates/header.html'); ?>

<body>
	<h3> Pag. en progreso uwu </h3>
	<br>
    <!-- Mostrar listado vuelos pendientes, usuario puede cliquear la propuesta y aceptar/rechazar
        CAMBIOS DEBEN REFLEJARSE EN AMBAS BASES
        tambien pueden filtrar las propuestas por fecha (2 campos para ingresar fecha y boton filtrar)-->
    <form align="center" action='asignar_fechas.php' method="get">
        <input type="date" name="fecha1" placeholder="fecha 1" required autofocus>
        <input type="date" name="fecha2" placeholder="fecha 2" required>
        <button type="submit" name="login"> Filtrar </button>

    </form>
    <?php 
        echo $_SESSION['username'];
        echo $_SESSION['fechas'];
        if ($_SESSION['fechas']== 'true') {
            
            $_SESSION['fechas'] = 'false';

            $date1 = $_SESSION['fecha1'];
            $date2 = $_SESSION['fecha2'];
            echo $date1;
            echo $date2;

            // Mostrar tabla con vuelos pendientes!

        }
    ?>
    

    <?php include('../templates/footer.html'); ?>
</body>