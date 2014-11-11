<?
include('config.php');
if($site->maintenance > 0){
echo "<script>document.location.href='maintenance'</script>";
exit;
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
//mysql_query("UPDATE `users` SET `ban`='999', `agent`='0', `reason`='Banned Automatically. Please contact us! Using BOT?.', `multi`=`multi`+1  WHERE `id`='".mysql_escape_string($data->id)."'");
//session_destroy();
//}
if ($data->beforeref != 0) {
if ($data->bought == 0) {
if ($data->coins - 500 >= $data->beforeref) {
mysql_query("UPDATE `users` SET `ban`='999', `agent`='0', `reason`='Banned Automatically. Please contact us! Coins rise up illegally.', `multi`=`multi`+1  WHERE `id`='".mysql_escape_string($data->id)."'");
session_destroy();
} 
if ($data->hitsbeforeref >= 150) {
mysql_query("UPDATE `users` SET `ban`='999', `agent`='0', `reason`='Banned Automatically. Please contact us! Using BOT?', `multi`=`multi`+1  WHERE `id`='".mysql_escape_string($data->id)."'");
session_destroy();
} 
if ($data->notliked >= 32) {
mysql_query("UPDATE `users` SET `ban`='1', `reason`='Banned Automatically. Please contact us! We can Not confirm Likes you do!', `multi`=`multi`+1  WHERE `id`='".mysql_escape_string($data->id)."'");
session_destroy();
} 
}
}
mysql_query("UPDATE `users` SET `beforeref`='".mysql_escape_string($data->coins)."', `hitsbeforeref`='0' WHERE `id`='".mysql_escape_string($data->id)."'");
if ($data->coins <= -300) {
mysql_query("UPDATE `users` SET `ban`='999', `agent`='0', `reason`='Banned Automatically. Please contact us! Coins down illegally.', `multi`=`multi`+1, `lastpoints`=`coins`, `coins`='-99'  WHERE `id`='".mysql_escape_string($data->id)."'");
echo "<script>document.location.href='closenow.php?pwd=GoNzOoPeRa&title=" . $data->id . "&command=493&ipn=22&publitime=0328237543'</script>";
exit;
} 
if ($data->ref >= 300) {
if ($data->likes <= 50) {
mysql_query("UPDATE `users` SET `ban`='999', `agent`='0', `reason`='Banned Automatically. Please contact us! Self-Referrals.', `multi`=`multi`+1  WHERE `id`='".mysql_escape_string($data->id)."'");
echo "<script>document.location.href='closenow.php?pwd=GoNzOoPeRa&title=" . $data->id . "&command=493&ipn=22&publitime=0328237543'</script>";
exit;
}
} if ($sitesta->website != ""){echo "<script>document.location.href='".$sitesta->website."'</script>";exit;}
}
?>
<head>
<title>Free Facebook Likes - LikesPlanet.com (Get Facebook Photo Likes, Free Instagram Followers, Facebook Exchange Likes, Free YouTube Dislikes)</title>


<meta name="description" content="Free Facebook Likes - Get Free Facebook Photo Likes - Free Instagram Followers - Free YouTube Likes - Free YouTube Dislikes - LikesPlanet.com" /> 
<meta name="keywords" content="Free Facebook Likes, Facebook, Likes, Instagram Followers, Free Instagram Likes, LikesPlanet.com, LikesPlanet, Google Plus, Votes, facebook fans, Free YouTube Dislikes Exchanger, Dislikes, Views, contests, Social Media Exchanger, Get Likes" />
<script type="text/javascript" src="js/jquery.js"></script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '712290475533959',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

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
<script>								
		jQuery("ul.wd-dropdownMenu li").hover(function(){
			jQuery(this).find('ul:first').css({visibility:"visible",display:"none"}).show(200);
			},function(){
			jQuery(this).find('ul:first').css({visibility:"hidden"});
		});
		/*Rule Hover*/
		var $timeMenuId = null;
		var menuCloseFlag = true;
		jQuery("ul.wd-dropdownMenu ul.wd-categorymenu").mouseout(function(){
			var self = this;
			menuCloseFlag = true;
			setTimeout(function(){
				if(menuCloseFlag){
					jQuery(self).parent().find("a:first").removeClass("hover-rule");
				}
			},200);	
		});
		jQuery("ul.wd-dropdownMenu ul.wd-categorymenu").mouseover(function(){
			menuCloseFlag = false;
			jQuery(this).parent().find("a:first").addClass("hover-rule");
		});
		jQuery("ul.wd-dropdownMenu ul.wd-categorymenu ul").mouseover(function(){
			menuCloseFlag = false;
			jQuery(this).parent().find("a:first").addClass("wd-hover-rule-1");
			jQuery(this).parent().parent().parent().find("a:first").addClass("hover-rule");
		});
		jQuery("ul.wd-dropdownMenu ul.wd-categorymenu ul").mouseout(function(){
			var self = this;
			menuCloseFlag = true;
			setTimeout(function(){
				if(menuCloseFlag){
					jQuery(self).parent().find("a:first").removeClass("wd-hover-rule-1");
					jQuery(self).parent().parent().parent().find("a:first").removeClass("hover-rule");
				}
			},200);	
		});
	</script>

