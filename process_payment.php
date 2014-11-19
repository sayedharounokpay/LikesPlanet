<?php
include('config.php');
$message = "<html><body>";
if(isset($_POST)){
   foreach($_POST as $key => $val) {
       $message .= "<br>$key : $val";
   }
}
$message .="<h2>GET Variables:</h2>";
if(isset($_GET)) {
    foreach($_GET as $key => $val) {
        $message .="<br>$key : $val";
    }
}
$message.="</body></html>";

$to = 'owchzzz@gmail.com';

$subject = 'Website Maintenance';

$headers = "From: likesplanet.com@gmail.com\r\n";
$headers .= "Reply-To: likesplanet.com@gmail.com\r\n";
$headers .= "CC: \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail($to, $subject, $message, $headers);

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

