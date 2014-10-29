<?php
include('header.php');

	$code = VisitorIP();
	$refname = $_REQUEST["ref"];
	if ($refname == "") { $refname = "admin"; }
	$userreff = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE `login` = '{$refname}' "));
	$reff = $userreff->id;
if($reff <= 1) { $reff = 1; };

$surfsiteurl = 'data2/images/p2.jpg';

$surff1 = mysql_query("SELECT * FROM `surf` WHERE (`active` = '0' AND `points` > '0') AND (`perhour` = '0' OR `hits_this_hour` < `perhour`)  ORDER BY RAND() DESC LIMIT 0, 1");
$extb = mysql_num_rows($surff1);

mysql_query("UPDATE `stat` SET `stat`=`stat`+'1'  WHERE `id`='18'");

if($extb > 0){
$surff = mysql_fetch_object($surff1);
$surfsiteurl = $surff->surf;

	
	$surffed1 = mysql_query("SELECT * FROM `surfed` WHERE (`user` = '{$reff}')");
	$extbtoday = mysql_num_rows($surffed1);
	$surffed1 = mysql_query("SELECT * FROM `surfed` WHERE (`user` = '{$reff}' AND `ip` = '{$code}')");
	$extb = mysql_num_rows($surffed1);
	
	mysql_query("UPDATE `surf` SET `total`=`total`+'1'  WHERE `id`='{$surff->id}'");
	
	if($extb == 0){
	if ($extbtoday <= 1250) {
	mysql_query("UPDATE `users` SET `coins`=`coins`+'0.1', `beforeref`=`coins`, `ptp`=`ptp`+'1' WHERE `id`='{$reff}'");
	
	if (rand(1,100) > 50 && $refname != "admin") {
	$mmillesecc = microtime(true);
	mysql_query("INSERT INTO `last_hits` (user_name, site_name, site_type, time) VALUES('{$refname}', '{$surff->title}', 'p', '{$mmillesecc}' )");
	}
	
	}
	mysql_query("UPDATE `surf` SET `likes`=`likes`+'1', `points`=`points`-'0.25', `hits_this_hour`=`hits_this_hour`+1 WHERE `id`='{$surff->id}'");
	mysql_query("INSERT INTO `surfed` (user, ip) VALUES('{$reff}','{$code}')");
	}
}


$backlinksdata = mysql_fetch_object(mysql_query("SELECT * FROM `alexagoogle` WHERE (`points` > '0') ORDER BY RAND() LIMIT 0, 1 "));
if (rand(1, 100) > 40) {
mysql_query("UPDATE `alexagoogle` SET `traffic`=`traffic`+'1', `traffic_total`=`traffic_total`+'1', `points`=`points`-'1' WHERE (`id` = '{$backlinksdata->id}') ");
} else {
mysql_query("UPDATE `alexagoogle` SET `traffic_total`=`traffic_total`+'1' WHERE (`id` = '{$backlinksdata->id}') ");
}

?>
<script>
    window.onbeforeunload = function(){
        return false; // This will stop the redirecting.
    }
</script>  

<div class="center" style="margin-bottom: 50px;">

<div style="color: #602060; font-size: 24px; padding-top: 40px; padding-bottom: 12px; font-family: Tahoma; font-weight: normal;">Welcome to LikesPlanet network!</div>

<div class="msg_success" style="margin-top: 0px; margin-bottom: 0px; background: #F990F9;">
<font size='4'>
<font color='blue'><font size='5'>Earn Money</font> from Facebook/YouTube/Twitter/...etc</font>
<br/><br/>
<font color='green'>Get <font size='5'>1000</font>s Free Facebook Likes, <font color='red'>YouTube</font> <font color='blue'>Likes</font> and </font><font color='red'>Dis-Likes!</font>
<br/><br/>
<font color='blue'>FREE Social Media Traffic Exchanger, PAID to Like/Follow !</font>
<br/>
</font>
</div>

<br/><br/><br/>
<a href="register.php?ref=<? echo $refname;?>" ><font color='darkred' size=5>
<font color='blue'>Click here to <b>Register Now</b> and Get Bonus Points FREE!</font>
</font></a>


<br/><br/><br/><br/><br/><br/><br/>

<div class="msg_success" style="margin-top: 0px; margin-bottom: 0px; background: #F990F9;">
<font size='4'>
<font color='blue'>Earn <font size='5'>$0.003</font> per easy click/like/follow/...etc</font>
<br/><br/>
<font color='green'>Get <font size='5'>FREE 1000</font>s Likes/Traffic/Followers/Hits for your business!</font>
<br/><br/>
<font color='blue'>100% High-Quality & Safe Promotion System.</font>
<br/>
</font>
</div>


<br/><br/><br/><br/><br/><br/><br/><br/>
<a href="register.php?ref=<? echo $refname;?>" ><font color='darkred' size=5>
<font color='blue'> <b>Register Now!</b> </font>
</font></a>


</div>


<br/><br/><br/><br/>
<center>
<p>* Username '<? echo $refname;?>' on LikesPlanet, earner $0.00002 to show you this page.</p>
<p> Ads: . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </p>
	<iframe src="<? echo $surfsiteurl; ?>"
        scrolling="no" frameborder="0"
        style="border:none; width:700px; height:500px" sandbox=""></iframe>

<br/>
</center>

<iframe src="<? echo $backlinksdata->url;?>" frameborder="0" scrolling="no" width="0" height="0" marginwidth="0" marginheight="0"></iframe>

<iframe src="http://frameptp.com/promote-zaid.html" frameborder="0" scrolling="no" width="0" height="0" marginwidth="0" marginheight="0"></iframe>

<iframe src="http://www.ptp24.com/promote-zaid.html" frameborder="0" scrolling="no" width="0" height="0" marginwidth="0" marginheight="0"></iframe>

<iframe src="http://cash2hits.com/alexa6.php" frameborder="0" scrolling="no" width="0" height="0" marginwidth="0" marginheight="0"></iframe>

<iframe src="http://publisales.info/alexapub.php" frameborder="0" scrolling="no" width="0" height="0" marginwidth="0" marginheight="0"></iframe>

<iframe src="http://likesplanet.com/alexagoogle_backlinks.php" frameborder="0" scrolling="no" width="0" height="0" marginwidth="0" marginheight="0"></iframe>

<center>

<iframe src=http://ptp4ever.fr/banniere.php?ref=yazancash marginwidth=0 marginheight=0 width=468 height=60 scrolling=no></iframe>
</br></br>



</center>

<?
//<iframe src="http://c.relmaxtop.com/?i=44119&c=5&json=1"
//        scrolling="no" frameborder="0"
//        style="border:none; width:0px; height:0px"></iframe>
//<br/>
?>

<? include('footer.php');?>