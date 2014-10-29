<?php
include('headeraddon.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

if(!isset($data->login)){echo "<script>document.location.href='login.php'</script>"; exit;}

if($get['error'] == 1) {$message = "Error while uploading file!</br>Please choose smaller photo."; $message2 = 1;}


?>
<body id="tab1" style="background-color: transparent;"> 

<center>
<div style="color: #4299ED; font-size: 24px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma; font-weight: normal;">Hello <? echo ucfirst($data->login); ?>, Complete Your Profile:</div>
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


<? if($get['edit'] == 1) {?>
<font color='green' size='4'><b>Edit your profile photo: </b> (100x120 pxl)</font>
</br></br>
<img src="uploads/<? echo $data->login;?>.jpg" width="100" height="120">
</br></br>
<? } else { ?>
<font color='green' size='4'><b>Step 1: Upload your profile photo: </b> (100x120 pxl)</font>
<? } ?>

</br></br>
<img src="img/prev1.jpg">
</br></br>
<form enctype="multipart/form-data" action="usercomp1_u.php" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
<input name="uploadedfile" type="file" /><br />
</br></br>
<input type="submit" value="Upload File" />
</form>

<? if($get['edit'] == 1) {?>
</br></br>
<a href="userpanel.php" > <font color='blue' size='4'> << <b>Back</b> to My Panel <<. </font> </a>
<? } ?>

</center>

<? include('footeraddon.php');?>