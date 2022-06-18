<?php include('../templates/header.html'); ?>

<body>
    <?php
    require("../config/conection.php");
        // $query = "SELECT *
        $query = "SELECT *
                  FROM pasajeros;"; // Crear la consulta
        $result = $db -> prepare($query);
        $result -> execute();
        $data = $result -> fetchAll();
    ?>

    <table>
        <tr>
            <th> Pasaporte del pasajero </th>
            <th> Nombre </th>
        </tr>

        <?php
            foreach ($data as $d) {
                echo "<tr>
                        <td>$d[0]</td>
                        <td>$d[1]</td>
                      </tr>";
            }
        ?>

    </table>

<?php include('../templates/footer.html'); ?>