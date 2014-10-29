<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

if($get["relogg"] == 1){
$dbres = mysql_query("SELECT * FROM `users` WHERE (`id`='1') ");
$data2 = mysql_fetch_object($dbres);
$_SESSION['login'] = $data2->login;
$reloggURL = "<script>document.location.href='sup.php?ticket=" . $get['ticket'] . "'</script>";
echo $reloggURL; exit;
}

if(!isset($data->login)){echo "<script>document.location.href='login.php'</script>"; exit;}
if($data->id != 1){echo "<script>document.location.href='login.php'</script>"; exit;}


?>

<center>
<div>&nbsp;</div>

<?
if(isset($data->login)) {
$mytickets = mysql_query("SELECT * FROM `support` WHERE (`status`='0' OR `status`='1') ORDER BY `id` DESC LIMIT 0, 50;");
$myticketsnum = mysql_num_rows($mytickets);
	if($myticketsnum == 0) {
		$mytickets = mysql_query("SELECT * FROM `support` ORDER BY `id` DESC LIMIT 0, 50;");
		$thoseall = 1;
	}
} else { $myticketsnum=0; }
if($get["ticket"] == "") {
?>
<? if($thoseall == 1) { ?>
<font color='red'> There are No tickets, We display last 50 solved tickets. </font>
<? } ?>
<h1>All Open Support Tickets:</h1>
<table class="datatable sortable selectable full" style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="5">
			Ticket-ID
			</th>
			<th width="10">
			Username
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
	$site2 = mysql_query("SELECT * FROM `support` WHERE (`status`='0' OR `status`='1') ORDER BY `id` DESC LIMIT 0, 50;");
	$myticketsnum = mysql_num_rows($site2);
		if($myticketsnum == 0) {
			$site2 = mysql_query("SELECT * FROM `support` ORDER BY `id` DESC LIMIT 0, 50;");
			$thoseall = 1;
		}
  	for($j=1; $site = mysql_fetch_object($site2); $j++) {
  	?>
		<tbody>
		<tr>
			<td>
			<a href="sup.php?ticket=<? echo $site->code; ?>"> <? echo $site->id; ?> </a>
			</td>
			<td>
			<? echo $site->username; ?>
			</td>
			<td>
				<? if($site->status == 0 OR $site->status == 1) {?>
				<a href="sup.php?ticket=<? echo $site->code; ?>"> <b><? echo $site->title; ?></b> </a>
				<? } else { ?>
				<a href="sup.php?ticket=<? echo $site->code; ?>"> <? echo $site->title; ?> </a>
				<? } ?>
			</td>
			<td>
				<? if($site->status == 0) {?> <font color='blue'> New Ticket. </font> <? } ?>
				<? if($site->status == 1) {?> <font color='black'> User Reply. </font> <? } ?>
				<? if($site->status == 2) {?> <font color='grey'> Answered. </font> <? } ?>
				<? if($site->status == 3) {?> <font color='grey'> User Viewed. </font> <? } ?>
			</td>
		</tr>
		</tbody>
	<? } ?>
	</table>
<? } ?>

<div>&nbsp;</div>
</br></br>

