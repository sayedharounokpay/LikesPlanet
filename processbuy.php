<?php
include('header.php');
function createTransaction($userid, $points, $cash) {
    $result = mysql_query("SELECT * FROM users WHERE id={$userid}");
    if($row = mysql_fetch_object($result)) {
        $transrand = rand(1000,1500) * 0.3;
        $transdate = strtotime("now");
        $transact = $transrand.$transdate.$userid;
        mysql_query("INSERT INTO transactions (date,userid,points,cash,transacid) VALUES (now(),{$userid},{$points},{$cash},{$transacid})");
        
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
<input type="hidden" name="item_name" value="#100,000 Points to <? echo $data->login; ?>">
<input type="hidden" name="item_number" value="100000">
<input type="hidden" name="custom" value="<? echo $data->id; ?>">
<input type="hidden" name="amount" value="50">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid=<?echo $data->id;?>&pnt=100000&price=50">
<input type="hidden" name="notify_url" value="http://www.likesplanet.com/thankyou.php?uid=<?echo $data->id;?>&pnt=100000&price=50">
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">
<input type="submit" class="submit" style="width: 200px; " name="submit" value="(PayPal / CreditCard)">
</form>';
        }
        
        else if($type == 2) {
            createTransaction($user_id, 225000, 100);
            echo '<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#225,000 Points to <? echo $data->login; ?>">
<input type="hidden" name="item_number" value="225000">
<input type="hidden" name="custom" value="<? echo $data->id; ?>">
<input type="hidden" name="amount" value="100">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid=<?echo $data->id;?>&pnt=0">
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">
<input type="submit" class="submit" style="width: 200px; " name="submit" value="(PayPal / CreditCard)">
</form>';
        }
        else if($type == 3) {
            createTransaction($user_id, 500000, 200);
            echo '<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#500,000 Points to <? echo $data->login; ?>">
<input type="hidden" name="item_number" value="500000">
<input type="hidden" name="custom" value="<? echo $data->id; ?>">
<input type="hidden" name="amount" value="200">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid=<?echo $data->id;?>&pnt=0">
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">
<input type="submit" class="submit" style="width: 200px; " name="submit" value="(PayPal / CreditCard)">
</form>';
        }
        else if($type == 4) {
            createTransaction($user_id, 4000, 4);
            echo '<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#4,000 Points to <? echo $data->login; ?>">
<input type="hidden" name="item_number" value="4000">
<input type="hidden" name="custom" value="<? echo $data->id; ?>">
<input type="hidden" name="amount" value="4">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid=<?echo $data->id;?>&pnt=4000&price=4">
<input type="hidden" name="notify_url" value="http://www.likesplanet.com/thankyou.php?uid=<?echo $data->id;?>&pnt=4000&price=4">
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">
<input type="submit" class="submit" style="width: 200px; " name="submit" value="(PayPal / CreditCard)">
</form>';
            
        }
        else if($type == 5) {
            createTransaction($user_id, 25000, 20);
            echo '<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#25,000 Points to <? echo $data->login; ?>">
<input type="hidden" name="item_number" value="25000">
<input type="hidden" name="custom" value="<? echo $data->id; ?>">
<input type="hidden" name="amount" value="20">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid=<?echo $data->id;?>&pnt=25000&price=20">
<input type="hidden" name="notify_url" value="http://www.likesplanet.com/thankyou.php?uid=<?echo $data->id;?>&pnt=25000&price=20">
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">
<input type="submit" class="submit" style="width: 200px; " name="submit" value="(PayPal / CreditCard)">
</form>';
        }
        else if($type == 6) {
            createTransaction($user_id, 60000, 40);
            echo '<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#60,000 Points to <? echo $data->login; ?>">
<input type="hidden" name="item_number" value="60000">
<input type="hidden" name="custom" value="<? echo $data->id; ?>">
<input type="hidden" name="amount" value="40">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid=<?echo $data->id;?>&pnt=0">
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">
<input type="submit" class="submit" style="width: 200px; " name="submit" value="(PayPal / CreditCard)">
</form>';
        }
        else if($type == 7) {
            createTransaction($user_id, 100000, 60);
            echo '<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#100,000 Points to <? echo $data->login; ?>">
<input type="hidden" name="item_number" value="100000">
<input type="hidden" name="custom" value="<? echo $data->id; ?>">
<input type="hidden" name="amount" value="60">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid=<?echo $data->id;?>&pnt=0">
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">
<input type="submit" class="submit" style="width: 200px; " name="submit" value="(PayPal / CreditCard)">
</form>';
        }
        else if($type == 8) {
            createTransaction($user_id, 140000, 80);
            echo '<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#140,000 Points to <? echo $data->login; ?>">
<input type="hidden" name="item_number" value="140000">
<input type="hidden" name="custom" value="<? echo $data->id; ?>">
<input type="hidden" name="amount" value="80">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou.php?uid=<?echo $data->id;?>&pnt=0">
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">
<input type="submit" class="submit" style="width: 200px; " name="submit" value="(PayPal / CreditCard)">
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
<script>
    $('#formPaypal').submit();
    </script>

