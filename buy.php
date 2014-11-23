<?php
$page_title = "LikesPlanet.com | Buy Points Cheaply | Get Thouthands of Likes/Followers/Traffic to your business.";
$meta_description = "Buy Facebook Likes Cheaply - Get Free Facebook Photo Likes - YouTube Dislikes - Website Traffic - Twitter Followers - Facebook Followers";
$meta_keywords = "Buy Facebook Likes, Free Facebook Photo Likes, Facebook, Likes, Google, Plus, Votes, followers, YouTube Dislikes, Exchange, Plays, Views, Traffic, Social Media Exchanger";

include('header.php');

$totalmembers1 = mysql_query("SELECT * FROM `login` ");
$onlinetoday = mysql_num_rows($totalmembers1);

foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

$sitestat = mysql_query("SELECT * FROM `stat` WHERE `id` = '15'");
$sitetotalmembers = mysql_fetch_object($sitestat);
$sitestat = mysql_query("SELECT * FROM `stat` WHERE `id` = '18'");
$sitestatmembers = mysql_fetch_object($sitestat);
$sitetotalmembersALL = $sitestatmembers->stat + $sitetotalmembers->stat;
$sitestat = mysql_query("SELECT * FROM `stat` WHERE `id` = '1'");
$likersAllOP = mysql_fetch_object($sitestat);
$likersALL = $likersAllOP->stat;

?>

<script language=javascript>
        var AddHitsMade = 0;
        var AddHitsMade1 = 0;
        var LikersStart = 0;
        var LikersStart1 = 0;
        setTimeout("DisplayHintCounter();", 120);
        function DisplayHintCounter() {
            var randd = Math.floor((Math.random() * 1000) + 1);
            if (randd > 300) {
                AddHitsMade = AddHitsMade + 1;
            }
            if (randd > 995) {
                LikersStart = LikersStart + 1;
            }
            AddHitsMade1 = <? echo $sitetotalmembersALL; ?> + AddHitsMade;
            LikersStart1 = <? echo $likersALL; ?> + LikersStart;
            $("#HintHits").html("<font color='green' size='3'><b><font color='blue'>" + numberWithCommas(AddHitsMade1) + "</font></b> hits/likes delivered by +<b>" + numberWithCommas(LikersStart1) + "</b> members!");
            setTimeout("DisplayHintCounter();", 70);
        }
        function numberWithCommas(x) {
            x = x.toString();
            var pattern = /(-?\d+)(\d{3})/;
            while (pattern.test(x))
                x = x.replace(pattern, "$1,$2");
            return x;
        }
</script>

<h2>Buy points</h2>
<p><b>After payment, points are credited within 24 hours.</b></p>

<center>
</br>

<div id="HintHits">
<font color='green' size='3'><b><font color='blue'><b><? echo number_format($sitetotalmembersALL); ?></font></b> Hits/likes delivered by <b><? echo number_format($likersALL); ?></b> Likers!</font>
</div>
</br></br>
</center>

<? if(!isset($data->login)) {
echo "<center><font color='red' size=4><b> Please LOGIN First Before Buying.</b></font></center></br></br>";
 } ?>

<div id="tbl" style="float: mid; Margin-left:auto; Margin-right:auto;">
<center>

<div class="tbl tbl-package" style="padding: 0px 0px 0px 0px; height: 320px; width: 250px; border-radius: 30px; border-color: #F5B22D; background: #2F8AA7;">
<center><img src="img/ord7.jpg?a" border="0" title="Buy Points from LikesPlanet.com"></center>
<div>&nbsp;</div>
<? if(isset($data->login)) { ?>

<a href="processbuy.php?type=1" class="payment_btn" style="width:200px;">Paypal / Credit Card</a><br>
<form  method="post" action="https://www.okpay.com/process.html">
    <input type="hidden" name="ok_receiver" value="likesplanet.com@gmail.com"/>
    <input type="hidden" name="ok_item_1_name" value="#100,000 Points to <? echo $data->login; ?>">
    <input type="hidden" name="ok_item_1_article" value="100000" />
    <input type="hidden" name="ok_item_1_price" value="50"/>
    <input type="hidden" name="ok_currency" value="USD"/>
    <input type="hidden" name="ok_item_1_custom_1_title" value="userid" />
    <input type="hidden" name="ok_item_1_custom_1_value" value="<? echo $data->id; ?>" />
    <input type="hidden" name="ok_return_success" value="http://www.likesplanet.com/thankyou.php" />
    <input type="hidden" name="ok_return_fail" value="http://www.likesplanet.com/" />
    <input type="hidden" name="ok_ipn" value="http://www.likesplanet.com/thankyou.php" /> 
    <input type="submit" class="submit" style="width: 200px; " name="submit" value="(OKPay)">
</form>
<? } else { ?>
<font color='yellow'>Login to Buy.</font>
<? } ?>
</div>

