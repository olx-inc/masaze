<?php

$email = $_GET["w"];

$servername = "localhost";
$username = "mtd";
$password = "_m7D#2015$";
$db = "DB_MASAZE";

$connection = new mysqli($servername, $username, $password);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 

$connection->select_db($db);

if($result = $connection->query("select id from masaze_users where email='$email'")) {
   $user_id_object = $result->fetch_object();
   $user_id = $user_id_object->id;
   
   if ($result2 = $connection->query("insert ignore into masaze_appointments(user_id, sent) values($user_id, 0);")) {
      echo "inserted your turn!";
   } else {
      die("could not insert your turn :(");
   }
} else {
   die("you don't exist!");
}

$connection->close();

?>
