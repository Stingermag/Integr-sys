<?php
session_start();  ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title> Kursach </title>
	<link rel="stylesheet" href="css/main.css">

</head>
<script type="text/javascript">
	function sortvak(typesort, counnt) {
		var body = "stroka=" + typesort;
		var counts = "counnt=" + counnt.value;
		//$str = text;
		xhr = new XMLHttpRequest();

		xhr.open('GET', 'sortnameres.php?' + body + '&&' + counts, true);
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
						echo "студент  <br>";
					}
					if (strcasecmp($_SESSION["user"], "jobgiver") == 0) {
						echo "работодатель <br>";
					}
					echo "Вы можете ";
					if (strcasecmp($_SESSION["user"], "student") == 0) {
						echo "подать заявки на вакансии.";
					}
					if (strcasecmp($_SESSION["user"], "jobgiver") == 0) {
						echo "просматривать резюме студентов.";
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
					Список резюме
				</h2>
				<div>

					<p>
						Количество записей
					</p>
					<p><textarea id="field">3</textarea></p>
					<br>

					<input type="button" onmousedown="sortvak(1,document.getElementById('field'))" value="Сортировать по фамилии" />
					<input type="button" onmousedown="sortvak(2,document.getElementById('field'))" value="Сортировать по описанию резюме" />


					<script type="text/javascript">
						sortvak(1, document.getElementById('field'));
					</script>

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