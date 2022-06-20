<?php session_start();
    if (isset($_SESSION['username'])){
        echo "Bienvenido/a: ";
        echo $_SESSION['username'];
    }
?>

<?php
    include("templates/header.html");
?>

<body>
    <h1> Plataforma grupo 59 & 80</h1>
    <br>
    <?php
        // Si NO hay sesión iniciada...
        if (!isset($_SESSION['username'])) { 
    ?>
        <form align="center" action="views/login.php" method="get">  
            <input type="submit" value="Iniciar sesión">
        </form>
        <form align="center" action="queries/usuarios_pasajeros.php" method="post">
            <input type="submit" value="Ver Usuarios"> 
        </form>
        <form align="center" action="queries/crea_importe_datos.php" method="post">
            <input type="submit" value="importar usuarios"> 

    <?php } else { ?> 
        <?php
        // Si HAY una sesión iniciada ...

        if ($_SESSION['username'] == 'DGAC' && $_SESSION['password']== 'admin'){
            $_SESSION['tipo'] = 'administrador';
            echo $_SESSION['tipo'];
            /* Hacer form para hacer cualquier acción de administrador y sus funciones */
            // Falta boton para filtrar por fechas
            // Falta funcionalidad: cliquear propuesta y aceptar/rchazar (cambios deben verse en ambas bases)
            
            // mostrar tabla de pendientes
            require("../config/conection.php");
            $query = "SELECT *
                    FROM vuelo AS V
                    WHERE V.estado = 'pendiente';";
            $result = $db2 -> prepare($query);
            $result -> execute();
            $data = $result -> fetchAll();
            ?>
            <h3> Tabla Vuelos Aprobados </h3>
            <table>
                <tr>
                    <th> Id Vuelo </th>
                    <th> Estado </th>
                    <th> Codigo Vuelo</th>
                    <th> Fecha Salida</th>
                    <th> Fecha Llegada</th>
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
            <?php
        }

        elseif ($_SESSION['tipo'] == 'compania'){
            echo $_SESSION['tipo'];
            /* Hacer form para hacer cualquier acción de compania y sus funciones */
            $name = $_POST['username']

            // Vuelos aceptados 
            require("../config/conection.php");
            $query = "SELECT VC.codigo_compania, V.propuesta_vuelo_id, V.estado, V.codigo, V.fecha_salida, V.fecha_llegada
                    FROM vuelo AS V, vuelocompania AS VC 
                    WHERE V.propuesta_vuelo_id = VC.propuesta_vuelo_id AND VC.codigo_compania ILIKE '$name' AND V.estado = 'aceptado';";
            $result = $db2 -> prepare($query);
            $result -> execute();
            $data = $result -> fetchAll();
            
            // Vuelos rechazados
            require("../config/conection.php");
            $query2 = "SELECT VC.codigo_compania, V.propuesta_vuelo_id, V.estado, V.codigo, V.fecha_salida, V.fecha_llegada
                    FROM vuelo AS V, vuelocompania AS VC 
                    WHERE V.propuesta_vuelo_id = VC.propuesta_vuelo_id AND VC.codigo_compania ILIKE '$name' AND V.estado = 'rechazado';";
            $result2 = $db2 -> prepare($query2);
            $result2 -> execute();
            $data2 = $result2 -> fetchAll();
            // Tablas
            ?>
            <h3> Tabla Vuelos Aprobados </h3>
            <table>
                <tr>
                    <th> Codigo Compañia </th>
                    <th> Id Vuelo </th>
                    <th> Estado </th>
                    <th> Codigo Vuelo</th>
                    <th> Fecha Salida</th>
                    <th> Fecha Llegada</th>
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
                            </tr>";
                    }
                ?>
            </table>
            <h3> Tabla Vuelos Rechazados </h3>
            <table>
                <tr>
                    <th> Codigo Compañia </th>
                    <th> Id Vuelo </th>
                    <th> Estado </th>
                    <th> Codigo Vuelo</th>
                    <th> Fecha Salida</th>
                    <th> Fecha Llegada</th>
                </tr>

                <?php
                    foreach ($data2 as $d) {
                        echo "<tr>
                                <td>$d[0]</td>
                                <td>$d[1]</td>
                                <td>$d[2]</td>
                                <td>$d[3]</td>
                                <td>$d[4]</td>
                                <td>$d[5]</td>
                            </tr>";
                    }
                ?>
            </table>

        <?php}

        elseif ($_SESSION['tipo'] == 'pasajero'){
            echo $_SESSION['tipo'];
            /* Hacer form para hacer cualquier acción de pasajeros y sus funciones */




        }

        else{
            session_start();
            unset($_SESSION['timeout']);
            unset($_SESSION['password']);
            unset($_SESSION['username']);
            $_SESSION['valid'] = false;
            header('Refresh: 0; url = views/fallo_inicio de sesion.php');
        };

        ?>
        <form align="center" action="views/logout.php" method="post">
            <input type="submit" value="Cerrar sesión">
        </form>
    <?php } ?>
    
</body>

</html>