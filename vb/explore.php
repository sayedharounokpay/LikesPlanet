<?php
include('headeraddon.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

if(!isset($data->login)){echo "<script>document.location.href='login.php'</script>"; exit;}

$shipdata = mysql_fetch_object(mysql_query("SELECT * FROM `vbships` WHERE (`id` = '{$get['id']}' ) "));
$orgfiles = mysql_query("SELECT * FROM `vbdocs` WHERE (`ship_id` = '{$shipdata->id}' AND `del` = '0') ");


?>
<body id="tab1" style="background-color: transparent;"> 

<center>
<div style="color: #4299ED; font-size: 24px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma; font-weight: normal;"><? echo ucfirst($shipdata->fullname); ?></div>
</br>

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
<tr><td><img src="img/planet_done.jpg?a" border="0" title="Error"></td><td width="20"></td><td> <font color='green' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>

<center>

<img src="uploads/ship_<? echo $shipdata->profile;?>.jpg" width="420" height="300" style="border-radius: 15px;">
</br></br>

<font color='black' size='4'> <b>Basic Documents:</b>  </font>
</br></br>

				<? for($j2=1; $filedetails = mysql_fetch_object($orgfiles); $j++) { ?>
				<a href="uploads/<? echo $filedetails->profile; ?>" target="_blabk" >
				<font color='green' size='3'> <? echo $filedetails->file_name; ?> </font>
				</a>
				</br></br>
				<? } ?>
				

</center>

</br>

<font color='black' size='4'> <b>VRS <-> <? echo ucfirst($data->login); ?> Documents:</b>  </font>
</br></br>

<? include('footeraddon.php');?>