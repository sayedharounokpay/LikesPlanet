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

?>



<body id="tab1" style="background-color: transparent;"> 
<center>

<div style="color: #4299ED; font-size: 24px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma; font-weight: normal;">Admin Panel</div>
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

</br>

<li> <a href="register.php" style="text-decoration: none;"> <font color='blue' size='4'><b> Register a New Surveyor </b></font> </a></li>
</br></br>

<li> <a href="listusers.php" style="text-decoration: none;"> <font color='blue' size='4'><b> List of Surveyors </b></font> </a></li>
</br></br>

<li> <a href="logout.php" style="text-decoration: none;"> <font color='grey' size='4'><b> Logout </b></font> </a></li>
</br></br>

</center>

<? include('footeraddon.php');?>