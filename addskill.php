<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<style>

    form  {
        background: #B0C4DE;
        width: 400px;
        border-radius: 30px;
        padding: 10px;
 		display:inline-block;
    	}

    input[type=text], input[type=password]
		{
		
		 border-radius: 10px;
		 border: 0px;
		     padding: 5px;
		}
		input[type=submit]
		{
		
		 border-radius: 10px;
		 border: 0px;
		 padding: 5px;
		 width: 200px;
		}
		
		.services_item{
	width: 370px;
	
	text-align: center;

}


  </style>
</head>

<body id="portfolio">
<center>
<?php 

$id = $_GET['id'];

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";

$mysqli = new mysqli($server_name,$user_name,$password,$db_name);
$mysqli->query('SET NAMES utf8');



$result = $mysqli->query("SELECT * FROM `demand`");



 echo "
 <form action=\"addskillbd.php\" method=\"post\">";
 


echo "<p>Требование: ";
echo "<select id = \"idvac\"  name=\"iddeamand\">";
echo "<option  value='0'>Выбор</option>";

while($rows = $result->fetch_object())
{
  echo "<option value = '$rows->idDenamd'> $rows->discription </option>";
}

echo "</select>";
echo "</p>";



 echo "
 <p>Уровень: <br>  <input type=\"text\" name=\"expskill\" /></p>
 
  <p>Умение: <br><input type=\"text\" name=\"idres\" value=\"$id\"/></p>
  <p><input type=\"submit\" /></p>
</form>"; 

 ?>
</center>

</body>

</html>