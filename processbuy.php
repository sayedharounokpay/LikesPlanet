<?php
include('header.php');
function createTransaction($userid, $points, $cash) {
    $result = mysql_query("SELECT * FROM users WHERE id={$userid}");
    if($row = mysql_fetch_object($result)) {
        $transrand = rand(1000,1500) * 0.3;
        $transdate = strtotime("now");
        $transactid = $transrand.$transdate.$userid;
        mysql_query("INSERT INTO transactions (date,userid,points,cash,transacid) VALUES (now(),{$userid},{$points},{$cash},'{$transacid}')");
       return $transactid;
    }
    else {
        return -1;
    }
}

if(!isset($data->login)) {
    echo '<script>document.location.href="http://www.likesplanet.com"</script>';
}

else {
    if(isset($_GET['type'])){
        $user_id = $data->id;
        $type = $_GET['type'];
        if($type == 1){
            createTransaction($user_id, 100000, 50);
            echo '<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#100,000 Points to '.$data->login.'">
<input type="hidden" name="item_number" value="100000">
<input type="hidden" name="custom" value="'.$data->login.'">
<input type="hidden" name="amount" value="50">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid='.$data->id.'&pnt=100000&price=50">
<input type="hidden" name="notify_url" value="http://www.likesplanet.com/thankyou.php?uid='.$data->id.'&pnt=100000&price=50&price=8&transactid='.$transactid.'">
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">

</form>';
        }
        
        else if($type == 2) {
            createTransaction($user_id, 225000, 100);
            echo '<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#225,000 Points to '.$data->login.'">
<input type="hidden" name="item_number" value="225000">
<input type="hidden" name="custom" value="'.$data->login.'>
<input type="hidden" name="amount" value="100">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid='.$data->id.'&pnt=0">
<input type="hidden" name="notify_url" value="http://www.likesplanet.com/process_payment.php?uid='.$data->id.'&pnt=225000&price=8&transactid='.$transactid.'">
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">

</form>';
        }
        else if($type == 3) {
            $transactid=createTransaction($user_id, 500000, 200);
            echo '<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#500,000 Points to '.$data->login.'">
<input type="hidden" name="item_number" value="500000">
<input type="hidden" name="custom" value="'.$data->login.'">
<input type="hidden" name="amount" value="200">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid='.$data->id.'&pnt=0">
<input type="hidden" name="notify_url" value="http://www.likesplanet.com/process_payment.php?uid='.$data->id.'&pnt=500000&price=200&transactid='.$transactid.' ">
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">

</form>';
        }
        else if($type == 4) {
            $transactid=createTransaction($user_id, 4000, 4);
            echo '<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#4,000 Points to '.$data->login.'">
<input type="hidden" name="item_number" value="4000">
<input type="hidden" name="custom" value="'.$data->login.'">
<input type="hidden" name="amount" value="4">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid='.$data->id.'&pnt=4000&price=4">
<input type="hidden" name="notify_url" value="http://www.likesplanet.com/process_payment.php?uid='.$data->id.'&pnt=4000&price=4&transactid='.$transactid.'">
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">

</form>';
            
        }
        else if($type == 5) {
            $transactid= createTransaction($user_id, 25000, 20);
            echo '<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#25,000 Points to '.$data->login.'">
<input type="hidden" name="item_number" value="25000">
<input type="hidden" name="custom" value="'.$data->login.'">
<input type="hidden" name="amount" value="20">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid='.$data->id.'&pnt=25000&price=20">
<input type="hidden" name="notify_url" value="http://www.likesplanet.com/process_payment.php?uid='.$data->id.'&pnt=25000&price=20&transactid='.$transactid.'">
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">

</form>';
        }
        else if($type == 6) {
            $transactid=createTransaction($user_id, 60000, 40);
            echo '<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#60,000 Points to '.$data->login.'">
<input type="hidden" name="item_number" value="60000">
<input type="hidden" name="custom" value="'.$data->login.'">
<input type="hidden" name="amount" value="40">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid='.$data->id.'&pnt=0">
<input type="hidden" name="notify_url" value="http://www.likesplanet.com/process_payment.php?uid='.$data->id.'&pnt=60000&price=40&transactid='.$transactid.'"> 
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">

</form>';
        }
        else if($type == 7) {
            $transactid=createTransaction($user_id, 100000, 60);
            echo '<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#100,000 Points to '.$data->login.'">
<input type="hidden" name="item_number" value="100000">
<input type="hidden" name="custom" value="'.$data->login.'">
<input type="hidden" name="amount" value="60">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid='.$data->id.'&pnt=0">
<input type="hidden" name="notify_url" value="http://www.likesplanet.com/process_payment.php?uid='.$data->id.'&pnt=100000&price=60&transactid='.$transactid.'"> 
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">

</form>';
        }
        else if($type == 8) {
            $transactid=createTransaction($user_id, 140000, 80);
            echo '<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#140,000 Points to '.$data->login.'">
<input type="hidden" name="item_number" value="140000">
<input type="hidden" name="custom" value="'.$data->login.'">
<input type="hidden" name="amount" value="80">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid='.$data->id.'&pnt=0">
<input type="hidden" name="notify_url" value="http://www.likesplanet.com/process_payment.php?uid='.$data->id.'&pnt=140000&price=80&transactid='.$transactid.'"> 
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">

</form>';
        }
        else if($type == 10) {
            $transactid=createTransaction($user_id, 9000, 8);
            echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#9,000 Points to '.$data->login.'">
<input type="hidden" name="item_number" value="9000">
<input type="hidden" name="custom" value="'.$data->login.'">
<input type="hidden" name="amount" value="8">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid='.$data->id.'&pnt=9000&price=8">
<input type="hidden" name="notify_url" value="http://www.likesplanet.com/process_payment.php?uid='.$data->id.'&pnt=9000&price=8&transactid='.$transactid.'"> 
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">

</form>';
        }
        else if($type == 1000) {
            $transactid=createTransaction($user_id, 9000, 8);
            echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#9,000 Points to '.$data->login.'">
<input type="hidden" name="item_number" value="1000">
<input type="hidden" name="custom" value="'.$data->login.'">
<input type="hidden" name="amount" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid='.$data->id.'&pnt=1000&price=1">
<input type="hidden" name="notify_url" value="http://www.likesplanet.com/process_payment.php?uid='.$data->id.'&pnt=1000&price=1&transactid='.$transactid.'"> 
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">

</form>';
        }
    }
    else {
        echo '<script>document.location.href="http://www.likesplanet.com"</script>';
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
Processing... Please wait a moment
<script>
    $('document').ready(function(){
        $('form').submit();
    });
    </script>

