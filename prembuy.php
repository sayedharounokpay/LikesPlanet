<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#<? echo $pack->name;?> to <? echo $data->login; ?>">
<input type="hidden" name="item_number" value="<? echo $pack->name;?>">
<input type="hidden" name="custom" value="<? echo $data->id; ?>">
<input type="hidden" name="amount" value="<? echo $pack->price;?>">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="<?echo $site->site_url;?>/thankyou2.php?uid=<?echo $data->id;?>&pnt=0">
<input type="hidden" name="cancel_return" value="<?echo $site->site_url;?>">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">
<input type="submit" class="submit" style="width: 200px; " name="submit" value="PayPal (Buy Now)">
</form>
 */
include('header.php');


function createTransaction($userid,$pnts,$cash){
    $result = mysql_query("SELECT * FROM users WHERE id={$userid}");
    if($row = mysql_fetch_object($result)) {
        $transrand = rand(1000,1500) * 0.3;
        $transdate = strtotime("now");
        $transactid = $transrand.$transdate.$userid;
        mysql_query("INSERT INTO transactions (date,userid,points,cash,transacid,vip) VALUES (now(),{$userid},{$pnts},{$cash},'{$transactid}',1)");
        return $transactid;
    }
    else {
        return 0;
    
    }
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if($packs = mysql_query("SELECT * FROM p_pack WHERE id={$id}")) {
        if($pack = mysql_fetch_object($packs)){
            $name = $pack->name;
            $transactid=  createTransaction($id, $pack->coins, $pack->price);
            echo $transactid;
        echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="'.$name.' to '.$data->login.'">
<input type="hidden" name="item_number" value="'.$pack->name.'">
<input type="hidden" name="custom" value="'.$data->id.'">
<input type="hidden" name="amount" value="'.$pack->price.'">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.likesplanet.com/thankyou2.php?uid='.$data->id.'&pnt='.$pack->coins.'">
    <input type="hidden" name="notify_url" value="http://www.likesplanet.com/process_payment.php?uid='.$data->id.'&pnt='.$pack->coins.'&transactid='.$transactid.'">
<input type="hidden" name="cancel_return" value="http://www.likesplanet.com/">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">
</form>';
        }
    }
}

?>
Processing... Please wait a moment
<script>
    $('document').ready(function(){
        $('form').submit();
    });
    </script>