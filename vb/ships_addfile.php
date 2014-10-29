<?php
include('headeraddon.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

if(!isset($data->login)){echo "<script>document.location.href='login.php?adminpanel=1'</script>"; exit;}

if($data->id != '1'){echo "<script>document.location.href='login.php?adminpanel=1'</script>"; exit;}

if($get['error'] == 1) {$message = "Error while uploading file!</br>Please try again."; $message2 = 1;}
if($get['done'] == 1) {$message = "File uploaded succesfully!"; $message2 = 2;}

$shipdata = mysql_fetch_object(mysql_query("SELECT * FROM `vbships` WHERE (`id` = '{$get['id']}') "));

?>



<body id="tab1" style="background-color: transparent;"> 

<center>
<div style="color: #4299ED; font-size: 24px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma; font-weight: normal;">Ships: Attach Document</div>
</br></br>

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

<font color='green' size='4'>

Ship Name: <? echo $shipdata->fullname; ?>

</br></br>

<img src="uploads/ship_<? echo $shipdata->profile;?>.jpg" width="320" height="240" style="border-radius: 12px;">
</br></br>

<form enctype="multipart/form-data" action="ships_addfile_u.php?id=<? echo $shipdata->id;?>" method="POST">
New File: <input name="uploadedfile" type="file" /><br />
</br></br>


<input type="submit" value="Upload & Add Document" />
</form>
</font>

</br></br>
<a href="listships.php" > <font color='blue' size='4'> << <b>Back</b> to List of Ships <<. </font> </a>

</center>


<? include('footeraddon.php');?>