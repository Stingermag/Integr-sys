<?php
session_start();
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";

$mysqli = new mysqli($server_name, $user_name, $password, $db_name);
$mysqli->query('SET NAMES utf8');

$strok = $_GET['stroka'];
$counnt = $_GET['counnt'];
if ($strok == 1) {
	$result = $mysqli->query("SELECT `students`.`fio`, `resume`.`description`,`students`.`idStudent`,`resume`.`idresume`
FROM `students` 
	LEFT JOIN `resume` ON `resume`.`Students_idStudent` = `students`.`idStudent`
	WHERE `resume`.`description` != 'нет' ORDER BY `students`.`fio` LIMIT $counnt");



	echo '<table id ="tl"><tr><th>ФИО студента</th><th>описание резюме</th><th></th></tr>';
	while ($rows = $result->fetch_object()) {
		echo "<tr><th>$rows->fio</th><th>$rows->description</th><th><a href=\"numrez.php?id=$rows->idStudent\"> Подробнее</a></th><th><a href=\"invite.php?id=$rows->idresume\">Пригласить на вакансию</a></th></tr>";
	}
	echo '</table>';
}
if ($strok == 2) {
	$result = $mysqli->query("SELECT `students`.`fio`, `resume`.`description`,`students`.`idStudent`,`resume`.`idresume`
FROM `students` 
	LEFT JOIN `resume` ON `resume`.`Students_idStudent` = `students`.`idStudent`
	WHERE `resume`.`description` != 'нет' LIMIT $counnt");



	echo '<table id ="tl"><tr><th>ФИО студента</th><th>описание резюме</th><th></th></tr>';
	while ($rows = $result->fetch_object()) {
		echo "<tr><th>$rows->fio</th><th>$rows->description</th><th><a href=\"numrez.php?id=$rows->idStudent\"> Подробнее</a></th><th><a href=\"invite.php?id=$rows->idresume\">Пригласить на вакансию</a></th></tr>";
	}
	echo '</table>';
}



$mysqli->close();
