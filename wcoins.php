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
$page = mysql_fetch_object(mysql_query("SELECT * FROM `website` WHERE `id`='{$id}' AND `user`='{$data->id}'"));

if(isset($_POST['add'])){
if($_POST['coins'] > $data->coins){$msg = "<div class=\"msg_error\">ERROR: You don't have enough coins!</div>";}
else if($_POST['coins'] < 1){$msg = "<div class=\"msg_error\">ERROR: Please enter an valid number!</div>";}
else if(!is_numeric($_POST['coins'])){$msg = "<div class=\"msg_error\">ERROR: Please enter an valid number!</div>";}
else{
    echo $msg = "<div class=\"msg_error\">Warning: Points possibly not added.</div>";
    $validify=2;
    if($result = mysql_query("SELECT id FROM website WHERE id='{$page->id}'")) {
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
mysql_query("UPDATE `website` SET `points`=`points`+'{$protect['coins']}' WHERE `id`='{$id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$protect['coins']}' WHERE `id`='{$data->id}'");
$msg = "<div class=\"msg_success\">Coins added with success!</div>";
    }
}}
?>
<body> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="website.php">Earn Coins</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab2"><a href="addw.php">Add Website</a></li> 
	<li class="tab3"><a href="wpages.php">Your Websites</a></li> 
</ul>
</div>
<p>&nbsp;</p>



<h1>Add coins</h1>
<? echo $msg;?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 1px dotted #ccc; padding: 20px; text-align: left;">
<tr><td><label for="url">Website</label></td><td width="20"></td><td><? echo $page->website;?></td></tr>
<tr><td><label for="added">Added points</label></td><td width="20"></td><td><? echo $page->points;?></td></tr>
<tr><td><label for="add">Add</label></td><td width="20"></td><td><input type="text" name="coins" id="add" size="3" maxlength="5" value="0" /> points</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add points" class="submit" /></td></tr>
</table></center>
</form>
<? include('footer.php');?>