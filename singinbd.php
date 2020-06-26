<?php
session_start();
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";

$mysqli = new mysqli($server_name,$user_name,$password,$db_name);
$mysqli->query('SET NAMES utf8');

$login= $_POST['login'];
$pwd= $_POST['password'];
$fio= $_POST['fio'];
$numgroup= $_POST['numgroup'];

$rnd= rand(1000, 9999);

$pwd=sha1($pwd).$rnd;
$result = $mysqli->prepare("INSERT INTO students (idStudent,fio,Group_idgroup,login,pwd,rnd,token) VALUES (?,?,?,?,?,?,0)"); 
$result->bind_param('isissi', $rnd,$fio,$numgroup,$login, $pwd, $rnd);
$result->execute();

$rndres= rand(1000, 9999);
$result = $mysqli->prepare("INSERT INTO resume (idresume,description,Students_idStudent) VALUES (?,'нет',?)"); 
$result->bind_param('ii', $rndres,$rnd);
$result->execute();

$mysqli->close();
header('Location: index.php');
?>

