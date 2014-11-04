<?php
include('header.php');
if(isset($_GET['requestid'])) {
    if( $query = mysql_query("SELECT * FROM reset_requests WHERE id=".$_GET['requestid']).' AND completed=0' ) {
        if($request = mysql_fetch_object($query)) {
            if(isset($_GET['user']) && $_GET['user'] == $request->user) {
                if(isset($_GET['conf']) && $_GET['conf'] == $request->newpass) {
                    
                    mysql_query("UPDATE users SET pass = '{$request->newpass}' WHERE login='{$request->user}'");
                    mysql_query("UPDATE pass_request SET completed = 1 WHERE id=".$_GET['requestid']);
                    
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

