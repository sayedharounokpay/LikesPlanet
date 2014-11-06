<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$id = $get['id'];
$page = mysql_fetch_object(mysql_query("SELECT * FROM `adsb` WHERE `id`='{$id}' AND `user_id`='{$data->id}'"));

if(isset($_POST['add'])){
if($_POST['coins'] > $data->coins){$msg = "<div class=\"msg_error\">ERROR: You don't have enough Points!</div>";}
else if($_POST['coins'] < 1){$msg = "<div class=\"msg_error\">ERROR: You don't have enough Points!</div>";}
else if(!is_numeric($_POST['coins'])){$message = "Invalid number!"; $message2 = 1;}

else{

if ($page->isclicks == '0') {
	if ($data->pr > 0) {
	mysql_query("UPDATE `adsb` SET `points`=`points`+'{$protect['coins']}'*40 WHERE `id`='{$id}'"); }
	else { mysql_query("UPDATE `adsb` SET `points`=`points`+'{$protect['coins']}'*20 WHERE `id`='{$id}'"); }
}

if ($page->isclicks == '1') {
	if ($data->pr > 0) {
	mysql_query("UPDATE `adsb` SET `clx`=`clx`+'{$protect['coins']}'/10 WHERE `id`='{$id}'"); }
	else {mysql_query("UPDATE `adsb` SET `clx`=`clx`+'{$protect['coins']}'/20 WHERE `id`='{$id}'");}
}

mysql_query("UPDATE `users` SET `coins`=`coins`-'{$protect['coins']}' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_deducted,ads,log,page) VALUES ({$data->id},NOW(),{$protect['coins']},1,'Points Added To Instagram Photo Likes: {$site->id}','adsbcoins.php')");
$msg = "<div class=\"msg_success\">Credits added with Success!</div>";

}

}
?>
<body> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="adsadd.php">Add New Text Ads</a></li> 
	<li class="tab2"><a href="adsmy.php">My Text Ads</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp; </li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="adsbadd.php">Add New Banner Ads</a></li> 
	<li class="tab4"><a href="adsbmy.php">My Banner Ads</a></li> 
</ul>
</div>
<p>&nbsp;</p>



<h1>Add Poins</h1>
<? echo $msg;?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 1px dotted #ccc; padding: 20px; text-align: left;">
<tr><td><label for="url">Ads Title</label></td><td width="20"></td><td><? echo $page->title;?></td></tr>

<tr><td><label for="points">Points to Add:</label></td><td width="20"></td><td><select name="coins" id="coins">
	<? if ($page->isclicks == '0') {
	if ($data->pr == 0){ ?>
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
	<?}
	} else {
	if ($data->pr == 0){ ?>
	<option value="300">300 Points for 15 Clicks</option>
	<option value="400">400 Points for 20 Clicks</option>
	<option value="500">500 Points for 25 Clicks</option>
	<option value="1000">1000 Points for 50 Clicks</option>
	<option value="2000">2000 Points for 100 Clicks</option>
	<?} else {?>
	<option value="60">60 Points for 6 Clicks</option>
	<option value="100">100 Points for 10 Clicks</option>
	<option value="200">200 Points for 20 Clicks</option>
	<option value="300">300 Points for 30 Clicks</option>
	<option value="400">400 Points for 40 Clicks</option>
	<option value="500">500 Points for 50 Clicks</option>
	<option value="1000">1000 Points for 100 Clicks</option>
	<?} }?>
</select></td></tr>
<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership!"</b> and advertise <b>x2 Cheaper!</b> </font></a><p>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add Points" class="submit" /></td></tr>
</table></center>
</form>
<? include('footer.php');?>