<?php
include('headeraddon.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

	$code = VisitorIP();
	
$defuser = mysql_query("SELECT * FROM `vbusers` WHERE (`IP`='{$code}' )");
$ext1 = mysql_num_rows($defuser);
if($ext1 > 0){
$defuser1 = mysql_fetch_object($defuser);
$defusername = $defuser1->login;
}

if(isset($_POST['login'])) {
$dbres = mysql_query("SELECT * FROM `vbusers` WHERE (`login`='{$_POST['username']}' OR `email`='{$_POST['username']}') AND `pass`='{$_POST['pass']}'");
$num = mysql_num_rows($dbres);
$data2 = mysql_fetch_object($dbres);

if($num > 0) {
	  $_SESSION['login'] = $data2->login;
	  if($data2->id == 1) {
	  echo "<script>document.location.href='admin.php'</script>";
	  } else {
	  echo "<script>window.top.location.href='http://vrsclass.net/home/certificates-documents/'</script>";
	  }
    	} else {
$message = "<div class=\"msg_error\">ERROR: Username and Password does not match!</div>";
   	}
  }
?>

<body id="tab1" style="background-color: transparent;"> 

<div class="center" style="margin-bottom: 10px;">

<? if($get['adminpanel'] == 1) { ?>
<div style="color: #4299ED; font-size: 24px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma; font-weight: normal;">Admin Login</div>
<? } else { ?>
<div style="color: #4299ED; font-size: 24px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma; font-weight: normal;">Surveyor Login</div>
<? } ?>

</br>
<? echo $message;?>

<form method="post" action="" style="margin-top: 20px; padding: 20px; border: 5px dotted #ccc;">
<table cellpadding="0" cellspacing="0" border="0" class="form" >

<tr><td> </td><td> </br> </td></tr>

<tr><td><label for="username">Username or Email:</label></td><td width="20"></td><td><input type="text" style="border-radius: 10px;" name="username" id="username" size="20" maxlength="25" style="margin-bottom: 15px;" value="" /></td></tr>

<tr><td> </td><td> </br> </td></tr>

<tr><td><label for="password">Password:</label></td><td width="20"></td><td><input type="password" style="border-radius: 10px;"  name="pass" id="password" size="20" maxlength="25" /></td></tr>

<tr><td> </td><td> </br> </td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="login" value="Login" class="submit" style="background: #0099FF; border-radius: 10px;" /></td></tr>
</table>
<input type="hidden" name="r" value="" />
</form>

</div>	
</div>	

<? include('footeraddon.php');?>
