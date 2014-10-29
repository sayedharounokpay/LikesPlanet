<?php
include('config.php');
error_reporting(E_ALL);
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
$_SESSION['login_err'] = 0;
if ( isset($_POST['captcha']) ) {
    if( $_POST['captcha'] != "" && $_SESSION['code'] == $_POST['captcha'] ) {
        if( isset($_POST['login']) ) {
            $user = mysql_real_escape_string($_POST['username']); 
            $pass =mysql_real_escape_string($_POST['pass']); 
            
            $dbres1 = mysql_query("SELECT * FROM `users` WHERE (`login`='{$user}' OR `email`='{$user}')");
            $dbres2 = mysql_fetch_object($dbres1);
            
                $dbres= mysql_query("SELECT * FROM `users` WHERE (`login`='{$user}' OR `email`='{$user}' )");
            
            
            $num = mysql_num_rows($dbres);
            $data2 = mysql_fetch_object($dbres);
            
            $final = VisitorIP();
            mysql_query("INSERT INTO `log_ip` (IP) VALUES('{$final}')");
            $dbres00 = mysql_query("SELECT * FROM `log_ip` WHERE `IP`='{$final}'");
            $num00 = mysql_num_rows($dbres00);
            $message = "";
            if($num > 0) {
                if($num > 25) {  
                    //Account Checks
                    if($data2->conf == 5) {
                        $message = "You should confirm your account. Check your email address";
                    }
                    else if ($data2->ban > 0) {
                        $message = "Your account has been banned for " . $data2->ban ." days. Reason: " .$data2->reason;
                    }
                    else if ($data2->banned > 0) {
                        $message = "Your account has been banned.";
                    }
                    else if($data2->activate > 0) {
                        $message = "You should confirm your account. Check your email address";
                    }
                    //Bug
                    /*
                    else if($num00 > 20){
                        $message = "Temporary problem happens when you try to login!</br>Please come back next 30 minutes."; $message2 = 1;
                    }
                     * 
                     */
                    else if($num > 0){
                        $final = VisitorIP();
                        mysql_query("UPDATE `users` SET `lastpoints`=`coins`  WHERE (`login`='{$_POST['username']}' OR `email`='{$_POST['username']}' )");
                        $sitelogin = mysql_query("SELECT * FROM `login` WHERE (`user_id` = '{$_POST['username']}')");
                        $extlog = mysql_num_rows($sitelogin);
                        if($extlog == 0){
                            mysql_query("INSERT INTO `login` (user_id) VALUES('{$_POST['username']}')");
                            mysql_query("UPDATE `sitestat` SET `online`=`online`+'1'  WHERE `id`='3'");
                        }
                        // Old Login check function
                        $sitelogin = mysql_query("SELECT * FROM `users` WHERE (`IP` = '{$final}' OR `lastip` = '{$final}') AND NOT `login` ='{$_POST['username']}'  AND NOT `email` ='{$_POST['username']}' ");
                        $extlog = mysql_num_rows($sitelogin);
                        if(2 == 1 && $extlog != 0 && $data2->pr == 0 && $data2->agent == 0){
                            $sitelogin0 = mysql_query("SELECT * FROM `users` WHERE (`login` ='{$_POST['username']}' OR `email` ='{$_POST['username']}') ");
                            $useripc0 = mysql_fetch_object($sitelogin0);
                            if ($data2->pr == 0 && $data2->agent == 0) {
                                mysql_query("UPDATE `users` SET `ban`=`ban`+1, `reason`='You are using More than 1 Account.', `multi`=`multi`+1  WHERE `id`='{$useripc0->id}'");
                                for($j=1; $useripc = mysql_fetch_object($sitelogin); $j++)
                                {
                                    mysql_query("INSERT INTO `similarip` (user1, user2, IP) VALUES('{$useripc0->id}', '{$useripc->id}', '{$final}' )");
                                    mysql_query("UPDATE `users` SET `ban`=`ban`+1, `reason`='You are using More than 1 Account.', `multi`=`multi`+1  WHERE `id`='{$useripc->id}'");
                                }
                            }
                        $message = "You try to login More that 1 account!"; $message2 = 1;
                        }
                        else 
                        {
                            mysql_query("UPDATE `users` SET `online`=NOW(), `lastip`='{$final}', `log_h`='24'  WHERE (`login`='{$data2->login}') ");
	  
                            if(isset($data2->login) && $data2->login!="")
                            {
                                $_SESSION['login'] = $data2->login;
                            }
                            if($data2->login == "admin") {
                                echo "<script>document.location.href='index.php'</script>";
                            } else {
                                echo "<script>document.location.href='".$siteme->login."'</script>";
                            }
                        }
                    }
                    else 
                    {
                        $message = "Username or password is incorrect";
                    }
                }
            }
            else {
                $message = "Username or password is incorrect";
            }
        }
    }
    else {
        $message = "Incorrect Captcha Code.";
    }
    
    $message2 = (strlen($message) > 1) ? 1 : 0;
    $_SESSION['login_error'] = $message2;
    $_SESSION['login_message'] = $message;
}

echo "<script>document.location.href='index.php'</script>";