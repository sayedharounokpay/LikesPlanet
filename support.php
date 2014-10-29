<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
?>

<center>
<div>&nbsp;</div>

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
<? } 
if(isset($data->login)) {
$mytickets = mysql_query("SELECT * FROM `support` WHERE (`user_id`='{$data->id}')");
$myticketsnum = mysql_num_rows($mytickets);
} else { $myticketsnum=0; }
if($myticketsnum > 0) {
if($get["ticket"] == "") { ?>
<h1>My Support Tickets:</h1>
<table class="datatable sortable selectable full" style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="10">
			Ticket-ID
			</th>
			<th width="500">
			Title
			</th>
			<th width="150">
			Status
			</th>
		</tr>
		</thead>
	<?
	$site2 = mysql_query("SELECT * FROM `support` WHERE (`user_id`='{$data->id}') ORDER BY `id` DESC");
  	for($j=1; $site = mysql_fetch_object($site2); $j++) {
  	?>
		<tbody>
		<tr>
			<td>
			<a href="support.php?ticket=<? echo $site->code; ?>"> <? echo $site->id; ?> </a>
			</td>
			<td>
				<? if($site->status == 0 OR $site->status == 1) {?>
				<a href="support.php?ticket=<? echo $site->code; ?>"> <b><font color='black' size='2'><? echo $site->title; ?></font></b> </a>
				<? } ?>
				<? if($site->status == 2) {?>
				<a href="support.php?ticket=<? echo $site->code; ?>"> <b><font color='green' size='4'><? echo $site->title; ?></font></b> </a>
				<? } ?>
				<? if($site->status == 3) {?>
				<a href="support.php?ticket=<? echo $site->code; ?>"> <font color='black' size='2'><? echo $site->title; ?></font> </a>
				<? } ?>
			</td>
			<td>
				<? if($site->status == 0) {?> <font color='grey' size='3'> New Ticket. </font> <? } ?>
				<? if($site->status == 1) {?> <font color='grey' size='3'> Your Reply. </font> <? } ?>
				<? if($site->status == 2) {?> <font color='blue' size='4'> <b>New Reply.<b> </font> <? } ?>
				<? if($site->status == 3) {?> <font color='blue'> Answered. </font> <? } ?>
			</td>
		</tr>
		</tbody>
	<? } ?>
	</table>
	<div>&nbsp;</div></br></br></br></br></br></br></br></br></br></br></br></br>
<? }} ?>

<div>&nbsp;</div>
</br></br>

