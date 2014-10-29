<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $likespla_planet = new mysqli($host, $username, $password, "likespla_planet");
    $likespla_ankur = new mysqli($host, $username, $password, "likespla_ankur");
    
    if ($likespla_planet->connect_errno) {
        echo "Failed to connect to MySQL: (" . $likespla_planet->connect_errno . ") " . $likespla_planet->connect_error;
        die();
    }
    
    if ($likespla_ankur->connect_errno) {
        echo "Failed to connect to MySQL: (" . $likespla_ankur->connect_errno . ") " . $likespla_ankur->connect_error;
        die();
    }
    
    if($lp1 = $likespla_ankur->query('SELECT * FROM users WHERE email=\'nagham@googlemail.com\'')) {
        while($row = $lp1->fetch_assoc()) {
            $login = $row['login'];
            echo '<br> Found: '.$login;
            if($lp2 = $likespla_planet->query('SELECT * FROM users WHERE login=\''.$login.'\' LIMIT 1')) {
                $row2 = $lp2->fetch_assoc();
                $likespla_ankur->query('UPDATE users SET email=\''.$row2['email'].'\' WHERE id='.$row2['id']);
                echo ' Changed to: '.$row2['email'];
            }
        }
    }
    
    
?>