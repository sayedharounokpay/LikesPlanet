<?php
$baselocation = "http://www.likesplanet.com/cms";

if(isset($_SESSION['admin_state_login'])) {
    if($_SESSION['admin_state_login'] == true) {
        // Logged
    }
    else {        
        //header('Location: login.php');
        echo '<script>document.location.href="'.$baselocation.'/login.php"</script>';
    }
}
else {
    echo '<script>document.location.href="'.$baselocation.'/login.php"</script>';
}


function check_admin(){
    if($_SESSION['admin_level'] == 1) {
        return true;
    }
    else {
        return false;
    }
}

