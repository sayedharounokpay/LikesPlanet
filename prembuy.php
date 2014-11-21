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
echo 'processing';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if($packs = mysql_query("SELECT * FROM p_pack WHERE id={$id}")) {
        if($pack = mysql_fetch_object($packs)){
            $name = $pack->name;
        echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="'.$name.' to '.$data->login.'">
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
</form>';
        }
    }
}