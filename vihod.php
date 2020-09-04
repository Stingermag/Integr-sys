<?php
session_start();
$_SESSION['user'] = null;
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";

$mysqli = new mysqli($server_name, $user_name, $password, $db_name);

$tok = $_COOKIE['ident'];

$result = $mysqli->query("UPDATE users SET token = 0 WHERE token = '$tok'");
$_SESSION['user'] = null;
$_SESSION['stud'] = null;
$_SESSION['fio'] = null;
$_SESSION["jober"] = null;

$mysqli->close();
header('Location: index.php');
