<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){

$mysql_num_rows = 0;
$verificare1 = mysql_query("SELECT * FROM `alexagoogle` WHERE `url`='{$_POST['url']}'");
$verificare = mysql_num_rows($verificare1);
if($verificare > 0) {$message = "Error: Website/Page Added by another user!</br>If you are Website Owner, please Contact us to add."; $message2 = 1;}

else if($_POST['title'] == "") {$message = "Website Title can Not be empty!"; $message2 = 1;}

else if($_POST['keyword'] == "") {$message = "Website Keywords can Not be empty!"; $message2 = 1;}

else{
mysql_query("INSERT INTO `alexagoogle` (user, url, title, keyword) VALUES('{$data->id}', '{$protectie['url']}', '{$protectie['title']}', '{$protectie['keyword']}'  ) ");

$message = "Website Added with success!"; $message2 = 2;

}}
?>
<body id="tab2"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="alexagoogle.php">My Websites</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab2"><a href="alexagoogle_add.php">Add New Website</a></li>  
</ul>
</div>
<h1>Add New Website</h1>
<p>You can add Websites here to boost up your Alexa.</p>

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
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 4px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="title">Website Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="40" maxlength="20" /></td></tr>
<tr><td><label for="url">Website URL:</label></td><td width="20"></td><td><input type="text" name="url" id="url" size="40" maxlength="150" value="http://" /></td></tr>
<tr><td><label for="url">Keywords:</label></td><td width="20"></td><td><input type="text" name="keyword" id="keyword" size="40" maxlength="150" value="keyword1, keyword2, keyword3" /></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add Website" class="submit" style="width: 270px; height: 38px;" /></td></tr>
</table></center>
</form>
<? include('footer.php');?>