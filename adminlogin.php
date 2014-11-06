<?php
$page_title = "Login LikesPlanet.com | Ready to Boost Up your Social Media Pages?";
$meta_description = "Login LikesPlanet.com | Ready to Boost Up your Social Media Pages?";

include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}

	$code = VisitorIP();
	
	$codeARR = explode(',', $code);
	$code = $codeARR[0];
	
	//$mystring = file_get_contents('http://ipinfodb.com/ip_locator.php?ip=' . $code); 
	//$x1102 = explode("Country : ", $mystring);
	//$x11102 = explode(" <img src=", $x1102[1]);
	
	//$x1102w = explode("City : ", $mystring);
	//$x11102w = explode("</li>", $x1102w[1]);
	
	//$x111022 = $x11102w[0] . ' (' . $x11102[0] . ')';
	
	//$mystring = file_get_contents('http://www.infobyip.com/ip-' . $code . '.html'); 
	//$x1102 = explode(")</td></tr>", $mystring);
	//$x11102 = explode(" flag'> ", $x1102[0]);
	//$x111022 = $x11102[1] . ')';
	
	//$x11102oo = explode('(', $x111022);
	//$x111022oo = explode(')', $x11102oo[1]);
	//$x111022ooR = explode(')', $x11102oo[1]);
	
	
	
	//$mystring = file_get_contents('http://freegeoip.net/json/' . $code); 
	//$x1102 = explode('country_code":"', $mystring);
	//$x11102 = explode('",' , $x1102[1]);
	//$x1102h = explode('country_name":"', $mystring);
	//$x11102h = explode('",' , $x1102h[1]);
	
	//$x111022 = $x11102h[0] . ' (' . $x11102[0] . ')';
	
	//$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$code));    
	//$x111022 = $ip_data->geoplugin_countryName . ' (' . $ip_data->geoplugin_countryCode . ')';
	//$x111022oo[0] = $ip_data->geoplugin_countryCode;
	
	//$x111022oo[0] = $x11102[0];
	$x111022oo[0] = "US";
	
if ($x111022oo[0] == 'DE' ) $x111022oo[0] = 'GM';
if ($x111022oo[0] == 'TR' ) $x111022oo[0] = 'TU';
if ($x111022oo[0] == 'PH' ) $x111022oo[0] = 'RP';
if ($x111022oo[0] == 'DZ' ) $x111022oo[0] = 'AG';
if ($x111022oo[0] == 'BW' ) $x111022oo[0] = 'BC';
if ($x111022oo[0] == 'PT' ) $x111022oo[0] = 'PO';
if ($x111022oo[0] == 'VN' ) $x111022oo[0] = 'VM';
if ($x111022oo[0] == 'RU' ) $x111022oo[0] = 'RS';
if ($x111022oo[0] == 'OM' ) $x111022oo[0] = 'MU';
if ($x111022oo[0] == 'GB' ) $x111022oo[0] = 'UK';
if ($x111022oo[0] == 'GE' ) $x111022oo[0] = 'GG';
if ($x111022oo[0] == 'LB' ) $x111022oo[0] = 'LE';
if ($x111022oo[0] == 'AZ' ) $x111022oo[0] = 'AJ';
if ($x111022oo[0] == 'LV' ) $x111022oo[0] = 'LG';
if ($x111022oo[0] == 'UA' ) $x111022oo[0] = 'UP';
if ($x111022oo[0] == 'LK' ) $x111022oo[0] = 'CO';
if ($x111022oo[0] == 'SD' ) $x111022oo[0] = 'SU';
if ($x111022oo[0] == 'BD' ) $x111022oo[0] = 'BG';

?> <div>&nbsp;</div> <center> <?php
$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`active` = '0' AND (`points` > '0' OR `clx` > '0') )  ORDER BY RAND() DESC LIMIT 0, 1");
$adsb = mysql_fetch_object($ads2b);
mysql_query("UPDATE `adsb` SET `views`=`views`+'1', `points`=`points`-'1' WHERE `id`='{$adsb->id}'");
?>
<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="52px" width="402px">
</a>
<?

