<?php
require_once ('../header.php');
require_once ('functions.php');
require_once ('../conn.php');
require_once ('../global-functions.php');
// Base File. To control everything

if(isset($_GET['action'])) {
    if($_GET['action'] == 'edit-logon-avab') {
        require_once('interface/user-list.php');
    }
    else if($_GET['action'] == "send-email") {
        authenticate_page(1);
        require_once('interface/send-email.php');
    }
    else if($_GET['action'] == 'email-send-act') {
        authenticate_page(1);
         global $db;
        ?>
<form action="<?=$baselocation;?>/users/base.php?action=email-send-conf" method="POST">
    <input type="hidden" name="message" value="<?=$_POST['message']?>"/>
    <input type="hidden" name="subject" value="<?=$_POST['subject']?>"/>
    <input type="submit" class="btn btn-success btn-lg" value="Click to confirm email send"/>
</form>
        <?php
        
    }
    else if($_GET['action'] == 'email-send-conf') {
        if($result = $db->query("SELECT DISTINCT email FROM users")) {
            $count = $result->num_rows;
            $exectime = ($count * 0.5) * 100;
            set_time_limit($exectime);
            while($row = $result->fetch_assoc) {
                $message = $_POST['message'];
                $subject = $_POST['subject'];
                $emailMessage = new emailMess($row['email'], $message, $subject);
            }
            echo 'Success!<br>';
            echo 'Email Sent to '.$count.' Unique Emails';
        }
        else {
            echo 'Failure. Error code 101';
        }
    }
    else if($_GET['action'] == "uoptions") {
        require_once('interface/user-options.php');
       
    }
    
    else if($_GET['action'] == "save_edit") {
        foreach($_POST as $key=>$val) {
            if(is_string($val)) {
            global $db;
            
            if($result = $db->query("UPDATE users SET $key = '$val' WHERE id=".$_GET['id']) ) {
                
            }
            else 
            {
                
            }
            }
        }
        if(isset($_POST['admin_login'])) {
            $db->query("UPDATE users SET admin_login = 1 WHERE id=".$_GET['id']);
        }
        else {
            $db->query("UPDATE users SET admin_login = 0 WHERE id=".$_GET['id']);
        }
        //header('Location: ' . $_SERVER['HTTP_REFERER'] . '&result=success');
        echo '<script>document.location.href="'.$_SERVER['HTTP_REFERER'] . '&result=success";</script>';
    }
}

require_once('../footer.php');