<?php
session_start();
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";

$mysqli = new mysqli($server_name, $user_name, $password, $db_name);
$mysqli->query('SET NAMES utf8');

$id = rand(1000, 9999);
$rab = $_SESSION["jober"];
$prof = $_POST['prof'];
$disc = $_POST['disc'];
$exp = $_POST['exp'];
echo $rab;
echo $id;
$result = $mysqli->prepare("INSERT INTO `vacancy` (`idVacancy`, `description`, `expirience`, `Profstandart_idProfstandart`, `Jobgiver_idJobgiver`) VALUES(?,?,?,?,?)");
$result->bind_param('issii', $id, $disc, $exp, $prof, $rab);
$result->execute();

$mysqli->close();
header('Location: vakans.php');