<div class="tbl tbl-package" style="padding: 0px 0px 0px 0px; height: 320px; width: 250px; border-radius: 30px; border-color: #F5B22D; background: #2F8AA7;">
<center><img src="img/ord8.jpg?a" border="0" title="Buy Points from LikesPlanet.com"></center>
<div>&nbsp;</div>
<? if(isset($data->login)) { ?>

<a href="processbuy.php?type=2" class="payment_btn" style="width: 200px;">Paypal / Credit Card</a><br>
<form  method="post" action="https://www.okpay.com/process.html">
    <input type="hidden" name="ok_receiver" value="likesplanet.com@gmail.com"/>
    <input type="hidden" name="ok_item_1_name" value="#225,000 Points to <? echo $data->login; ?>">
    <input type="hidden" name="ok_item_1_article" value="225000" />
    <input type="hidden" name="ok_item_1_price" value="100"/>
    <input type="hidden" name="ok_currency" value="USD"/>
    <input type="hidden" name="ok_item_1_custom_1_title" value="userid" />
    <input type="hidden" name="ok_item_1_custom_1_value" value="<? echo $data->id; ?>" />
    <input type="hidden" name="ok_return_success" value="http://www.likesplanet.com/thankyou.php" />
    <input type="hidden" name="ok_return_fail" value="http://www.likesplanet.com/" />
    <input type="hidden" name="ok_ipn" value="http://www.likesplanet.com/thankyou.php" /> 
    <input type="submit" class="submit" style="width: 200px; " name="submit" value="(OKPay)">
</form>
<? } else { ?>
<font color='yellow'>Login to Buy.</font>
<? } ?>
</div>

<div class="tbl tbl-package" style="padding: 0px 0px 0px 0px; height: 320px; width: 250px; border-radius: 30px; border-color: #F5B22D; background: #2F8AA7;">
<center><img src="img/ord9.jpg?a" border="0" title="Buy Points from LikesPlanet.com"></center>
<div>&nbsp;</div>
<? if(isset($data->login)) { ?>

<a href="processbuy.php?type=3" class="payment_btn" style="width:200px;">Paypal / Credit Card</a<br>
<form  method="post" action="https://www.okpay.com/process.html">
    <input type="hidden" name="ok_receiver" value="likesplanet.com@gmail.com"/>
    <input type="hidden" name="ok_item_1_name" value="#500,000 Points to <? echo $data->login; ?>">
    <input type="hidden" name="ok_item_1_article" value="500000" />
    <input type="hidden" name="ok_item_1_price" value="200"/>
    <input type="hidden" name="ok_currency" value="USD"/>
    <input type="hidden" name="ok_item_1_custom_1_title" value="userid" />
    <input type="hidden" name="ok_item_1_custom_1_value" value="<? echo $data->id; ?>" />
    <input type="hidden" name="ok_return_success" value="http://www.likesplanet.com/thankyou.php" />
    <input type="hidden" name="ok_return_fail" value="http://www.likesplanet.com/" />
    <input type="hidden" name="ok_ipn" value="http://www.likesplanet.com/thankyou.php" /> 
    <input type="submit" class="submit" style="width: 200px; " name="submit" value="(OKPay)">
</form>
<? } else { ?>
<font color='yellow'>Login to Buy.</font>
<? } ?>
</div>

</br>

