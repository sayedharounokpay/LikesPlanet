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
$page = mysql_fetch_object(mysql_query("SELECT * FROM `reverb` WHERE `id`='{$id}' AND `user`='{$data->id}'"));

if(isset($_POST['add'])){
if($_POST['coins'] > $data->coins){$message = "You do Not have enough points on balance!"; $message2 = 1;}
else if($_POST['coins'] < 49) {$message = "You should add 50 Points at least!"; $message2 = 1;}
else if($_POST['coins'] < 1){$message = "Please enter an valid number!"; $message2 = 1;}
else if(!is_numeric($_POST['coins'])){$message = "Please enter an valid number!"; $message2 = 1;}
else{
    $validify=2;
    if($result = mysql_query("SELECT id FROM reverb WHERE id='{$page->id}'")) {
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
mysql_query("UPDATE `reverb` SET `points`=`points`+'{$protect['coins']}' WHERE `id`='{$id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$protect['coins']}' WHERE `id`='{$data->id}'");
$message = "Points added with success!"; $message2 = 2;
    }
}}
?>
<body> 
<div>
<ul id="tabnav"> 
	<li class="tab2"><a href="reverb.php">Earn Points</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="addreverb.php">Add Profile</a></li> 
	<li class="tab4"><a href="reverbpages.php">My Profiles</a></li> 
</ul>
</div>
<p>&nbsp;</p>



<h1>Add Points</h1>
<p>Remember to add points to your profile each time, otherwise it will not get fans even if you have points in your account balance.</p>

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
<tr><td><label for="url">Profile Title</label></td><td width="20"></td><td><? echo $page->title;?></td></tr>
<tr><td><label for="added">Points in Profile</label></td><td width="20"></td><td><? echo $page->points;?></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><label for="add">Add</label></td><td width="20"></td><td><input type="text" name="coins" id="add" size="3" maxlength="5" value="50" /> points. (min=50)</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add points" class="submit" /></td></tr>
</table></center>
</form>
<? include('footer.php');?>