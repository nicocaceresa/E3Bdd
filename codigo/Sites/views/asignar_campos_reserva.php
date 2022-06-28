<?php
	ob_start();
	session_start();
?>

<?php
  $_SESSION['origen'] = $_GET['origen'];
  $_SESSION['destino'] = $_GET['destino'];
  $_SESSION['fecha_despegue'] = $_GET['fecha_despegue'];
  $_SESSION['valid'] = 'true';
  header('Location: ../views/vista_hacer_reserva.php?msg=$msg');
?>