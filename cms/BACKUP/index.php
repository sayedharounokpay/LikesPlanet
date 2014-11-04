<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
$loc = 'login.php';
if(isset($_SESSION['admin_login_state'])) {
    if($_SESSION['admin_login_state']) {
        $loc = 'dashboard.php';
    }
}
header('Location: '.$loc );
?>