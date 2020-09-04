<?php
session_start();
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "integration system";

$mysqli = new mysqli($server_name, $user_name, $password, $db_name);
$mysqli->query('SET NAMES utf8');

$strok = $_GET['stroka'];
$counnt = $_GET['counnt'];
if ($strok == 1) {
    $result = $mysqli->query("SELECT vacancy.idVacancy,vacancy.description,vacancy.expirience,jobgiver.fio FROM vacancy,jobgiver WHERE vacancy.Jobgiver_idJobgiver = jobgiver.idJobgiver ORDER BY vacancy.description LIMIT $counnt");


    echo '<table id ="tl"><tr><th>Название</th><th>Описание</th><th>работодатель</th><th> </th></tr>';
    while ($rows = $result->fetch_object()) {
        echo "<tr><th>$rows->description</th><th>$rows->expirience</th><th>$rows->fio</th><th><a href=\"numvak.php?id=$rows->idVacancy\"> Подробнее</a></th></tr>";
    }
    echo '</table>';
}
if ($strok == 2) {
    $result = $mysqli->query("SELECT vacancy.idVacancy,vacancy.description,vacancy.expirience,jobgiver.fio FROM vacancy,jobgiver WHERE vacancy.Jobgiver_idJobgiver = jobgiver.idJobgiver ORDER BY vacancy.expirience LIMIT $counnt");


    echo '<table id ="tl"><tr><th>Название</th><th>Описание</th><th>работодатель</th><th> </th></tr>';
    while ($rows = $result->fetch_object()) {
        echo "<tr><th>$rows->description</th><th>$rows->expirience</th><th>$rows->fio</th><th><a href=\"numvak.php?id=$rows->idVacancy\"> Подробнее</a></th></tr>";
    }
    echo '</table>';
}
if ($strok == 3) {
    $result = $mysqli->query("SELECT vacancy.idVacancy,vacancy.description,vacancy.expirience,jobgiver.fio FROM vacancy,jobgiver WHERE vacancy.Jobgiver_idJobgiver = jobgiver.idJobgiver ORDER BY jobgiver.fio LIMIT $counnt");


    echo '<table id ="tl"><tr><th>Название</th><th>Описание</th><th>работодатель</th><th> </th></tr>';
    while ($rows = $result->fetch_object()) {
        echo "<tr><th>$rows->description</th><th>$rows->expirience</th><th>$rows->fio</th><th><a href=\"numvak.php?id=$rows->idVacancy\"> Подробнее</a></th></tr>";
    }
    echo '</table>';
}


$mysqli->close();
