<?
$rndnow = rand(0,100);

$sitestat = mysql_query("SELECT * FROM `stat` WHERE `id` = '1'");
$sitetotalmembers = mysql_fetch_object($sitestat);
$sitestat = mysql_query("SELECT * FROM `stat` WHERE `id` = '20'");
$sitestatmembers = mysql_fetch_object($sitestat);

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
	input.submitgreen {
		background: #229922;
		border: 1px solid #333;
		border-radius: 10px;
		border-width: 3px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 100px;
		height: 28px;
		}
	input.submitblue {
		background: #2222FF;
		border: 1px solid #333;
		border-radius: 10px;
		border-width: 3px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 100px;
		height: 28px;
		}
	input.submitgold {
		background: #999922;
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
		<h1 style="top: 40px; left: -115px;"> <input type="submit" class="submit" value="Register" onclick="document.location.href='register.php?rnd=<? echo rand(1,100); ?>';" /> </h1>
		<h1 style="top: 90px; left: -125px;"> <input type="submit" class="submit" style="width: 120px;" value="How It Works" onclick="document.location.href='help.php';" /> </h1>
		</br>
		</br>
	</div>
	
</div>


<img src="img/planet_line.png" border="0" height="9px" width="904px">
</br>

<center>
<a href="addcomp.php" >
<img src="img/buydirectfans.jpg" border="0" title="Click here to see our Offers!" >
</a>
<br/>
<h1><font size='4'>What is LikesPlanet.com?</font></h1>
<p><b><font color='#904090' size='5'>LikesPlanet</font> is your way to <font color='green' size='6'>Advertise your social pages</font> or <font color='blue' size='4'>Earn Money</font> by doing Likes!</b></p>

<font color='green' size='5'><b> <? echo number_format(8000 + $sitetotalmembers->stat); ?> </b> Users Joined LikesPlanet network!</font>
<br/><br/>
<font color='green' size='5'><b> <? echo $sitestatmembers->stat; ?> </b> Users Joined LikesPlanet within <b>last 24 hours</b>!</font>
<br/><br/>
<font color='green' size='5'><b> <font color='red' size='6'>50%</font> </b> Referrals Earnings! </font>
<br/><br/>

<a href="register.php" >
<div id="slideshowme" style="width: 902px; height: 423px; background: url('img/index_v2_1.jpg'); transition: 0.5s all ease; opacity: 1;">
</div>
</a>

<br/><br/>



<font size='4' color='#602060'>
Facebook Likes, Facebook Subscribers, Twitter Followers, Youtube Subscribers, LinkedIn Shares, Youtube Video Views, Twitter ReTweets, Youtube Video Likes, Youtube Video Dislikes, Instagram Followers, Stumbleupon Followers, Reverbnation Fans, Website Traffic...etc
</font>
<br/><br/><font size='6' color='blue'><b> All Free! </b></font>

<br/><br/>

<h1 style="font-size: 16; color:green; ">How it works?</h1>
<a href="help.php"> <img src="img/HowItWorks.png?b" border="0" title="How LikesPlanet.com works?"> </a>

<br/><br/>
<h1 style="font-size: 16; color:green; ">Want to Buy Likes/Fans/Hits Directly?</h1>
<a href="addcomp.php"> <img src="img/BUYLIKES0.jpg?b" border="0" title="Buy Fans/Followers for your social media!"> </a>
<br/><br/>

<br/>
</center>
<font size='3' color='#602060'>
		<ul>
		
		<li>Get 1000s Free <b><font size='4' color='#2020F9'>FaceBook Page/Photo/Post/Album <font size='5' color='#202099'>Likes/Shares </font></font></b> !!</li>
		</br>
		
		<li>Get 1000s Free <b><font size='4' color='#F92020'>YouTube Video <font size='5' color='#992020'>Likes/Dislikes/Plays </font></font></b> !!</li>
		</br>
		
		<li>Get 1000s Free <b><font size='4' color='#20D520'>Twitter/StumbleUpon/LinkedIN/Instagram <font size='5' color='#007000'>Followers </font></font></b> !!</li>
		</br>
		
		<li>Get 1000s Free <b><font size='4' color='#A0A000'>Website <font size='5' color='#808000'>Traffic </font></font></b> !!</li>
		</br>
		<li><b><font size='4' color='#00A000'>100% SAFE Network. </b> Get only High-Quality Fans!</font></li>
		<br/>
		<li><b><font size='4' color='#A00000'>NO</font> <font size='4'>BOTs, NO </b>Automated profiles!</font></li>
		</br>
		<li><font size='4'>We are all here for the same reason, Exchanging Fans!</font></li>
		<br/>
		</ul>
</font>

<center>
</br></br>
<b><font color='blue' size='5'>In Two Words:</font> <font color='green' size='5'>LikesPlanet.com is what you are looking for!</font></b>

</br></br></br></br>

<font color='red' size='6'>
<form action="register.php" method="post"> <center>
=>> <input type="submit" name="submit" class="submit" style="width: 450; height: 40;" value="Join Now & Claim 50 Points Signup Bonus!"> <<= </center>
<br/>
</form>
</font>

</br></br></br></br>

<div id="footer" style="background: #904090;">likesplanet.com &copy; 2013 All rights reserved.</div>

	<div id="footer" style="background: #FFFFFF; border-width: 15px; border-color: #904090; border-radius: 15px;">
	</br>
	<input type="submit" class="submitblue" style="width: 130px;" value="Contact Us" onclick="OpenPage('contact.php');" />
	&nbsp;
	<input type="submit" class="submitblue" style="width: 70px;" value="Chat" onclick="OpenPage('chat.php');" />
	&nbsp;
	<input type="submit" class="submitblue" style="width: 70px;" value="Blog" onclick="OpenPage('http://blog.likesplanet.com/');" />
	&nbsp;
	<input type="submit" class="submitblue" style="width: 85px;" value="Fan Signs" onclick="OpenPage('fan_sign_generator.php?ref=<? echo rand(1,100);?>');" />
	&nbsp;
	<input type="submit" class="submitblue" style="width: 120px;" value="Payment Proof" onclick="OpenPage('payproof.php');" />
	&nbsp;
	
	<input type="submit" class="submitgreen" style="width: 150px;" value="Buy Points" onclick="OpenPage('buy.php');" />
	&nbsp;
	<input type="submit" class="submitgold" style="width: 150px;" value="Become Premium" onclick="OpenPage('prem.php');" />
	</br></br>
<a href="http://facebook.com/likesplanet" target="_blank" title="Find us on Facebook"><img src="img/fuofb.png" alt="Find us on Facebook" width="116" height="28" /></a>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
	<g:plusone href="http://likesplanet.com/" size="large"></g:plusone>
	</center>
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
setTimeout("NextIcoo();", 7000);

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

setTimeout("NextIcoo();", 5000);
}
}
</script>

</body>