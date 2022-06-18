<?php include('../templates/header.html'); ?>

    <?php
        require("../config/conection.php");
        $query = "SELECT importar_pasajeros();";
        $result = $db -> prepare($query);
        $result -> execute();
        $data = $result -> fetchAll();
    ?>

<?php include '../templates/footer.html' ?>