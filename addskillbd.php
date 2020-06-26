<?php
session_start();
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";

$mysqli = new mysqli($server_name,$user_name,$password,$db_name);
$mysqli->query('SET NAMES utf8');

$id= rand(1000, 9999);

$expskill= $_POST['expskill'];
$iddeamand= $_POST['iddeamand'];
$idres= $_POST['idres'];

echo "1 $id ";
echo "2 $expskill ";
echo "3 $iddeamand ";
echo "4 $idres ";

$result = $mysqli->prepare("INSERT INTO `resume_demand`(`idResume_Demand`, `expirience`, `Demand_idDemand`, `Resume_idresume`) VALUES (?,?,?,?)"); 
$result->bind_param('iiii',$id, $expskill,$iddeamand,$idres);
$result->execute();

$mysqli->close();
$url="myrez.php";
header("Location:$url");
?>

