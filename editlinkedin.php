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
$page = mysql_fetch_object(mysql_query("SELECT * FROM `linkedin` WHERE `id`='{$id}' AND `user`='{$data->id}'"));

if(isset($_POST['edit'])){
if($_POST['cpc'] < 2) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 15) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 10 && $data->pr == 0) {$message = "CPC Problem!"; $message2 = 1;}

else if($_POST['title'] == ""){$message = "Title can Not be empty!"; $message2 = 1;}
else{
mysql_query("UPDATE `linkedin` SET `title`='{$protect['title']}', `active`='{$protect['active']}', `cpc`='{$protect['cpc']}', `target`='{$protect['setcountry11']}' WHERE (`id`='{$id}' AND `user`='{$data->id}')");
$message = "Page Edited with success!"; $message2 = 2;
}}
?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="linkedin.php">Earn Coins</a></li> 
	<li class="tab2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab2"><a href="addlinkedin.php">Add Website</a></li> 
	<li class="tab3"><a href="linkedinpages.php">My Websites</a></li> 
</ul>
</div>


<h1>Edit Linkedin Share Website</h1>
<p>You can change CPC or Website title.</p>
<p>Choosing the best CPC is very important. The higher the CPC chosen the higher you will show up on the list and the more Points the person sharing your sites will recieve, however you will lose more points.</p>
<p>You can set Status 'OFF' to Stop getting shares.</p>
<p>If your site is Closed (Shows in RED), then Set 'Status' ON to Activate it again.</p>

<div class="clearer">&nbsp;</div>

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

<? if ($message2 != 2) {?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 4px dotted #ccc; padding: 20px; text-align: left;">
<tr><td><label for="url">Website URL</label></td><td width="20"></td><td><? echo $page->linkedin;?></td></tr>
<tr><td><label for="title">Title</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="30" maxlength="25" value="<? echo $page->title;?>" /></td></tr>
<tr><td><label for="points">Points per Share (CPC):</label></td><td width="20"></td><td><select name="cpc" id="points">
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
<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership!"</b> and unlock <b>15 cpc</b>, get shares even faster!</font></a><p>

<tr><td><label for="status">Status</label></td><td width="20"></td><td><select name="active" id="status">
	<option value="0" <?if($page->active == 0){?>selected<?}?>>ON</option>
	<option value="1" <?if($page->active == 1){?>selected<?}?>>OFF</option>
</select></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="edit" value="Edit Website Setting" class="submit" style="width: 270px; height: 38px;" /></td></tr>
</table></center>

<center>
<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>
<p>Target Likes :  <select name="target" id="target">
	<? 
	$targetlist1 = mysql_query("SELECT * FROM `target` ORDER BY `num` DESC");
	for($jt=1; $targetlist = mysql_fetch_object($targetlist1); $jt++)
	{
	echo "<option value=" . $targetlist->country . ">" . $targetlist->title . "</option>";
	}
	 ?>
</select></p>
<p><input type="text" name="setcountry11" id="setcountry11" value="<? echo $page->target;?>" size="40" maxlength="70" /></p>
<p>Leave target box Empty to get likes from ALL World.</p>
</center>

</form>

<script language=javascript>
function AddCountry() {
var myindex = document.getElementById("target").selectedIndex;
var SelValue = document.getElementById("target").options[myindex].value;
document.getElementById("setcountry11").value = document.getElementById("setcountry11").value + SelValue ;
}
</script>

<center>
<p><input type="submit" name="insert" value="Add Country" class="submit" onclick="AddCountry();" /></p>
</center>

<? } ?>

<script type="text/javascript"><!--
if (document.forms[0]){
if (document.forms[0].elements[0]){
	try{
		document.forms[0].elements[0].focus()
	}catch(e){}
}}
</script>

<? include('footer.php');?>