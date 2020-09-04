<?php
session_start();
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";

$mysqli = new mysqli($server_name,$user_name,$password,$db_name);
$mysqli->query('SET NAMES utf8');

$id= rand(1000, 9999);
$expdeamand= $_POST['expdeamand'];
$iddeamand= $_POST['idDenamd'];
$idvac= $_POST['idvac'];

$result = $mysqli->prepare("INSERT INTO `vacancy_demands`(`idVacancy_Demand`, `Vacancy_idVacancy`, `Demand_idDemand`, `expirience`) VALUES (?,?,?,?)"); 
$result->bind_param('iiii',$id,$idvac, $iddeamand,$expdeamand);
$result->execute();

$mysqli->close();
$url="numvak.php?id=$idvac";
header("Location:$url");
