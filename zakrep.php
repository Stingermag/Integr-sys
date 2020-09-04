<?php
session_start();

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";


$idstudent = $_SESSION['stud'];

$mysqli = new mysqli($server_name, $user_name, $password, $db_name);
$mysqli->query('SET NAMES utf8');
$idreq = rand(1000, 9999);
$idVac = $_GET['id'];

$result = $mysqli->query("SELECT idresume FROM resume WHERE resume.Students_idStudent = $idstudent");
$rows = $result->fetch_object();
$idres = $rows->idresume;
$status = "обрабатывается";
//$result = $mysqli->query('INSERT INTO `request`(`idRequest`, `Resume_idresume`, `Vacancy_idVacancy`) VALUES ($idreq,$idstudent,$idVac)');
$result = $mysqli->prepare("INSERT INTO `request`(`idRequest`, `Resume_idresume`, `Vacancy_idVacancy`,`status_req`) VALUES (?,?,?,?)");
$result->bind_param('iiis', $idreq, $idres, $idVac, $status);
$result->execute();


$mysqli->close();
header('Location: vakans.php');