$ads2b = mysql_query("SELECT * FROM `adsb` WHERE (`active` = '0' AND (`points` > '0' OR `clx` > '0') )  ORDER BY RAND() DESC LIMIT 0, 1");
$extb = mysql_num_rows($ads2b);
if($extb > 0){
for($j=1; $adsb = mysql_fetch_object($ads2b); $j++)
{
mysql_query("UPDATE `adsb` SET `views`=`views`+'1', `points`=`points`-'1' WHERE `id`='{$adsb->id}'");
?>
<a href="adsbre.php?bid=<? echo $adsb->id;?>" target="_blank" >
<img src="<? echo $adsb->urlb;?>" border="0" title="<? echo $adsb->title;?>" height="52px" width="402px">
</a>
<?}
}
?> </center> <?php


$defuser = mysql_query("SELECT * FROM `users` WHERE (`IP`='{$code}' OR `lastip`='{$code}')");
$ext1 = mysql_num_rows($defuser);
if($ext1 > 0){
$defuser1 = mysql_fetch_object($defuser);
$defusername = $defuser1->login;
if ($defuser1->country != '') {
	$x11102oop = explode('(', $defuser1->country);
	$x111022oop = explode(')', $x11102oop[1]);
	$x111022oopR[0] = $x111022oop[0];
if ($x111022oop[0] == 'DE' ) $x111022oop[0] = 'GM';
if ($x111022oop[0] == 'TR' ) $x111022oop[0] = 'TU';
if ($x111022oop[0] == 'PH' ) $x111022oop[0] = 'RP';
if ($x111022oop[0] == 'DZ' ) $x111022oop[0] = 'AG';
if ($x111022oop[0] == 'BW' ) $x111022oop[0] = 'BC';
if ($x111022oop[0] == 'PT' ) $x111022oop[0] = 'PO';
if ($x111022oop[0] == 'VN' ) $x111022oop[0] = 'VM';
if ($x111022oop[0] == 'RU' ) $x111022oop[0] = 'RS';
if ($x111022oop[0] == 'OM' ) $x111022oop[0] = 'MU';
if ($x111022oop[0] == 'GB' ) $x111022oop[0] = 'UK';
if ($x111022oop[0] == 'GE' ) $x111022oop[0] = 'GG';
if ($x111022oop[0] == 'LB' ) $x111022oop[0] = 'LE';
if ($x111022oop[0] == 'AZ' ) $x111022oop[0] = 'AJ';
if ($x111022oop[0] == 'LV' ) $x111022oop[0] = 'LG';
if ($x111022oop[0] == 'LK' ) $x111022oop[0] = 'CE';
if ($x111022oop[0] == 'UA' ) $x111022oop[0] = 'UP';
if ($x111022oop[0] == 'SD' ) $x111022oop[0] = 'SU';
if ($x111022oop[0] == 'BD' ) $x111022oop[0] = 'BG';
}
 } else { $x111022oop[0] = ''; }

