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
    else if($_GET['action'] == 'add-points') {
        authenticate_page(1);
        require_once('interface/user-points');
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