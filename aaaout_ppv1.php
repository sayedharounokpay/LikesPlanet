<?php
include('header.php');

foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}

if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if($data->id != 1){echo "<script>document.location.href='index.php'</script>"; exit;}

if ($_REQUEST["skip"] > 0) {

$cashoutdata0 = mysql_query("SELECT * FROM `ppv` WHERE ( `id` = '{$_REQUEST["skip"]}'  AND `paid`='0' ) ");
$cashoutdata = mysql_fetch_object($cashoutdata0);

$usernamehere0 = mysql_query("SELECT * FROM `users` WHERE ( `id` = '{$cashoutdata->user}' ) ");
$usernamehere = mysql_fetch_object($usernamehere0);

mysql_query("UPDATE `ppv` SET `paid`='2' WHERE ( `id`='{$_REQUEST['skip']}' ) ");
}



if ($_REQUEST["paid"] > 0) {
$cashoutdata0 = mysql_query("SELECT * FROM `ppv` WHERE ( `id` = '{$_REQUEST["paid"]}' AND `paid`='0' ) ");
$cashoutdata = mysql_fetch_object($cashoutdata0);

$usernamehere0 = mysql_query("SELECT * FROM `users` WHERE ( `id` = '{$cashoutdata->user}' ) ");
$usernamehere = mysql_fetch_object($usernamehere0);

if($usernamehere->id > 0) {

mysql_query("UPDATE `ppv` SET `paid`='1', `points`='{$_REQUEST['points']}'  WHERE ( `id`='{$_REQUEST['paid']}' ) ");

mysql_query("UPDATE `users` SET `coins`=`coins`+'{$_REQUEST['points']}' WHERE ( `id`='{$cashoutdata->user}' ) ");
mysql_query("INSERT INTO statistics (user_id,date,coins_gained,refund,log,page) VALUES ({$cashoutdata->user},NOW(),{$_REQUEST['points']},1,'Requested Refund From System','aaaout.php')");
mysql_query("UPDATE `users` SET `beforeref`=`coins` WHERE `id`='{$cashoutdata->user}'");
}

$noteslist = mysql_query("SELECT * FROM `notes` WHERE (`url`='extrapoints.php' AND `user_id`='{$cashoutdata->user}') ");
$noteslistext = mysql_num_rows($noteslist);
if ($noteslistext == 0) {
mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$cashoutdata->user}', 'PPV', 'Paid To Blog/Video : Your Link Approved!', 'extrapoints.php' )");

}
}

$allcashout = mysql_query("SELECT * FROM `ppv` WHERE (`paid`='0') ");
$totalnum = 0;

$mytotalearns = 0;
$videoname = "";

for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalnum = $totalnum + 1;

if ($j == 1) {
$cashoutid = $cashout->id;
$link = $cashout->link;
$userid = $cashout->user;
$useroo = mysql_query("SELECT * FROM `users` WHERE (`id`='{$userid}') ");
$user5 = mysql_fetch_object($useroo);

	if(preg_match("/\byoutube.com\b/i", $link)){
		$splitarray = explode('?v=', $link);
		$videoname = $splitarray[1];
		$videoname = substr($videoname,0,11);
		$videoaddedbefore = mysql_query("SELECT * FROM `ppv` WHERE (`link` LIKE '%" . $videoname . "%' AND NOT `paid` = '0') ");
		$verificare = mysql_num_rows($videoaddedbefore);
	}
	if(preg_match("/\byoutu.be\b/i", $link)){
		$splitarray = explode('be/', $link);
		$videoname = $splitarray[1];
		$videoname = substr($videoname,0,11);
		$videoaddedbefore = mysql_query("SELECT * FROM `ppv` WHERE (`link` LIKE '%" . $videoname . "%' AND NOT `paid` = '0') ");
		$verificare = mysql_num_rows($videoaddedbefore);
	}

}

}

?>

<h1>Links: <?echo $totalnum;?></h1>

