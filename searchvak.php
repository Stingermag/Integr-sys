
<?php 
session_start();  ?>

<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<title> Kursach </title>
		<link rel="stylesheet" href="css/main.css">

</head>

<body id="portfolio">
	

	<header>
		<div class="container">
			<div class="heading clearfix">
			<a href="index.php">  <img src="img/logo.png" alt="Golden" style="margin-top: 12px;"></a>
			<nav class="men">
				<ul class="menu">
					<li>
						<?php
						if(strcasecmp($_SESSION["user"], "student") == 0 )
						{
						 echo "<a href=\"vakans.php\">Вакансии</a>";
						}
						if(strcasecmp($_SESSION["user"], "jobgiver") == 0 )
						{
						 echo "<a href=\"resumes.php\">Резюме</a>";
						}
						?>
					</li>
					<li>
						<?php
						if(strcasecmp($_SESSION["user"], "student") == 0 )
						{
						 echo "<a href=\"myreqstd.php\">Мои заявки</a>";
						}
						if(strcasecmp($_SESSION["user"], "jobgiver") == 0 )
						{
						 echo "<a href=\"myreq.php\">Заявки</a>";
						}
						?>
					</li>
					<li>
						<?php
						if(strcasecmp($_SESSION["user"], "student") == 0 )
						{
						 echo "<a href=\"myrez.php\">Резюме</a>";
						}
						if(strcasecmp($_SESSION["user"], "jobgiver") == 0 )
						{
						 echo "<a href=\"vakans.php\">Вакансии</a>";
						}

						?>
						
					</li>
					<li>
						<a href="vihod.php"> Выйти</a>
					</li>
	
					<li>
						<a href="singin.php"> Регистрация</a>
					</li>
					

				</ul>
						
			</nav>
						<?php 

							if(isset($_SESSION["user"]))
								{
								}
							else{
									
									$server_name = "localhost";
									$user_name = "root";
									$password = "";
									$db_name = "integration system";

									if(isset($_COOKIE['ident']))
									{
									$tok = $_COOKIE["ident"];
									
									$mysqli = new mysqli($server_name,$user_name,$password,$db_name);
									
									$result = $mysqli->prepare("SELECT login FROM users WHERE token = ?"); 
									$result->bind_param('s', $tok);
									$result->bind_result($login);
									$result->execute();
									
									$result->fetch(); 

									
									$_SESSION['user'] = $login;
									echo $_SESSION['user'];

									}
									else
									echo "Вы не вошли";
							}
							
						?>
			</div>
			<div class="title">


				<div class="title_first">

					Поиск вакансий 
				
				</div>
			
			</div>

			
			
		</div>
	</header>
	<section id="portfolio">
		<div class="container">
			<div class="title">
				<h2>
					Список подходящих вакансий
				</h2>
				<div  >


<?php


$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";

$mysqli = new mysqli($server_name,$user_name,$password,$db_name);
$mysqli->query('SET NAMES utf8');


$idstudent = $_SESSION['stud'];

//выбрать текущее резюме
$result = $mysqli->query("SELECT idresume FROM resume WHERE Students_idStudent = $idstudent"); 
$rows = $result->fetch_object();
$idrez = $rows->idresume;

$result = $mysqli->query("SELECT vacancy.idVacancy,vacancy.description,vacancy.expirience,jobgiver.fio FROM vacancy,jobgiver WHERE vacancy.Jobgiver_idJobgiver = jobgiver.idJobgiver"); 
	echo '<table id ="tl"><tr><th>id</th><th>Название</th><th>Описание</th><th>работодатель</th><th>Коэффициент</th> <th></th></tr>';

	while ($rows = $result->fetch_object()) 
	{ 
		{
			$result1 = $mysqli->query("SELECT idresume, IFNULL(resdisk,vakdisk) AS vakdisk, IFNULL(resex,0) AS resex, idVacancy,vakdisk, vakex FROM (SELECT `resume`.`idresume`, `resume_demand`.`Demand_idDemand` AS resdisk, `resume_demand`.`expirience` AS resex FROM `resume` LEFT JOIN `resume_demand` ON `resume_demand`.`Resume_idresume` = `resume`.`idresume` WHERE `resume`.`idresume` = $idrez) AS STUD RIGHT JOIN (SELECT `vacancy`.`idVacancy`, `vacancy_demands`.`Demand_idDemand` AS vakdisk, `vacancy_demands`.`expirience`AS vakex FROM `vacancy` LEFT JOIN `vacancy_demands` ON `vacancy_demands`.`Vacancy_idVacancy` = `vacancy`.`idVacancy` WHERE`vacancy`.`idVacancy` = $rows->idVacancy ) AS VAK ON STUD.resdisk = VAK.vakdisk"); 
			$koef = 0;

			while ($rows1 = $result1->fetch_object())
			{
				if("$rows1->vakex" >= "$rows1->resex") 
				$koef  =  $koef + (pow("$rows1->vakex" - "$rows1->resex",2));

			}
			$koef = sqrt($koef);

			$koef = 10-$koef;
			
			$koef = round($koef, 2); 

		}
		if("$koef" > 4.5)
        echo "<tr><th>$rows->idVacancy</th><th>$rows->description</th><th>$rows->expirience</th><th>$rows->fio</th><th>$koef </th><th><a href=\"numvak.php?id=$rows->idVacancy\">Подробнее</a></th></tr>";
		
    }
        echo '</table>';

$mysqli->close();
?>

</div>

			
				
				
			</div>

			

		</div>
	</section>
	<footer>
		<div class="container">
			<div class="fot">
				<p>
					 8-(954)345-12-34
				
				</p>
				<p>
				   2017-2018 © ColoroScheme.Ru    
				</p>
			</div>
			
		</div>
	</footer>
	


</body>
</html>