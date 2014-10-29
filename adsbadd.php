<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}

if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){

function blockedsites($text) {
    $bannedWords = array('socialbirth', 'addmefast', 'youlikehits', 'shareyt', 'likerr', 'netlikes', 'get2gathers', 'freefblike', 'anhits', 'gimmehits', 'clicksocialexchange', 'growsociallikes', 'socialskive', 'hitger', 'wanafans', 'yaa1', 'likesniper', 'like-ex', 'fbtwister', 'seoclerks', 'fanslave', 'addm', 'googleglassessupplier', 'fan-likes', 'socialworld', 'youlikefan', 'atodoweb', 'todagalicia', 'youlikefans', 'likeyou', 'exchanger', 'fiverr', 'shorthit', 'followerslikehits', 'socialpromo', 'bit.ly', 'ewsaly', 'likesasap', 'hitserr', 'advertcash', 'addm.cc', 'any.gs', 'wantmorelikes', 'likescowboy', 'socialtrade', 'fanporfan', 'likesrd', 'social-mediapromotion.com', 'globallikers', 'hypes', 'hypesplanet', 'drlikes') ;
    foreach ($bannedWords as $bannedWord) {
        if (strpos($text, $bannedWord) !== false) {
            return false ;}}
    return true;
   }
   
$replacedText = blockedsites($protectie['url']);
$replacedText2 = blockedsites($protectie['urlb']);

if ($replacedText === false AND $data->agent == 0) {
$message = 'Sorry, This site is not allowed to be added on this network!'; $message2 = 1;
} else if ($replacedText2 === false AND $data->agent == 0) {
$message = 'Sorry, This site is not allowed to be added on this network!'; $message2 = 1;
} else {

mysql_query("INSERT INTO `adsb` (user_id, title, url, urlb, points, active, isclicks) VALUES('{$data->id}', '{$protectie['title']}', '{$protectie['url']}', '{$protectie['urlb']}', '0', '0', '{$protectie['system']}' ) ");

$message = "Banner Ads added with Success!</br>You have to ADD Points to your banner! Click on My Banners tab."; $message2 = 2;

}

}
?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="adsadd.php">Add New Text Ads</a></li> 
	<li class="tab2"><a href="adsmy.php">My Text Ads</a></li> 
	<li class="tab3"><a href="adsbadd.php">Add New Banner Ads</a></li> 
	<li class="tab4"><a href="adsbmy.php">My Banner Ads</a></li> 
</ul>

</div>
<h1>Add New Banner Ads</h1>
<p>You can Add Banner Ads here, By using your points to advertise.</p>
<p>Your Banner Ads will apear in All pages of LikesASAP!</p>

<? echo $msg; ?>
<? if ($message2 == 1) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>
<? if ($message2 == 2) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_done.jpg?a" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='green' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>

<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="padding: 20px; text-align: left;">

<tr><td><label for="title">Ads Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="40" maxlength="100" /></td></tr>
<tr><td><label for="url">Ads URL:</label></td><td width="20"></td><td><input type="text" name="url" id="url" size="40" maxlength="200" value="http://" /></td></tr>
<tr><td><label for="url0">Banner URL:</label></td></tr>
<tr><td><label for="urlb">Banner should be (468 x 60)px.</label></td> <td width="20"></td><td><input type="text" name="urlb" id="url" size="40" maxlength="200" value="http://" /></td> </tr>

<tr><td><label for="points">Visitors System:</label></td><td width="20"></td><td><select name="system" id="points">
	<? if ($data->pr == 0) {?>
	<option value="0">Pay points per Views (20 views per 1 point)</option>
	<option value="1">Pay points per Clicks (1 click for 20 points)</option>
	<? } ?>
	<? if ($data->pr > 0) {?>
	<option value="0">Pay points per Views (40 views per 1 point)</option>
	<option value="1">Pay points per Clicks (1 click for 10 points)</option>
	<? } ?>
</select></td></tr>
<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership!"</b> and advertise <b>x2 Cheaper!</b> </font></a><p>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add" class="submit" /></td></tr>
</table></center>
</form>
<? include('footer.php');?>
