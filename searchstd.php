<?php
session_start();  ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title> Kursach </title>
	<link rel="stylesheet" href="css/main.css">
	<style>
		li em {
			content: attr(data-title);
			/* Выводим текст */
			position: absolute;
			/* Абсолютное позиционирование */
			left: 20%;
			top: 30%;
			/* Положение подсказки */
			z-index: 1;
			/* Отображаем подсказку поверх других элементов */
			background: rgba(255, 255, 230, 0.9);
			/* Полупрозрачный цвет фона */
			font-family: Arial, sans-serif;
			/* Гарнитура шрифта */
			font-size: 11px;
			/* Размер текста подсказки */
			padding: 5px 10px;
			/* Поля */
			border: 1px solid #333;
			/* Параметры рамки */
		}
	</style>

</head>
<script type="text/javascript">
	function sortvak(idvak) {

		var idvacanc = "idvac=" + idvak.value;
		//$str = text;
		xhr = new XMLHttpRequest();

		xhr.open('GET', 'searchnameres.php?' + idvacanc, true);
		xhr.onreadystatechange = onStateChange;

		xhr.send();

	}

	function onStateChange() {
		if (xhr.readyState == 4 && xhr.status == 200) {

			var div = document.getElementById('time');
			div.innerHTML = xhr.responseText;

		}

	}
</script>

<body id="portfolio">


	<header>
		<div class="container">
			<div class="heading clearfix">
				<a href="index.php"> <img src="img/logo.png" alt="Golden" style=" margin-top: 12px;"></a>
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

					Подбор претендентов

				</div>

			</div>



		</div>
	</header>
	<section id="portfolio">
		<div class="container">
			<div class="title">
				<h2>
					Поиск резюме
				</h2>
				<div>

					<p>
						Количество записей
					</p>

					<?php

					$server_name = "localhost";
					$user_name = "root";
					$password = "";
					$db_name = "integration system";

					$mysqli = new mysqli($server_name, $user_name, $password, $db_name);
					$mysqli->query('SET NAMES utf8');

					$idjob  = $_SESSION["jober"];

					$result = $mysqli->query("SELECT * FROM `vacancy`");

					echo "<p>Вакансия: ";
					echo "<select id = \"idvac\"  name=\"idvac\">";
					echo "<option  value='0'>Выбор</option>";

					while ($rows = $result->fetch_object()) {
						echo "<option value = '$rows->idVacancy'> $rows->description </option>";
					}

					echo "</select>";
					echo "</p>";







					?>

					<center>

						<input type="button" onmousedown="sortvak(document.getElementById('idvac'))" value="Подобрать" />

					</center>


					<div id='time'>
					</div>

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