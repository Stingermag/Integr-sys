
<?php 
session_start();  ?>

<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<title> Kursach </title>
		<link rel="stylesheet" href="css/main.css">
		<script type="text/javascript" src="jquery.js"></script>
		<style>
			 .memum em {
   
   
   
    z-index: 1; /* Отображаем подсказку поверх других элементов */
    background: rgba(255,255,230,0.9); /* Полупрозрачный цвет фона */
  
    font-size: 11px; /* Размер текста подсказки */
    padding: 5px 10px; /* Поля */
    border: 1px solid #333; /* Параметры рамки */
   }
		</style>

</head>

<script type="text/javascript">
	$(document).ready(function(){

    $(".memum a").hover(function() 
    {
    	
        $(this).next("em").animate({opacity: "show", top: "-75"}, "slow");
    }, function() 
    {
        $(this).next("em").animate({opacity: "hide", top: "-85"}, "fast");
    });
});

</script>

<body id="portfolio">
	

	<header>
		<div class="container">
			<div class="heading clearfix">
			<a href="index.php">  <img src="img/logo.png" alt="Golden" style="
    margin-top: 12px;
"></a>
			<nav class="men">
				<ul class="menu">
					<li>
						<?php

						if(isset($_SESSION["user"]))
						if(strcasecmp($_SESSION["user"], "student") == 0 )
						{
						 echo "<a href=\"vakans.php\">Вакансии</a>";
						}
						if(isset($_SESSION["user"]))
						if(strcasecmp($_SESSION["user"], "jobgiver") == 0 )
						{
						 echo "<a href=\"resumes.php\">Резюме</a>";
						}
						?>
					</li>
					<li>
						<?php
						if(isset($_SESSION["user"]))
						if(strcasecmp($_SESSION["user"], "student") == 0 )
						{
						 echo "<a href=\"myreqstd.php\">Мои заявки</a>";
						}
						if(isset($_SESSION["user"]))
						if(strcasecmp($_SESSION["user"], "jobgiver") == 0 )
						{
						 echo "<a href=\"myreq.php\">Заявки</a>";
						}
						?>
					</li>
					<li>
						<?php
						if(isset($_SESSION["user"]))
						if(strcasecmp($_SESSION["user"], "student") == 0 )
						{
						 echo "<a href=\"myrez.php\">Резюме</a>";
						}
						if(isset($_SESSION["user"]))
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
						//	session_start();
							
							if(isset($_SESSION["user"]))
								{
									
								//	echo $_SESSION['user'];
									
								}
							else{
									
									$server_name = "localhost";
									$user_name = "root";
									$password = "";
									$db_name = "integration system";



									//тут надо вообще наличие проверить
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
								//	else
								//	echo "Вы не вошли";
							}
							
						?>
			</div>
			<div class="title">





				<div class="title_first">
					<?php 
					echo "Добро пожаловать <br>";
					 if (isset($_SESSION["fio"]))
					 	echo $_SESSION['fio'];
					 else echo "вам нужно авторизоваться, чтобы зайти";
					 echo "<br> в компонент подсистемы взаимодействия работодателей и студентов!";
					?>
					

				</div>
				<h1>
					<?php 
						if(isset($_SESSION["user"]) ==0)
						echo "Войдите";
					?>
					
				</h1>
			</div>
			<div class="memum">
			
<?php 
						//	session_start();
							if(isset($_SESSION["user"]))
							{
							if(strcasecmp($_SESSION["user"], "student") == 0 )
								{									
									echo "<a class=\"button\" href=\"searchvak.php\">Найти подходящую профессию   </a> <em style=\"display: none; top: -85px;\">Профессии</em>";					
								}

							else if(strcasecmp($_SESSION["user"], "jobgiver") == 0 )
								{									
									echo "<a class=\"button\" href=\"searchstd.php\">Найти претендента на работу </a>  <em style=\"display: none; top: -85px;\">Претенденты</em> ";					
								}
								else{
									

echo
" <div class=\"container\"><form action=\"loginbd.php\" method=\"post\">
<p class=\"logpas\">Логин <input type=\"text\" name=\"login\" /></p>
<p class=\"logpas\">Пароль <input type=\"text\" name=\"password\" /></p>
<p class=\"logpas\"><input class=\"buttonvhod\" type=\"submit\" /></p>
</form> </div>";
								}
							}
							else
							{
echo
" <div class=\"container\"><form action=\"loginbd.php\" method=\"post\">
<p class=\"logpas\">Логин <input type=\"text\" name=\"login\" /></p>
<p class=\"logpas\">Пароль <input type=\"text\" name=\"password\" /></p>
<p class=\"logpas\"><input class=\"buttonvhod\" type=\"submit\" /></p>
</form> </div>";

							}
			?>
			
			</div>
		</div>
	</header>

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