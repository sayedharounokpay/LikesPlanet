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
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '&result=success');
    }
}

require_once('../footer.php');