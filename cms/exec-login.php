<?php
require_once('conn.php');
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
    $result = FALSE;
    $err = "undefined";
if(isset($_POST['admin_username'])) {
    $username = mysql_real_escape_string($_POST['admin_username']);
    $password = FALSE;

    if(isset($_POST['admin_password'])) {
        $password = mysql_real_escape_string($_POST['admin_password']);
    }
    else {
        $err="pass";
    }
    $query = "SELECT pass FROM users WHERE login = ? ";
    if($stmt = $db->prepare($query)) {
        $stmt->bind_param("s",$username);
        if($stmt->execute()) {
            $stmt->bind_result($pass);
            while ($stmt->fetch()) {
                if($password){
                    if($pass == $password){
                        $_SESSION['admin_login_state'] = TRUE;
                        $result = TRUE;
                    }
                    else {
                        $err = "pass";
                    }
                }
            }
        }
    }
    else {
        $err="query";
    }
}
else 
{
    $err = "user";
}

if($result) {
    header('Location: dashboard.php');
}
else {
    header('Location: login.php?err='.$err);
}