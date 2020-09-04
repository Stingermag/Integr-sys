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
						echo "Студент <br>";
					}
					if (strcasecmp($_SESSION["user"], "jobgiver") == 0) {
						echo "работодатель";
					}
					echo "Вы можете ";
					if (strcasecmp($_SESSION["user"], "student") == 0) {
						echo "подать заявки на вакансии.";
					}
					if (strcasecmp($_SESSION["user"], "jobgiver") == 0) {
						echo "Просматривать список заявок.";
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
					Список моих заявок
				</h2>
				<div>


					<?php


					$server_name = "localhost";
					$user_name = "root";
					$password = "";
					$db_name = "integration system";

					$mysqli = new mysqli($server_name, $user_name, $password, $db_name);
					$mysqli->query('SET NAMES utf8');

					$idstud = $_SESSION['stud'];

					$result = $mysqli->query("

SELECT `vacancy`.`idVacancy` , `vacancy`.description as vacdisc, `request`.idRequest, `resume`.description as resdisc, `students`.fio, `students`.idStudent,`request`.status_req
FROM `vacancy` 
	LEFT JOIN `request` ON `request`.`Vacancy_idVacancy` = `vacancy`.`idVacancy` 
	LEFT JOIN `resume` ON `request`.`Resume_idresume` = `resume`.`idresume` 
	LEFT JOIN `students` ON `resume`.`Students_idStudent` = `students`.`idStudent`
    WHERE `resume`.`Students_idStudent` = $idstud");

					echo '<table id ="tl"><tr><th>id вакансии</th><th>описание вакансии</th><th>номер заявки</th><th>описание резюме</th><th>фио студента</th><th>статус</th></tr>';
					while ($rows = $result->fetch_object()) {
						echo "
		<tr><th><a href=\"numvak.php?id=$rows->idVacancy\"> $rows->idVacancy</a></th>
        <th>$rows->vacdisc</th>
        <th>$rows->idRequest</th>
        <th>$rows->resdisc</th>
        <th>$rows->fio</th>
        <th>$rows->status_req</th></tr>";
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