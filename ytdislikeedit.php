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
$page = mysql_fetch_object(mysql_query("SELECT * FROM `ytdislike` WHERE `id`='{$id}' AND `user`='{$data->id}'"));

if(isset($_POST['edit'])){
if($_POST['title'] == ""){$msg = "<div class=\"msg_error\">ERROR: Title can't be empty!</div>";}
else if($_POST['cpc'] < 2){$msg = "<div class=\"msg_error\">ERROR: CPC Error!</div>";}
else if($_POST['cpc'] > 50){$msg = "<div class=\"msg_error\">ERROR: CPC Error!</div>";}
else{
mysql_query("UPDATE `ytdislike` SET `title`='{$protect['title']}', `active`='{$protect['active']}', `cpc`='{$protect['cpc']}', `top`='{$protect['smartstop']}'  WHERE (`id`='{$id}' AND `user`='{$data->id}')");
$msg = "<div class=\"msg_success\">Video edited with success!</div>";
}}
?>
<body> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="ytdislike.php">Earn Coins</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab2"><a href="addytdislike.php">Add Video</a></li> 
	<li class="tab3"><a href="ytdislikepages.php">My Videos</a></li> 
</ul>
</div>
<p>&nbsp;</p>



<h1>Edit Video</h1>
<? echo $msg;?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 1px dotted #ccc; padding: 20px; text-align: left;">
<tr><td><label for="url">Url</label></td><td width="20"></td><td>https://www.youtube.com/watch?v=<? echo $page->ytdislike;?></td></tr>
<tr><td><label for="title">Title</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="30" maxlength="40" value="<? echo $page->title;?>" /></td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="points">Points to give</label></td><td width="20"></td><td><select name="cpc" id="points">
	<option value="2" <?if($page->cpc == 2){?>selected<?}?>>2</option>
	<option value="3" <?if($page->cpc == 3){?>selected<?}?>>3</option>
	<option value="4" <?if($page->cpc == 4){?>selected<?}?>>4</option>
	<option value="5" <?if($page->cpc == 5){?>selected<?}?>>5</option>
	<option value="6" <?if($page->cpc == 6){?>selected<?}?>>6</option>
	<option value="7" <?if($page->cpc == 7){?>selected<?}?>>7</option>
	<option value="8" <?if($page->cpc == 8){?>selected<?}?>>8</option>
	<option value="9" <?if($page->cpc == 9){?>selected<?}?>>9</option>
	<option value="10" <?if($page->cpc == 10){?>selected<?}?>>10</option>
	<option value="11" <?if($page->cpc == 11){?>selected<?}?>>11</option>
	<option value="12" <?if($page->cpc == 12){?>selected<?}?>>12</option>
	<option value="13" <?if($page->cpc == 13){?>selected<?}?>>13</option>
	<option value="14" <?if($page->cpc == 14){?>selected<?}?>>14</option>
	<option value="15" <?if($page->cpc == 15){?>selected<?}?>>15</option>
	<option value="16" <?if($page->cpc == 16){?>selected<?}?>>16</option>
	<? if ($data->pr >0){ ?>
	<option value="17" <?if($page->cpc == 17){?>selected<?}?>>17</option>
	<option value="18" <?if($page->cpc == 18){?>selected<?}?>>18</option>
	<option value="19" <?if($page->cpc == 19){?>selected<?}?>>19</option>
	<option value="20" <?if($page->cpc == 20){?>selected<?}?>>20</option>
	<?}?>
</select></td></tr>
<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership!"</b> and unlock <b>20 cpc</b>, get likes even faster!</font></a><p>

<tr><td><label for="status">Status</label></td><td width="20"></td><td><select name="active" id="status">
	<option value="0" <?if($page->active == 0){?>selected<?}?>>ON</option>
	<option value="1" <?if($page->active == 1){?>selected<?}?>>OFF</option>
</select></td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="smartstop">Smart Stop:</label></td><td width="20"></td><td><input type="text" name="smartstop" id="smartstop" value="<? echo $page->top;?>"  size="40" maxlength="4" /></td></tr>
<tr><td colspan="2"></td><td>(0) means Do Not Stop automatically.</td></tr>
<tr><td colspan="2"></td><td>(100) means Stop when video reach 100 real dislikes on YouTube.</td></tr>
<tr><td colspan="2"></td><td>TOTAL DisLikes, NOT LikesASAP dislikes only.</td></tr>

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