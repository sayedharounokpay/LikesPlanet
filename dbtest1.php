<?php

$host = "localhost";
$username = "likespla_liker";
$password = "eaK}WdQ@q#~D";
$database = "likespla_ankur625";
$mysqli = mysqli_connect($host, $username, $password, $database);
   
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $likespla_planet->connect_errno . ") " . $likespla_planet->connect_error;
        die();
    }
    
$query = "SELECT * FROM users_old WHERE users_old.login NOT IN ( SELECT login FROM users )";
$accs=0;
if($lp1 = $mysqli->query($query)) {
    while($row = $lp1->fetch_assoc()) {
        $stmt=$mysqli->prepare('INSERT INTO users (email,login,coins,IP,pass,signup,online,banned,ref,unlikes,likes,ref2,refgive,rate,votes,hitstoday,fbn,deny,conf,code,lastip,ban,reason,pr,country,taskstoday,lastpoints,agent,bought,multi,beforeref,hitsbeforeref,ytn,age,ptp,pagelikesnow,reverb,reg_h,twitter,totalgive,rank,mana,reg_ip,log_h,likes_quality,refrally) '
                            . 'VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                
                    $stmt->bind_param("ssdssssiiiiiiiiisiissisisiiiiiiisiiisisiidsiii",$row['email'],$row['login'],$row['coins'],$row['IP'],$row['pass'],$row['signup'],$row['online'],$row['banned'],$row['ref'],$row['unlikes'],$row['likes'],$row['ref2'],$row['refgive'],$row['rate'],$row['votes'],$row['hitstoday'],$row['fbn'],$row['deny'],$row['conf'],$row['code'],$row['lastip'],$row['ban'],$row['reason'],$row['pr'],$row['country'],$row['taskstoday'],$row['lastpoints'],$row['agent'],$row['bought'],$row['multi'],$row['beforeref'],$row['hitsbeforeref'],$row['ytn'],$row['age'],$row['ptp'],$row['pagelikesnow'],$row['reverb'],$row['reg_h'],$row['twitter'],$row['totalgive'],$row['rank'],$row['mana'],$row['reg_ip'],$row['log_h'],$row['likes_quality'],$row['refrally']);
                    $rc=$stmt->execute();
                    if(!$rc) {
                            die('execute() failed: ' . htmlspecialchars($stmt->error));
                    }
                    printf('<br>Inserted into Database with login: '.$row['login']);
                    $stmt->close();
                    $accs++;
                    
    }
}
echo '<br><br><br><b>';
echo $accs.' RETRIEVED ACCOUNTS';
                