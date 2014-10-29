<?php
include('config.php');
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
	$rndnow = rand(0,100);
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

<head>
<title>Free Facebook Likes - LikesPlanet.com</title>
<style>
input:hover[type="submit"] {
background: #FF9900;
box-shadow:inset 0px 0px 3px 4px rgba(0,0,0,0.4);
color: #602060;
}
input {
transition: 0.2s all ease;
}
h1
{
	font-family: "lucida grande", tahoma, verdana, arial, sans-serif;
	font-size:14px;
	color:#0065CE;
	font-weight:regular;
}
#footer {
	background: #3b5998;
	color: #fff;
	font: 11px/14px Lucida Grande, Lucida, Verdana, sans-serif;
	padding: 5px 20px;
	}
#header {
	background: #3b5998;
	border-bottom: 2px solid #333;
	height: 80px;
	position: relative;
	}
	#header h1 {
		position: absolute;
		left: 28px;
		margin: 0;
		top: 18px;
		}
	#header h1 a {
		background: url('../img/logo.png');
		display: block;
		font-size: 0;
		height: 50px;
		line-height: 0;
		text-indent: -800px;
		overflow: hidden;
		width: 195px;
		}
#login {
	color: #fff;
	font: 13px/16px Tahoma, Arial, Helvetica, sans-serif;
	position: absolute;
	right: 28px;
	text-align: right;
	top: 36px;
	}
	#login ul, #login ul li {
		display: block;
		list-style: none;
		margin: 0;
		padding: 0;
		}
	#login ul {
		float: right;
		}
#body {
	border: 2px solid #3b5998;
	border-style: none solid;
	-moz-border-radius-bottomright: 3px;
    border-bottom-right-radius: 3px;
	-moz-border-radius-bottomleft: 3px;
    border-bottom-left-radius: 3px;
	margin: 0 auto;
	width: 780px;
	}
input.submit {
		background: #904090;
		border: 1px solid #333;
		border-radius: 10px;
		border-width: 3px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 100px;
		height: 28px;
		}
</style>

<meta name="description" content="Free Facebook Likes - Get Free Facebook Photo Likes - Free YouTube Likes - Free YouTube Dislikes - LikesPlanet.com" /> 
<meta name="keywords" content="Free Facebook Likes, Facebook, Likes, LikesPlanet.com, LikesPlanet, Google Plus, Votes, facebook fans, Free YouTube Dislikes Exchanger, Dislikes, Views, contests, Social Media Exchanger, Get Likes" />
<script type="text/javascript" src="js/jquery.js"></script>

</head>
<body style="background: #C999C9; border-width: 15px; border-color: #904090; border-radius: 15px;">
<font color=#C999C9 size='1'> Free Facebook Likes, YouTube Dislikes, Alexa Boostup. </font>


<center>
<table cellpadding="0" cellspacing="0" border="0" style="margin-top: 0px; padding: 0px;">
<tr>
<td>

<div id="body" style="width: 904px; background: #FFFFFF; background2: #eeeeee; border-width: 15px; border-color: #904090; border-radius: 15px;">
	<div id="header" style="height:195px; background: #FFFFFF; border-width: 0px; ">
			<? if ($rndnow < 20) { ?>
			<h1 style="top: 0px; left: 0px;"><a href="index.php" style="background: url('img/planet_logo1.jpg?k'); width: 904px; height:195;">LikesPlanet.com</a></h1>
			<? } ?>
			<? if ($rndnow > 19 && $rndnow < 40) { ?>
			<h1 style="top: 0px; left: 0px;"><a href="index.php" style="background: url('img/planet_logo2.jpg?k'); width: 904px; height:195;">LikesPlanet.com</a></h1>
			<? } ?>
			<? if ($rndnow > 39 && $rndnow < 60) { ?>
			<h1 style="top: 0px; left: 0px;"><a href="index.php" style="background: url('img/planet_logo3.jpg?k'); width: 904px; height:195;">LikesPlanet.com</a></h1>
			<? } ?>
			<? if ($rndnow > 59 && $rndnow < 80) { ?>
			<h1 style="top: 0px; left: 0px;"><a href="index.php" style="background: url('img/planet_logo4.jpg?k'); width: 904px; height:195;">LikesPlanet.com</a></h1>
			<? } ?>
			<? if ($rndnow > 79) { ?>
			<h1 style="top: 0px; left: 0px;"><a href="index.php" style="background: url('img/planet_logob5.jpg?k'); width: 904px; height:195;">LikesPlanet.com</a></h1>
			<? } ?>
	<div id="login">
		<h1 style="top: 0px; left: -115px;"> <input type="submit" class="submit" value="Login" onclick="document.location.href='login.php?rnd=<? echo rand(1,100); ?>';" /> </h1>
		<h1 style="top: 40px; left: -115px;"> <input type="submit" class="submit" value="Register" onclick="document.location.href='register.php?ref=<? echo $refname;?>';" /> </h1>
		<h1 style="top: 90px; left: -125px;"> <input type="submit" class="submit" style="width: 120px;" value="How It Works" onclick="document.location.href='help.php';" /> </h1>
		</br>
		</br>
	</div>
	
