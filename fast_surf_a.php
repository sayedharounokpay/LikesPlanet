<?
include('config.php');
if(!isset($data->login)){echo "<script>document.location.href='login.php'</script>"; exit;}
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

$userAdata0 = mysql_query("SELECT * FROM `fast_surf` WHERE (`user_id`='{$data->id}') ");
$verificareNum = mysql_num_rows($userAdata0);

if ($verificareNum == 0) {
$codeconfirmm = "LIKESPLANET";
$alexahitstoday = 0;
} else {
$userAdata = mysql_fetch_object($userAdata0);
$codeconfirmm = $userAdata->code;
$alexahitstoday = $userAdata->hitstoday;
}

$bonus = 0;
$morehits = 100 - $alexahitstoday;
if( $alexahitstoday >= 100 ) { $bonus = 10; $morehits = 200 - $alexahitstoday; }
if( $alexahitstoday >= 200 ) { $bonus = 20; $morehits = 400 - $alexahitstoday; }
if( $alexahitstoday >= 400 ) { $bonus = 30; $morehits = -1;}


if (strpos($_SERVER['HTTP_USER_AGENT'],'AlexaToolbar') !== false) {
$iminstalled = 1;
} else {
$iminstalled = 0;
}

$randclicker = rand(1,4);

$siteurlll = "http://likesplanet.com/?reff" . rand(1, 1000);

$backlinksdata0 = mysql_query("SELECT * FROM `alexagoogle` WHERE (`points` > '0') ORDER BY RAND() LIMIT 0, 1 ");
$verificareNum = mysql_num_rows($backlinksdata0);
$randommmi = RAND(1, 100);
if($verificareNum == 1 && $randommmi >= 25) {
$backlinksdata = mysql_fetch_object($backlinksdata0);
$siteurlll = $backlinksdata->url;
mysql_query("UPDATE `alexagoogle` SET `traffic`=`traffic`+'1', `traffic_total`=`traffic_total`+'1', `points`=`points`-'1' WHERE (`id` = '{$backlinksdata->id}') ");
} else {
$surff10 = mysql_query("SELECT * FROM `surf` WHERE (`active` = '0' AND `points` > '0')  ORDER BY RAND() DESC LIMIT 0, 1");
$extb = mysql_num_rows($surff10);
	if($extb == 1 && $randommmi >= 25) {
	$backlinksdata2 = mysql_fetch_object($surff10);
	$siteurlll = $backlinksdata2->surf;
	mysql_query("UPDATE `surf` SET `total`=`total`+'1' WHERE `id`='{$backlinksdata2->id}'");
	if($randommmi >= 50) {
	mysql_query("UPDATE `surf` SET `likes`=`likes`+'1', `points`=`points`-'0.25' WHERE `id`='{$backlinksdata2->id}'");
	}
	unset($backlinksdata);
	unset($backlinksdata2);
	}
}


?>

<html>
<head>
<title>Free Facebook Likes - LikesPlanet.com</title>
<script type="text/javascript" src="js/jquery.js"></script>

<style>
input:hover[type="submit"] {
background: #FF9900;
box-shadow:inset 0px 0px 3px 4px rgba(0,0,0,0.4);
}
input {
color: #602060;
border: 4px solid #333;
border-radius: 10px 10px 10px 10px;
transition: 0.2s all ease;
}
</style>

</head>
<body>

<table cellpadding="0" cellspacing="0" border="0" style="margin-top: 2px; padding: 0px;">
<tr><td width="480">
<?

$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`active` = '0' AND (`points` > '0' OR `clx` > '0') AND `user_id`!='{$data->id}')  ORDER BY RAND() LIMIT 0, 1");
$extb = mysql_num_rows($ads2b);
if($extb > 0){
for($j=1; $adsb = mysql_fetch_object($ads2b); $j++)
{
mysql_query("UPDATE `adsb` SET `views`=`views`+'1', `points`=`points`-'1' WHERE `id`='{$adsb->id}'");
?>

<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="60px" width="468px" style="border-radius: 12px;">
</a>

<?}
}
else{
?>
<a href="adsbadd.php" target="_blank">
<img src="img/banner1.jpg?a" border="0" title="LikesPlanet.com" style="border-radius: 12px;">
</a>
<?} ?>