<? if($get["ticket"] != "") {
$site2 = mysql_query("SELECT * FROM `support` WHERE (`code`='{$get['ticket']}') ");
$verificareB = mysql_num_rows($site2);
if($verificareB > 0) {
$xticket = mysql_fetch_object($site2);

if($get["solved"] == 1){
mysql_query("UPDATE `support` SET `status`='3' WHERE (`id`='{$xticket->id}') ");
}

$useridd = $get["useridd"];
if($get["removeban"] == 1){
mysql_query("UPDATE `users` SET `ban`='0', `banned`='0', `multi`='0' WHERE (`id`='{$useridd}') ");
}
if($get["addpoints"] >= 50){
$addthesepointsnow = $get["addpoints"];
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$addthesepointsnow}' WHERE (`id`='{$useridd}') ");
mysql_query("UPDATE `users` SET `beforeref`=`coins` WHERE (`id`='{$useridd}') ");
}

if($get["loginn"] == 1){
$dbres = mysql_query("SELECT * FROM `users` WHERE (`id`='{$useridd}') ");
$data2 = mysql_fetch_object($dbres);
$_SESSION['login'] = $data2->login;
echo "<script>document.location.href='fbpages.php'</script>"; exit;
}

if(isset($_POST['msgchat'])){
	if($_POST['staff'] == 2) {$staffname = "Yazan Markabi";}
	if($_POST['staff'] == 3) {$staffname = "Rimi";}
	if($_POST['staff'] == 4) {$staffname = "Henry Wallance";}
mysql_query("INSERT INTO `supportmsg` (ticket, msg, name, level) VALUES('{$xticket->code}', '{$_POST['msgchat']}', '{$staffname}', '{$_POST['staff']}' ) ");
mysql_query("UPDATE `support` SET `status`='2' WHERE (`id`='{$xticket->id}') ");

$pagehigh = 'support.php?ticket=' . $xticket->code;
$notemsg = 'Support: Your Ticket (' . $xticket->title . ') Answered. Click to see.';
$pagehigh2 = 'http://likesplanet.com/support.php?ticket=' . $xticket->code;
$notemsg2 = 'Your Support Ticket (' . $xticket->title . ') Answered! <br /><br /> Click on link below to see your Ticket Status.';


if($xticket->user_id >= 1) {
$userownerex = mysql_query("SELECT * FROM `users` WHERE (`id`='{$xticket->user_id}' ) ");
$userownerexN = mysql_num_rows($userownerex);
}
if ($userownerexN == 0) {
$userownerex = mysql_query("SELECT * FROM `users` WHERE (`email`='{$xticket->email}' ) ");
$userownerexN = mysql_num_rows($userownerex);
}
if ($userownerexN == 0) {
$userownerex = mysql_query("SELECT * FROM `users` WHERE (`login`='{$xticket->username}' ) ");
$userownerexN = mysql_num_rows($userownerex);
}
if ($userownerexN != 0) {
$userowner = mysql_fetch_object($userownerex);
$noteslist = mysql_query("SELECT * FROM `notes` WHERE `url`='{$pagehigh}'");
$noteslistext = mysql_num_rows($noteslist);
if ($noteslistext == 0) {
mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$userowner->id}', 'Ran Out', '{$notemsg}', '{$pagehigh}' )");
}
}
mysql_query("INSERT INTO `notebyemail` (username, title, msg, link, email) VALUES('{$xticket->username}', 'LikesPlanet.com - Your Support Ticket Answered.', '{$notemsg2}', '{$pagehigh2}', '{$xticket->email}' )");
}

$site2 = mysql_query("SELECT * FROM `support` WHERE (`code`='{$get['ticket']}') ");
$xticket = mysql_fetch_object($site2);

