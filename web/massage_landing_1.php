<?php

	$email = strtolower($_GET["w"]);

	if (empty($email) or substr($email, -8) != "@olx.com") {
		
		header("Location: massage_landing_error.php");
		die();

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
				<h2>Hola <?php echo $email ?> !</h2>
				<br/><br/>
				<h2>Estar a punto de solicitar un turno de masajes. Para confirmar hacé click aquí</h2>
				<br/><br/>
				<a href="massage_landing_2.php?w=<?php echo $email ?>" class="button">Confirmar Solicitud</a>

			</section>
			<br/><br/>
			<p>Tené en cuenta que no podemos garantizar tu lugar. Las vacantes son limitadas. Te informaremos por E-mail.</p>

		</div>
	</body>
</html>
