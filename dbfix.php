<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "likespla_ankur625";
$mysqli = mysqli_connect($host, $username, $password, $database);
   
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $likespla_planet->connect_errno . ") " . $likespla_planet->connect_error;
        die();
    }
    
    $query = "SELECT * FROM users_old WHERE users_old.login IN ( SELECT login FROM users )";
    if($lp1 = $mysqli->query($query)) {
        while($row = $lp1->fetch_assoc()) {
            $query = "UPDATE users SET pass='".$row['pass']."' WHERE id=".$row['id'];
            $mysqli->query($query);
            echo '<br>fixed: '.$row['login'];
        }
    }