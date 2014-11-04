<?php
include('header.php');
$message ="";

error_reporting(E_ALL);
if(isset($_GET['requestid'])) {
    if( $passrequest = mysql_query("SELECT * FROM pass_requests WHERE id=".$_GET['requestid'].' AND completed=0' )) {
        if($request = mysql_fetch_object($passrequest)) {
            if(isset($_GET['user']) && $_GET['user'] == $request->user) {
                if(isset($_GET['conf']) && $_GET['conf'] == $request->newpass) {
                    
                    if(mysql_query("UPDATE users SET pass = '{$request->newpass}' WHERE login='{$request->user}'")){
                        if(mysql_query("UPDATE pass_requests SET completed = 1 WHERE id=".$_GET['requestid'])) {
                            echo 'Password Change has been completed. Please Login now with your new password';
                        }
                        else {
                            echo 'MySQL Confirmation Error';
                        }
                    }
                    else {
                        echo 'MySQL Error';
                    }
                    
                }
            }
            else {
                $message = "MISSMATCH";
            }
        }
    }
    else {
        $message = "UNDEFINED REQUEST";
    }
}else {
    $message = "UNDEFINED REQUEST";
}
echo $message;
include('footer.php');

