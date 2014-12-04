<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "likespla_ankur625";

$db = mysqli_connect($host, $user, $pass, $db) or die("Error " . mysqli_error($link));
$link = mysql_connect('localhost', $user, $pass);
$baselocation = "http://localhost/LikesPlanet/cms";
