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
            // dsps subo lo que tenia 
        }

        elseif ($_SESSION['tipo'] == 'compania'){
            echo $_SESSION['tipo'];
            /* Hacer form para hacer cualquier acción de compania y sus funciones */
            echo $_SESSION['username'];
            // despues subo lo que tenia x2
             }

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
        

        }?>
        <form align="center" action="views/logout.php" method="post">
            <input type="submit" value="Cerrar sesión">
        </form>
    <?php } ?>
    
</body>

</html>