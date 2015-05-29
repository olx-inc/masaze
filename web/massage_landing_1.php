<?php
	$email = $_GET["w"];
	if (empty($email)) {
		header("Location: error.php");
		die();
	} ´
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
				<h2>Hi <?php echo $email ?> !</h2>
				<br/><br/>
				<h2>You are about to request a Massage Appointment for Today. To Confirm please click below.</h2>
				<br/><br/>
				<a href="massage_landing_2.php?w=<?php echo $email ?>" class="button">Confirm Request</a>

			</section>
			<br/><br/>
			<p>Please note that appointments are not guaranteed as vacants are limited. If you are selected you will receive an E-mail notification.</p>


		</div>
	</body>
</html>
