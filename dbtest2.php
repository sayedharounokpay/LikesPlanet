<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $likespla_planet = new mysqli($host, $username, $password, "likespla_me");
    $likespla_ankur = new mysqli($host, $username, $password, "likespla_ankur625");
    
    
    
    if ($likespla_planet->connect_errno) {
        echo "Failed to connect to MySQL: (" . $likespla_planet->connect_errno . ") " . $likespla_planet->connect_error;
        die();
    }
    
    if ($likespla_ankur->connect_errno) {
        echo "Failed to connect to MySQL: (" . $likespla_ankur->connect_errno . ") " . $likespla_ankur->connect_error;
        die();
    }
    $accts=0;
    $scanned=0;
    if($lp1 = $likespla_ankur->query('SELECT * FROM users WHERE email=\'nagham@googlemail.com\'')) {
        while($row = $lp1->fetch_assoc()) {
            $login = $row['login'];
            echo '<br> Found: '.$login;
            $scanned++;
            if($lp2 = $likespla_planet->query('SELECT * FROM users_old WHERE login=\''.$login.'\' LIMIT 1')) {
                $row2 = $lp2->fetch_assoc();
                if($row2['email'] != "nagham@googlemail.com" && strlen($row2['email']) > 1){
                $likespla_ankur->query('UPDATE users SET email=\''.$row2['email'].'\' WHERE id='.$row2['id']);
                echo ' Changed to: '.$row2['email'];
                $accts++;
                }
            }
        }
    }
    echo '<br><br><br>Emails Scanned: '.$scanned;
    echo '<br><br><br>Emails Retrieved: '.$accts
    
    
?>