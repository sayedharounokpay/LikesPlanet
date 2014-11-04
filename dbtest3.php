<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $likespla_ankur = new mysqli($host, $username, $password, "likespla_ankur625");
    
    if ($likespla_ankur->connect_errno) {
        echo "Failed to connect to MySQL: (" . $likespla_ankur->connect_errno . ") " . $likespla_ankur->connect_error;
        die();
    }
    
   
    $query = "SELECT * FROM users WHERE users.login NOT IN (SELECT login FROM user_pw_backup)";
    echo $query;
    if($lp1 = $likespla_ankur->query($query)) {
        while($row = $lp1->fetch_assoc()) {
            
            $id = $row['id'];
            $pass = $row['pass'];
            $login = $row['login'];
            $passhex = md5($pass);
            $query = "UPDATE users SET pass ='$passhex' WHERE id=$id";
            
            if($lp2 = $likespla_ankur->query($query)) {
                echo "<br>Password of $login changed from $pass to $passhex";
                $query = "INSERT INTO user_pw_backup (id,login,password) VALUES ($id,'$login','$pass')";
                echo '<br>'.$query;
                echo '<br>';
                if($lp3 = $likespla_ankur->query($query)) {
                    echo ' <b>user password backed up</b> ';
                }
                else {
                    echo 'error';
                }
            }
            
        }
    }
    else {
        echo 'Bad Query';
    }