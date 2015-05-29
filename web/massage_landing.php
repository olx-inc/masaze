<?php

$servername = "localhost";
$username = "mtd";
$password = "_m7D#2015$";
$db = "DB_MASAZE";

$email = $_GET["w"];

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
		
		if ($result2 = $connection->query("insert ignore into masaze_appointments(user_id, sent) values($user_id, 0);")) {
			$result_status = 3;
			$result_message_title = "Success!";
			$result_message_desc = "We'll send you an email with the details of your appointment very soon :)";
		} else {
			$result_status = 4;
			$result_message_title = "Oops!";
			$result_message_desc = "We weren't able to book your appointment :(";
		}
	} else {
		$result_status = 2;
		$result_message_title = "Oops!";
		$result_message_desc = "It seems you're not registered in MAZASE :S";
	}
	
}

?>


<!DOCTYPE html>
<html>
    <head>
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
                <p><?php echo $result_message_desc ?></p>
            </section>
        </div>
    </body>
</html>


<?php

$connection->close();

?>