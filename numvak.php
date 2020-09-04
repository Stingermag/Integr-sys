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
				<a href="index.php"> <img src="img/logo.png" alt="Golden" style="
    margin-top: 12px;
"></a>
				<nav class="men">
					<ul class="menu">

						<li>
							<?php
							if (strcasecmp($_SESSION["user"], "student") == 0) {
								echo "<a href=\"vakans.php\">Вакансии</a>";
							}
							if (strcasecmp($_SESSION["user"], "jobgiver") == 0) {
								echo "<a href=\"resumes.php\">Резюме</a>";
							}
							?>
						</li>
						<li>
							<?php
							if (strcasecmp($_SESSION["user"], "student") == 0) {
								echo "<a href=\"myreqstd.php\">Мои заявки</a>";
							}
							if (strcasecmp($_SESSION["user"], "jobgiver") == 0) {
								echo "<a href=\"myreq.php\">Заявки</a>";
							}
							?>
						</li>
						<li>
							<?php
							if (strcasecmp($_SESSION["user"], "student") == 0) {
								echo "<a href=\"myrez.php\">Резюме</a>";
							}
							if (strcasecmp($_SESSION["user"], "jobgiver") == 0) {
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
				//	session_start();

				if (isset($_SESSION["user"])) {

					//	echo $_SESSION['user'];

				} else {

					$server_name = "localhost";
					$user_name = "root";
					$password = "";
					$db_name = "integration system";



					//тут надо вообще наличие проверить
					if (isset($_COOKIE['ident'])) {
						$tok = $_COOKIE["ident"];

						$mysqli = new mysqli($server_name, $user_name, $password, $db_name);

						$result = $mysqli->prepare("SELECT login FROM users WHERE token = ?");
						$result->bind_param('s', $tok);
						$result->bind_result($login);
						$result->execute();

						$result->fetch();


						$_SESSION['user'] = $login;
						echo $_SESSION['user'];
					} else
						echo "Вы не вошли";
				}

				?>
			</div>
			<div class="title">


				<div class="title_first">


					<?php
					if (strcasecmp($_SESSION["user"], "student") == 0) {
						echo "Студент";
					}
					if (strcasecmp($_SESSION["user"], "jobgiver") == 0) {
						echo "Работодатель <br>";
					}
					echo "Вы можете ";
					if (strcasecmp($_SESSION["user"], "student") == 0) {
						echo "подать заявки на вакансии.";
					}
					if (strcasecmp($_SESSION["user"], "jobgiver") == 0) {
						echo "добавлять требования на вакансии.";
					}
					?>
				</div>

			</div>



		</div>
	</header>
	<section id="portfolio">
		<div class="container">
			<div class="title">
				<h2>
					Выбранная вакансия
				</h2>
				<div>


					<?php


					$server_name = "localhost";
					$user_name = "root";
					$password = "";
					$db_name = "integration system";
					$idVac = $_GET['id'];

					$mysqli = new mysqli($server_name, $user_name, $password, $db_name);
					$mysqli->query('SET NAMES utf8');

					$result = $mysqli->query("SELECT vacancy.Jobgiver_idJobgiver,vacancy.idVacancy,vacancy.description,vacancy.expirience,jobgiver.fio FROM vacancy,jobgiver WHERE vacancy.Jobgiver_idJobgiver = jobgiver.idJobgiver and vacancy.idVacancy = $idVac");

					while ($rows = $result->fetch_object()) {
						echo "<table id =\"tl\"><tr><th>Номер вакансии</th><th>$rows->idVacancy</th></tr>";
						echo "<tr><th>Название</th><th>$rows->description</th></tr>";
						echo "<tr><th>Описание</th><th>$rows->expirience</th></tr>";
						echo "<tr><th>ФИО работодетеля</th><th>$rows->fio</th></tr>";
						echo '</table>';

						$idjobg =  $rows->Jobgiver_idJobgiver;
					}

					echo "<h2>Требования вакансии</h2>";
					$result = $mysqli->query("SELECT `Vacancy_idVacancy`,`demand`.`discription`, `expirience` FROM `vacancy_demands`,`demand` WHERE vacancy_demands.Demand_idDemand = demand.idDenamd  and  Vacancy_idVacancy = $idVac");
					echo "<table>";
					while ($rows = $result->fetch_object()) {
						echo "<tr><th>Требование: </th><th>$rows->discription</th><th>Требуемый уровень (1-5 )<br>$rows->expirience</th></tr>";
					}
					echo '</table>';

					/*       
if($_SESSION["user"], "jobgiver")
{
	

}*/
					if (strcasecmp($_SESSION["user"], "student") == 0) {
						echo "<a href=\"zakrep.php?id=$idVac\">Подать заявку</a>";
					}
					if (isset($_SESSION["jober"])) {
						if (!strnatcasecmp($idjobg, $_SESSION["jober"])) {
							echo "<tr><th><a href=\"adddeamand.php?id=$idVac\">Добавить требований</a></th><th></th></tr>";
						}
					}



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