<?php
	$msg = $_GET['msg'];
    session_start();
?>

<?php include('../templates/header.html'); ?>

<title> Aquí podrás hacer tus Reservas </title>

<body>

<?php echo $_SESSION['username']; echo " Llena los campos para hacer tu Reserva"; ?>




<?php include('../templates/footer.html'); ?>
</body>

