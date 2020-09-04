
<?php 

$id = $_GET['id'];

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";

$mysqli = new mysqli($server_name,$user_name,$password,$db_name);
$mysqli->query('SET NAMES utf8');

$result = $mysqli->query("UPDATE `request` SET `status_req`= 'одобрена' WHERE idRequest = $id"); 

$url="myreq.php";
header("Location:$url");
 ?>
