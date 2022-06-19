<!-- Si ya se inicio sesión se redirige al inicio, 
    AQUI DEBEN APARECEN LAS OPCIONES PARA CADA TIPO DE USUARIO: ADMIN, COMPANIA y PASAJERO-->
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
        if (!isset($_SESSION['username'])) { 
    ?>
        <!-- Si hay un inicio de sesión, se muestra la pag para login-->
        <form align="center" action="views/login.php" method="get">  
            <input type="submit" value="Iniciar sesión">
        </form>

        <form align="center" action="queries/usuarios_pasajeros.php" method="post">
            <input type="submit" value="Ver Usuarios"> 
        </form>
        <form align="center" action="queries/crea_importe_datos.php" method="post">
            <input type="submit" value="importar usuarios"> 
        <form align="center" action="queries/Borrar_importe.php" method="post">
            <input type="submit" value="Borrar el importación de usuarios"> 
        </form>
    <?php } else { ?>
        <!-- Si ya hay un inicio de sesión, se le da la opción de cerrarla-->
        <form align="center" action="views/logout.php" method="post">
            <input type="submit" value="Cerrar sesión">
        </form>
        <form align="center" action="consultas/pokemones.php" method="post">
            <input type="submit" value="Ver pokemones">
        </form>
        <form align="center" action="consultas/pelea_pokemon.php" method="post">
            <input type="submit" value="Ver peleas">
        </form>
        <form align="center" action="consultas/crear_pelea_pokemon.php" method="post">
            <input type="text" name="pid1">
            <input type="text" name="pid2">
            <input type="submit" value="Crear pelea">
        </form>
    <?php } ?>
    
</body>

</html>