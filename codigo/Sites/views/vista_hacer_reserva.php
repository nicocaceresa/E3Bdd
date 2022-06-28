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

        <form action='asignar_campos_reserva.php' method='get'>
            <select name='origen'>
                <option value='' disabled selected>Ciudad Origen</option>
                <?php foreach ($data as $d){ echo "<option value='$d[0]' name= 'origen'>$d[0]</option>";}?>
            </select>
            <select name='destino'>
                <option value='' disabled selected>Ciudad Destino</option>
                <?php foreach ($data as $d){ echo "<option value='$d[1]' name= 'destino'>$d[1]</option>";}?>
            </select>
            <select name='fecha_despegue'>
                <option value='' disabled selected>Fecha Despegue</option>
                <?php foreach ($data as $d){ echo "<option value='$d[2]' name= 'fecha_despegue'>$d[2]</option>";}?>
            </select>
            <input type='submit' value='Buscar Vuelo'> </form>

<?php
if ($_SESSION['valid']== 'true') {
    $_SESSION['valid'] = 'false';
    //mostrar vuelos!!!
    $origen = $_SESSION['origen'];
    $destino = $_SESSION['destino'];
    $fecha_despegue = $_SESSION['fecha_despegue'];
    echo "VUELOS DISPONIBLES";

    require("../config/conection.php");
    $query = "SELECT V.propuesta_vuelo_id, AL2.nombre_ciudad, A2.nombre, AL1.nombre_ciudad, A1.nombre, V.fecha_salida, V.fecha_llegada, VC.codigo_compania 
    FROM Vuelo AS V, VueloAerodromo AS VA, Aerodromo AS A1, Aerodromo AS A2, AerodromoLugar AS AL1, AerodromoLugar AS AL2, VueloCompania AS VC 
    WHERE V.estado = 'aceptado' AND V.propuesta_vuelo_id = VA.propuesta_vuelo_id AND VA.aerodromo_llegada_id = A1.aerodromo_id 
            AND VA.aerodromo_salida_id = A2.aerodromo_id AND A1.aerodromo_id = AL1.aerodromo_id AND A2.aerodromo_id = AL2.aerodromo_id 
            AND V.propuesta_vuelo_id = VC.propuesta_vuelo_id AND AL2.nombre_ciudad = '$origen' AND AL1.nombre_ciudad = '$destino' AND V.fecha_salida >= '$fecha_despegue';";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
    ?>

            <table>
                    <tr>
                        <th> Id Vuelo </th>
                        <th> Origen </th>
                        <th> Aerodromo Origen </th>
                        <th> Destino</th>
                        <th> Aerodromo Destino</th>
                        <th> Fecha Salida</th>
                        <th> Fecha Llegada</th>
                        <th> Compañia</th>
                    </tr>

                    <?php
                        foreach ($data as $d) {
                            echo "<tr>
                                    <td>$d[0]</td>
                                    <td>$d[1]</td>
                                    <td>$d[2]</td>
                                    <td>$d[3]</td>
                                    <td>$d[4]</td>
                                    <td>$d[5]</td>
                                    <td>$d[6]</td>
                                    <td>$d[7]</td>
                                </tr>";
                        }
                    ?>

            </table>
            <?php


}
?>

<?php include('../templates/footer.html'); ?>
</body>

