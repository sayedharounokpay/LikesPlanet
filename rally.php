<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='login.php'</script>"; exit;}

foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$bonuson = $get['bonus'];

$verificare1 = mysql_query("SELECT * FROM `rallydaily` WHERE `userid`='{$data->id}'");
$verificare = mysql_num_rows($verificare1);

if($bonuson == '1') {
	if($verificare > 0) {
	$message = "ERROR: You already claimed bonus rank!</br>Come back next 30 minutes to increase your Rally Rank more."; $message2 = 1;
	} else {
	mysql_query("UPDATE `users` SET `hitstoday`=`hitstoday` + 6 WHERE `id`='{$data->id}'");
	mysql_query("INSERT INTO `rallydaily` (userid) VALUES( '{$data->id}' ) ");
	echo "<script>document.location.href='rally.php'</script>"; exit;
	}
}

?>

<script language=javascript>
setTimeout(RefreshLiveMe,59000);
function RefreshLiveMe(){
window.location.reload();
clearTimeout(RefreshLiveMe);setTimeout(RefreshLiveMe,59000);
}
</script>

<body id="tab3"> 

<? 

  $siterally = mysql_fetch_object( mysql_query("SELECT * FROM rally WHERE `id` = '1' ") );

  $site2 = mysql_query("SELECT * FROM users ORDER BY `hitstoday` DESC LIMIT 0, 5");
  
  $siteall = mysql_query("SELECT * FROM users ORDER BY `hitstoday` DESC");
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
Rally will be closed within about <font color='blue'><b><? echo number_format(($siterally->time)/12 ,0); ?></b></font> Hours!
<? } else { ?>
<font color='blue'>Rally will be closed in less than an hour!</font>
<? } ?>
</font>
</br>

<? if($siterally->time < 288) { ?>
<img src="img/rally_1.png">
</br>

<?
  
  for($j=1; $site = mysql_fetch_object( $site2 ); $j++)
  {
  
  switch ($j) {
    case '1':
        $willearn = '600';
        break;
    case '2':
        $willearn = '300';
        break;
    case '3':
        $willearn = '150';
        break;
    case '4':
        $willearn = '75';
        break;
    case '5':
        $willearn = '40';
        break;
  }
  
  if ($site->id != 32) {$usernamee = $site->login; } else { $usernamee = $siterally->name; }

?>

	<? echo $j; ?># <b><font color='blue' size='3'> <? echo $usernamee; ?> </font></b> made <b><font color='red'><? echo $site->hitstoday; ?></font></b> Hits today.
	</br>	
	He is going to win <font color='green' size='3'><? echo $willearn; ?></font> Points = <b><font color='green' size='3'>$<? echo  number_format($willearn/$coinsdollar,2); ?></font></b>	
	</br></br>	

<?}?>


<? if($myranknow > 5) { ?>
---------------------------------------------------------</br>
<? echo $myranknow; ?>#  <b><font color='blue' size='3'> <? echo $data->login; ?> </font></b> made <b><font color='red'><? echo $data->hitstoday; ?></font></b> Hits today.</br>
<font color='grey'> Do more hits to be one of the winners.</font> </br>
<? } } ?>


</br>
<img src="img/rally_1.png">
</br>

<font color='blue' size='4'>
This is Daily Contest, We pay <b>1,165</b> Points for Top 5 Likers Everyday. </br></br></br></br>
<font color='red'><b>No more sites to hit today?</b></font></br></br>
You can increase your Rally Rank <b>Every 30 minutes</b> by clicking link below: </br></br>
<? if($verificare == 0) { ?>
<a href='rally.php?bonus=1'><b>Click here</a> to increase your Rank +6 Free Hits!</b>
<? } else { ?>
<font color='grey'> Come back next minutes to increase your rank more and more! </font>
<? } ?>
</font>
</br>



<img src="img/rally_1.png">
</br>

<font color='blue' size='5'>
Winners of Yesterday: </br></br></br></font>
<?
$siterallyAll = mysql_query("SELECT * FROM rally WHERE `id` > '1' ");
for($j=1; $sitewon = mysql_fetch_object( $siterallyAll ); $j++)
  {
?>
  <? echo $j; ?># <b><font color='blue' size='3'> <? echo $sitewon->name; ?> </font></b> won <b><font color='green' size='3'><? echo $sitewon->time; ?></font></b> Points.
  </br></br>  
  <? } ?>


<img src="img/rally_1.png">
</br>
	<iframe src="live.php?ref=<? echo rand(1, 100); ?>"
        scrolling="no" frameborder="0"
        style="border:none; width:500px; height:250px"></iframe>
</br>


</center>

<? include('footer.php');?>