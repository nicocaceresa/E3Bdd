<?php
    $var = intval($_GET['var']);
    session_start();
    $estado= $_POST['estado'];

    require("../config/conection.php");
    $query = "UPDATE Vuelo SET estado = '$estado' WHERE propuesta_vuelo_id = $var;";
    $result = $db2 -> prepare($query);
    $result -> execute();

    require("../config/conection.php");
    $query2 = "UPDATE Vuelos SET estado = '$estado' WHERE vid = $var;";
    $result2 = $db -> prepare($query2);
    $result2 -> execute();

    header('Location: ../views/vista_dgac.php?msg=$msg')
?>