<?php

$base = "../";
require_once ($base . "cron/lib/phpmailer/class.phpmailer.php");

$email = strtolower($_GET["w"]);

if (empty($email) or substr($email, -8) != "@olx.com") {
	header("Location: massage_landing_error.php");
	die();
}

$servername = "10.4.12.27";
$username = "mtd";
$password = "_m7D#2015$";
$db = "DB_MASAZE";

$connection = new mysqli($servername, $username, $password);

$result_status = 0;
$result_message_title = "";
$result_message_desc = "";

if ($connection->connect_error) {
	$result_status = 1;
	$result_message_title = "Server Error";
	$result_message_desc = "There was an error connecting to the database :(";
} else {

	$connection->select_db($db);

	if($result = $connection->query("select id from masaze_users where email='$email'")) {
		$user_id_object = $result->fetch_object();
		$user_id = $user_id_object->id;

		if ($result2 = $connection->query("UPDATE masaze_users SET score = score + 1 WHERE id = $user_id;")) {
			$result_status = 3;
			$result_message_title = "Registramos tu cancelación.";
			$result_message_desc = "Gracias por avisarnos !";

      $mailer = new PHPMailer();
      $mailer -> IsSMTP();
      $mailer -> Host = "mail-server";
      $mailer -> Hostname = "relay1.olx.com";
      $mailer -> SMTPAuth = false;
      $mailer -> Username = 'sitemail@olx.com';
      $mailer -> Password = 'pendrive';
      $mailer -> WordWrap = 64;
      $mailer -> IsHTML(true);
      $mailer -> CharSet = 'utf-8';


      $mailTemplate = "<b>Turno Cancelado: $email</b><br/>";

      $toAddress = 'emiliano@olx.com';
      $mailer->Sender = 'massages@olx.com';
      $mailer->FromName = 'massages@olx.com';
      $mailer->From = 'massages@olx.com';
      $mailer->Subject = 'Cancelacion de Turno - ' . $email;
      $mailer->Body = $mailTemplate;
      $mailer->AddAddress($toAddress, $toAddress);

      if ($mailer->Send()) {
          error_log("Mail sent to: "  . $toAddress . " - ok");
      } else {
          error_log("Error sending email to: " . $toAddress . " : " . $mailer->ErrorInfo);
      }

		} else {
			$result_status = 4;
			$result_message_title = "Oops!";
			$result_message_desc = "No pudimos procesar tu pedido :(";
		}
	} else {
		$result_status = 2;
		$result_message_title = "Oops!";
		$result_message_desc = "No estás registrado en MAZASE :S";
	}

}

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>masaże :: Appointment system</title>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
	</head>
	<body>
		<div class="wrapper">
			<header>
				<div class="header-logo">
					<img src="../images/logo.png" alt="masaże logo" />
				</div>
			</header>
			<section class="notifications icons icon-check-round">
				<h2><?php echo $result_message_title ?></h2>
				<br/><br/>
				<p><?php echo $result_message_desc ?></p>
			</section>
		</div>
	</body>
</html>


<?php

$connection->close();

?>
