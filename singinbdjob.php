<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";

$mysqli = new mysqli($server_name,$user_name,$password,$db_name);
$mysqli->query('SET NAMES utf8');

$login= $_POST['login'];
$pwd= $_POST['password'];
$fio= $_POST['fio'];
$numorg= $_POST['numgroup'];

$rnd= rand(1000, 9999);

$pwd=sha1($pwd).$rnd;
$result = $mysqli->prepare("INSERT INTO jobgiver (idJobgiver,fio,Organization_idOrganization,login,pwd,rnd,token) VALUES (?,?,?,?,?,?,0)"); 
$result->bind_param('isissi', $rnd,$fio,$numorg,$login, $pwd, $rnd);
$result->execute();

$mysqli->close();
header('Location: index.php');
?>