</div>


<img src="img/planet_line.png" border="0" height="9px" width="904px">
</br>

<center>
<h1><font size='4'>What is LikesPlanet.com?</font></h1>
<p><b><font color='#904090' size='5'>LikesPlanet</font> is your way to <font color='green' size='5'>Advertise your social pages</font> or <font color='blue' size='6'>Earn Money</font> by doing Likes/Hits!</b></p>

<div class="msg_success" style="margin: 10px 30px 10px 30px; background: #F990F9; border-radius: 45px;">
<br/>
<font size='5'><b>
<font color='blue'><font size='6'>Earn Money</font> from Facebook/YouTube/Twitter/...etc</font>
<br/><br/>
<font color='green'>Get <font size='5'>1000</font>s Free Facebook Likes, <font color='red'>YouTube</font> <font color='blue'>Likes</font> and </font><font color='red'>Dis-Likes!</font>
<br/><br/>
<font color='blue' size='6'>FREE Social Media Traffic Exchanger.</font>
<br/></b>
</font>
<br/>
</div>

<br/>
<a href="register.php?ref=<? echo $refname;?>" ><font color='darkred' size=5>
<font color='blue'>Click here to <b>Register Now</b> and Get Bonus Points FREE!</font>
</font></a>

<br/><br/><br/>

<a href="register.php?ref=<? echo $refname;?>" >
<div id="slideshowme" style="width: 902px; height: 423px; background: url('img/index_v2_1.jpg'); transition: 0.5s all ease; opacity: 1;">
</div>
</a>

<br/><br/><br/>

<div class="msg_success" style="margin: 10px 30px 10px 30px; background: #F990F9; border-radius: 45px;">
<br/>
<font size='5'><b>
<font color='blue'>Earn <font size='6'>$0.003</font> per easy click/like/follow/...etc</font>
<br/><br/>
<font color='green'>Get <font size='6'>FREE 1000</font>s Likes/Traffic/Followers/Hits for your business!</font>
<br/><br/>
<font color='blue'>100% High-Quality & Safe Promotion System.</font>
<br/></b>
</font>
<br/>
</div>

<br/><br/>

<a href="register.php?ref=<? echo $refname;?>" ><font color='darkred' size=8>
<font color='red'> <b>Join LikesPlanet Now!</b> </font>
</font></a>

</br></br></br></br><br/>

</center>
<p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Ads: . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </p>
<p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; * Username '<? echo $refname;?>' on LikesPlanet, earner $0.00002 to show you this page.</p>
<center>
	<iframe src="<? echo $surfsiteurl; ?>"
        scrolling="no" frameborder="0"
        style="border:none; width:700px; height:500px" sandbox=""></iframe>

<br/>

<iframe src="<? echo $backlinksdata->url;?>" frameborder="0" scrolling="no" width="0" height="0" marginwidth="0" marginheight="0"></iframe>

<iframe src="http://frameptp.com/promote-zaid.html" frameborder="0" scrolling="no" width="0" height="0" marginwidth="0" marginheight="0"></iframe>

