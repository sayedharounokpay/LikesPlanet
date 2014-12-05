<?php
require_once ('../header.php');
require_once ('functions.php');
include ('../conn.php');
require_once ('../global-functions.php');
// Base File. To control everything

if(isset($_GET['action'])) {
    if($_GET['action'] == 'edit-logon-avab') {
        require_once('interface/user-list.php');
    }
    else if($_GET['action'] == 'add-points') {
        authenticate_page(1);
        require_once('interface/user-points.php');
    }
    else if($_GET['action'] == 'add-points-exec') {
        authenticate_page(1);
        global $db;
        echo '<div class="row"> <div class="col-lg-12">
        <div class="row"><h1>Status</h1>
        <hr/>';
        if(isset($_POST['conf'])){
            $query = "SELECT * FROM users WHERE login='admin'";
            if($result = $db->query($query)){
                if($useradmin = $result->fetch_object()){
                    if(md5($_POST['conf']) == $useradmin->pass){
                       
                    }
                    else {
                        echo '<h1>UNABLE TO CONTINUE. ERROR</h1>';
                        die();
                    }
                }
            }
        }
        if(isset($_POST['login'])){
            $login = $_POST['login'];
            $query = "SELECT * FROM users WHERE login='{$login}'";
            
            if($results = $db->query($query)){
            if($userr = $results->fetch_assoc() ){
                $db->query("UPDATE users SET coins=coins+{$_POST['points']} WHERE id={$userr['id']}");
                $db->query("UPDATE users SET beforeref=coins WHERE id={$userr['id']}");
                $db->query("INSERT INTO statistics (user_id,date,coins_gained,admin,log,page) VALUES ({$userr['id']},NOW(),{$_POST['points']},1,'<b style=\"color:orange;\">Points Added From Administrator</b>','users-interface-add-points-exec')");
                $message = '<h1><b style="color:green">'.$_POST['points'].'</b> Points added to: '.$userr['login'].'</h1>';
            }
            else {
                $message = "<p>Points Not added. User not found.</p>";
            }
            
            }
            else {
                $message = '<p>Undefined Error</p>';
                echo mysqli_error($db);
            }
        }
        else {
            $message = "<p>Please fill up the form before proceeding</p>";
            echo mysqli_errno($db);
        }
        echo $message;
        echo '</div> </div> </div>';
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
    <div class="row" style="padding:15px; background-color:#f6f6f6;">
        <h4>Filters</h4>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="filter_ban" checked> Exclude Banned Users
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="filter_paying" checked> Include Paying Customers
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="filter_nonpaying" checked> Include Non-paying Customers
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="filter_active" checked> Include Active Customers (1 year)
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="filter_nonactive" checked> Include Non-Active Customers
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="filter_activeweek"> Include Active only within 1 week
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="filter_nonactiveweek"> Include Non-Active Customers only within 1 week
            </label>
        </div>
        
        
    </div>
    <input type="submit" class="btn btn-success btn-lg" value="Click to confirm email send"/>
</form>
        <?php
        
    }
    else if($_GET['action'] == 'email-send-conf') {
        authenticate_page(1);
        $searchparams=array('params'=>array(),'query'=>'','conditionals'=>array('bought'=>false));
       
        $filtervals = array('filter_ban'=>'ban = 0','filter_paying'=>'bought > 0','filter_nonpaying'=>'bought = 0','filter_active'=>'online > NOW() - INTERVAL 30 DAY','filter_nonactive'=>'online < NOW() - INTERVAL 30 DAY','filter_activeweek'=>false,'filter_nonactiveweek'=>false);
        
        //Conditional Filtering
        if(isset($_POST['filter_paying']) && isset($_POST['filter_nonpaying'])) {
            $searchparams['params'][] = 'bought >= 0';
            unset($_POST['filter_paying']);
            unset($_POST['filter_nonpaying']);
        }
        
        if(isset($_POST['filter_active']) && isset($_POST['filter_nonactive'])){
            unset($_POST['filter_active']);
            unset($_POST['filter_nonactive']);
        }
        
        
        foreach($filtervals as $key=>$val){
            if(isset($_POST[$key])) {
                $searchparams['params'][] = $val;
            }
        }
        
        //Build query
        for($i = 0; $i < count($searchparams['params']); $i++){
            $searchparams['query'] .= ($i == 0) ? 'WHERE ':'';
            $searchparams['query'] .= $searchparams['params'][$i].' ';
            $searchparams['query'] .= ($i < count($searchparams['params'])-1) ? 'AND ' : '';
        }
        //var_dump($searchparams);
        $query = "SELECT DISTINCT email FROM users";
        $query .= isset($searchparams['query']) ? ' '.$searchparams['query'] : '';
        //echo '<br>Query: '.$query;
        echo '<h2>Email Sending</h2><hr/><b style="color:red;" id="emailstate">PROCESSING: Please do not close browser</b><br><div id="emailprogress"></div>';
        if($result = $db->query($query)) {
            $currentcount=0;
            $count = $result->num_rows;
            $exectime = ($count * 0.5) * 100;
            set_time_limit($exectime);
            while($row = $result->fetch_assoc()) {
                $currentcount++;
                $progress = ($currentcount/$count) * 100;
                //$message = $_POST['message'];
                //$subject = $_POST['subject'];
                //$emailMessage = new emailMess($row['email'], $message, $subject);
                //echo '<br>Email Sent to: '.$row['email'];
                if($progress%2 == 0) {
                echo '<script>$(\'#emailprogress\').html("'.number_format($progress,2).'%")</script>';
                }
            }
            echo '<script>$(\'#emailstate\').css(\'color\',\'green\')</script>';
            echo '<script>$(\'#emailstate\').html("COMPLETED: Email Sending Process has been completed")</script>';
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
    
    function searchConditionals($cond,$cond2) {
        
    }
}

require_once('../footer.php');