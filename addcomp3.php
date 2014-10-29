<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

if ($_POST["title1"] != "") {
$siteurl = $_POST["title1"];
$type1 = $_POST["title2"];
$price1 = $_POST["title3"];

mysql_query("INSERT INTO `aaafans` (type, url, date) VALUES('{$type1}', '{$siteurl}', NOW() ) ");

?>
<div style="padding:10px;">
<h1>Buy Fans/Followers Cheaply: Step 2 of 2 : Purchase.</h1>
<br/><br/>
<font color='blue' size='3'>
<ul>
<li>Now pay via PayPal, and Wait to get votes/likes/fans!</li>
<br/><br/>
<br/>
</ul>

<center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="likesplanet.com@gmail.com">
<input type="hidden" name="lc" value="RO">
<input type="hidden" name="item_name" value="#BuyFans : <? echo $type1;?>">
<input type="hidden" name="item_number" value="<? echo $siteurl;?>">
<input type="hidden" name="custom" value="">
<input type="hidden" name="amount" value="<? echo $price1;?>">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="<?echo $site->site_url;?>/thankyou4.php">
<input type="hidden" name="cancel_return" value="<?echo $site->site_url;?>">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHosted">
<input type="submit" class="submit" style="width: 200px; background: #0000FF; border-radius: 10px;" name="submit" value="Pay via PayPal">
</form>
</center>


<?
}