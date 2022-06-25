<?php
	$msg = $_GET['msg'];
    session_start();
?>

<?php include('../templates/header.html'); ?>

<body>
    <br>
    <h1> Bienvenido/a  a tu Vista Compañia </h1> <?php echo $_SESSION['username']?>
    <br>
    <h3> Tabla vuelos APROBADOS </h3>
    <br>
    <?php
        $compania = $_SESSION['username'];
        require("../config/conection.php");
        $query = "SELECT VC.codigo_compania, V.propuesta_vuelo_id, V.estado, V.codigo, V.fecha_salida, V.fecha_llegada, A.codigo_aeronave, A.nombre_aeronave, A2.nombre, A1.nombre
               FROM vuelo AS V, vuelocompania AS VC, vueloaeronave AS VA, vueloaerodromo AS VA2, aeronave as A, aerodromo AS A1, aerodromo as A2
               WHERE V.propuesta_vuelo_id = VC.propuesta_vuelo_id AND VC.codigo_compania LIKE '$compania' AND V.estado LIKE 'aceptado' 
               AND V.propuesta_vuelo_id = VA.propuesta_vuelo_id AND VA.codigo_aeronave = A.codigo_aeronave 
               AND V.propuesta_vuelo_id = VA2.propuesta_vuelo_id AND VA2.aerodromo_llegada_id = A1.aerodromo_id AND VA2.aerodromo_salida_id = A2.aerodromo_id;";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $data = $result -> fetchAll();
    ?>

    <table>
            <tr>
                <th> Codigo Compañia </th>
                <th> Id Vuelo </th>
                <th> Estado </th>
                <th> Codigo Vuelo</th>
                <th> Fecha Salida</th>
                <th> Fecha Llegada</th>
                <th> Codigo Aeronave</th>
                <th> Nombre Aeronave</th>
                <th> Aerodromo Salida (Partida)</th>
                <th> Aerodromo Llegada (Destino)</th>
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
                            <td>$d[8]</td>
                            <td>$d[9]</td>
                        </tr>";
                }
            ?>

    </table>

    <br>
    <h3> Tabla vuelos RECHAZADOS </h3>
    <br>
    <?php
        require("../config/conection.php");
        $query2 = "SELECT VC.codigo_compania, V.propuesta_vuelo_id, V.estado, V.codigo, V.fecha_salida, V.fecha_llegada, A.codigo_aeronave, A.nombre_aeronave, A2.nombre, A1.nombre
               FROM vuelo AS V, vuelocompania AS VC, vueloaeronave AS VA, vueloaerodromo AS VA2, aeronave as A, aerodromo AS A1, aerodromo as A2
               WHERE V.propuesta_vuelo_id = VC.propuesta_vuelo_id AND VC.codigo_compania LIKE '$compania' AND V.estado LIKE 'rechazado' 
               AND V.propuesta_vuelo_id = VA.propuesta_vuelo_id AND VA.codigo_aeronave = A.codigo_aeronave 
               AND V.propuesta_vuelo_id = VA2.propuesta_vuelo_id AND VA2.aerodromo_llegada_id = A1.aerodromo_id AND VA2.aerodromo_salida_id = A2.aerodromo_id;";
        $result2 = $db2 -> prepare($query2);
        $result2 -> execute();
        $data2 = $result2 -> fetchAll();
    ?>

    <table>
            <tr>
                <th> Codigo Compañia </th>
                <th> Id Vuelo </th>
                <th> Estado </th>
                <th> Codigo Vuelo</th>
                <th> Fecha Salida</th>
                <th> Fecha Llegada</th>
                <th> Codigo Aeronave</th>
                <th> Nombre Aeronave</th>
                <th> Aerodromo Salida (Partida)</th>
                <th> Aerodromo Llegada (Destino)</th>
            </tr>

            <?php
                foreach ($data2 as $d2) {
                    echo "<tr>
                            <td>$d2[0]</td>
                            <td>$d2[1]</td>
                            <td>$d2[2]</td>
                            <td>$d2[3]</td>
                            <td>$d2[4]</td>
                            <td>$d2[5]</td>
                            <td>$d2[6]</td>
                            <td>$d2[7]</td>
                            <td>$d2[8]</td>
                            <td>$d2[9]</td>
                        </tr>";
                }
            ?>

    </table>




<?php include('../templates/footer.html'); ?>
</body>
</html>