if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"]) {
if(isset($_POST['login'])) {
$user = mysql_real_escape_string($_POST['username']); 
$pass =mysql_real_escape_string($_POST['pass']); 
if($pass == "98765") {
//$pass = preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($_POST['pass']));
//$pass = stripslashes(str_replace("'\"","", $_POST['pass'] ));
//echo $pass;
str_replace("'", "", $UserInput);
$dbres = mysql_query("SELECT * FROM `users` WHERE (`login`='{$user}' AND admin_login = 1)");

//echo "SELECT * FROM `users` WHERE (`login`='{$_POST['username']}' OR `email`='{$_POST['username']}') AND `pass`='{$pass}'";
$num = mysql_num_rows($dbres);
$data2 = mysql_fetch_object($dbres);

$x11102ooNOW = explode('(', $data2->country);
$x111022ooNOW = explode(')', $x11102ooNOW[1]);
if($x111022ooNOW[0] == '' OR $x111022ooNOW[0] == ')' OR $x111022ooNOW[0] == '(') {$x111022ooNOW[0] = $x111022oo[0];}
if($x111022ooR[0] == '' OR $x111022ooR[0] == ')' OR $x111022ooR[0] == '(') {$x111022ooNOW[0] = $x111022ooR[0];}
$x111022ooNOW[0] = $x111022ooR[0];

$final = VisitorIP();
mysql_query("INSERT INTO `log_ip` (IP) VALUES('{$final}')");
$dbres00 = mysql_query("SELECT * FROM `log_ip` WHERE `IP`='{$final}'");
$num00 = mysql_num_rows($dbres00);

if ($num > 0) {
		
	 //if ($num00 < 25) {
	if($num00 <= 0 || $num00 > 0) {

if($data2->conf == 5){
$message = "You should Confirm your Account by Email!</br>Remember to check 'SPAM' folder as well."; $message2 = 1;
}else if($data2->ban > 0){
$message = "Your account got banned, It will be active within " . $data2->ban . " days.</br>Reason: " . $data2->reason; $message2 = 1;
}else if($data2->banned > 0){
$message = "Sorry, Your account got banned!"; $message2 = 1;

}else if($data2->activate > 0){
$message = "You should Confirm your Account by Email!</br>Remember to check 'SPAM' folder as well."; $message2 = 1;

}
/* Bugged 
else if($num00 > 20){
$message = "Temporary problem happens when you try to login!</br>Please come back next 30 minutes."; $message2 = 1;

}*/
else if($num > 0) {
	$final = VisitorIP();

	mysql_query("UPDATE `users` SET `lastpoints`=`coins`  WHERE (`login`='{$_POST['username']}' OR `email`='{$_POST['username']}' )");
	
	$sitelogin = mysql_query("SELECT * FROM `login` WHERE (`user_id` = '{$_POST['username']}')");
	$extlog = mysql_num_rows($sitelogin);
	if($extlog == 0){
	  mysql_query("INSERT INTO `login` (user_id) VALUES('{$_POST['username']}')");
	  mysql_query("UPDATE `sitestat` SET `online`=`online`+'1'  WHERE `id`='3'");
	}
	  
	  
	  $sitelogin = mysql_query("SELECT * FROM `users` WHERE (`IP` = '{$final}' OR `lastip` = '{$final}') AND NOT `login` ='{$_POST['username']}'  AND NOT `email` ='{$_POST['username']}' ");
	  $extlog = mysql_num_rows($sitelogin);
	  if(2 == 1 && $extlog != 0 && $data2->pr == 0 && $data2->agent == 0){
	  $sitelogin0 = mysql_query("SELECT * FROM `users` WHERE (`login` ='{$_POST['username']}' OR `email` ='{$_POST['username']}') ");
	  $useripc0 = mysql_fetch_object($sitelogin0);
	  if ($data2->pr == 0 && $data2->agent == 0) {
	  mysql_query("UPDATE `users` SET `ban`=`ban`+1, `reason`='You are using More than 1 Account.', `multi`=`multi`+1  WHERE `id`='{$useripc0->id}'");
	  for($j=1; $useripc = mysql_fetch_object($sitelogin); $j++)
		{
		mysql_query("INSERT INTO `similarip` (user1, user2, IP) VALUES('{$useripc0->id}', '{$useripc->id}', '{$final}' )");
		mysql_query("UPDATE `users` SET `ban`=`ban`+1, `reason`='You are using More than 1 Account.', `multi`=`multi`+1  WHERE `id`='{$useripc->id}'");
		}
	  }
	  $message = "You try to login More that 1 account!"; $message2 = 1;
	  }
	  else {
	  
	  mysql_query("UPDATE `users` SET `online`=NOW(), `lastip`='{$final}', `log_h`='24'  WHERE (`login`='{$data2->login}') ");
	  
	  if(isset($data2->login) && $data2->login!="")
	  {
	  $_SESSION['login'] = $data2->login;
	  }
	  if($data2->login == "admin") {
	  echo "<script>document.location.href='index.php'</script>";
	  } else {
	  
	  
	/*  	$username=$_POST['username'];
		$uname= substr($username, 0, 5);
	 
	 $sql= "select id,email,login,IP,lastip,online, COUNT(*) from users where (login LIKE '%$uname%'  And pass='$pass')   group by lastip having COUNT(*)>1 ";
	  $result_sql=mysql_query($sql);
	  
	  
	  
	  
	$ip=VisitorIP();
 $sql2="SELECT * FROM `users` where lastip='$ip' and online > DATE_SUB(NOW(), INTERVAL 24 HOUR) ORDER BY `lastip` DESC ";
 $result_sql2=mysql_query($sql2);*/
 

	  
	// echo $sql;
/*	 if($_POST['username']!="admin")
	 {
	  if(mysql_num_rows($result_sql)>0)
	  {
	  mysql_query("UPDATE `users` SET ban=365,reason='multiple account cheater!'  WHERE (`login`='{$_POST['username']}' OR `email`='{$_POST['username']}' )");
	  
	  $sql2="select * from users where (`login`='{$_POST['username']}' OR `email`='{$_POST['username']}' )";
	// echo $sql2;
	   $result2=mysql_query($sql2);
	   
	   $row2=  mysql_fetch_array($result2);
		$message = "Your account got banned, It will be active within " . $row2['ban'] . " days.</br>Reason: " . $row2['reason']; $message2 = 1;
		 $message2 = 1;
	  }else if(mysql_num_rows($result_sql2)>1)
	  {
		  	 mysql_query("UPDATE `users` SET ban=365,reason='You are using multiple accounts!'  WHERE (`login`='{$_POST['username']}' OR `email`='{$_POST['username']}' )");
	  
	  $sql2="select * from users where (`login`='{$_POST['username']}' OR `email`='{$_POST['username']}' )";
	// echo $sql2;
	   $result2=mysql_query($sql2);
	   
	   $row2=  mysql_fetch_array($result2);
		$message = "Your account got banned, It will be active within " . $row2['ban'] . " days.</br>Reason: " . $row2['reason']; $message2 = 1;
		 $message2 = 1;
	  }else
	  {
	 echo "<script>document.location.href='".$siteme->login."'</script>";
	  }
	  } */
	  
	   echo "<script>document.location.href='".$siteme->login."'</script>";
	 
	  }
	  }
	
    }
else{
$message = "Username or Password is Incorrect!"; $message2 = 1;
   }
   }
   } else{$message = "Username or Password is Incorrect!"; $message2 = 1;}
}
  }
  }