<div class="tbl tbl-package" style="padding: 0px 0px 0px 0px; height: 320px; width: 250px; border-radius: 30px; border-color: #F5B22D; background: #2F8AA7;">
<center><img src="img/ord1.jpg?a" border="0" title="Buy Points from LikesPlanet.com"></center>
<div>&nbsp;</div>
<? if(isset($data->login)) { ?>

<a href="processbuy.php?type=4" class="payment_btn" style="width: 200px;">Paypal / Credit Card</a><br>
<form  method="post" action="https://www.okpay.com/process.html">
    <input type="hidden" name="ok_receiver" value="likesplanet.com@gmail.com"/>
    <input type="hidden" name="ok_item_1_name" value="#4,000 Points to <? echo $data->login; ?>">
    <input type="hidden" name="ok_item_1_article" value="4000" />
    <input type="hidden" name="ok_item_1_price" value="4"/>
    <input type="hidden" name="ok_currency" value="USD"/>
    <input type="hidden" name="ok_item_1_custom_1_title" value="userid" />
    <input type="hidden" name="ok_item_1_custom_1_value" value="<? echo $data->id; ?>" />
    <input type="hidden" name="ok_return_success" value="http://www.likesplanet.com/thankyou.php" />
    <input type="hidden" name="ok_return_fail" value="http://www.likesplanet.com/" />
    <input type="hidden" name="ok_ipn" value="http://www.likesplanet.com/thankyou.php" /> 
    <input type="submit" class="submit" style="width: 200px; " name="submit" value="(OKPay)">
</form>
<? } else { ?>
<font color='yellow'>Login to Buy.</font>
<? } ?>
</div>


<div class="tbl tbl-package" style="padding: 0px 0px 0px 0px; height: 320px; width: 250px; border-radius: 30px; border-color: #F5B22D; background: #2F8AA7;">
<center><img src="img/ord2.jpg?a" border="0" title="Buy Points from LikesPlanet.com"></center>
<div>&nbsp;</div>
<? if(isset($data->login)) { ?>

<a href="processbuy.php?type=10" class="payment_btn" style="width:200px;">Paypal / Credit Card</a><br>
<form  method="post" action="https://www.okpay.com/process.html">
    <input type="hidden" name="ok_receiver" value="likesplanet.com@gmail.com"/>
    <input type="hidden" name="ok_item_1_name" value="#9,000 Points to <? echo $data->login; ?>">
    <input type="hidden" name="ok_item_1_article" value="9000" />
    <input type="hidden" name="ok_item_1_price" value="8"/>
    <input type="hidden" name="ok_currency" value="USD"/>
    <input type="hidden" name="ok_item_1_custom_1_title" value="userid" />
    <input type="hidden" name="ok_item_1_custom_1_value" value="<? echo $data->id; ?>" />
    <input type="hidden" name="ok_return_success" value="http://www.likesplanet.com/thankyou.php" />
    <input type="hidden" name="ok_return_fail" value="http://www.likesplanet.com/" />
    <input type="hidden" name="ok_ipn" value="http://www.likesplanet.com/thankyou.php" /> 
    <input type="submit" class="submit" style="width: 200px; " name="submit" value="(OKPay)">
</form>
<? } else { ?>
<font color='yellow'>Login to Buy.</font>
<? } ?>
</div>


<div class="tbl tbl-package" style="padding: 0px 0px 0px 0px; height: 320px; width: 250px; border-radius: 30px; border-color: #F5B22D; background: #2F8AA7;">
<center><img src="img/ord3.jpg?a" border="0" title="Buy Points from LikesPlanet.com"></center>
<div>&nbsp;</div>
<? if(isset($data->login)) { ?>

<a href="processbuy.php?type=5" class="payment_btn" style="width: 200px;">Paypal / Credit Card</a><br>
<form  method="post" action="https://www.okpay.com/process.html">
    <input type="hidden" name="ok_receiver" value="likesplanet.com@gmail.com"/>
    <input type="hidden" name="ok_item_1_name" value="#25,000 Points to <? echo $data->login; ?>">
    <input type="hidden" name="ok_item_1_article" value="25000" />
    <input type="hidden" name="ok_item_1_price" value="20"/>
    <input type="hidden" name="ok_currency" value="USD"/>
    <input type="hidden" name="ok_item_1_custom_1_title" value="userid" />
    <input type="hidden" name="ok_item_1_custom_1_value" value="<? echo $data->id; ?>" />
    <input type="hidden" name="ok_return_success" value="http://www.likesplanet.com/thankyou.php" />
    <input type="hidden" name="ok_return_fail" value="http://www.likesplanet.com/" />
    <input type="hidden" name="ok_ipn" value="http://www.likesplanet.com/thankyou.php" /> 
    <input type="submit" class="submit" style="width: 200px; " name="submit" value="(OKPay)">
</form>
<? } else { ?>
<font color='yellow'>Login to Buy.</font>
<? } ?>
</div>

</br></br>


