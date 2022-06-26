<?php

$msg = $_GET['msg'];
session_start();

?>

<?php include('../templates/header.html'); ?>

<title> Aquí puedes ver tus Reservas </title>

    <?php
    $pas = $_SESSION['username'];
    require("../config/conection.php");
    $query = "SELECT R.reserva_id, R.pasaporte_comprador, R.codigo_reserva FROM reservas AS R WHERE pasaporte_comprador = '$pas'";
    $result = $db -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
    ?>

            <table>
                    <tr>
                        <th> Id Reserva </th>
                        <th> Pasaporte Comprador </th>
                        <th> Codigo Reserva </th>

                    </tr>

                    <?php
                        foreach ($data as $d) {
                            echo "<tr>
                                    <td>$d[0]</td>
                                    <td>$d[1]</td>
                                    <td>$d[2]</td>

                                </tr>";
                        }
                    ?>

            </table>






<body>





<?php include('../templates/footer.html'); ?>
</body>