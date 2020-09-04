<?php
session_start();
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";

$mysqli = new mysqli($server_name, $user_name, $password, $db_name);
$mysqli->query('SET NAMES utf8');

$login = $_POST['login'];
$pwd = $_POST['password'];


$result = $mysqli->prepare("SELECT idStudent,fio,login,pwd,rnd FROM students WHERE login = ?");
$result->bind_param('s', $login);
$result->bind_result($idtar, $fio, $logintar, $pwdtar, $rnd);
$result->execute();
$result->fetch();

$pwd = sha1($pwd) . $rnd;








if ($pwd == $pwdtar) {
	$_SESSION['user'] = "student";
	$_SESSION['stud'] = $idtar;
	$_SESSION['fio'] = $fio;
	$identif = sha1(rand() . rand());


	$mysqli = new mysqli($server_name, $user_name, $password, $db_name);
	$result = $mysqli->prepare("UPDATE students SET token = ? WHERE idStudent = ?");
	$result->bind_param('si', $identif, $idtar);
	$result->execute();
	setcookie("ident", $identif, time() + 3600 * 24, "/");
} else {

	$result = $mysqli->prepare("SELECT idJobgiver,fio,login,pwd,rnd FROM jobgiver WHERE login = ?");
	$result->bind_param('s', $login);
	$result->bind_result($idtar, $fio, $logintar, $pwdtar, $rnd);
	$result->execute();
	$result->fetch();
	$pwd = $_POST['password'];
	$pwd = sha1($pwd) . $rnd;

	if ($pwd == $pwdtar) {
		$_SESSION['user'] = "jobgiver";
		$_SESSION['jober'] = $idtar;
		$_SESSION['fio'] = $fio;
		$identif = sha1(rand() . rand());


		$mysqli = new mysqli($server_name, $user_name, $password, $db_name);
		$result = $mysqli->prepare("UPDATE jobgiver SET token = ? WHERE idJobgiver = ?");
		$result->bind_param('si', $identif, $idtar);
		$result->execute();
		setcookie("ident", $identif, time() + 3600 * 24, "/");
	} else
		$_SESSION['user'] = "";
}



$mysqli->close();
header('Location: index.php');