<div class="tbl tbl-package" style="padding: 0px 0px 0px 0px; height: 320px; width: 250px; border-radius: 30px; border-color: #F5B22D; background: #2F8AA7;">
<center><img src="img/ord4.jpg?a" border="0" title="Buy Points from LikesPlanet.com"></center>
<div>&nbsp;</div>
<? if(isset($data->login)) { ?>

<a href="processbuy.php?type=6" class="payment_btn" style="width:200px;">Paypal / Credit Card</a><br>
<form  method="post" action="https://www.okpay.com/process.html">
    <input type="hidden" name="ok_receiver" value="likesplanet.com@gmail.com"/>
    <input type="hidden" name="ok_item_1_name" value="#60,000 Points to <? echo $data->login; ?>">
    <input type="hidden" name="ok_item_1_article" value="60000" />
    <input type="hidden" name="ok_item_1_price" value="40"/>
    <input type="hidden" name="ok_currency" value="USD"/>
    <input type="hidden" name="ok_item_1_custom_1_title" value="userid" />
    <input type="hidden" name="ok_item_1_custom_1_value" value="<? echo $data->id; ?>" />
    <input type="hidden" name="ok_return_success" value="http://www.likesplanet.com/thankyou.php" />
    <input type="hidden" name="ok_return_fail" value="http://www.likesplanet.com/" />
    <input type="hidden" name="ok_ipn" value="http://www.likesplanet.com/thankyou.php" /> 
    <input type="submit" class="submit" style="width: 200px; " name="submit" value="(OKPay)">
</form>
<? } else { ?>
<font color='yellow'>Login to Buy.</font>
<? } ?>
</div>


<div class="tbl tbl-package" style="padding: 0px 0px 0px 0px; height: 320px; width: 250px; border-radius: 30px; border-color: #F5B22D; background: #2F8AA7;">
<center><img src="img/ord5.jpg?a" border="0" title="Buy Points from LikesPlanet.com"></center>
<div>&nbsp;</div>
<? if(isset($data->login)) { ?>
<a href="processbuy.php?type=7" class="payment_btn" style="width:200px;">Paypal / Credit Card</a><br>
<form  method="post" action="https://www.okpay.com/process.html">
    <input type="hidden" name="ok_receiver" value="likesplanet.com@gmail.com"/>
    <input type="hidden" name="ok_item_1_name" value="#100,000 Points to <? echo $data->login; ?>">
    <input type="hidden" name="ok_item_1_article" value="100000" />
    <input type="hidden" name="ok_item_1_price" value="60"/>
    <input type="hidden" name="ok_currency" value="USD"/>
    <input type="hidden" name="ok_item_1_custom_1_title" value="userid" />
    <input type="hidden" name="ok_item_1_custom_1_value" value="<? echo $data->id; ?>" />
    <input type="hidden" name="ok_return_success" value="http://www.likesplanet.com/thankyou.php" />
    <input type="hidden" name="ok_return_fail" value="http://www.likesplanet.com/" />
    <input type="hidden" name="ok_ipn" value="http://www.likesplanet.com/thankyou.php" /> 
    <input type="submit" class="submit" style="width: 200px; " name="submit" value="(OKPay)">
</form>
<? } else { ?>
<font color='yellow'>Login to Buy.</font>
<? } ?>
</div>


<div class="tbl tbl-package" style="padding: 0px 0px 0px 0px; height: 320px; width: 250px; border-radius: 30px; border-color: #F5B22D; background: #2F8AA7;">
<center><img src="img/ord6.jpg?a" border="0" title="Buy Points from LikesPlanet.com"></center>
<div>&nbsp;</div>
<? if(isset($data->login)) { ?>

<a href="processbuy.php?type=8" class="payment_btn" style="width: 200px;">Paypal / Credit Card</a><br>
<form  method="post" action="https://www.okpay.com/process.html">
    <input type="hidden" name="ok_receiver" value="likesplanet.com@gmail.com"/>
    <input type="hidden" name="ok_item_1_name" value="#140,000 Points to <? echo $data->login; ?>">
    <input type="hidden" name="ok_item_1_article" value="140000" />
    <input type="hidden" name="ok_item_1_price" value="80"/>
    <input type="hidden" name="ok_currency" value="USD"/>
    <input type="hidden" name="ok_item_1_custom_1_title" value="userid" />
    <input type="hidden" name="ok_item_1_custom_1_value" value="<? echo $data->id; ?>" />
    <input type="hidden" name="ok_return_success" value="http://www.likesplanet.com/thankyou.php" />
    <input type="hidden" name="ok_return_fail" value="http://www.likesplanet.com/" />
    <input type="hidden" name="ok_ipn" value="http://www.likesplanet.com/thankyou.php" /> 
    <input type="submit" class="submit" style="width: 200px; " name="submit" value="(OKPay)">
</form>
<? } else { ?>
<font color='yellow'>Login to Buy.</font>
<? } ?>
</div>

