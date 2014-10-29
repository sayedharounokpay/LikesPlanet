<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

$humanid = $get["humanid"];
$oid = $get["oid"];

?>
<div style="padding:10px;">
<h1>Rent People : Step 2 of 2 : Pay and Wait for Recording your video.</h1>
<br/><br/>
<font color='blue' size='3'>
<ul>
<li>Now pay via PayPal, and Wait to record your video! it may take 10 days to record and deliver.</li>
<br/><br/>
<br/>
</ul>

<center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="RentPeople: <? echo $humanid;?>">
<input type="hidden" name="item_number" value="<? echo $oid;?>">
<input type="hidden" name="custom" value="">
<input type="hidden" name="amount" value="20">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="<?echo $site->site_url;?>/thankyou5.php">
<input type="hidden" name="cancel_return" value="<?echo $site->site_url;?>">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">
<input type="submit" class="submit" style="width: 200px; background: #0000FF; border-radius: 10px;" name="submit" value="Pay via PayPal">
</form>
</center>


</div>
<? include('footer.php');?>