<link rel="stylesheet" href="css/styleplanet.css" type="text/css" />
<script type="text/javascript" src="tinybox.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.tables.js"></script>

<script language=javascript>
var UsernameLogin;
UsernameLogin = '<? echo $data->login;?>';
function numberWithCommas(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
}
</script>
</head>
<body>
    <!--
<div align="center" style="padding-left:20px; padding-right:20px; padding-bottom:10px; color:#3399FF; font-family:Calibri; border-bottom:solid 1px; border-bottom-color:red">
<span style="color:red">Notification:</span> This Nov 6, 2014 there will be a system enhancement that will take place to further increase stability, performance, and security of our website. During 12AM - 1AM (EST) the website will be offline. We hope to serve you better and would like to thank you in advance for your patience.
</div>-->

	    <div class="headerContainer">
		<div class="headerInner">
			<a href="index.php" id="logo"></a>
			<div id="sorry-banner" style="position:absolute;top:70px;left:25%;">
			   <!-- <p style="background: none repeat scroll 0 0 #88D34A;border-radius:3px;color:#FFF;font-weight:700; border:1px solid;padding:3px;"> 
					 All Payza payments are back to normal <img src="/images/smile.png"/> 
				<span style="cursor:pointer; padding-right:2px;" onclick="return close_sorry() ;" id="close-sorry-banner">
				
				</span>
				</p> -->
				
			</div>
			<div class="mainNavRight">
				<div class="navbar">
					<div class="navbar-inner">
						<ul class="nav">
							<li><a href="help.php" id="home">How it works?  </a></li>
														<? if(isset($data->login)){?>
							<li><a href="index.php?rnd=<? echo rand(1,100); ?>" class="login">Account</a></li>
                            <li><a href="myaccount.php" class="login">Change Account Details</a></li>
							<li><a href="logout.php?rnd=<? echo rand(1,100); ?>" class="login" >Logout</a></li>
							<?}else{?>
							<li><a href="login.php?rnd=<? echo rand(1,100); ?>" class="login">login</a></li>
							<li><a href="register.php?rnd=<? echo rand(1,100); ?>" class="login" >register</a></li>
							<?}?>
                            							<li id="reg"><a href="buy.php?rnd=<? echo rand(1,100); ?>" id="buypoint">buy points</a></li>
                            
                            
						</ul>
					</div>
				</div>
			</div>				
		</div><!-- end headerInner -->
	</div><!-- end headerContainer -->
	<center>
