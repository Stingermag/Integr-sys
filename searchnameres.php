<?php
session_start();
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";

$mysqli = new mysqli($server_name, $user_name, $password, $db_name);
$mysqli->query('SET NAMES utf8');

$idvak = $_GET['idvac']; {
	$result = $mysqli->query("SELECT `students`.`fio`, `resume`.`description`,`students`.`idStudent`,`resume`.`idresume`
FROM `students` 
	LEFT JOIN `resume` ON `resume`.`Students_idStudent` = `students`.`idStudent`
	WHERE `resume`.`description` != 'нет'");




	echo '<table id ="tl"><tr><th>ФИО студента</th><th>описание резюме</th><th></th><th>Коэффициент схожести</th></tr>';
	while ($rows = $result->fetch_object()) {


		$result1 = $mysqli->query("
		


			 SELECT idresume, IFNULL(resdisk,vakdisk) AS vakdisk, IFNULL(resex,0) AS resex, idVacancy,vakdisk, vakex FROM (SELECT `resume`.`idresume`, `resume_demand`.`Demand_idDemand` AS resdisk, `resume_demand`.`expirience` AS resex FROM `resume` LEFT JOIN `resume_demand` ON `resume_demand`.`Resume_idresume` = `resume`.`idresume` WHERE `resume`.`idresume` = $rows->idresume) AS STUD RIGHT JOIN (SELECT `vacancy`.`idVacancy`, `vacancy_demands`.`Demand_idDemand` AS vakdisk, `vacancy_demands`.`expirience`AS vakex FROM `vacancy` LEFT JOIN `vacancy_demands` ON `vacancy_demands`.`Vacancy_idVacancy` = `vacancy`.`idVacancy` WHERE `vacancy`.`idVacancy` = $idvak ) AS VAK ON STUD.resdisk = VAK.vakdisk");
		$koef = 0;

		while ($rows1 = $result1->fetch_object()) {
			if ("$rows1->vakex" >= "$rows1->resex")
				$koef  =  $koef + (pow("$rows1->vakex" - "$rows1->resex", 2));
		}
		$koef = sqrt($koef);

		$koef = 10 - $koef;
		$koef = round($koef, 2);




		if ("$koef" > 4.5)
			echo "<tr><th>$rows->fio</th><th>$rows->description</th><th><a href=\"numrez.php?id=$rows->idStudent\"> Подробнее</a></th> <th>$koef</th> <th><a href=\"invite.php?id=$rows->idresume\">Пригласить на вакансию</a></th></tr>";
	}
	echo '</table>';
}


$mysqli->close();
