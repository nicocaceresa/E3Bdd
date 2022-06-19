<?php
	ob_start();
	session_start();
?>
<!-- FALTA VALIDAR QUE EL USUARO ESTE REGISTRADO EN LAS BBDD -->
<?php
    $msg = '';
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password']))
    {   // LO quE ESTA A CONTINUACIÓN NO SIRVE, pues no filtra
        $rut = $_POST['username'];
        $user_password = $_POST['password'];
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];

        $msg = "Sesión iniciada correctamente";
        header("Location: ../index.php?msg=$msg");
    }
    else {
        $_SESSION['valid'] = false;
        $msg = "El usuario o la contraseña no son correctos, por favor vuelva a intentar"
        // FALTA REDIRIGIR A LA MISMA PAGINA DE INICIO DE SESIÓN
    }
?>