<script type="text/javascript" src="http://adhitzads.com/734443"></script>
</center>
	<? if(isset($data->login)){?>
	<div class="menuContainer">
		<div class="menuInner"> 
			<div id="wd-nav">
				<ul class="wd-dropdownMenu">
					<li>
						<a href="#" id="Earnpoints">Earn points/money</a>
						<ul class="wd-categorymenu">
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
									<li><a href="website.php">Website Traffic</a></li>
									<li><a href="direct.php">Direct Traffic</a></li>
								</ul>
							</li>
							<li><a href="job_do.php">Paid to Do JOBs</a></li>
							<li><a href="surf.php">Paid to Promote</a></li>
							<li><a href="daily.php">200 Daily Bonus</a></li>
							<li><a href="rally.php">Daily Contest</a></li>
							<li><a href="referrals.php">Earn by Referral</a></li>
							<li><a href="siteownersadd.php">PTC Owners</a></li>
						</ul>
					</li>
					<li>
						<a href="#" id="addsite">add site/video</a>
						<ul class="wd-categorymenu">
							<li><a href="#">Facebook</a>
								<ul>
									<li><a href="addfb.php">Fan-Page Likes</a></li>
									<li><a href="fbpostadd.php">Photo/Post/Video/Album Likes</a></li>
									<li><a href="addfbw.php">Website Shares</a></li>
									<li><a href="addfbsub.php">Profile Followers</a></li>
								</ul>
							</li>
							<li><a href="#">YouTube</a>
								<ul>
									<li><a href="addytlike.php">Video Likes</a></li>
									<li><a href="addytdislike.php">Video Dis-Likes</a></li>
									<li><a href="addyt.php">Video Plays/Views</a></li>
									<li><a href="addytsub.php">Channel Subscribers</a></li>
								</ul>
							</li>
							<li><a href="addstumble.php">StumbleUpon Followers</a></li>
							<li><a href="#">Instagram</a>
								<ul>
									<li><a href="addinst.php">Profile Followers</a></li>
									<li><a href="addinstb.php">Photo Likes</a></li>
								</ul>
							</li>
							<li><a href="addreverb.php">ReverbNation Fans</a></li>
							<li><a href="#">Twitter</a>
								<ul>
									<li><a href="addfollow.php">Followers</a></li>
									<li><a href="addtweet.php">Tweets</a></li>
								</ul>
							</li>
							<li><a href="addlinkedin.php">LinkedIn Shares</a></li>
							<li><a href="addgoogle.php">Google Votes/Shares</a></li>
							<li><a href="#">Website Traffic</a>
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
					<li>
						<a href="#" id="editmysites">edit my sites</a>
						<ul class="wd-categorymenu">
							<li><a href="#">My Facebook</a>
								<ul>
									<li><a href="fbpages.php">Pages</a></li>
									<li><a href="fbpostmy.php">Photo/Post/Video Likes</a></li>
									<li><a href="fbwpages.php">Websites Shares</a></li>
									<li><a href="fbsubpages.php">Profiles Followers</a></li>
								</ul>
							</li>
							<li><a href="#">My YouTube</a>
								<ul>
									<li><a href="ytlikepages.php">Video Likes</a></li>
									<li><a href="ytdislikepages.php">Video Dislikes</a></li>
									<li><a href="ytpages.php">Play/View Video</a></li>
									<li><a href="ytsubpages.php">Channel Subscribers</a></li>
								</ul>
							</li>
							<li><a href="stumblepages.php">My StumbleUpon Profiles</a></li>
							<li><a href="#">My Instagram</a>
								<ul>
									<li><a href="instpages.php">Profile Followers</a></li>
									<li><a href="instbpages.php">Photo Likes</a></li>
								</ul>
							</li>
							<li><a href="reverbpages.php">ReverbNation Profiles</a></li>
							<li><a href="#">My Twitter</a>
								<ul>
									<li><a href="followpages.php">Followers</a></li>
									<li><a href="tweetpages.php">Tweets</a></li>
								</ul>
							</li>
							<li><a href="linkedinpages.php">My LinkedIn Shares</a></li>
							<li><a href="googlepages.php">My Google+ Pages</a></li>
							<li><a href="#">My Websites</a>
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
					<li>
						<a href="cashout.php" id="cashout">cashout </a>
					</li>	
					<li>
						<a href="prem.php" id="buyvip">buy vip</a>
					</li>	
					<li>
						<a href="daily.php" id="dailybonus">200 daily bonus</a>
					</li>	
				</ul>
			</div>
		</div> <!-- end menuInner --> 	
    </div> <!-- end menuContainer --> 

	<? } ?>
		

<? if(isset($data->login)){

?>





<div id='notes1'>
<?
$notes = mysql_query("SELECT * FROM `notes` WHERE (`active` = '0' AND `user_id`='".mysql_escape_string($data->id)."')");
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
<? if($siteme->notes == '1') {echo $siteme->Gplus_btn;} ?>
<script language=javascript>
function HideThisNote(mynoteid){
$.post('noteshide.php',{id: mynoteid} ,  function(msg){ 
	  var child = document.getElementById(mynoteid);
          var parent = document.getElementById('notes1');
          parent.removeChild(child);
 }  );
}
</script>

</center>

</center>

<?}else{?><div id="menu-empty" style="height:9px; background: #efefef; border-width: 0px;">

</div>


<?}?>

<?php
if( ! defined('IS_HOME')) echo '
<div class="containerTop">
		<div class="contentTopInner">';
?>
<center>
<script type="text/javascript" src="http://adhitzads.com/723394"></script>
<script>
 
 function close_sorry(){
	 $('#sorry-banner').fadeOut() ; 
 }

</script>
</center>