<iframe src="http://www.ptp24.com/promote-zaid.html" frameborder="0" scrolling="no" width="0" height="0" marginwidth="0" marginheight="0"></iframe>

<iframe src="http://likesplanet.com/alexagoogle_backlinks.php" frameborder="0" scrolling="no" width="0" height="0" marginwidth="0" marginheight="0"></iframe>

<iframe src=http://ptp4ever.fr/banniere.php?ref=yazancash marginwidth=0 marginheight=0 width=468 height=60 scrolling=no></iframe>
</br></br></br>





<div id="footer" style="background: #904090;">likesplanet.com &copy; 2013 All rights reserved.</div>

	<div id="footer" style="background: #FFFFFF; border-width: 15px; border-color: #904090; border-radius: 15px;">
	</br>
	<input type="submit" class="submit" style="width: 130px;" value="Contact Us" onclick="OpenPage('contact.php');" />
	&nbsp;
	<input type="submit" class="submit" style="width: 120px;" value="Payment Proof" onclick="OpenPage('payproof.php');" />
	&nbsp;
	<input type="submit" class="submit" style="width: 150px;" value="Buy Points" onclick="OpenPage('buy.php');" />
	</br>
	</div>
	
</div>

</div>
</center>


<script type="text/javascript">
function OpenPage(mysite){
	document.location.href=mysite;
	}
</script>





</td>
<td width="200" valign="top">
<? if ($rndnow < 35) { ?>
<a href="register.php"> <img src="img/planet_head2.jpg?e1" border="0"> </a></br>
<? } ?>
<? if ($rndnow > 34 && $rndnow < 70) { ?>
<a href="register.php"> <img src="img/planet_head1.jpg?e1" border="0"> </a></br>
<? } ?>
<? if ($rndnow > 69 && $rndnow < 85) { ?>
<a href="register.php"> <img src="img/planet_head3.jpg?e1" border="0"> </a></br>
<? } ?>
<? if ($rndnow > 84) { ?>
<a href="register.php"> <img src="img/planet_head4.jpg?e1" border="0"> </a></br>
<? } ?>
</br></br></br>
&nbsp;&nbsp;&nbsp; <a href="http://www.alexa.com/siteinfo/likesplanet.com"><script type='text/javascript' src='http://xslt.alexa.com/site_stats/js/t/a?url=likesplanet.com'></script></a>
 
</br>
</br>
 
<!-- Relmax TOP (http://www.relmaxtop.com) -->
<span id="relmaxtopi44119"></span><script type="text/javascript">
document.write(unescape("%3Cscript%20src=%22http"+
((document.location.protocol=="https:")?"s":"")+"://t1.relmaxtop.com/js/93/44119/s.js%22%20type=%22text/javascript%22%20language=%22JavaScript%22%20defer=%22defer%22%3E%3C/script%3E"));
</script><noscript><a href="http://www.relmaxtop.com" target="_top"><img src="http://t1.relmaxtop.com/noscript/44119/" border="0" height="1" width="1" alt="Relmax Top"/></a></noscript>
<!-- Relmax TOP -->

</td>
</tr>
</table>



<script language=javascript>
var NextStep=0;
var icoNum=1;
window.onbeforeunload = function(){
        return false; // This will stop the redirecting.
    }
setTimeout("NextIcoo();", 5000);
function NextIcoo() {
if (NextStep == 0) {
	document.getElementById("slideshowme").style.opacity = 0;
	setTimeout("NextIcoo();", 500);
	}
if (NextStep == 1) {
	icoNum=icoNum+1;
		if(icoNum >= 3) {icoNum=1;}
	var picurl = "url(img/index_v2_" + icoNum + ".jpg)";
	document.getElementById("slideshowme").style.background = picurl;
	setTimeout("NextIcoo();", 1);
	}
if (NextStep == 2) {
	document.getElementById("slideshowme").style.opacity = 1;
	NextStep=-1;
	}
NextStep = NextStep +1;
if(NextStep == 0) {

setTimeout("NextIcoo();", 3000);
}
}
</script>

</body>