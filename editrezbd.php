<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";

$mysqli = new mysqli($server_name,$user_name,$password,$db_name);
$mysqli->query('SET NAMES utf8');
$id = $_POST['id'];
$newdisc= $_POST['newdisc'];


//$result = $mysqli->query("UPDATE books SET nazv = '$nazv',janr = '$janr' , avtor = '$avtor' WHERE books.id = '$id'");
$result = $mysqli->prepare("UPDATE resume SET description = ? WHERE idresume = ?");
$result->bind_param('si', $newdisc,$id);
$result->execute();

$mysqli->close();


header('Location: myrez.php');

?>

