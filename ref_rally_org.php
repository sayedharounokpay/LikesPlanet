<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='login.php'</script>"; exit;}
?>

<body id="tab3"> 

<? 

  $siterally = mysql_fetch_object( mysql_query("SELECT * FROM refrally WHERE `id` = '1' ") );

  $site2 = mysql_query("SELECT * FROM users ORDER BY `refrally` DESC LIMIT 0, 10");
  
  $siteall = mysql_query("SELECT * FROM users ORDER BY `refrally` DESC");
  $myranknow = 999;
  for($j=1; $siteme = mysql_fetch_object( $siteall ); $j++)
  {
  if($siteme->id == $data->id) {
  	$myranknow = $j;
  	break;
  }
  }
  
  
  $hourstoclose = number_format(($siterally->time)/12 ,0);
  
?>
<center>

</br></br>

<? echo $msg; ?>
<? if ($message2 == 1) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>
<? if ($message2 == 2) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_done.jpg?a" border="0" title="Done"></td><td width="20"></td><td> <font color='green' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>

</br>

<font size='5'>
<? if($hourstoclose >0) { ?>
Referrals-Rally will be closed within <font color='blue'><b><? echo number_format(($siterally->time)/12 ,0); ?></b></font> Hours!
<? } else { ?>
<font color='blue'>Rally will be closed in less than an hour!</font>
<? } ?>
</font>
</br>

<? if($siterally->time < 2000) { ?>
<img src="img/rally_1.png">
</br>

<?
  
  for($j=1; $site = mysql_fetch_object( $site2 ); $j++)
  {
  
  switch ($j) {
    case '1':
        $willearn = '50,000 Points.';
        break;
    case '2':
        $willearn = '15,000 Points.';
        break;
    case '3':
        $willearn = '5,000 Points.';
        break;
    case '4':
        $willearn = '2,000 Points.';
        break;
    default:
        $willearn = '-';
        break;
  }
  
  if ($site->id != 32) {$usernamee = $site->login; } else { $usernamee = $siterally->name; }

?>

	<? echo $j; ?># <b><font color='blue' size='3'> <? echo $usernamee; ?> </font></b> made <b><font color='red'><? echo $site->refrally; ?></font></b> Referrals.
	</br>
	<? if ($willearn != "-") { ?>
	He is going to win <font color='green' size='3'><? echo $willearn; ?></font></br>
	<? } ?>
	</br></br>	

<?}?>


<? if($myranknow > 5) { ?>
---------------------------------------------------------</br>
<? echo $myranknow; ?>#  <b><font color='blue' size='3'> <? echo $data->login; ?> </font></b> made <b><font color='red'><? echo $data->refrally; ?></font></b> Referrals.</br>
<font color='grey'> Refer more friends to be one of the winners.</font> </br>
<? } } ?>


</br>
<img src="img/rally_1.png">
</br>

<font color='blue' size='4'>
This is Weekly Contest, We pay <b>72,000 Points</b> for Top Two Referrers Every Week. </br></br></br></br>
<font color='red'><b>New: Your referrals should do 6 Likes at least to count.</b></font></br></br>
<font color='red'>Because of Cheaters (Self Refers), We will review Referrals before giving Points.</font></br></br>
<font color='red'>If we remove a user from Contest after reviewing referrals, Points will be rewarded to below.</font></br></br>
<font color='red'>This means, Users at level #5 or less are Possible to win.</font></br></br>

</br>
<img src="img/rally_1.png">
</br>

<font color='blue' size='5'>
Winners of Last Week: </br></br></br></font>
<?
$siterallyAll = mysql_query("SELECT * FROM refrally WHERE `id` > '3' LIMIT 0, 4");
for($j=1; $sitewon = mysql_fetch_object( $siterallyAll ); $j++)
  {
?>
  <? echo $j; ?># <b><font color='blue' size='3'> <? echo $sitewon->name; ?> </font></b> won <b><font color='green' size='3'><? echo $sitewon->time; ?></font></b> Points.
  </br></br>  
  <? } ?>

</br>

</center>

<? include('footer.php');?>