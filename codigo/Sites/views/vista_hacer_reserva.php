<?php
	$msg = $_GET['msg'];
    session_start();
?>

<?php include('../templates/header.html'); ?>

<title> Aquí podrás hacer tus Reservas </title>

<body>

<?php $pas = $_SESSION['username']; echo "$pas Llena los campos para hacer tu Reserva";
    
        require("../config/conection.php");
        $query = "SELECT AL2.nombre_ciudad, AL1.nombre_ciudad, V.fecha_salida
                    FROM Vuelo AS V, VueloAerodromo AS VA, Aerodromo AS A1, Aerodromo AS A2, AerodromoLugar AS AL1, AerodromoLugar AS AL2 
                    WHERE V.estado = 'aceptado' AND V.propuesta_vuelo_id = VA.propuesta_vuelo_id AND VA.aerodromo_llegada_id = A1.aerodromo_id 
                            AND VA.aerodromo_salida_id = A2.aerodromo_id AND A1.aerodromo_id = AL1.aerodromo_id AND A2.aerodromo_id = AL2.aerodromo_id;";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $data = $result -> fetchAll(); ?>

        <form method='post'>
            <select name='origen'>
                <option value='' disabled selected>Ciudad Origen</option>
                <?php foreach ($data as $d){ echo "<option value='' >$d[0]</option>";}?>
            </select>
            <select name='destino'>
                <option value='' disabled selected>Ciudad Destino</option>
                <?php foreach ($data as $d){ echo "<option value='' >$d[1]</option>";}?>
            </select>
            <select name='fecha_despegue'>
                <option value='' disabled selected>Fecha Despegue</option>
                <?php foreach ($data as $d){ echo "<option value='' >$d[2]</option>";}?>
            </select>
            <input type='submit' value='Buscar Vuelo'> </form>
        

<?php include('../templates/footer.html'); ?>
</body>

