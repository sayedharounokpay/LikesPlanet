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
$page = mysql_fetch_object(mysql_query("SELECT * FROM `google` WHERE `id`='{$id}' AND `user`='{$data->id}'"));

if(isset($_POST['add'])){
if($_POST['coins'] > $page->points ) {$msg = "<div class=\"msg_error\">ERROR: No Enough Coins in your Page!</div>";}
else if(!is_numeric($_POST['coins'])){$msg = "<div class=\"msg_error\">ERROR: Please enter an valid number!</div>";}
else{
mysql_query("UPDATE `google` SET `points`=`points`-'{$protect['coins']}' WHERE `id`='{$id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$protect['coins']}' WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `beforeref`=`coins` WHERE `id`='{$data->id}'");
$msg = "<div class=\"msg_success\">Coins retracted with success!</div>";
}}
?>
<body> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="google.php">Earn Coins</a></li> 
	<li class="tab2"><a href="addg.php">Add Website</a></li> 
	<li class="tab3"><a href="gpages.php">Your Websites</a></li> 
</ul>
</div>
<p>&nbsp;</p>



<h1>Retract coins</h1>
<? echo $msg;?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 1px dotted #ccc; padding: 20px; text-align: left;">
<tr><td><label for="url">Site</label></td><td width="20"></td><td><? echo $page->google;?></td></tr>
<tr><td><label for="added">Added points</label></td><td width="20"></td><td><? echo $page->points;?></td></tr>
<tr><td><label for="add">Retract</label></td><td width="20"></td><td><input type="text" name="coins" id="add" size="3" maxlength="5" value="0" /> points</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Retract points" class="submit" /></td></tr>
</table></center>
</form>
<? include('footer.php');?>