<?php
require_once('conn.php');

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
    $query = "SELECT pass,id FROM users WHERE login = ? ";
    if($stmt = $db->prepare($query)) {
        $stmt->bind_param("s",$username);
        if($stmt->execute()) {
            $stmt->bind_result($pass,$id);
            while ($stmt->fetch()) {
                if($password){
                    if($pass == md5($password)){
                        if($id == 1 || $id == 2){
                        $_SESSION['admin_state_login'] = TRUE;
                        $_SESSION['admin_level'] = $id;
                        $result = TRUE;
                        echo 'success';
                        }
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
?>
<html>
    
    <head>
        <?php
if($result) {
    echo '<script>document.location.href="dashboard.php"</script>';exit;
}
else {
    echo '<script>document.location.href="login.php?err='.$err.'"</script>';exit;
}
?>
    </head>
</html>