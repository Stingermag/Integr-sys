<!DOCTYPE html>
<html lang="en">
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

<head>
	<meta charset="UTF-8">

</head>

<body>
	<center>
		<section>
			<div class="centerr">
				<div class="services_item">
					<h2> Если вы студент</h2>

					<form action="singinbd.php" method="post">
						<p>login:<br>
							<input type="text" name="login" /></p>
						<p>password:<br>
							<input type="text" name="password" /></p>
						<p>fio:<br>
							<input type="text" name="fio" /></p>
						<p>numgroup:<br>
							<input type="text" name="numgroup" /></p>
						<p><input type="submit" /></p>
					</form>
				</div>
				<div class="services_item">

					<h2> Если вы работодатель</h2>
					<form action="singinbdjob.php" method="post">
						<p>login:<br>
							<input type="text" name="login" /></p>
						<p>password:<br>
							<input type="text" name="password" /></p>
						<p>fio:<br>
							<input type="text" name="fio" /></p>
						<p>numorganisation:<br>
							<input type="text" name="numgroup" /></p>
						<p><input type="submit" /></p>
					</form>
					<div>
					</div>

		</section>
	</center>
</body>

</html>