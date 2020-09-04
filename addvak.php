<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<style>
		form {
			background: #B0C4DE;
			width: 300px;
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

<body>
	<center>
		<div class="services_item">
			<h3>Введите данные о вакансии</h3>
			<form action="addvakbd.php" method="post">


				<p>Название: <br><input type="text" name="disc" /></p>
				<p>Описание: <br><input type="text" name="exp" /></p>
				<p>Профстандарт: <br><input type="text" name="prof" value="1" /></p>

				<p><input type="submit" value="Создать вакансию" /></p>
			</form>
		</div>
	</center>
</body>

</html>