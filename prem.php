<?php
$page_title = "Become VIP Membership - LikesPlanet.com";
$meta_description = "Become VIP Membership - LikesPlanet.com";
$meta_keywords = "Facebook, Followers, Photo, Likes, Fans, Social Media Exchanger, LikesPlanet.com";

include('header.php');

$totalmembers1 = mysql_query("SELECT * FROM `users` WHERE `pr`!='0' ");
$premmembers = mysql_num_rows($totalmembers1);

?>
<h2>Become Premium</h2>
<p> Premium is a special account subscription. When your account is Premium you can set CPC (Points Per Like/Follow/..) above everyone's content who isn't Premium. To get likes/followers/views/ect.. <b>faster</b> make sure your using the highest CPC. Premium account let you to set Higher CPC for all systems.</p>
<p> When your account is Premium, you can advertise in Banners or Text-Ads for <b>X2 Cheaper!</b> than standard account.</p>
<p> When your account is Premium, you can set Higher CPC to get Likes/Fans <b>FASTER</b>.</p>

<div class="clearer">&nbsp;</div>
<p><font color='blue'><b>Premium Members on LikesPlanet</b> : </font><font color='darkgreen'><b> <? echo number_format($premmembers + 12); ?> </b></font></p>
<div class="clearer">&nbsp;</div>
<? if(!isset($data->login)) {
echo "<center><font color='red' size=5><b> Please LOGIN First!</b></font></center>";
 } ?>
 
<div id="tbl" style="float: mid; Margin-left:auto; Margin-right:auto;">
<?
  $pack2 = mysql_query("SELECT * FROM `p_pack` ORDER BY `id` ASC");
  for($j=1; $pack = mysql_fetch_object($pack2); $j++)
{
?>



<div class="tbl tbl-package" style="padding: 0px 0px 0px 0px; height: 250px; width: 250px; border-radius: 25px; border-color: #E6A21B; background: #2F8AA8;">
<center><img src="img/BBBp<? echo $j; ?>.png" border="0" title="Become VIP on LikesPlanet.com"></center>
<div class="clearer">&nbsp;</div>
<? if(isset($data->login)) { ?>
<a href="prembuy.php?id=<?=$pack->id;?>" class="submit" style="width: 200px; ">Purchase with Paypal</a>
<? } else { ?>
<font color='red'>Login to Buy.</font>
<? } ?>
</div>


<?}?>

<div class="clearer">&nbsp;</div></br>
</br>
<h2>For OKPay, Payza or Any question : info@likesplanet.com</h2>

	<div class="clearer">&nbsp;</div>
</div>
<script type='text/javascript'>(function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://widget.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({ c: '2cd2d3db-7c56-4318-b5e1-3147712777bd', f: true }); done = true; } }; })();</script>



<?include('footer.php');?>