</td>
<td width="5"></td>
<td width="350">
<center>
<div id="HintHits">
<font color='blue' size='5'> 12 </font>
</div>
</center>
</td>
<td width="5"></td>
<td>
<font color='blue'>
Mana: <b><? echo number_format($data->mana, 1); ?></b> &nbsp;&nbsp;-&nbsp;&nbsp; Points: <b><? echo number_format($data->coins, 2); ?></b> </br>
</font>
<? if($iminstalled == 1) { ?>
You earn by click: +0.9 Mana +0.03 Point. </br>
Hits Today: <b><? echo number_format($alexahitstoday, 0); ?></b>
<? } else { ?>
You earn by hit: +0.3 Mana +0.01 Point. </br>
<a href="http://www.alexa.com/toolbar" target="_blank"> <font color='red' size='4'> Earn x300% by installing Alexa Toolbar. </font> </a>
<? } ?>
</td>
</tr>
</table>

<? if($iminstalled == 0) { ?>
<font color='red' size='4'> LikesPlanet detercts that Alexa Toolbar is NOT Installed, Please <a href="http://www.alexa.com/toolbar" target="_blank"> Click Here </a> to install and earn <b>x3</b> more per hit! </font> </br>
<? } ?>
<font color='green' size='4'> Bonus: <b><? echo $bonus;?>%</b> 
<? if($morehits > -1) { ?>  ; Do more <? echo $morehits;?> Hits to Bonus Up!  <? } ?>
</font></br>

<a href="fast_surf.php"> <font color='blue' size='4'> Come back to Manual Surf 4 Seconds? </font> </a> </br>

<center>
<a href="http://www.alexa.com/siteinfo/<? echo $siteurlll;?>"><script type='text/javascript' src='http://xslt.alexa.com/site_stats/js/t/c?url=<? echo $siteurlll;?>'></script></a>
</br>
<? echo $siteurlll;?></br>
<div id="containerfr"> ... </div>
</center>

<script language=javascript>
var mywindow11;
var timerseconds = 12;
setTimeout("DisplayTimer();", 1000);
var releaseform = 0;
window.onbeforeunload = function(){
	if(releaseform == 0) {
        return false; // This will stop the redirecting.
        }
}

StartWindd();
function SendConfirm(answer, code, installedd) {
releaseform = 1;
if(answer == <? echo $randclicker;?>) {
		document.getElementById("HintHits").innerHTML = "<img src='img/loader.gif'>";
		mywindow11.close();
		setTimeout("window.location.reload();", 8000);
		$.post('fast_surf_c.php',{data11: code} ,  function(msg){
		document.getElementById("HintHits").innerHTML = msg;
		window.location.reload();
		} );
} else {
document.getElementById("HintHits").innerHTML = "<font size=4 color='red'> No ! </font>";
window.location.reload();
mywindow11.close();
}
}
function StartWindd() {
mywindow11 = window.open('<? echo $siteurlll;?>');
}
function DisplayTimer(){
	if (timerseconds >= 2 ) {
	timerseconds = timerseconds -1;
	document.getElementById("HintHits").innerHTML = "<font size=5 color='blue'>"+timerseconds+"</font>";
	setTimeout("DisplayTimer();", 1000);
	} else {
		if(mywindow11 == null || typeof(mywindow11) == "undefined" || mywindow11.closed) {
			document.getElementById("HintHits").innerHTML = "<font size=5 color='red'> Popup Disabled! </font>";
			releaseform = 1;
			setTimeout("window.location.reload();", 2000);
			mywindow11.close();
		} else {
			document.getElementById("HintHits").innerHTML = "<font size=5 color='green'> Click <b>GREEN</b> Button </font>";
			SendConfirm('<? echo $randclicker;?>', '<? echo $codeconfirmm;?>', '<? echo $iminstalled;?>');
		}
	}
}
</script>

</body>
</html>