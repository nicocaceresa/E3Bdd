<?php

$msg = $_GET['msg'];
session_start();

?>

<?php include('../templates/header.html'); ?>

<title> Aquí puedes ver tus Reservas </title>

    <?php
    $pas = $_SESSION['username'];
    require("../config/conection.php");
    $query = "SELECT T.pasaporte_pasajero, T.numero_ticket, T.numero_asiento, T.clase, T.comida_y_maleta
                FROM ticket AS T 
                WHERE T.pasaporte_pasajero = 'V03976673';";
    $result = $db -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
    ?>

            <table>
                    <tr>
                        
                        <th> Pasaporte Pasajero </th>
                        <th> Nº Ticket </th>
                        <th> Asiento </th>
                        <th> Clase </th>
                        <th> Comida/Equipaje </th>
                        <!--
                        <th> Id Vuelo </th>
                        <th> Estado Vuelo </th>
                        <th> Compañia </th>
                        <th> Aeronave </th>
                        <th> Aerodromo Origen </th>
                        <th> País Origen </th>
                        <th> Aerodromo Destino </th>
                        <th> País Destino </th> -->

                    </tr>

                    <?php
                        foreach ($data as $d) {
                            echo "<tr>
                                    <td>$d[0]</td>
                                    <td>$d[1]</td>
                                    <td>$d[2]</td>
                                    <td>$d[3]</td>
                                    <td>$d[4]</td>


                                </tr>";
                        }
                    ?>

            </table>






<body>





<?php include('../templates/footer.html'); ?>
</body>