<?php

  require_once "../classes/ProcessEvent.php";

  $action = strtolower($_GET["a"]);

  if (1 == $action) {
    $processEvent = new ProcessEvent($action);
    $processEvent->process();
    $message = "Solicitudes enviadas con éxito.";
  }
  else if (2 == $action) {
    $processEvent = new ProcessEvent($action);
    $processEvent->process();
    $message = "Turnos procesados exitósamente.";
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
				<h4>Si querés enviar una notificación, hacé click aquí:</h4>
				<br/><br/>
				<div class="button-content">
					<a href="index.php?a=1" class="button">Enviar Solicitud</a>
				</div>
        <br/>
				<h4>Si querés procesar la asignación de turnos, hacé click aquí:</h4>
				<br/><br/>
				<div class="button-content">
					<a href="index.php?a=2" class="button">Procesar Turnos</a>
				</div>
			</section>
			<br/><br/>
      <?php
      if ($message != "") {
      ?>
      <p class="verde"><?php echo $message; ?></p>
      <?php
      }
      ?>
		</div>
	</body>
</html>