</br>






</center>



<div class="clearer">&nbsp;</div>



<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>
<p> <font color="darkgreen"><b>Do not have PayPal account?</b></b>  No problem, We also accept Payza and OkPay. <a href="contact.php" target="_blank">Contact us for details!</a></font></p> 
<div class="clearer">&nbsp;</div>
<p> <font><b> Last 25 Users Bought on LikesPlanet :</b></b></font></p> 
<table class="datatable sortable selectable full">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>Username</b>			
			</th>		
            <th>			
			<b>Country</b>			
			</th>
	    <th>			
			<b>Type</b>			
			</th>
            <th>			
			<b>Payment</b>			
			</th>
	    <th>			
			<b>Date</b>			
			</th>					
		</tr>
        </thead>	
<?
  $site2 = mysql_query("SELECT * FROM `fakeorders` ORDER BY `id` DESC LIMIT 0, 25");
  for($j=1; $userp = mysql_fetch_object($site2); $j++)
{

$x11102oo = explode('(', $userp->country);
$x111022oo = explode(')', $x11102oo[1]);
if ($x111022oo[0] == 'DE' ) $x111022oo[0] = 'GM';
if ($x111022oo[0] == 'TR' ) $x111022oo[0] = 'TU';
if ($x111022oo[0] == 'PH' ) $x111022oo[0] = 'RP';
if ($x111022oo[0] == 'DZ' ) $x111022oo[0] = 'AG';
if ($x111022oo[0] == 'BW' ) $x111022oo[0] = 'BC';
if ($x111022oo[0] == 'PT' ) $x111022oo[0] = 'PO';
if ($x111022oo[0] == 'VN' ) $x111022oo[0] = 'VM';
if ($x111022oo[0] == 'RU' ) $x111022oo[0] = 'RS';
if ($x111022oo[0] == 'OM' ) $x111022oo[0] = 'MU';
if ($x111022oo[0] == 'GB' ) $x111022oo[0] = 'UK';
if ($x111022oo[0] == 'GE' ) $x111022oo[0] = 'GG';
if ($x111022oo[0] == 'LB' ) $x111022oo[0] = 'LE';
if ($x111022oo[0] == 'AZ' ) $x111022oo[0] = 'AJ';
if ($x111022oo[0] == 'LV' ) $x111022oo[0] = 'LG';
if ($x111022oo[0] == 'UA' ) $x111022oo[0] = 'UP';
if ($x111022oo[0] == 'LK' ) $x111022oo[0] = 'CO';
if ($x111022oo[0] == 'SD' ) $x111022oo[0] = 'SU';
if ($x111022oo[0] == 'BD' ) $x111022oo[0] = 'BG';

if ($userp->points == 0) { $typeoff = 'VIP Membership'; } else { $typeoff = 'Points Package'; };

?>

<tbody>
			<tr>
				<td>							
                		<?echo$j;?>							
				</td>				
				<td>												
				<b><font color='blue'><? echo $userp->login;?></font></b>
				</td>	
				<td>	
				<img src="https://www.cia.gov/library/publications/the-world-factbook/graphics/flags/large/<? echo Strtolower($x111022oo[0]); ?>-lgflag.gif" border="0" title="User Country : <? echo $userp->country; ?>" height="16" width="24" >											
				<? echo $userp->country;?>
				</td>
				<td>												
				<? echo $typeoff;?>
				</td>
				<td>												
				<center><font color='green'>$<? echo $userp->money;?>.0</font></center>
				</td>	
				<td>												
				<? echo $userp->date;?>
				</td>	
			</tr>
</tbody><?}?>
</table>	

</div>










<div>&nbsp;</div>

</center>
<script type='text/javascript'>(function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://widget.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({ c: '2cd2d3db-7c56-4318-b5e1-3147712777bd', f: true }); done = true; } }; })();</script>



<?include('footer.php');?>