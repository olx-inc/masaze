<?php

  require_once "../classes/ProcessEvent.php";

  $action = strtolower($_GET["a"]);

  if (1 == $action) {
    $processEvent = new ProcessEvent($action);
    $processEvent->process();
    $message = "Solicitud enviada con exito.";
  }
  else if (2 == $action) {
    $processEvent = new ProcessEvent($action);
    $processEvent->process();
    $message = "Turnos procesados exitosamente.";
  }

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>masaże :: Appointment system</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<div class="wrapper">
			<header>
				<div class="header-logo">
					<img src="images/logo.png" alt="masaże logo" />
				</div>
			</header>

			<section class="">
				<br/><br/>
				<h2>Bienvenido !</h2>
				<br/><br/>
				<h4>Si querés enviar una notificacion, hacé click aquí</h4>
				<br/><br/>
				<div class="button-content">
					<a href="index.php?a=1" class="button">Enviar Solicitud</a>
				</div>
        <br/>
				<h4>Si procesar la asignacion de turnos, hacé click aquí</h4>
				<br/><br/>
				<div class="button-content">
					<a href="index.php?a=2" class="button">Procesar Turnos</a>
				</div>
			</section>
			<br/><br/>
      <?php
      if ($message != "") {
      ?>
      <p><?php echo $message; ?></p>
      <?php
      }
      ?>
		</div>
	</body>
</html>
