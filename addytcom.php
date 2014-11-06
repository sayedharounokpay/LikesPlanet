<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){

$mysql_num_rows = 0;

$splitarray = explode('?v=', $_POST['url']);
$videoname = $splitarray[1];
$verificare1 = mysql_query("SELECT * FROM `ytcom` WHERE `ytcom`='{$videoname}'");
$verificare = mysql_num_rows($verificare1);
if($verificare > 99) {$msg = "
<div class=\"msg_error\">ERROR: Video is Added by other user!</div>
<div class=\"msg_success\" >If You Are Video Owner Contact us to add.</div>

";}

else if($_POST['cpc'] < 2) {$msg = "<div class=\"msg_error\">ERROR: CPC Problem!</div>";}
else if($_POST['cpc'] > 60) {$msg = "<div class=\"msg_error\">ERROR: CPC Problem!</div>";}
else if($_POST['title'] == "") {$msg = "<div class=\"msg_error\">ERROR: Title can't be empty!</div>";}






else{
mysql_query("INSERT INTO `ytcom` (user, ytcom, title, cpc, say) VALUES('{$data->id}', '{$videoname}', '{$protectie['title']}', '{$protectie['cpc']}', '{$protectie['say']}' ) ");

$site = mysql_fetch_object(mysql_query("SELECT * FROM `ytcom` WHERE `ytcom`='{$videoname}'"));

// Add my coins to this page
if ($_POST['addpoints'] <= $data->coins  and  $_POST['addpoints']>-1){
if ($site->id > -1) {
mysql_query("UPDATE `ytcom` SET `points`=`points`+'{$_POST['addpoints']}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['addpoints']}' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_deducted,yt_like,log,page) VALUES ({$data->id},NOW(),{$_POST['addpoints']},1,'Points Added To Youtube (Comments): {$site->id}','addytcom.php')");
}
$msg = "<div class=\"msg_success\">Video added with success!</div>
<div class=\"msg_success\">Remember to ADD Coins to your Video!</div>
";
}
else{$msg = "<div class=\"msg_success\">Video added with success!</div>
<div class=\"msg_error\">You don't have enough coins to add for your video!</div>
<div class=\"msg_success\">Remember to ADD Coins to your Video!</div>";}

}}
?>
<body id="tab2"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="ytcom.php">Earn Coins</a></li> 
	<li class="tab2"><a href="addytcom.php">Add Video</a></li> 
	<li class="tab3"><a href="ytcompages.php">My Videos</a></li> 
</ul>
</div>
<h1>Add YouTube Video</h1>
<p>You can add here your YouTube Videos to get Comments.</p>
<? echo $msg;?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 1px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="title">Video Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="40" maxlength="30" /></td></tr>
<tr><td><label for="url">Video URL:</label></td><td width="20"></td><td><input type="text" name="url" id="url" size="40" maxlength="43" value="https://www.youtube.com/watch?v=" /></td></tr>

<tr><td><label for="say">   <div class="clearer">&nbsp;</div>   </label></td><td width="20"></td><td> </td></tr>

<tr><td><label for="points">Points to Give:</label></td><td width="20"></td><td><select name="cpc" id="points">
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="16">16</option>
</select></td></tr>

<tr><td><label for="addpoints">Points to Add:</label></td><td width="20"></td><td><input type="text" name="addpoints" id="addpoints" value="<? echo $data->coins ;?>"  size="20" maxlength="30" /></td></tr>

<tr><td><label for="say">   <div class="clearer">&nbsp;</div>   </label></td><td width="20"></td><td> </td></tr>

<tr><td><label for="say">Comment Info :</label></td><td width="20"></td><td>
<textarea name="say" style="width:400px;height:260px;">Please Post ONE comment similar to:

- </textarea>
</td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add" class="submit" /></td></tr>
</table></center>
</form>
<? include('footer.php');?>