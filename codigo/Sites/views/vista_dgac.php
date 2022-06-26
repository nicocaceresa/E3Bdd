<?php
	$msg = $_GET['msg'];
    session_start();
?>

<?php include('../templates/header.html'); ?>

<body>
	<h3> Aquí puedes ver los vuelos pendientes y evaluarlos  </h3>
	<br>
    
    <form align="center" action='asignar_fechas.php' method="get">
        <input type="date" name="fecha1" placeholder="fecha 1" required autofocus>
        <input type="date" name="fecha2" placeholder="fecha 2" required>
        <button type="submit" name="login"> Filtrar </button>

    </form>
    <?php 

        if ($_SESSION['fechas']== 'true') {
            
            $_SESSION['fechas'] = 'false';

            $date1 = $_SESSION['fecha1'];
            $date2 = $_SESSION['fecha2'];
            echo $date1;
            echo $date2;

            // Mostrar tabla con vuelos pendientes!
            echo 'TABLA VUELOS PENDIENTES'; 
            require("../config/conection.php");
            $query = "SELECT V.propuesta_vuelo_id, VC.codigo_compania, V.estado, V.codigo, V.fecha_salida, V.fecha_llegada, A.codigo_aeronave, A.nombre_aeronave, A2.nombre, A1.nombre
                FROM vuelo AS V, vuelocompania AS VC, vueloaeronave AS VA, vueloaerodromo AS VA2, aeronave as A, aerodromo AS A1, aerodromo as A2
                WHERE V.propuesta_vuelo_id = VC.propuesta_vuelo_id AND V.estado LIKE 'pendiente' 
                AND V.propuesta_vuelo_id = VA.propuesta_vuelo_id AND VA.codigo_aeronave = A.codigo_aeronave 
                AND V.propuesta_vuelo_id = VA2.propuesta_vuelo_id AND VA2.aerodromo_llegada_id = A1.aerodromo_id AND VA2.aerodromo_salida_id = A2.aerodromo_id 
                AND V.fecha_salida >= '$date1' AND V.fecha_llegada <= '$date2';";
            $result = $db2 -> prepare($query);
            $result -> execute();
            $data = $result -> fetchAll();

            ?>

            <table>
                    <tr>
                        <th> Id Vuelo </th>
                        <th> Codigo Compañia </th>
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
                                    <td>
                                    <form action='logica_dgac.php?var=$d[0]' method='post'>
                                    <select name='estado'>
                                        <option value='$d[0]' name='id' disabled selected>$d[0]</option>
                                        <option value='aceptado'>Aceptar</option>
                                        <option value='rechazado'>Rechazar</option>
                                    </select>
                                    <input type='submit' value='Enviar cambios'> </form>
                                    </td>
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
            <?php
        }

    ?>
    

    <?php include('../templates/footer.html'); ?>
</body>