<? if($get["ticket"] != "") {
$site2 = mysql_query("SELECT * FROM `support` WHERE (`code`='{$get['ticket']}') ");
$verificareB = mysql_num_rows($site2);
if($verificareB > 0) {
$xticket = mysql_fetch_object($site2);

if($xticket->status == 2){
mysql_query("UPDATE `support` SET `status`='3' WHERE (`id`='{$xticket->id}') ");
}

if(isset($_POST['msgchat'])){
mysql_query("INSERT INTO `supportmsg` (ticket, msg, name, level) VALUES('{$xticket->code}', '{$_POST['msgchat']}', '{$xticket->username}', '1' ) ");
mysql_query("UPDATE `support` SET `status`='1' WHERE (`id`='{$xticket->id}') ");
$msg = "<div class=\"msg_success\">Your messages Posted with success!</div>";
}

$site2 = mysql_query("SELECT * FROM `support` WHERE (`code`='{$get['ticket']}') ");
$xticket = mysql_fetch_object($site2);

	?>
	
	</center>
	<? if(isset($data->login)) { ?>
	</br></br><a href="support.php"> << See All my Support Tickets. </a>
	<? } ?>
	</br></br><font color='green' size='4'>Support Ticket: <b><? echo ucfirst($xticket->title);?></b></font>
	</br></br><font color='green' size='4'>Status:</font>
		<? if($xticket->status == 0){?> <font color='grey' size='4'> New Ticket.</font> <?}?>
		<? if($xticket->status == 1){?> <font color='grey' size='4'> You Reply.</font> <?}?>
		<? if($xticket->status == 2){?> <font color='blue' size='4'> Answered.</font> <?}?>
		<? if($xticket->status == 3){?> <font color='grey' size='4'> Answered.</font> <?}?>
	</br></br>
	<center>
	<table style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="200">
			
			</th>
			<th width="700">
			
			</th>
		</tr>
		</thead>
	<?
	$site20 = mysql_query("SELECT * FROM `supportmsg` WHERE (`ticket`='{$xticket->code}') ORDER BY `id` ");
  	for($j=1; $site0 = mysql_fetch_object($site20); $j++) {
  	?>
		<tbody>
		<tr>
			<td width="250">
			<center>
			<? if($site0->level == 1) { ?>
			<center><font color='grey' size='3'><b><? echo ucfirst($site0->name);?></b></font>
			</br><img src="img/support_unknown.png" style="border-radius: 10px;"></center></br>
			</td>
			<td width="600">
			<center><textarea readonly name="url" style="width:600px; height:150px;" ><? echo $site0->msg; ?></textarea></center>
			<? } else { ?>
			<center><font color='grey' size='3'><b><font color='blue'><? echo $site0->name;?></font></b></font>
			</br><img src="img/support_<? echo $site0->level; ?>.png?b" style="border-radius: 10px;"></center></br>
			</td>
			<td width="600">
			<center><textarea readonly name="url" style="width:600px; height:150px;" ><? echo $site0->msg; ?></textarea></center>
			<? } ?>
			</td>
		</tr>
		</tbody>
	<? } ?>
	</table>
	
	</br></br>
	<form method="post">
	</center> <font color='grey' size='4'> Reply :</font>
	<center><textarea name="msgchat" id="msgchat" style="width:600px; height:150px; background: #99FFFF" ></textarea>
	</br><input type="submit" name="add" id="add" value="Reply" class="submit" style="width:150px;" onclick="CorrectThisValue2(); $('#add').attr('disabled', 'disabled');" />
	</form>
	
<?
}
} else { 

$allowmoretickets = 0;
if($data->id >= 1) {
$site24 = mysql_query("SELECT * FROM `support` WHERE (`user_id`='{$data->id}' AND `status` ='0') ");
$verificareB4 = mysql_num_rows($site24);
	if($verificareB4 == 0) {$allowmoretickets = 1;}
} else {
$allowmoretickets = 1;
}

?>

<? if($allowmoretickets == 1) { ?>
<center>
<img src="img/planet_contact.jpg?a" border="0" title="LikesPlanet.com - Contact">
</center>
<form method="post" action="supportsend.php" style="margin-top: 20px; padding: 30px; border: 4px dotted #ccc;">
<table cellpadding="0" cellspacing="0" border="0">
<tr><td width="180"><font color='blue' size=3>Username:</font></td><td width="50"><font color='blue' size=3>Your Email Address:</font></td></tr>
<tr><td width="180"><input type=text name=title1 id=title1 value="<? echo $data->login; ?>" size="13" maxlength="50"></td><td width="50"><input type=text name=title2 id=title2 value="" size="50" maxlength="50"></td></tr>
<tr><td></td><td>&nbsp;</td></tr>
<tr><td width="180"><font color='blue' size=3>Message Title:</font></td><td width="50"><input type=text name=title3 id=title3 value="" size="50" maxlength="30"> </td></tr>
<tr><td><font color='blue' size=3>Message :</font> </td><td> <textarea name="htmlmsg" id="htmlmsg" style="width: 500px; height: 150px; color:darkblue;"></textarea></td></tr>
<tr><td></td><td>&nbsp;</td></tr>
<tr><td><font color='blue' size=3>Image Number</br>(Captcha)</font></td><td>
<center><img src="captcha.php" /></br><input name="captcha" size="7" maxlength="5"  type="text"></center>
</td></tr>
<tr><td></td><td>&nbsp;</td></tr>
<tr><td></td><td><center><input type=submit class="submit3" value="Create a New Support Ticket" style="width: 300px;" onclick="CorrectThisValue();" ></center>
</td></tr></table>
</form>

<? }} ?>

<script language=javascript>
function CorrectThisValue() {
var SelValue = document.getElementById("title3").value;
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," "); 
SelValue = SelValue.replace(","," "); 
SelValue = SelValue.replace(String.fromCharCode(34)," ");
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," "); 
SelValue = SelValue.replace(","," "); 
SelValue = SelValue.replace(String.fromCharCode(34)," ");
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," "); 
SelValue = SelValue.replace(","," "); 
SelValue = SelValue.replace(String.fromCharCode(34)," ");
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," "); 
SelValue = SelValue.replace(","," "); 
SelValue = SelValue.replace(String.fromCharCode(34)," ");
document.getElementById("title3").value = SelValue ;

SelValue = document.getElementById("htmlmsg").value;
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," "); 
SelValue = SelValue.replace(","," "); 
SelValue = SelValue.replace(String.fromCharCode(34)," "); 
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," "); 
SelValue = SelValue.replace(","," "); 
SelValue = SelValue.replace(String.fromCharCode(34)," "); 
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," "); 
SelValue = SelValue.replace(","," "); 
SelValue = SelValue.replace(String.fromCharCode(34)," "); 
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," "); 
SelValue = SelValue.replace(","," "); 
SelValue = SelValue.replace(String.fromCharCode(34)," "); 
document.getElementById("htmlmsg").value = SelValue ;
}
function CorrectThisValue2() {
var SelValue = document.getElementById("msgchat").value;
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," "); 
SelValue = SelValue.replace(","," "); 
SelValue = SelValue.replace(String.fromCharCode(34)," "); 
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," "); 
SelValue = SelValue.replace(","," "); 
SelValue = SelValue.replace(String.fromCharCode(34)," "); 
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," "); 
SelValue = SelValue.replace(","," "); 
SelValue = SelValue.replace(String.fromCharCode(34)," "); 
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," "); 
SelValue = SelValue.replace(","," "); 
SelValue = SelValue.replace(String.fromCharCode(34)," "); 
document.getElementById("msgchat").value = SelValue ;
}
</script>

<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>


<?php
include('footer.php');
?>