<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 1px dotted #ccc; padding: 20px; text-align: left;">
<tr><td><label for="title">Username:</label></td><td width="20"></td><td> <? if($user5->ban >= 1 OR $user5->banned == 1 OR $user5->bought ==1) { ?> <font color='red'> <? } else { ?> <font color='green'> <? } ?> |<?echo $user5->login;?>| </font> </td></tr>
<tr><td><label for="title">Link:</label></td><td width="20"></td><td> <font color='green'> <a href="<?echo $link;?>" target="_blank">  <b><?echo $link;?></b> </a> </font> </td></tr>

<? if( $videoname != "") { ?>
<tr><td><label for="title"> </label></td><td width="20"></td><td> <font color='green'> <? echo $verificare; ?> </font> </td></tr>
<? } ?>

<tr><td><label for="title"> </label></td><td width="20"></td><td>  </td></tr>

<tr><td><label for="title">User ID:</label></td><td width="20"></td><td> <?echo $userid;?> </td></tr>

<tr><td><label for="title">Likes:</label></td><td width="20"></td><td> <?echo $user5->likes;?> / <?echo $user5->unlikes;?> </td></tr>
<tr><td><label for="title">Hits Today:</label></td><td width="20"></td><td> <?echo $user5->hitstoday;?> </td></tr>
<tr><td><label for="title">Points:</label></td><td width="20"></td><td> <b><?echo $user5->coins;?></b> / <?echo $user5->lastpoints;?> </td></tr>
<tr><td><label for="title">Country:</label></td><td width="20"></td><td> <?echo $user5->country;?> </td></tr>

<tr><td><label for="title"> </label></td><td width="20"></td><td>  </td></tr>

<tr><td><label for="title">Ref:</label></td><td width="20"></td><td> <?echo $user5->ref;?> / <?echo $user5->ref2;?> </td></tr>
<tr><td><label for="title">Ban:</label></td><td width="20"></td><td> <?echo $user5->ban;?> / <?echo $user5->banned;?> </td></tr>
<tr><td><label for="title">Signup/Login:</label></td><td width="20"></td><td> <?echo $user5->signup;?> / <?echo $user5->online;?> </td></tr>
<tr><td><label for="title">PTP:</label></td><td width="20"></td><td> <?echo $user5->ptp;?> </td></tr>

<?
$allearns = mysql_query("SELECT * FROM `cashout` WHERE (`pending`='1' AND `id`='{$user5->id}') ");
for($j=1; $totalearning = mysql_fetch_object($allearns); $j++)
{
$mytotalearns = $mytotalearns + $totalearning->cash;
}
?>

<tr><td><label for="title">Total Earned:</label></td><td width="20"></td><td> <?echo $mytotalearns;?> </td></tr>

</table></center>

<div class="clearer">&nbsp;</div>

<a href="aaaout_ppv.php?skip=<?echo $cashoutid;?>">Reject Request</a>
<div class="clearer">&nbsp;</div>
<a href="aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=60"><b><font color='green' size='5'>Pay 60</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=100"><b><font color='green' size='5'>Pay 100</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=150"><b><font color='green' size='5'>Pay 150</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=200"><b><font color='green' size='5'>Pay 200</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=250"><b><font color='green' size='5'>Pay 250</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=300"><b><font color='green' size='5'>Pay 300</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=400"><b><font color='green' size='5'>Pay 400</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=500"><b><font color='green' size='5'>Pay 500</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=600"><b><font color='green' size='5'>Pay 600</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=750"><b><font color='green' size='5'>Pay 750</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=1000"><b><font color='green' size='5'>Pay 1000</font></b></a>
<div class="clearer">&nbsp;</div>
<a href="aaaout_ppv.php?paid=<?echo $cashoutid;?>&points=1500"><b><font color='green' size='5'>Pay 1500</font></b></a>
<div class="clearer">&nbsp;</div>


<? include('footer.php');?>