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
$page = mysql_fetch_object(mysql_query("SELECT * FROM `ads` WHERE `id`='{$id}' AND `user_id`='{$data->id}'"));

if(isset($_POST['edit'])){
if($_POST['title'] == ""){$msg = "<div class=\"msg_error\">ERROR: Title can't be empty!</div>";}
else if($_POST['url'] == ""){$msg = "<div class=\"msg_error\">ERROR: URL can't be empty!</div>";}
else{
mysql_query("UPDATE `ads` SET `title`='{$protect['title']}', `active`='{$protect['active']}', `url`='{$protect['url']}' WHERE (`id`='{$id}' AND `user_id`='{$data->id}' )");
$msg = "<div class=\"msg_success\">Text Ads edited with Success!</div>";
}}
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



<h1>Edit Your Text Ads</h1>
<? echo $msg;?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 1px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="title">Title</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="30" maxlength="100" value="<? echo $page->title;?>" /></td></tr>
<tr><td><label for="url">URL</label></td><td width="20"></td><td><input type="text" name="url" id="url" size="30" value="<? echo $page->url;?>" /></td></tr>

<tr><td><label for="status">Status</label></td><td width="20"></td><td><select name="active" id="status">
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