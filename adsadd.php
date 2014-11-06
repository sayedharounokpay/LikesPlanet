<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}

if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){

function blockedsites($text) {
    $bannedWords = array('socialbirth', 'addmefast', 'youlikehits', 'shareyt', 'likerr', 'netlikes', 'get2gathers', 'freefblike', 'anhits', 'gimmehits', 'clicksocialexchange', 'growsociallikes', 'socialskive', 'hitger', 'wanafans', 'yaa1', 'likesniper', 'like-ex', 'fbtwister', 'seoclerks', 'fanslave', 'addm', 'googleglassessupplier', 'fan-likes', 'socialworld', 'youlikefan', 'atodoweb', 'todagalicia', 'youlikefans', 'likeyou', 'exchanger', 'fiverr', 'shorthit', 'followerslikehits', 'socialpromo', 'bit.ly', 'ewsaly', 'likesasap', 'hitserr', 'advertcash', 'addm.cc', 'any.gs', 'wantmorelikes', 'likescowboy', 'socialtrade', 'fanporfan', 'likesrd', 'social-mediapromotion.com', 'globallikers', 'hypes', 'hypesplanet', 'likeitnow', 'drlikes') ;
    foreach ($bannedWords as $bannedWord) {
        if (strpos($text, $bannedWord) !== false) {
            return false ;}}
    return true;
   }
   
$replacedText = blockedsites($protectie['url']);
$replacedText2 = blockedsites($protectie['title']);

if ($replacedText === false AND $data->agent == 0) {
$message = 'Sorry, This site is not allowed to be added on this network!'; $message2 = 1;
} else if ($replacedText2 === false AND $data->agent == 0) {
$message = 'Sorry, This site is not allowed to be added on this network!'; $message2 = 1;
} else {

if ($_POST['cpc'] > 49){
// Add my coins to this page
if ($_POST['cpc'] <= $data->coins){

if ($data->pr > 0){
mysql_query("INSERT INTO `ads` (user_id, title, url, points) VALUES('{$data->id}', '{$protectie['title']}', '{$protectie['url']}', '{$protectie['cpc']}'*40 ) ");
} else {
mysql_query("INSERT INTO `ads` (user_id, title, url, points) VALUES('{$data->id}', '{$protectie['title']}', '{$protectie['url']}', '{$protectie['cpc']}'*20 ) ");
}

mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['cpc']}' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_deducted,ads,log,page) VALUES ({$data->id},NOW(),{$_POST['cpc']},1,'Points Added To Text Ads','adsadd.php')");
$message = "Text Ads added with Success!"; $message2 = 2;
}

else{
$message = "Error: You don't have enough points to add your Text Ads!"; $message2 = 1;
}

}
}

}
?>
<body id="tab1"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="adsadd.php">Add New Text Ads</a></li> 
	<li class="tab2"><a href="adsmy.php">My Text Ads</a></li> 
	<li class="tab3"><a href="adsbadd.php">Add New Banner Ads</a></li> 
	<li class="tab4"><a href="adsbmy.php">My Banner Ads</a></li> 
</ul>

</div>
<h1>Add New Text Ads</h1>
<p>You can Add Text Ads here, By using your points to advertise.</p>
<p>Your Ads will apear in All pages of LikesASAP!</p>

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
<tr><td><label for="points">Points to Add:</label></td><td width="20"></td><td><select name="cpc" id="points">
	<? if ($data->pr == 0){ ?>
	<option value="200">200 Points for 4,000 Views</option>
	<option value="300">300 Points for 6,000 Views</option>
	<option value="400">400 Points for 8,000 Views</option>
	<option value="500">500 Points for 10,000 Views</option>
	<option value="1000">1000 Points for 20,000 Views</option>
	<?} else {?>
	<option value="50">50 Points for 2,000 Views</option>
	<option value="100">100 Points for 4,000 Views</option>
	<option value="200">200 Points for 8,000 Views</option>
	<option value="300">300 Points for 12,000 Views</option>
	<option value="400">400 Points for 16,000 Views</option>
	<option value="500">500 Points for 20,000 Views</option>
	<option value="1000">1000 Points for 40,000 Views</option>
	<?}?>
</select></td></tr>
<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership!"</b> and advertise <b>x2 Cheaper!</b> </font></a><p>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add" class="submit" /></td></tr>
</table></center>
</form>
<? include('footer.php');?>