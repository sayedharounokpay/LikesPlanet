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
$page = mysql_fetch_object(mysql_query("SELECT * FROM `surf` WHERE `id`='{$id}' AND `user`='{$data->id}'"));

if(isset($_POST['add'])){
if($_POST['coins'] > $data->coins){$message = "ERROR: You don't have enough coins!"; $message2 = 1;}
else if($_POST['coins'] < 1){$message = "ERROR: Please enter an valid number!"; $message2 = 1;}
else if(!is_numeric($_POST['coins'])){$message = "ERROR: Please enter an valid number!"; $message2 = 1;}
else{
    $validify=2;
    if($result = mysql_query("SELECT id FROM surf WHERE id='{$page->id}'")) {
        $rows = mysql_num_rows($result);
        if($rows >= 1)
        {
            $validify=1;
        }
        else {
            $message = "ERROR: Do not steal points";
            $message2=1;
        }
    }
    else {
        $message = "ERROR: Database Offline.";
        $message2=1;
    }
    if($page->id < 1){
        $validify = 2;
    }
    if($validify == 1){
mysql_query("UPDATE `surf` SET `points`=`points`+'{$protect['coins']}' WHERE `id`='{$id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$protect['coins']}' WHERE `id`='{$data->id}'");
$message = "Coins added with success!"; $message2 = 2;
    }
}}
?>
<body> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="surf.php">Earn Points to Promote</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab2"><a href="addsurf.php">Add Website to Promote</a></li> 
	<li class="tab3"><a href="surfpages.php">My Websites</a></li> 
</ul>
</div>
<p>&nbsp;</p>



<h1>Add coins</h1>

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
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 1px dotted #ccc; padding: 20px; text-align: left;">
<tr><td><label for="url">Website</label></td><td width="20"></td><td><? echo $page->surf;?></td></tr>
<tr><td><label for="added">Added points</label></td><td width="20"></td><td><? echo $page->points;?></td></tr>
<tr><td><label for="add">Add</label></td><td width="20"></td><td><input type="text" name="coins" id="add" size="3" maxlength="5" value="0" /> points</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add points" class="submit" /></td></tr>
</table></center>
</form>
<? include('footer.php');?>