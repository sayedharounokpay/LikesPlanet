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
$page = mysql_fetch_object(mysql_query("SELECT * FROM `directlink` WHERE `id`='{$id}' AND `user`='{$data->id}'"));

if(isset($_POST['edit'])){
if($_POST['cpc'] < 2) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 15) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 10 && $data->pr == 0) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['title'] == ""){$message = "Title can Not be empty!"; $message2 = 1;}
else{
mysql_query("UPDATE `directlink` SET `title`='{$protect['title']}', `active`='{$protect['active']}', `cpc`='{$protect['cpc']}' WHERE (`id`='{$id}' AND `user`='{$data->id}')");
$message = "Page Edited with success!"; $message2 = 2;
}}
?>
<body> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="direct.php">Earn Coins</a></li> 
	<li class="tab2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab2"><a href="adddirect.php">Add Website</a></li> 
	<li class="tab3"><a href="directpages.php">My Websites</a></li> 
</ul>
</div>
<p>&nbsp;</p>



<h1>Edit Website URL</h1>

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
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 4px dotted #ccc; padding: 20px; text-align: left;">
<tr><td><label for="url">URL:</label></td><td width="20"></td><td><? echo $page->directlink;?></td></tr>
<tr><td><label for="title">Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="30" maxlength="40" value="<? echo $page->title;?>" /></td></tr>
<tr><td><label for="points">Points to give</label></td><td width="20"></td><td><select name="cpc" id="points">
	<option value="2" style="background-color: #FF9999;" <?if($page->cpc == 2){?>selected<?}?>>2</option>
	<option value="3" style="background-color: #FF9999;" <?if($page->cpc == 3){?>selected<?}?>>3</option>
	<option value="4" style="background-color: #FF9999;" <?if($page->cpc == 4){?>selected<?}?>>4</option>
	<option value="5" style="background-color: #9999FF;" <?if($page->cpc == 5){?>selected<?}?>>5</option>
	<option value="6" style="background-color: #9999FF;" <?if($page->cpc == 6){?>selected<?}?>>6</option>
	<option value="7" style="background-color: #9999FF;" <?if($page->cpc == 7){?>selected<?}?>>7</option>
	<option value="8" style="background-color: #99FF99;" <?if($page->cpc == 8){?>selected<?}?>>8</option>
	<option value="9" style="background-color: #99FF99;" <?if($page->cpc == 9){?>selected<?}?>>9</option>
	<option value="10" style="background-color: #99FF99;" <?if($page->cpc == 10){?>selected<?}?>>10</option>
	<? if ($data->pr >0){ ?>
	<option value="11" style="background-color: #FFFF00;" <?if($page->cpc == 11){?>selected<?}?>>11 [VIP]</option>
	<option value="12" style="background-color: #FFFF00;" <?if($page->cpc == 12){?>selected<?}?>>12 [VIP]</option>
	<option value="13" style="background-color: #FFFF00;" <?if($page->cpc == 13){?>selected<?}?>>13 [VIP]</option>
	<option value="14" style="background-color: #FFFF00;" <?if($page->cpc == 14){?>selected<?}?>>14 [VIP]</option>
	<option value="15" style="background-color: #FFFF00;" <?if($page->cpc == 15){?>selected<?}?>>15 [VIP]</option>
	<?}?>
</select></td></tr>
<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership!"</b> and unlock <b>15 cpc</b>, get visitors even faster!</font></a><p>

<tr><td><label for="status">Status</label></td><td width="20"></td><td><select name="active" id="status">
	<option value="0" <?if($page->active == 0){?>selected<?}?>>ON</option>
	<option value="1" <?if($page->active == 1){?>selected<?}?>>OFF</option>
</select></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="edit" value="Edit Website Setting" class="submit" style="width: 270px; height: 38px;"  /></td></tr>
</table></center>
</form>

<script type="text/javascript"><!--
if (document.forms[0]){
if (document.forms[0].elements[0]){
	try{
		document.forms[0].elements[0].focus()
	}catch(e){}
}}
</script>

<? include('footer.php');?>