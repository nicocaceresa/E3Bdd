<?php include('../templates/header.html'); ?>

<body>
    <?php
    require("../config/conection.php");
        // $query = "SELECT *
        $query = "SELECT *
                  FROM usuarios;"; // Crear la consulta
        $result = $db -> prepare($query);
        $result -> execute();
        $data = $result -> fetchAll();
    ?>

    <table>
        <tr>
            <th> Id del usuario </th>
            <th> Username </th>
            <th> Password </th>
            <th> Tipo </th>
        </tr>

        <?php
            foreach ($data as $d) {
                echo "<tr>
                        <td>$d[0]</td>
                        <td>$d[1]</td>
                        <td>$d[2]</td>
                        <td>$d[3]</td>
                      </tr>";
            }
        ?>

    </table>

<?php include('../templates/footer.html'); ?>