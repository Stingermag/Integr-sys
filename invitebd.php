<?php
session_start();
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";

$mysqli = new mysqli($server_name,$user_name,$password,$db_name);
$mysqli->query('SET NAMES utf8');

$id= rand(1000, 9999);
$idres= $_POST['idres'];
$idvac= $_POST['idvac'];
echo "$idres $idvac";
$ststus = "приглашени от работодателя";

$result = $mysqli->prepare("INSERT INTO `request`(`idRequest`, `Resume_idresume`, `Vacancy_idVacancy`,`status_req`) VALUES (?,?,?,?)"); 
$result->bind_param('iiis', $id, $idres, $idvac, $ststus);
$result->execute();




$mysqli->close();
$url="resumes.php";
header("Location:$url");
?>

