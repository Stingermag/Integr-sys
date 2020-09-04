<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<style>
		form {
			background: #B0C4DE;
			width: 400px;
			border-radius: 30px;
			padding: 10px;
			display: inline-block;
		}

		input[type=text],
		input[type=password] {

			border-radius: 10px;
			border: 0px;
			padding: 5px;
		}

		input[type=submit] {

			border-radius: 10px;
			border: 0px;
			padding: 5px;
			width: 180px;
		}

		.services_item {
			width: 370px;

			text-align: center;

		}
	</style>
</head>

<body id="portfolio">
	<center>
		<?php
		session_start();
		$server_name = "localhost";
		$user_name = "root";
		$password = "";
		$db_name = "integration system";

		$mysqli = new mysqli($server_name, $user_name, $password, $db_name);
		$mysqli->query('SET NAMES utf8');
		$id = $_GET['id'];
		$idjob  = $_SESSION["jober"];

		$result = $mysqli->query("SELECT * FROM `vacancy` WHERE `vacancy`.`Jobgiver_idJobgiver` = $idjob");



		echo "<form action=invitebd.php method=post>
  <p>id резюме: <input type=text name=idres value=\"$id\"></p>";




		echo "<p>id вакансии: ";
		echo "<select name=\"idvac\">";
		echo "<option  value='0'>Выбор</option>";

		while ($rows = $result->fetch_object()) {
			echo "<option value = '$rows->idVacancy'> $rows->description </option>";
		}

		echo "</select>";
		echo "</p>";



		echo " <p><input type=submit /></p>";



		echo "</form>";
		?>
	</center>
</body>

</html>