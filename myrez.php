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

					Ваше резюме

				</div>

			</div>



		</div>
	</header>
	<section id="portfolio">
		<div class="container">
			<div class="title">
				<h2>
					<?php
					echo $_SESSION['fio'];
					?>
				</h2>
				<div>


					<?php


					$server_name = "localhost";
					$user_name = "root";
					$password = "";
					$db_name = "integration system";
					$idstudent = $_SESSION['stud'];

					$mysqli = new mysqli($server_name, $user_name, $password, $db_name);
					$mysqli->query('SET NAMES utf8');

					//выбрать группу текущего студента
					$result = $mysqli->query("SELECT Group_idgroup FROM students WHERE idStudent = $idstudent");
					$rows = $result->fetch_object();
					$idgroup = $rows->Group_idgroup;
					//$result->bind_param('i', $idstudent);
					//$result->bind_result($idgroup);
					//$result->execute();
					//$result->fetch();




					$result = $mysqli->query("SELECT `students`.`idStudent`,`students`.`fio`,`groupp`.`name` FROM `students`, `groupp` WHERE `students`.`idStudent` = $idstudent and `groupp`.`idgroupp` = $idgroup");
					//	$result = $mysqli->query("SELECT students.idStudent,students.fio FROM students WHERE students.idStudent = 1967"); 
					while ($rows = $result->fetch_object()) {
						echo "<table id =\"tl\"><tr><th>ID студента</th><th>$rows->idStudent</th></tr>";
						echo "<tr><th>ФИО</th><th>$rows->fio</th></tr>";
						echo "<tr><th>Группа</th><th>$rows->name</th></tr>";
					}
					$idresume;
					$result = $mysqli->query("SELECT description,idresume FROM resume WHERE Students_idStudent = $idstudent");

					while ($rows = $result->fetch_object()) {
						$idresume = "$rows->idresume";
						echo "<tr><th>Описание</th><th>$rows->description</th></tr>";
						echo "<tr><th><a href=\"editrez.php?id=$rows->idresume&disc=$rows->description\">Редактировать/добавить</a></th><th></th></tr>";
					}

					echo '</table>';

					echo "<h2>умения</h2>";
					//суда вывод скилов
					$result = $mysqli->query("SELECT `idResume_Demand`, `demand`.`discription`, `expirience` FROM `resume_demand`,`demand` WHERE resume_demand.Demand_idDemand = Demand.idDenamd and Resume_idresume = $idresume");
					echo "<table>";
					while ($rows = $result->fetch_object()) {
						echo "<tr><th>Умение: </th><th>$rows->discription</th><th>Уровень владения (1-5) <br> $rows->expirience</th></tr>";
					}
					echo '</table>';
					//


					echo "<a href=\"addskill.php?id=$idresume\">Добавить умение</a>";
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