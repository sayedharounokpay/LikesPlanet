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

if(isset($_POST['add'])){
if($page->id != "") {
$page2 = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE `id`='{$id}' AND `user`='{$data->id}'"));
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$page2->points}' WHERE `id`='{$page2->user}'");
mysql_query("UPDATE `facebook` SET `points`='0' WHERE `id`='{$id}'");
mysql_query("DELETE FROM `facebook` WHERE `id`='{$id}'");
mysql_query("DELETE FROM `liked` WHERE `site_id`='{$id}'");
mysql_query("UPDATE `users` SET `beforeref`=`coins` WHERE `id`='{$data->id}'");

$msg = "<div class=\"msg_success\">Deleted with success!</div>";
}}

?>
<body> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="fbstdlikes.php">Earn Points</a></li> 
	<li class="tab2"><a href="addfb.php">Add Facebook Page</a></li> 
	<li class="tab3"><a href="fbpages.php">My Pages</a></li> 
</ul>
</div>
<p>&nbsp;</p>



<h1>Delete Facebook Page</h1>

<? echo $msg;?>

<? if ($msg == '') {
if($page->id != "") { ?>

<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 4px dotted #ccc; padding: 20px; text-align: left;">
<tr><td><label for="url">If you need more likes in future, Do NOT Delete.</label></td><td width="20"></td><td></td></tr>
<tr><td><label for="url">Are you sure You want to Delete It ?</label></td><td width="20"></td><td></td></tr>
<tr><td><label for="add"><font color='blue'><b><? echo $page->title;?></b></font></label></td><td width="20"></td><td></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" style="background: #FF0000; border-radius: 10px;" name="add" value="Delete" class="submit" /></td></tr>
</table></center>
</form>

<? }} ?>

<? include('footer.php');?>