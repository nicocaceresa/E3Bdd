<?php
	ob_start();
	session_start();
?>

<?php
        require("../config/conection.php");
        $query = "SELECT *
                  FROM usuarios
                  WHERE Tipo = 'pasajero';"; // Crear la consulta
        $result = $db -> prepare($query);
        $result -> execute();

        $data_pasajeros = $result -> fetchAll();
?>

<?php
        require("../config/conection.php");
        $query = "SELECT *
                  FROM usuarios
                  WHERE Tipo = 'compania';"; // Crear la consulta
        $result = $db -> prepare($query);
        $result -> execute();

        $data_companias = $result -> fetchAll();
?>


<?php
    $msg = '';
    $pasajero = false;
    $compania = false;
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password']))
    {


        foreach ($data_pasajeros as $dp) {
            if ($_POST['username'] == $dp[1]){
                $pasajero = true;
            }
        };

        foreach ($data_companias as $dc) {
            if ($_POST['username'] == $dc[1]){
                $compania = true;
            }
        };


        if ($_POST['username'] == 'DGAC' && $_POST['password']== 'admin'){
            $_SESSION['tipo'] = 'administrador';
        }

        elseif ($compania == true){
            $_SESSION['tipo'] = 'compania';
        }

        elseif ($pasajero == true){
            $_SESSION['tipo'] = 'pasajero';
        }

        else{
            $_SESSION['tipo'] = 'no registrado';
        }

        



        $rut = $_POST['username'];
        $user_password = $_POST['password'];
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];



        $msg = "Sesión iniciada correctamente";
        header("Location: ../index.php?msg=$msg");
    }
?>