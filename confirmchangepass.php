<?php
$message = "";
include('config.php');
if(isset($_POST['requestid'])) {
    if(isset($_POST['conf']) && (strlen($_POST['conf']) > 5)) {
        if($passwordcheck = mysql_query("SELECT * FROM pass_requests WHERE id={$_POST['requestid']} AND newpass='{$_POST['conf']}' AND completed=0")){
            if($request = mysql_fetch_object($passwordcheck)) {
                if(isset($_POST['pass']) && strlen($_POST['pass']) > 5) {
                    if(isset($_POST['repass']) && $_POST['pass'] == $_POST['repass']) {
                        mysql_query("UPDATE pass_requests WHERE id={$_POST['requestid']} SET completed=1");
                        $userid = $request->user;
                        $newpass = md5($_POST['pass']);
                        mysql_query("UPDATE users WHERE login='{$userid}' SET pass='{$newpass}'");
                        $message = "Password Has successfully Been changed. Please proceed to <a href=\"http://www.likesplanet.com/login.php\">Login</a>";
                    }
                    else {
                        $message = "Passwords do not match.";
                    }
                }
                else {
                    $message = "Invalid Password";
                }
            }
        }
        else {
            try {
                mysql_query("UPDATE pass_requests SET completed=1 WHERE id={$_POST['requestid']}");
            } catch (Exception $ex) {
                $message = $ex;
            }
        }
    }
    else {
        $message = "Unidentified Signature.";
    }
}
else {
    $message = "Invalid Request";
   
}
echo $message;
?>