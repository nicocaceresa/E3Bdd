<?php
	ob_start();
	session_start();
?>

<?php
  $_SESSION['fecha1'] = $_GET['fecha1'];
  $_SESSION['fecha2'] = $_GET['fecha2'];
  $_SESSION['fechas'] = 'true';
  header('Location: ../views/vista_dgac.php?msg=$msg');
?>