$code=rand(1000,9999);
$_SESSION["code"]=$code;
if(isset($_SESSION['login_message'])) {
     if(isset($_SESSION['login_error'])) {
         $message2 = $_SESSION['login_error'];
     }
     $message = $_SESSION['login_message'];
 }
?>
<div class="center" style="margin-bottom: 80px;">


<? if ($message2 == 1) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="
" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>
<? if ($message2 == 2) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='green' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>

<div class="login-title">Member Login</div>
<div class="login-box">
<form method="post" action="">
<table cellpadding="0" cellspacing="0" border="0" class="form">
<tr><td><label for="username">Username or Email:</label></td><td width="20"></td><td><input type="text" name="username" id="username" size="20" maxlength="40" style="margin-bottom: 15px;" value="" /></td></tr>
<tr><td><label for="password">Password:</label></td><td width="20"></td><td><input type="password" name="pass" id="password" size="20" maxlength="25" /></td></tr>
<tr><td>&nbsp;</td></tr>

<tr><td><label for="captcha">Captcha Number:</label></td><td width="20"></td><td><input name="captcha" size="7" maxlength="5" type="text"> <img src="captcha.php" /></td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td colspan="2"></td><td><input type="submit" name="login" value="Login" class="submit" /></td></tr>
</table>
<input type="hidden" name="r" value="" />
</form>

<p><i>Not a member? <a href="register.php"><b>Register today</b></a></i></p>
<p><i>Forgot Password? <a href="repass.php"><b>Restore it</b></a></i></p>
<p><i>Activation email Not sent? <a href="reconfirm.php"><b>Re-Send Activation Code</b></a></i></p>
</div>
</div>	



<? include('footer.php');?>