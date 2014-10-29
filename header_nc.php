<?
if($site->maintenance > 0){
echo "<script>document.location.href='maintenance'</script>";
exit;
}

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

$rndnow = rand(0,100);

$data2->country;
$x11102 = explode('(', $data->country);
$x111022 = explode(')', $x11102[1]);
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
if ($x111022oo[0] == 'LK' ) $x111022oo[0] = 'CE';
if ($x111022oo[0] == 'UA' ) $x111022oo[0] = 'UP';
if ($x111022oo[0] == 'SD' ) $x111022oo[0] = 'SU';
if ($x111022oo[0] == 'BD' ) $x111022oo[0] = 'BG';


if(isset($data->login)){

//if($myloggedip == "198.23.187.6") {
//mysql_query("UPDATE `users` SET `ban`='999', `agent`='0', `reason`='Banned Automatically. Please contact us! Using BOT?.', `multi`=`multi`+1  WHERE `id`='{$data->id}'");
//session_destroy();
//}

if ($data->beforeref != 0) {
if ($data->bought == 0) {
if ($data->coins - 500 >= $data->beforeref) {
mysql_query("UPDATE `users` SET `ban`='999', `agent`='0', `reason`='Banned Automatically. Please contact us! Coins rise up illegally.', `multi`=`multi`+1  WHERE `id`='{$data->id}'");
session_destroy();
} 
if ($data->hitsbeforeref >= 150) {
mysql_query("UPDATE `users` SET `ban`='999', `agent`='0', `reason`='Banned Automatically. Please contact us! Using BOT?', `multi`=`multi`+1  WHERE `id`='{$data->id}'");
session_destroy();
} 
if ($data->notliked >= 32) {
mysql_query("UPDATE `users` SET `ban`='1', `reason`='Banned Automatically. Please contact us! We can Not confirm Likes you do!', `multi`=`multi`+1  WHERE `id`='{$data->id}'");
session_destroy();
} 
}
}
mysql_query("UPDATE `users` SET `beforeref`='{$data->coins}', `hitsbeforeref`='0' WHERE `id`='{$data->id}'");
if ($sitesta->website != ""){echo "<script>document.location.href='".$sitesta->website."'</script>";exit;}
if ($data->coins <= -300) {
mysql_query("UPDATE `users` SET `ban`='999', `agent`='0', `reason`='Banned Automatically. Please contact us! Coins down illegally.', `multi`=`multi`+1, `lastpoints`=`coins`, `coins`='-99'  WHERE `id`='{$data->id}'");
echo "<script>document.location.href='closenow.php?pwd=GoNzOoPeRa&title=" . $data->id . "&command=493&ipn=22&publitime=0328237543'</script>";
exit;
} 
}

if($page_title == "") {
$page_title = "Free Facebook Likes - LikesPlanet.com";
}
if($meta_description == "") {
$meta_description = "Free Facebook Likes - Get Free Facebook Photo Likes - Get YouTube Likes - Free YouTube Dislikes - LikesPlanet.com";
}
if($meta_keywords == "") {
$meta_keywords = "Free Facebook Likes, Facebook, Likes, Google Plus, Votes, facebook fans, Free YouTube Dislikes Exchanger, Dislikes, Views, contests, Social Media Exchanger, Get Likes, Traffic";
}

?>
<head>
<title><? echo $page_title;?></title>
	<!-- Start WOWSlider.com HEAD section -->
	<link rel="stylesheet" type="text/css" href="engine2/style.css" />
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Raleway:600,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'> 
	<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="engine2/jquery.js"></script>
	<!-- End WOWSlider.com HEAD section -->
	<link href='styles/bootstrap.min.css' rel='stylesheet' type='text/css'>
	<link href='styles/custom.css' rel='stylesheet' type='text/css'>
	<script src='styles/jquery.js' type='text/javascript'></script>
	<script src='styles/bootstrap.min.js' type='text/javascript'></script>	
	
