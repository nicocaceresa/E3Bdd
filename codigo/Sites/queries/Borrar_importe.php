<?php include('../templates/header.html'); ?>

<body>
    <?php
    require("../config/conection.php");
        // $query = "SELECT *
        $query = "DELETE FROM usuarios;"; // Crear la consulta
        $result = $db -> prepare($query);
        $result -> execute();
    ?>
    </table>

<?php include('../templates/footer.html'); ?>