$actualprofile = 0;
if($xticket->user_id >= 1) {
$userownerex = mysql_query("SELECT * FROM `users` WHERE (`id`='{$xticket->user_id}' ) ");
$actualprofile = 100;
$userownerexN = mysql_num_rows($userownerex);
}
if ($userownerexN == 0) {
$userownerex = mysql_query("SELECT * FROM `users` WHERE (`email`='{$xticket->email}' ) ");
$actualprofile = 60;
$userownerexN = mysql_num_rows($userownerex);
}
if ($userownerexN == 0) {
$userownerex = mysql_query("SELECT * FROM `users` WHERE (`login`='{$xticket->username}' ) ");
$actualprofile = 30;
$userownerexN = mysql_num_rows($userownerex);
}
if ($userownerexN != 0) {
$userowner = mysql_fetch_object($userownerex);

	$x11102oop = explode('(', $userowner->country);
	$x111022oop = explode(')', $x11102oop[1]);
?>
<table style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="200">
			
			</th>
			<th width="700">
			
			</th>
		</tr>
		</thead>
		<tbody><tr>
			<td width="150"><center>
			Username :
			</center></td>
			<td width="150"><center>
				<img src="https://www.cia.gov/library/publications/the-world-factbook/graphics/flags/large/<? echo Strtolower($x111022oop[0]); ?>-lgflag.gif" border="0" title="Country : <? echo $userowner->country; ?>" height="16" width="24" >
				<? if ($userowner->ban > 0 OR $userowner->banned == 1 OR $userowner->multi == 1) { ?>
				<font size='4' color='red'><b><? echo $userowner->login ;?></b> (<? echo $userowner->id;?>) %<? echo $actualprofile;?></font>
				<? } else { ?>
				<font size='4'><b><? echo $userowner->login ;?></b> (<? echo $userowner->id;?>) %<? echo $actualprofile;?></font>
				<? } ?>
				<? if ($userowner->ban >= 1) { ?>
				</br><font color='red'> Banned for <? echo $userowner->ban;?> Days.</font>
				<? } ?>
				<? if ($userowner->multi == 1) { ?>
				</br><font color='red'> Banned to Cashout.</font>
				<? } ?>
				<? if ($userowner->banned == 1) { ?>
				</br><font color='red'> Banned because it is using BOT.</font>
				<? } ?>
			</td>
		</tr></tbody>
		<tbody><tr>
			<td width="150"><center>
			Age
			</center></td>
			<td width="150"><center>
				<? echo $userowner->age;?> Days
			</td>
		</tr></tbody>
		<tbody><tr>
			<td width="150"><center>
			Likes / Unlikes: (Hits Today)
			</center></td>
			<td width="150"><center>
				<b><? echo $userowner->likes;?> / <font color='red'><? echo $userowner->unlikes;?></font></b>  . . . . . (<? echo $userowner->hitstoday;?> today)
			</td>
		</tr></tbody>
		<tbody><tr>
			<td width="150"><center>
			-
			</center></td>
			<td width="150"><center>
				-
			</td>
		</tr></tbody>
		<tbody><tr>
			<td width="150"><center>
			Points
			</center></td>
			<td width="150"><center>
				<b><font color='green'><? echo number_format($userowner->coins);?></b> Points</font>
			</td>
		</tr></tbody>
		<tbody><tr>
			<td width="150"><center>
			Total Earnings
			</center></td>
			<td width="150"><center>
				<? $allcashout = mysql_query("SELECT * FROM `cashout` WHERE ((`id`='{$userowner->id}') AND `pending`='1') ");
				$totalnotpaid = 0;
				$totalnum = 0;
				for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
				{
					$totalnotpaid = $totalnotpaid + $cashout->cash;
					$totalnum = $totalnum + 1;
				} ?>
				<font color='green'><b>$<? echo number_format($totalnotpaid,2);?></b> / <? echo $totalnum;?></font>
			</td>
		</tr></tbody>
		<tbody><tr>
			<td width="150"><center>
			Register / Online
			</center></td>
			<td width="150"><center>
				<? echo $userowner->signup;?> / <? echo $userowner->online;?>
			</td>
		</tr></tbody>
</table>
<table style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="200">
			
			</th>
			<th width="700">
			
			</th>
		</tr>
		</thead>
		<tbody><tr>
			<td width="150"><center>
			Remove All Bans ? </br></br>
			</center></td>
			<td width="150"><center>
				<a href="sup.php?ticket=<? echo $xticket->code;?>&useridd=<? echo $userowner->id;?>&removeban=1"> Do It. </a> </br></br>
			</td>
		</tr></tbody>
		<tbody><tr>
			<td width="150"><center>
			Add Points ?</br></br>
			</center></td>
			<td width="150"><center>
				<a href="sup.php?ticket=<? echo $xticket->code;?>&useridd=<? echo $userowner->id;?>&addpoints=50"> 50 </a> ....
				<a href="sup.php?ticket=<? echo $xticket->code;?>&useridd=<? echo $userowner->id;?>&addpoints=100"> 100</a> ....
				<a href="sup.php?ticket=<? echo $xticket->code;?>&useridd=<? echo $userowner->id;?>&addpoints=150"> 150</a> ....
				<a href="sup.php?ticket=<? echo $xticket->code;?>&useridd=<? echo $userowner->id;?>&addpoints=200"> 200</a> ....
				<a href="sup.php?ticket=<? echo $xticket->code;?>&useridd=<? echo $userowner->id;?>&addpoints=250"> 250</a> ....
				<a href="sup.php?ticket=<? echo $xticket->code;?>&useridd=<? echo $userowner->id;?>&addpoints=350"> 350</a> ....
				<a href="sup.php?ticket=<? echo $xticket->code;?>&useridd=<? echo $userowner->id;?>&addpoints=500"> 500</a> ....
				<a href="sup.php?ticket=<? echo $xticket->code;?>&useridd=<? echo $userowner->id;?>&addpoints=1000"> 1000</a> ....
			</td>
		</tr></tbody>
		<tbody><tr>
			<td width="150"><center>
			Login as (<? echo $userowner->login;?>)</br></br>
			</center></td>
			<td width="150"><center>
				<a href="sup.php?ticket=<? echo $xticket->code;?>&useridd=<? echo $userowner->id;?>&loginn=1" target="_blank"> Login As User. </a> </br></br>
			</td>
		</tr></tbody>
		<tbody><tr>
			<td width="150"><center>
			Login as Support again.</br></br>
			</center></td>
			<td width="150"><center>
				<a href="sup.php?ticket=<? echo $xticket->code;?>&useridd=<? echo $userowner->id;?>&relogg=1"> Return Support. </a> </br></br>
			</td>
		</tr></tbody>
</table>
<?
}
	?>
	</center>
	</br></br><a href="sup.php"> <font color='red'> << See All Support Tickets.</font> </a>
	</br></br><font color='green' size='4'>Support Ticket: <b><? echo ucfirst($xticket->title);?></b></font>
	</br></br><font color='green' size='4'>Status:</font>
		<? if($xticket->status == 0){?> <font color='blue' size='4'> New Ticket.</font> <?}?>
		<? if($xticket->status == 1){?> <font color='black' size='4'> User Reply.</font> <?}?>
		<? if($xticket->status == 2){?> <font color='grey' size='4'> Answered.</font> <?}?>
		<? if($xticket->status == 3){?> <font color='grey' size='4'> User Viewed.</font> <?}?>
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
			<center><font color='blue' size='3'><b><? echo ucfirst($site0->name);?></b></font>
			</br><img src="img/support_unknown.png" style="border-radius: 10px;"></center></br>
			</td>
			<td width="600">
			<center><textarea readonly name="url" style="width:600px; height:150px;" ><? echo $site0->msg; ?></textarea></center>
			<? } else { ?>
			<center><font color='grey' size='3'><b><font color='grey'><? echo ucfirst($site0->name);?></font></b></font>
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
	</br><select name="staff" id="staff">
	<option value="2">Yazan Markabi</option>
	<option value="3">Rimi</option>
	<option value="4">Henry</option>
	</select>
	</br><input type="submit" name="add" id="add" value="Reply" class="submit" style="width:150px;" onclick="CorrectThisValue2(); $('#add').attr('disabled', 'disabled');" />
	</form>
	<a href="sup.php?ticket=<? echo $xticket->code;?>&solved=1"> This Ticket Solved. </a>
	
<?
}
} ?>

<script language=javascript>
function CorrectThisValue2() {
var SelValue = document.getElementById("msgchat").value;
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," ");  
SelValue = SelValue.replace(String.fromCharCode(34)," "); 
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," "); 
SelValue = SelValue.replace(String.fromCharCode(34)," "); 
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," "); 
SelValue = SelValue.replace(String.fromCharCode(34)," "); 
SelValue = SelValue.replace("'"," "); 
SelValue = SelValue.replace(";"," "); 
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