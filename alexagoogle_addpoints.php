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
$page = mysql_fetch_object(mysql_query("SELECT * FROM `alexagoogle` WHERE `id`='{$id}' AND `user`='{$data->id}'"));

if(isset($_POST['add'])){
if($_POST['coins'] > $data->coins){$message = "ERROR: You don't have enough Points!"; $message2 = 1;}
else if($_POST['coins'] < 0){$message = "ERROR: Please enter an valid number! minimum is 0 Points."; $message2 = 1;}
else if($_POST['mana'] > $data->mana){$message = "ERROR: You don't have enough Mana!"; $message2 = 1;}
else if($_POST['mana'] < 0){$message = "ERROR: Please enter an valid number! minimum is 0 Mana."; $message2 = 1;}
else if(!is_numeric($_POST['coins'])){$message = "ERROR: Please enter an valid number!"; $message2 = 1;}
else if(!is_numeric($_POST['mana'])){$message = "ERROR: Please enter an valid number!"; $message2 = 1;}
else{
mysql_query("UPDATE `alexagoogle` SET `points`=`points`+'{$protect['coins']}'*10 WHERE ( `id`='{$id}' AND `user`='{$data->id}' ) ");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$protect['coins']}' WHERE `id`='{$data->id}'");

mysql_query("UPDATE `alexagoogle` SET `points`=`points`+'{$protect['mana']}' WHERE `id`='{$id}'");
mysql_query("UPDATE `users` SET `mana`=`mana`-'{$protect['mana']}' WHERE `id`='{$data->id}'");

$message = "Points/Mana added with success!"; $message2 = 2;
}}
?>
<body id="tab1"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="alexagoogle.php">My Websites</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab2"><a href="alexagoogle_addpoints.php">Add Points/Hours</a></li>  
</ul>
</div>
<p>&nbsp;</p>



<h1>Add Traffic Points</h1>
<p>You can Add Credits by using your LikesPlanet <a href="help.php" target="_blank">Points</a>, or by using Mana you earned by <a href="fast_surf.php" target="_blank"> surfing websites in Alexa system</a>.</p>
<p>MANA is a kind of Points, but it can be used to get Alexa Traffic only.</p>
<p>POINT is better than MANA, because Point can be used in All systems, but MANA is special for Alexa traffic only.</p>

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
<tr><td><img src="img/planet_done.jpg?a" border="0" title="LikesPlanet.com - Done"></td><td width="20"></td><td> <font color='green' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>

<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 1px dotted #ccc; padding: 20px; text-align: left;">
<tr><td><label for="url">Website</label></td><td width="20"></td><td><? echo $page->url;?></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><label for="add">Add</label></td><td width="20"></td><td><input type="text" name="coins" id="add" size="3" maxlength="5" value="0" /> Points</td></tr>
<tr><td><label for="add"></label></td><td width="20"></td><td>1 Point = 10 Traffic</td></tr>
<tr><td><label for="add"></label></td><td width="20"></td><td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font color='blue'>OR</font> </td></tr>
<tr><td><label for="add">Add</label></td><td width="20"></td><td><input type="text" name="mana" id="add" size="3" maxlength="5" value="0" /> Mana</td></tr>
<tr><td><label for="add"></label></td><td width="20"></td><td>1 Mana = 1 Traffic</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add Credits" class="submit" /></td></tr>
</table></center>
</form>
<? include('footer.php');?>