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
$page = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE `id`='{$id}' AND `user`='{$data->id}'"));

if(isset($_POST['edit'])){

if($_POST['cpc'] < 2) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 15) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 10 && $data->pr == 0) {$message = "CPC Problem!"; $message2 = 1;}

else if($_POST['title'] == ""){$message = "Title can Not be empty!"; $message2 = 1;}
else{
mysql_query("UPDATE `facebook` SET `title`='{$protect['title']}', `active`='{$protect['active']}', `cpc`='{$protect['cpc']}', `target`='{$protect['setcountry11']}', `top`='{$protect['smartstop']}', `keep`='{$protect['keep']}' WHERE (`id`='{$id}' AND `user`='{$data->id}') ");
$message = "Page Edited with success!"; $message2 = 2;
}}
?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="fbstdlikes.php">Earn Points</a></li> 
	<li class="tab2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab2"><a href="addfb.php">Add Facebook Page</a></li> 
	<li class="tab3"><a href="fbpages.php">My Pages</a></li> 
</ul>
</div>


<h1>Edit Facebook Page</h1>
<p>You can change CPC or Page title.</p>
<p>Choosing the best CPC is very important. The higher the CPC chosen the higher you will show up on the list and the more Credits the person liking your pages will recieve, however you will lose more points.</p>
<p>You can set Active 'OFF' to Stop getting likes.</p>
<p>If your page is Closed (Shows in RED), then Set 'Active' ON to Activate it again.</p>

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
<tr><td><label for="url">Page URL</label></td><td width="20"></td><td><? echo $page->facebook;?></td></tr>
<tr><td><label for="title">Title</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="30" maxlength="25" value="<? echo $page->title;?>" /></td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="points">Points per Like (CPC):</label></td><td width="20"></td><td><select name="cpc" id="points" onchange="RefBefore(this.value);">
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
<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership"</b> and unlock <b>15 CPC</b>, get likes even faster!</font></a><p>

<tr><td></td><td></td><td>
<center><iframe id='pagesbeforeii' name="pagesbeforeii" src="getpagesbefore.php?type=fb&cpc=<? echo $page->cpc;?>"
        scrolling="no" frameborder="0"
        style="border:none; width:400px; height:28px"></iframe></center>
</td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="smartstop">Smart Stop:</label></td><td width="20"></td><td><input type="text" name="smartstop" id="smartstop" value="<? echo $page->top;?>"  size="40" maxlength="8" /></td></tr>
<tr><td colspan="2"></td><td>(0) means Do Not Stop automatically.</td></tr>
<tr><td colspan="2"></td><td>(100) means Stop when page reach 100 real likes on Facebook.</td></tr>
<tr><td colspan="2"></td><td>* TOTAL Likes, NOT LikesPlanet likes only.</td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="status">Active:</label></td><td width="20"></td><td><select name="active" id="status">
	<option value="0" <?if($page->active == 0){?>selected<?}?>>ON</option>
	<option value="1" <?if($page->active == 1){?>selected<?}?>>OFF</option>
</select></td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="keep">Anti-Reports</label></td><td width="20"></td><td><select name="keep" id="keep">
	<option value="0" <?if($page->keep == 0){?>selected<?}?>>Off - Pause page when it has reports.</option>
	<option value="1" <?if($page->keep == 1){?>selected<?}?>>ON - KEEP Page Active even if it has reports.</option>
</select></td></tr>
<tr><td colspan="2"></td><td>If your page stop automatically, Set 'Anti Report' = ON.</td></tr>
<tr><td colspan="2"></td><td>Your Page will Stay Active even if it got reports. (set SmartStop=0)</td></tr>
<tr><td colspan="2"></td><td>This option costs +1 Point for Each like. (Likers will get upset)</td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td colspan="2"></td><td><input type="submit" name="edit" value="Edit Page Setting" class="submit" style="width: 270px; height: 38px;"  /></td></tr>
</table></center>

<center>
<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>
<p>Target Likes :  <select name="target" id="target">
	<? 
	$targetlist1 = mysql_query("SELECT * FROM `target` ORDER BY `num` DESC");
	echo "<option value=WWW>All World</option>";
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

<center>
<p><input type="submit" name="insert" value="Add Country" class="submit" onclick="AddCountry();" /></p>
</center>

<? } ?>

<script language=javascript>
function RefBefore(CPCset) { 
var aaa = "getpagesbefore.php?type=fb&cpc=" + CPCset;
document.getElementById("pagesbeforeii").src = aaa;
}
function AddCountry() {
var myindex = document.getElementById("target").selectedIndex;
var SelValue = document.getElementById("target").options[myindex].value;
if (SelValue != 'WWW') {
document.getElementById("setcountry11").value = document.getElementById("setcountry11").value + SelValue ;
} else {
document.getElementById("setcountry11").value = '' ;
}
}
</script>

<script type="text/javascript"><!--
if (document.forms[0]){
if (document.forms[0].elements[0]){
	try{
		document.forms[0].elements[0].focus()
	}catch(e){}
}}
</script>

<? include('footer.php');?>