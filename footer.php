<?php
if( ! defined('IS_HOME')) echo '</div></div> <!-- CONTAINER END -->';
?>

<div class="container" style="margin-bottom: 20px;">
<table cellpadding="0" cellspacing="0" border="0" style="margin-top: 2px; padding: 0px;">
<center></br>
<script type="text/javascript" src="http://adhitzads.com/734447"></script>&nbsp;&nbsp;&nbsp;<script type="text/javascript" src="http://adhitzads.com/734454"></script>
</center>
<tr>
<td width="440">
<div><center>
<font size='2'><a STYLE="text-decoration:none"  href="adsadd.php" style="color:#6BAE33;"> Members Ads : (advertise here)</a></font> </center>
</div>
<div>&nbsp;</div>
<div>
<font color='blue' size=2><b>
<?
$ads2 = mysql_query("SELECT * FROM `ads` WHERE (`active` = '0' AND `points` > '0' AND `user_id`!='{$data->id}')  ORDER BY RAND() LIMIT 0, 1");
$ext = mysql_num_rows($ads2);
if($ext > 0){
for($j=1; $ads = mysql_fetch_object($ads2); $j++)
{
mysql_query("UPDATE `ads` SET `views`=`views`+'1', `points`=`points`-'1' WHERE `id`='{$ads->id}'");
?><center>
<a href="<? echo $ads->url;?>" target="_blank" style="color:green;"> <? echo $ads->title;?> </a></center>
<?}
}
else{
?>
<center><a href="adsadd.php" style="color:#88D34A;"> You can Advertise here... </a></center>
<?}?>
</b></font>
</div>
</td>
<td width="20"></td>

<td width="470">
<? $banodgoogle = rand(1,100);
$banodgoogle = 1;
if ($banodgoogle < 40) {
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`active` = '0' AND (`points` > '0' OR `clx` > '0' OR `days` > '0'))  ORDER BY RAND() LIMIT 0, 1");
$extb = mysql_num_rows($ads2b);
if($extb > 0){
for($j=1; $adsb = mysql_fetch_object($ads2b); $j++)
{
mysql_query("UPDATE `adsb` SET `views`=`views`+'1', `points`=`points`-'1' WHERE `id`='{$adsb->id}'");
?>

<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" alt="Members Ads" title="<? echo $adsb->title;?>" height="60px" width="468px" style="border-radius: 12px;">
</a>

<?}
}else{
?>
<a href="adsbadd.php" target="_blank">
<img src="img/banner1.jpg?a" border="0" title="LikesPlanet.com" style="border-radius: 12px;">
</a>
<?} } 

if ($banodgoogle >= 40 AND $banodgoogle <= 90) { ?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 468x60likesplanet -->
<ins class="adsbygoogle"
     style="display:inline-block;width:468px;height:60px"
     data-ad-client="ca-pub-4343540207347895"
     data-ad-slot="4325433157"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

<? } if ($banodgoogle > 90) { ?>
<iframe src="http://www.cash2hits.com/pub/pbnr1.php?ref=karamkhoury" marginwidth="0" marginheight="0" width="468" height="60" scrolling="no" border="0" frameborder="0"></iframe>
<? } ?>
</td>
</tr>

</table>
</div>



<div class="accountfooterTopContainer">
		<div class="accountfooterTopInner">
			<div class="accountfooter-link">
				<ul>
					<li><a href="contact.php?ref=<? echo rand(1,100);?>">Contact us</a></li>
					<li><a href="payproof.php?ref=<? echo rand(1,100);?>">Payment Proofs</a></li>
					<li><a href="chat.php?ref=<? echo rand(1,100);?>">Chat</a></li>
					<li><a href="fan_sign_generator.php?ref=<? echo rand(1,100);?>">Fan Signs</a></li>
				</ul>
			</div>
			<div class="accountfooterPayment">
				<div class="accountfooternav">
					
					<table>
					<tr>
						<td> <a href="http://www.alexa.com/siteinfo/likesplanet.com"><script type='text/javascript' src='http://xslt.alexa.com/site_stats/js/t/a?url=likesplanet.com'></script></a></td>
						<td>
							<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
							<g:plusone href="http://likesplanet.com/" size="large"></g:plusone></td>
						<td><a id="facebook" href="http://facebook.com/likesplanet"></a></td>
					</tr>
					
					</table>
					
					
					
				</div>
			</div>
		</div>
    </div> <!-- end accountfooterTopContainer -->
	
    <div class="accountfooterCopyrightContainer">
		<div class="accountfooterCopyrightInner">
			<p>likesplanet.com 2013 - 2014 All rights reserved. 
			</a></p>
		</div>
    </div> <!-- end accountfooterCopyrightContainer -->
    
    
    		<? if(1 > 2) { ?>
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- 728 -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:728px;height:90px"
		     data-ad-client="ca-pub-4343540207347895"
		     data-ad-slot="2918745152"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	<? } ?>
	
	<script type="text/javascript">
function OpenPage(mysite){
	document.location.href=mysite;
	}
	
</script>

    
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54300785-1', 'auto');
  ga('send', 'pageview');

</script>


<div id="tractor">
	<script type="text/javascript" src="http://xslt.alexa.com/site_stats/js/s/c?url=www.likesplanet.com"></script>
</div>

<script>$("#tractor").hide();</script>



</body>
</html>
