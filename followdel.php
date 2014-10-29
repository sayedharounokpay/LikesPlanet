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
$page = mysql_fetch_object(mysql_query("SELECT * FROM `follow` WHERE `id`='{$id}' AND `user`='{$data->id}'"));

if(isset($_POST['add'])){
if($page->id > 1) {
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$page->points}' WHERE `id`='{$page->user}'");
mysql_query("UPDATE `follow` SET `points`='0' WHERE `id`='{$id}'");
mysql_query("DELETE FROM `follow` WHERE `id`='{$id}'");
mysql_query("DELETE FROM `followed` WHERE `site_id`='{$id}'");
mysql_query("UPDATE `users` SET `beforeref`=`coins` WHERE `id`='{$data->id}'");

$msg = "<div class=\"msg_success\">Deleted with success!</div>";
}}

?>
<body> 
<div>
<ul id="tabnav"> 
	<li class="tab2"><a href="follow.php">Earn Points</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="addfollow.php">Add Profile</a></li> 
	<li class="tab4"><a href="followpages.php">My Profiles</a></li> 
</ul>
</div>
<p>&nbsp;</p>



<h1>Delete Twitter Profile</h1>

<? echo $msg;?>

<? if ($msg == '') {
if($page->id > 1) { ?>

<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 1px dotted #ccc; padding: 20px; text-align: left;">
<tr><td><label for="url">Are you sure You want to Delete It ?</label></td><td width="20"></td><td></td></tr>
<tr><td><label for="add"><font color='blue'><b><? echo $page->title;?></b></font></label></td><td width="20"></td><td></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" style="background: #FF0000; border-radius: 10px;" name="add" value="Delete" class="submit" /></td></tr>
</table></center>
</form>

<? }} ?>

<? include('footer.php');?>