<?php
include('config.php');


if(isset($_GET['transactid'])) {
    $results = mysql_query("SELECT * FROM transactions WHERE transacid='".$_GET['transactid']."' AND valid=0");
    if($transaction = mysql_fetch_object($results)) {
        if($_POST['payment_status'] == 'Completed') {
            if($transaction->cash == $_POST['mc_gross'] || $transaction->cash == $_POST['payment_gross']) {
                
                if($_POST['verify_sign'] != "") {
                    if($transaction->points == $_GET['pnt']) {
                        mysql_query("UPDATE `users` SET `coins`=`coins`+'{$_GET['pnt']}', `pr`=`pr`+'{$_GET['pnt']}', `bought`= '1' WHERE `id`='{$_GET['uid']}'");
                        mysql_query("UPDATE transactions SET valid=1 WHERE transacid='".$_GET['transactid']."'");
                        mysql_query("INSERT INTO statistics (user_id,date,coins_gained,payment,log,page) VALUES ({$_GET['uid']},NOW(),{$_GET['pnt']},1,'<b style=\"color:green;\">Bought Points (Paypal)</b>','process_payment.php')");
                        mysql_query("INSERT INTO `orders` (user_id, points, date, price) VALUES('{$_GET['uid']}', '{$_GET['pnt']}', NOW(), '{$_GET["price"]}' ) ");
                    }
                }
            }
        }
    }
}
?>

