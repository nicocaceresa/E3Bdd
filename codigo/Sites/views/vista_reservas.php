<?php

$msg = $_GET['msg'];
session_start();

?>

<?php include('../templates/header.html'); ?>

<title> Aquí puedes ver tus Reservas </title>

    <?php
    $pas = $_SESSION['username'];
    require("../config/conection.php");
    $query = "SELECT T.pasaporte_pasajero, T.reserva_id, T.numero_ticket, T.numero_asiento, T.clase, T.comida_y_maleta, V.vuelo_id, V.estado, V.codigo_compania, V.codigo_aeronave, (A1.nombre, A1.nombre_pais) AS aa1, (A2.nombre, A2.nombre_pais) AS aa2
                FROM ticket AS T, vuelos AS V, aerodromos AS A1, aerodromos AS A2
                WHERE T.pasaporte_pasajero = '$pas' AND T.vuelo_id = V.vuelo_id AND V.aerodromo_salida_id = A1.aerodromo_id AND V.aerodromo_llegada_id = A2.aerodromo_id;";
    $result = $db -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
    ?>

            <table>
                    <tr>
                        
                        <th> Pasaporte Pasajero </th>
                        <th> Id Reserva </th>
                        <th> Nº Ticket </th>
                        <th> Asiento </th>
                        <th> Clase </th>
                        <th> Comida/Equipaje </th>
                        <th> Id Vuelo </th>
                        <th> Estado Vuelo </th>
                        <th> Compañia </th>
                        <th> Aeronave </th>
                        <th> Origen </th>
                        <th> Destino </th>

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
                                    <td>$d[10]</td>
                                    <td>$d[11]</td>

                                </tr>";
                        }
                    ?>

            </table>






<body>





<?php include('../templates/footer.html'); ?>
</body>