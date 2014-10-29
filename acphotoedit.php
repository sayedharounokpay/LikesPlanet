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
$page = mysql_fetch_object(mysql_query("SELECT * FROM `photos2` WHERE `id`='{$id}' AND `user`='{$data->id}'"));

if(isset($_POST['edit'])){
mysql_query("UPDATE `photos2` SET `active`='{$protect['active']}', `cpc`='{$protect['cpc']}', `photo`='{$protect['url']}', `title`='{$protect['title1']}' WHERE `id`='{$id}'");
$msg = "<div class=\"msg_success\">Photo edited with success!</div>";
}
?>
<body> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="acphotos.php">Like Covers to Earn</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="acphotosadd.php">Add New Cover</a></li> 
	<li class="tab4"><a href="acphotosmy.php">My Covers</a></li> 
</ul>
</div>
<p>&nbsp;</p>



<h1>Edit My Photo Cover</h1>
<? echo $msg;?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 1px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="title">Title:</label></td><td width="50"></td><td><input type="text" name="title1" size="50" value=<? echo $page->title;?> ></td></tr>

<tr><td><label for="url2">URL:</label></td><td width="20"></td><td> <font color="blue"> <? echo $page->details;?> </font> </td></tr>

<tr><td><label for="url">Details:</label></td><td width="20"></td><td><textarea name="url" style="width:500px;height:150px;"><? echo $page->photo;?></textarea></td></tr>

<tr><td><label for="points">Payout</label></td><td width="20"></td><td><select name="cpc" id="points">
	<option value="2" <?if($page->cpc == 2){?>selected<?}?>>2</option>
	<option value="3" <?if($page->cpc == 3){?>selected<?}?>>3</option>
	<option value="4" <?if($page->cpc == 4){?>selected<?}?>>4</option>
	<option value="5" <?if($page->cpc == 5){?>selected<?}?>>5</option>
	<option value="6" <?if($page->cpc == 6){?>selected<?}?>>6</option>
	<option value="7" <?if($page->cpc == 7){?>selected<?}?>>7</option>
	<option value="8" <?if($page->cpc == 8){?>selected<?}?>>8</option>
	<option value="9" <?if($page->cpc == 9){?>selected<?}?>>9</option>
	<option value="10" <?if($page->cpc == 10){?>selected<?}?>>10</option>
	<option value="13" <?if($page->cpc == 13){?>selected<?}?>>13</option>
	<option value="15" <?if($page->cpc == 15){?>selected<?}?>>15</option>
	<option value="18" <?if($page->cpc == 18){?>selected<?}?>>18</option>
	<option value="20" <?if($page->cpc == 20){?>selected<?}?>>20</option>
	<option value="25" <?if($page->cpc == 25){?>selected<?}?>>25</option>
	<option value="30" <?if($page->cpc == 30){?>selected<?}?>>30</option>
</select></td></tr>

<tr><td><label for="status">Active</label></td><td width="20"></td><td><select name="active" id="status">
	<option value="0" <?if($page->active == 0){?>selected<?}?>>ON</option>
	<option value="1" <?if($page->active == 1){?>selected<?}?>>OFF</option>
</select></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="edit" value="Edit" class="submit" /></td></tr>
</table></center>
</form>

<script type="text/javascript"><!--
if (document.forms[0]){
if (document.forms[0].elements[0]){
	try{
		document.forms[0].elements[0].focus()
	}catch(e){}

<? include('footer.php');?>