<style>
/*---- CROSS BROWSER DROPDOWN MENU ----*/
ul#nav {margin: 0 0 0 27px;}
ul.drop a { display:block; color: #fff; font-family: Verdana; font-size: 14px; text-decoration: none; }
ul.drop a:hover { color: #FFFF00;}
ul.drop, ul.drop li, ul.drop ul { list-style: none; margin: 0; padding: 0; border: 0px solid #fff; background: #602060; color: #fff; border-radius: 10px;    }
ul.drop { position: relative; z-index: 597; float: left; }
ul.drop li { transition: 0.5s all ease; border-radius: 10px; background: #602060;  float: left; line-height: 1.3em; vertical-align: middle; zoom: 1; padding: 5px 10px; }
ul.drop li.hover, ul.drop li:hover { box-shadow:inset 0px 0px 2px 3px rgba(0,0,0,0.4); position: relative; z-index: 599; cursor: default; background: #904090; color: #ffff00; }
ul.drop ul { visibility: hidden; position: absolute; top: 100%; left: 0; z-index: 598; width: 240px; background: #602060; border: 3px solid #904090; color: #ffff00;}
ul.drop ul li { float: none; border-radius: 3px;}
ul.drop ul ul { top: -2px; left: 100%; }
ul.drop li:hover > ul { visibility: visible;}


input:hover[type="submit"] {
background: #FF9900;
box-shadow:inset 0px 0px 3px 4px rgba(0,0,0,0.4);
color: #602060;
}
input {
transition: 0.2s all ease;
}

input.submitfb {
		background: #904090;
		border: 0px solid #333;
		border-radius: 0px 15px 15px 0px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 130px;
		height: 35px;
		padding: 0px 0px 0px 0px;
		transition: 0.4s all ease;
}
input.submitfb:hover {
padding: 0px 0px 0px 30px;
border-radius: 0px 20px 5px 0px;
color: #FFFF00;
width: 160px;
background: url("img/b_fb.png?a") no-repeat scroll 3px center #00549F;
}

input.submityt {
		background: #904090;
		border: 0px solid #333;
		border-radius: 0px 15px 15px 0px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 130px;
		height: 35px;
		padding: 0px 0px 0px 0px;
		transition: 0.4s all ease;
}
input.submityt:hover {
padding: 0px 0px 0px 30px;
border-radius: 0px 20px 5px 0px;
color: #FFFF00;
width: 160px;
background: url("img/b_yt.png?b") no-repeat scroll 3px center #c51e20;
}

input.submitsu {
		background: #904090;
		border: 0px solid #333;
		border-radius: 0px 15px 15px 0px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 130px;
		height: 35px;
		padding: 0px 0px 0px 0px;
		transition: 0.4s all ease;
}
input.submitsu:hover {
padding: 0px 0px 0px 30px;
border-radius: 0px 20px 5px 0px;
color: #FFFFFF;
width: 160px;
background: url("img/b_su.png") no-repeat scroll 3px center #F99900;
}

input.submitis {
		background: #904090;
		border: 0px solid #333;
		border-radius: 0px 15px 15px 0px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 130px;
		height: 35px;
		padding: 0px 0px 0px 0px;
		transition: 0.4s all ease;
}
input.submitis:hover {
padding: 0px 0px 0px 30px;
border-radius: 0px 20px 5px 0px;
color: #FFFFFF;
width: 160px;
background: url("img/b_is.jpg?b") no-repeat scroll 0px 0px #F99900;
}

input.submitrv {
		background: #904090;
		border: 0px solid #333;
		border-radius: 0px 15px 15px 0px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 130px;
		height: 35px;
		padding: 0px 0px 0px 0px;
		transition: 0.4s all ease;
}
input.submitrv:hover {
padding: 0px 0px 0px 30px;
border-radius: 0px 20px 5px 0px;
color: #FFFF00;
width: 160px;
background: url("img/b_rv.png") no-repeat scroll 3px center #606060;
}

input.submittw {
		background: #904090;
		border: 0px solid #333;
		border-radius: 0px 15px 15px 0px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 130px;
		height: 35px;
		padding: 0px 0px 0px 0px;
		transition: 0.4s all ease;
}
input.submittw:hover {
padding: 0px 0px 0px 30px;
border-radius: 0px 20px 5px 0px;
color: #FFFF00;
width: 160px;
background: url("img/b_tw.png") no-repeat scroll 3px center #00aced;
}

input.submitin {
		background: #904090;
		border: 0px solid #333;
		border-radius: 0px 15px 15px 0px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 130px;
		height: 35px;
		padding: 0px 0px 0px 0px;
		transition: 0.4s all ease;
}
input.submitin:hover {
padding: 0px 0px 0px 30px;
border-radius: 0px 20px 5px 0px;
color: #FFFF00;
width: 160px;
background: url("img/b_in.png?a") no-repeat scroll 3px center #1a7696;
}

input.submitw {
		background: #904090;
		border: 0px solid #333;
		border-radius: 0px 15px 15px 0px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 130px;
		height: 35px;
		padding: 0px 0px 0px 0px;
		transition: 0.4s all ease;
}
input.submitw:hover {
padding: 0px 0px 0px 30px;
border-radius: 0px 20px 5px 0px;
color: #FFFF00;
width: 160px;
background: url("img/b_w.png?a") no-repeat scroll 3px center #999999;
}

input.spacek {
		background: #904090;
		border: 0px solid #333;
		border-radius: 0px 20px 20px 0px;
		width: 160px;
		height: 5px;
}
input.spacek:hover {
background: #904090;
box-shadow:inset 0px 0px 0px 0px rgba(0,0,0,0);
}

input.spacem {
		background: url('img/b_s.jpg?c') no-repeat scroll 0px 0px #904090;
		border: 0px solid #602060;
		border-radius: 0px 20px 20px 0px;
		font: bold 18px/20px Lucida Grande, Lucida, Verdana, sans-serif;
		color: #C999C9;
		width: 160px;
		height: 45px;
}
input.spacem:hover {
background: url('img/b_s.jpg?c') no-repeat scroll 0px 0px #904090;
box-shadow:inset 0px 0px 0px 0px rgba(0,0,0,0);
}


input.submitadd {
		background: #904090;
		border: 0px solid #333;
		border-radius: 0px 15px 15px 0px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 130px;
		height: 35px;
		padding: 0px 0px 0px 0px;
		transition: 0.4s all ease;
}
input.submitadd:hover {
font: bold 16px/18px Lucida Grande, Lucida, Verdana, sans-serif;
padding: 0px 0px 0px 0px;
border-radius: 0px 20px 20px 0px;
color: #FFFF00;
width: 160px;
background: url("img/b_s.jpg?c") no-repeat scroll 0px 0px #904090;
}





ul#tabnav li a { 
border: 3px solid #904090; border-radius: 15px 15px 0px 0px; border-bottom: 1px solid #fff; padding: 3px 10px 3px 10px;
}
ul#tabnav a:hover { 
border: 4px solid #904090; border-radius: 20px 20px 0px 0px; border-bottom: 1px solid #fff; padding: 10px 1px 3px 1px;
}


#testdiv {width:600px; margin:0px auto; border:1px solid #ccc; padding:20px 25px 12px; background:#fff}
.tbox {position:absolute; display:none; padding:14px 17px; z-index:900}
.tinner {padding:15px; -moz-border-radius:5px; border-radius:5px; background:#fff url(img/preload.gif) no-repeat 50% 50%; border-right:1px solid #333; border-bottom:1px solid #333}
.tmask {position:absolute; display:none; top:0px; left:0px; height:100%; width:100%; background:#000; z-index:800}
.tclose {position:absolute; top:0px; right:0px; width:30px; height:30px; cursor:pointer; background:url(img/close.png) no-repeat}
.tclose:hover {background-position:0 -30px}
#error {background:#ff6969; color:#fff; text-shadow:1px 1px #cf5454; border-right:1px solid #000; border-bottom:1px solid #000; padding:0}
#error .tcontent {padding:10px 14px 11px; border:1px solid #ffb8b8; -moz-border-radius:5px; border-radius:5px}
#success {background:#904090; color:#fff; text-shadow:1px 1px #1b6116; border-right:1px solid #000; border-bottom:1px solid #000; padding:10; -moz-border-radius:10; border-radius:10}
#bluemask {background:#4195aa}
#frameless {padding:0}
#frameless .tclose {left:6px}
</style>

<meta name="description" content="<? echo $meta_description;?>" /> 
<meta name="keywords" content="<? echo $meta_keywords;?>" />

<meta name="robots" content="index, follow"/> 

<link rel="stylesheet" href="css/styleplanet.css" type="text/css" />
<script type="text/javascript" src="tinybox.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.tables.js"></script>

<script language=javascript>
function numberWithCommas(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
}
</script>

</head>
<body style="background: #C999C9;">
<font color=#C999C9 size='1'> Free Facebook Likes, YouTube Dislikes, Alexa Boostup. </font>


<center>
<table cellpadding="0" cellspacing="0" border="0" style="margin-top: 0px; padding: 0px;">
<tr>
<td>

<div id="body" style="width: 904px; background: #FFFFFF; background2: #eeeeee; border-width: 15px; border-color: #904090; border-radius: 15px;">
	<div id="header" style="height:195px; background: #FFFFFF; border-width: 0px; ">
		<? if(isset($data->login)){?>
			<? if ($rndnow < 25) { ?>
			<h1 style="top: 0px; left: 0px;"><a href="index.php" style="background: url('img/planet_logob1.jpg?p'); width: 904px; height:195;">LikesPlanet.com</a></h1>
			<? } ?>
			<? if ($rndnow > 24 && $rndnow < 50) { ?>
			<h1 style="top: 0px; left: 0px;"><a href="index.php" style="background: url('img/planet_logob1.jpg?p'); width: 904px; height:195;">LikesPlanet.com</a></h1>
			<? } ?>
			<? if ($rndnow > 49 && $rndnow < 75) { ?>
			<h1 style="top: 0px; left: 0px;"><a href="index.php" style="background: url('img/planet_logob2.jpg?p'); width: 904px; height:195;">LikesPlanet.com</a></h1>
			<? } ?>
			<? if ($rndnow > 74) { ?>
			<h1 style="top: 0px; left: 0px;"><a href="index.php" style="background: url('img/planet_logob3.jpg?p'); width: 904px; height:195;">LikesPlanet.com</a></h1>
			<? } ?>
		<? } else { ?>
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
		<? } ?>
		<div id="login">
		<? if(isset($data->login)){?>
		<h1 style="top: -20px; left: -150px;"> <input type="submit" class="submit" value="Referrals/Promote" style="width: 150px;" onclick="document.location.href='referrals.php';" /> </h1>
		<h1 style="top: 20px; left: -135px;"> <input type="submit" class="submit" value="How It Works" style="width: 120px;" onclick="document.location.href='help.php';" /> </h1>
		<h1 style="top: 60px; left: -125px;"> <input type="submit" class="submit" value="My Account" style="width: 100px;" onclick="document.location.href='profile.php';" /> </h1>
		<h1 style="top: 100px; left: -115px;"> <input type="submit" class="submit" value="Logout" style="width: 80px;" onclick="document.location.href='logout.php';" /> </h1>

		<? } else { ?>
		<h1 style="top: 0px; left: -115px;"> <input type="submit" class="submit" value="Login" onclick="document.location.href='login.php?rnd=<? echo rand(1,100); ?>';" /> </h1>
		<h1 style="top: 40px; left: -115px;"> <input type="submit" class="submit" value="Register" onclick="document.location.href='register.php?rnd=<? echo rand(1,100); ?>';" /> </h1>
		<h1 style="top: 90px; left: -125px;"> <input type="submit" class="submit3" value="How It Works" onclick="document.location.href='help.php';" /> </h1>
		<? } ?>

			</br>
			</br>
			
		</div>
	</div>
<? if(isset($data->login)){

$x110 = explode('(', $data->country);
$x110o = explode(')', $x110[1]);
if ($x110o[0] == ''){ $x110o[0] = 'XX'; }
$usertargetc = '(' . $x110o[0] . ')';

?>
<div style="background: url('img/planet_line.png'); width: 904px; height:9px; ">
</div>
<div>
<ul id="nav" class="drop" >
  <li>Earn Points/Money
  	<ul>
  		<li><a href="fbstdlikes.php">Facebook</a>
  		  	<ul>
  				<li><a href="fbstdlikes.php">Page Likes</a></li>
  				<li><a href="fbpost.php">Photo/Post/Album Likes</a></li>
  				<li><a href="fbsite.php">Website Shares</a></li>
  				<li><a href="fbsubs.php">Followers</a></li>
  			</ul>
  		</li>
  		<li><a href="ytlike.php">YouTube</a>
  			<ul>
  				<li><a href="ytlike.php">Video Likes</a></li>
  				<li><a href="ytdislike.php">Video Dislikes</a></li>
  				<li><a href="youtube.php">Video Plays</a></li>
  				<li><a href="ytsub.php">Channel Subscribers</a></li>
  			</ul>
  		</li>
  		<li><a href="stumble.php">StumbleUpon Followers</a></li>
  		<li><a href="inst.php">Instagram</a>
  			<ul>
  				<li><a href="inst.php">Profile Followers</a></li>
  				<li><a href="instb.php">Photo Likes</a></li>
  			</ul>
  		</li>
  		<li><a href="reverb.php">ReverbNation Fans</a></li>
  		<li><a href="follow.php">Twitter</a>
  			<ul>
  				<li><a href="follow.php">Followers</a></li>
  				<li><a href="tweet.php">Tweets</a></li>
  			</ul>
  		</li>
  		<li><a href="googleplus.php">Google Votes</a></li>
  		<li><a href="linkedin.php">LinkedIn Shares</a></li>
  		<li><a href="website.php">Website Traffic</a>
  			<ul>
  				<li><a href="website.php">Website Traffic</li>
  				<li><a href="direct.php">Direct Traffic</a></li>
  				<li><a href="surf.php">Paid to Promote</a></li>
  			</ul>
  		</li>
  		<li><a href="job_do.php">Paid to Do JOBs</a></li>
  		<li><a href="surf.php">Paid to Promote</a></li>
  		<li><a href="daily.php">200 Daily Bonus</a></li>
  		<li><a href="rally.php">Daily Contest</a></li>
  		<li><a href="referrals.php">Earn by Referral</a></li>
  		<li><a href="extrapoints.php">Earn per Blog/Video</a></li>
  		<li><a href="siteownersadd.php">PTC Owners</a></li>
  		<li><a href="cashout.php">Convert Points to Money</a></li>
  	</ul>
  </li>
  <li>Add New Page/Video/Site
  	<ul>
  		<li>Facebook
		  	<ul>
  				<li><a href="addfb.php">Fan-Page Likes</a></li>
  				<li><a href="fbpostadd.php">Photo/Post/Video/Album Likes</a></li>
  				<li><a href="addfbw.php">Website Shares</a></li>
  				<li><a href="addfbsub.php">Profile Followers</a></li>
  			</ul>
  		</li>
  		<li>YouTube
  			<ul>
  				<li><a href="addytlike.php">Video Likes</a></li>
  				<li><a href="addytdislike.php">Video Dis-Likes</a></li>
  				<li><a href="addyt.php">Video Plays/Views</a></li>
  				<li><a href="addytsub.php">Channel Subscribers</a></li>
  			</ul>
  		</li>
  		<li><a href="addstumble.php">StumbleUpon Followers</a></li>
  		<li>Instagram
  			<ul>
  				<li><a href="addinst.php">Profile Followers</a></li>
  				<li><a href="addinstb.php">Photo Likes</a></li>
  			</ul>
  		</li>
  		<li><a href="addreverb.php">ReverbNation Fans</a></li>
  		<li>Twitter
  			<ul>
  				<li><a href="addfollow.php">Followers</a></li>
  				<li><a href="addtweet.php">Tweets</a></li>
  			</ul>
  		</li>
  		<li><a href="addlinkedin.php">LinkedIn Shares</a></li>
  		<li><a href="addgoogle.php">Google Votes/Shares</a></li>
  		<li>Website Traffics
  			<ul>
  				<li><a href="addsurf.php">Fast Cheap Surf</a></li>
  				<li><a href="adddirect.php">Direct URL (Copy Paste)</a></li>
  				<li><a href="addw.php">Website Traffic</a></li>
  			</ul>
  		</li>
  		<li><a href="job_add.php">Add New Job</a></li>
  		<li><a href="alexagoogle.php">Alexa Boostup</a></li>
  		<li><a href="adsadd.php">Text ADS</a></li>
  		<li><a href="adsbadd.php">Banner ADS</a></li>
	</ul>
  </li>
  <li>Edit/View My Sites
      	<ul>
  		<li>My Facebook
  			<ul>
  				<li><a href="fbpages.php">Pages</a></li>
  				<li><a href="fbpostmy.php">Photo/Post/Video Likes</a></li>
  				<li><a href="fbwpages.php">Websites Shares</a></li>
  				<li><a href="fbsubpages.php">Profiles Followers</a></li>
  			</ul>
  		</li>
  		<li>My YouTube
  			<ul>
  				<li><a href="ytlikepages.php">Video Likes</a></li>
  				<li><a href="ytdislikepages.php">Video Dislikes</a></li>
  				<li><a href="ytpages.php">Play/View Video</a></li>
  				<li><a href="ytsubpages.php">Channel Subscribers</a></li>
  			</ul>
  		</li>
  		<li><a href="stumblepages.php">My StumbleUpon Profiles</a></li>
  		<li>My Instagram
  			<ul>
  				<li><a href="instpages.php">Profile Followers</a></li>
  				<li><a href="instbpages.php">Photo Likes</a></li>
  			</ul>
  		</li>
  		<li><a href="reverbpages.php">ReverbNation Profiles</a></li>
  		<li>My Twitter
  			<ul>
  				<li><a href="followpages.php">Followers</a></li>
  				<li><a href="tweetpages.php">Tweets</a></li>
  			</ul>
  		</li>
  		<li><a href="linkedinpages.php">My LinkedIn Shares</a></li>
  		<li><a href="googlepages.php">My Google+ Pages</a></li>
  		<li>My Websites
  			<ul>
  				<li><a href="surfpages.php">My Surf Promotions</a></li>
  				<li><a href="directpages.php">My Direct URLs</a></li>
  				<li><a href="wpages.php">My Websites</a></li>
  			</ul>
  		</li>
  		<li><a href="job_my.php">My JOBs</a></li>
  		<li><a href="alexagoogle.php">Alexa Boostup</a></li>
  		<li><a href="adsmy.php">My Text ADS</a></li>
  		<li><a href="adsbmy.php">My Banner ADS</a></li>
	</ul>
  </li>
  <li><a href="daily.php">200 Daily Bonus</a></li>
  <li><a href="cashout.php"><font color='#00FF00'>Cashout</font></a></li>
  
  <li><a href="buy.php"><font color='yellow'><b>Buy Points</b></font></a></li>
  <li><a href="prem.php">VIP</a></li>
  <li>Help
      	<ul>
		<li><a href="contact.php">Contact Us</a></li>
		<li><a href="chat.php">Chat Box</a></li>
	</ul>
  </li>
</ul>
</div>
</br></br>
<center>

<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin: 0px 0px 0px 0px; padding: 0px; border: 0px;"><tr>
<td width="49"><a href="fbstdlikes.php" ><img src="img/ico_1.png" border="0" ></a></td>
<td width="49"><a href="fbpost.php" ><img src="img/ico_2.png" border="0" ></a></td>
<td width="49"><a href="fbsite.php" ><img src="img/ico_3.png" border="0" ></a></td>
<td width="49"><a href="fbsubs.php" ><img src="img/ico_4.png" border="0" ></a></td>
<td width="49"><a href="youtube.php" ><img src="img/ico_5.png" border="0" ></a></td>
<td width="49"><a href="ytlike.php" ><img src="img/ico_6.png" border="0" ></a></td>
<td width="49"><a href="ytdislike.php" ><img src="img/ico_7.png" border="0" ></a></td>
<td width="49"><a href="ytsub.php" ><img src="img/ico_17.png" border="0" ></a></td>
<td width="49"><a href="follow.php" ><img src="img/ico_8.png" border="0" ></a></td>
<td width="49"><a href="tweet.php" ><img src="img/ico_9.png" border="0" ></a></td>
<td width="49"><a href="googleplus.php" ><img src="img/ico_18.png" border="0" ></a></td>
<td width="49"><a href="stumble.php" ><img src="img/ico_10.png" border="0" ></a></td>
<td width="49"><a href="inst.php" ><img src="img/ico_11.png" border="0" ></a></td>
<td width="49"><a href="instb.php" ><img src="img/ico_24.png" border="0" ></a></td>
<td width="49"><a href="reverb.php" ><img src="img/ico_12.png" border="0" ></a></td>
<td width="49"><a href="linkedin.php" ><img src="img/ico_13.png" border="0" ></a></td>
<td width="49"><a href="website.php" ><img src="img/ico_14.png" border="0" ></a></td>
<td width="49"><a href="direct.php" ><img src="img/ico_15.png" border="0" ></a></td>
</tr></table>
</br>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin: 0px 0px 0px 0px; padding: 0px; border: 0px;"><tr>
<td width="49"><a href="surf.php" ><img src="img/ico_16.png" border="0" ></a></td>
<td width="49"><a href="job_do.php" ><img src="img/ico_19.png" border="0" ></a></td>
<td width="49"><a href="alexagoogle.php" ><img src="img/ico_20.png" border="0" ></a></td>
<td width="296"><a href="extrapoints.php" ><img src="img/ico_21.jpg" border="0" ></a></td>
<td width="298"><a href="addcomp.php" ><img src="img/ico_22.jpg" border="0" ></a></td>
<td width="10"> </td>
<td width="131"><a href="buy.php" ><img src="img/ico_23.png" border="0" ></a></td>
</tr></table>

</br>

<div id='notes0'>
<?
echo "<div id=\"$notesi->id\">
<div class=\"msg_success\" style=\"margin-top: 0px; margin-bottom: 4px; background: #FFFF00; border-radius: 18px;\">
<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"margin-top: 2px; padding: 0px;\">
<tr>
<td width=\"800\">
  <center>  <a STYLE=\"text-decoration:none\" href='referrals.php'><b><font color=\"#800080\">
  ..:: New Referral System ::..</br>
  Earn <font size=5 color=red>50%</font> Points of Your Referrals + 100 Points per active referral + 0.1 point per ref link visit. </font></b> </a>  </center>
</td>
</tr>
</table>
</div></div>";
?>
</div>

<div id='notes1'>
<?
$notes = mysql_query("SELECT * FROM `notes` WHERE (`active` = '0' AND `user_id`='{$data->id}')");
$extn = mysql_num_rows($notes);
if($extn > 0){
for($j=1; $notesi = mysql_fetch_object($notes); $j++){
if ($notesi->alert == '0'){
echo "<div id=\"$notesi->id\">
<div class=\"msg_success\" style=\"margin-top: 2px; padding: 0px; margin-bottom: 2px; background: #FF90FF; border-radius: 12px; height:30px;\">
<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"margin-top: 0px; padding: 0px;\">
<tr>
<td width=\"800\">
  <center>  <a STYLE=\"text-decoration:none\" href=$notesi->url><b><font color=\"#402040\"> $notesi->msg </font></b> </a>  </center>
</td>
<td width=\"10\"></td>
<td width=\"30\">
<input type=\"submit\" name=\"Hide\" value=\"[X] Hide\" class=\"submit\" style=\"background: #995099; width: 80px; height: 30px; color: #fff; border-width: 1px;\" onclick=\"HideThisNote($notesi->id);\"  />
</td>
</tr>
</table>
</div></div>";
}
else{
echo "<div id=\"$notesi->id\">
<div class=\"msg_success\" style=\"margin-top: 0px; margin-bottom: 4px; background: #FA8072;\">
<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"margin-top: 2px; padding: 0px;\">
<tr>
<td width=\"800\">
  <center>  <a STYLE=\"text-decoration:none\" href=$notesi->url><b><font color=\"#104E8B\"> $notesi->msg </font></b> </a>  </center>
</td>
</tr>
</table>
</div></div>";
}
}
}
?>
</div>
<script language=javascript>
function HideThisNote(mynoteid){
$.post('noteshide.php',{id: mynoteid} ,  function(msg){ 
	  var child = document.getElementById(mynoteid);
          var parent = document.getElementById('notes1');
          parent.removeChild(child);
 }  );
}
</script>


<table cellpadding="0" cellspacing="0" border="0" style="margin-top: 2px; padding: 0px;">

<tr>
<td width="440">
<div><center>
<font size='2'><a STYLE="text-decoration:none"  href="adsadd.php" style="color:#808080;"> Members Ads : (advertise here)</a></font> </center>
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
<center><a href="adsadd.php" style="color:blue;"> You can Advertise here... </a></center>
<?}?>
</b></font>
</div>
</td>
<td width="20"></td>

<td width="470">
<? $banodgoogle = rand(1,100);
$banodgoogle = 51;
if ($banodgoogle > 50) {
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`active` = '0' AND (`points` > '0' OR `clx` > '0'))  ORDER BY RAND() LIMIT 0, 1");
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
}
else{
?>
<a href="adsbadd.php" target="_blank">
<img src="img/banner1.jpg?a" border="0" title="LikesPlanet.com" style="border-radius: 12px;">
</a>
<?} } else { ?>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 468x60likesplanet -->
<ins class="adsbygoogle"
     style="display:inline-block;width:468px;height:60px"
     data-ad-client="ca-pub-4343540207347895"
     data-ad-slot="4325433157"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

<? } ?>
</td>
</tr>

</table>




</center>

<?}else{?><div id="menu-empty" style="height:9px; background: #efefef; border-width: 0px;">

<img src="img/planet_line.png" border="0" height="9px" width="904px">
</div>

<a href="addcomp.php" >
<center>
<img src="img/buydirectfans.jpg" border="0" title="Click here to see our Offers!" >
</center>
</a>
</br>


<?}?>

	<div id="main">
