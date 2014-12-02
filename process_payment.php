<?php
include('config.php');


if(isset($_GET['transactid'])) {
    $results = mysql_query("SELECT * FROM transactions WHERE transacid='".$_GET['transactid']."' AND valid=0");
    if($transaction = mysql_fetch_object($results)) {
        if($transaction->id > 0 && $transaction->vip == 0) {
        if($_POST['payment_status'] == 'Completed') {
            if($transaction->cash == $_POST['mc_gross'] || $transaction->cash == $_POST['payment_gross']) {
                $validvals = array(50=>100000,100=>225000,200=>500000,4=>4000,8=>9000,20=>25000,40=>60000,60=>100000,80=>140000);
                $validity=false;
                $final_cash=$transaction->cash;
                $final_pnts=$_GET['pnt'];
                foreach($validvals as $key=>$val){
                    if($validity == false) {
                        if($_POST['mc_gross'] == $key || $_POST['payment_gross'] == $key) {
                            $final_cash = $key;
                            $final_pnts = $val;
                            $validity=TRUE;
                        }
                    }
                }
                if($_POST['verify_sign'] != "") {
                    if($validity) {
                        mysql_query("UPDATE `users` SET `coins`=`coins`+'{$final_pnts}', `bought`= '1' WHERE `id`='{$transaction->userid}'");
                        mysql_query("UPDATE transactions SET valid=1 WHERE transacid='".$_GET['transactid']."'");
                        mysql_query("INSERT INTO statistics (user_id,date,coins_gained,payment,log,page) VALUES ({$transaction->userid},NOW(),{$final_pnts},1,'<b style=\"color:green;\">Bought Points (Paypal)</b>','process_payment.php')");
                        mysql_query("INSERT INTO `orders` (user_id, points, date, price) VALUES ('{$transaction->userid}',{$final_pnts},NOW(),{$final_cash}) ");
                        $userresult = mysql_query("SELECT * FROM users WHERE id={$transaction->userid}");
                        if($userr = mysql_fetch_object($userresult)){
                        mysql_query("INSERT INTO `fakeorders` (login, country, money, points, date) VALUES('{$userr->login}', '{$userr->country}', '{$final_cash}', '{$final_pnts}', NOW() ) ");
                        }
                        
                        }
                    else {
                        mysql_query("UPDATE transactions SET valid=-1 WHERE id=".$transaction->id);
                        $datet = date("Y-m-d H:i:s");
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
                        $headers .= "From: Likesplanet.com" . "\r\n" .
                        "Reply-To: no-reply@likesplanet.com" . "\r\n" .
                        "X-Mailer: PHP/" . phpversion();
                        $message = "<html><head></head>"
                                . "<body>"
                                . "<h1>Invalid Paypal Payment</h1>"
                                . "<p>An invalid paypal payment has been detected and filtered out<br/><br/>"
                                . "Recently a paypal transaction has failed and points were not provided. Deal with issue manually by contacting the respective parties involved. Reason: Invalid Amount to points recieved"
                                . "<br/><br/>User ID: {$data->id} <br> Paid Amount: {$_POST['mc_gross']} <br> Payment type: Paypal <br> Date: ".$datet
                                . "</body>"
                                . "</html>";
                        mail('likesplanet.com@gmail.com','Invalid Paypal Payment (LikesPlanet.com)',$message,$headers);
                    }
                }
            }
        }
        }
        else if($transaction->id > 0 && $transaction->vip > 0) {
            if($_POST['payment_status'] == "Completed") {
                if($transaction->cash == $_POST['mc_gross'] || $transaction->cash == $_POST['payment_gross']) {
                    $validvals = array(6=>168,9=>720,22=>8760);
                    $validity = FALSE;
                    $final_cash = $_POST['mc_gross'];
                    $final_pnts = $_GET['pnt'];
                    foreach($validvals as $key=>$val) {
                        if($validity == FALSE) {
                            if($_POST['mc_gross'] == $key || $_POST['payment_gross'] == $key) {
                                $final_cash = $key;
                                $final_pnts = $val;
                                $validity = TRUE;
                            }
                        }
                    }
                    
                    if($validity == TRUE) {
                         mysql_query("UPDATE `users` SET `pr`=`pr`+'{$final_pnts}', `bought`= '1' WHERE `id`='{$transaction->userid}'");
                        mysql_query("UPDATE transactions SET valid=1 WHERE transacid='".$_GET['transactid']."'");
                        mysql_query("INSERT INTO statistics (user_id,date,coins_gained,payment,log,page) VALUES ({$transaction->userid},NOW(),{$final_pnts},1,'<b style=\"color:green;\">Bought VIP Hours (Paypal)</b>','process_payment.php')");
                        mysql_query("INSERT INTO `orders` (user_id, points, date, price) VALUES('{$transaction->userid}', '{$final_pnts}', NOW(), '{$final_cash}' ) ");
                    }
                    else {
                        mysql_query("UPDATE transactions SET valid=-1 WHERE id=".$transaction->id);
                        $datet = date("Y-m-d H:i:s");
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
                        $headers .= "From: Likesplanet.com" . "\r\n" .
                        "Reply-To: no-reply@likesplanet.com" . "\r\n" .
                        "X-Mailer: PHP/" . phpversion();
                        $message = "<html><head></head>"
                                . "<body>"
                                . "<h1>Invalid Paypal Payment</h1>"
                                . "<p>An invalid paypal payment has been detected and filtered out<br/><br/>"
                                . "Recently a paypal transaction has failed and VIP Hours were not provided. Deal with issue manually by contacting the respective parties involved. Reason: Invalid Amount to points recieved"
                                . "<br/><br/>User ID: {$data->id} <br> Paid Amount: {$_POST['mc_gross']} <br> Payment type: Paypal <br> Date: ".$datet
                                . "</body>"
                                . "</html>";
                        mail('likesplanet.com@gmail.com','Invalid Paypal Payment (LikesPlanet.com)',$message,$headers);
                    }
                }
            }
        }
    }
}
?>

