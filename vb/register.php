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


	$code = VisitorIP();
	$mystring = file_get_contents('http://ipinfodb.com/ip_locator.php?ip=' . $code); 
	$x1102 = explode("Country : ", $mystring);
	$x11102 = explode(" <img src=", $x1102[1]);
	$x1102w = explode("City : ", $mystring);
	$x11102w = explode("</li>", $x1102w[1]);
	$x111022 = $x11102w[0] . ' (' . $x11102[0] . ')';
	$x11102oo = explode('(', $x111022);
	$x111022oo = explode(')', $x11102oo[1]);
if ($x111022oo[0] == '' ) $x111022oo[0] = 'US';
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
if ($x111022oo[0] == 'LK' ) $x111022oo[0] = 'CE';
if ($x111022oo[0] == 'UA' ) $x111022oo[0] = 'UP';
if ($x111022oo[0] == 'SD' ) $x111022oo[0] = 'SU';
if ($x111022oo[0] == 'BD' ) $x111022oo[0] = 'BG';

if(isset($_POST['register'])){
$verificare1 = mysql_query("SELECT * FROM `vbusers` WHERE `login`='{$_POST['user']}' OR `email`='{$_POST['email']}'");
$verificare = mysql_num_rows($verificare1);

if ($verificare > 0 ) {
$message = "This email address or username Already Registered! Please Try to Login."; $message2 = 1;
}else if (!isUserID($_POST['user'])) {
$message = "Username format is incorrect!"; $message2 = 1;
}else if(!isEmail($_POST['email'])) {
$message = "Email format is incorrect!"; $message2 = 1;
}else if($_POST['email'] != $_POST['email2']) {
$message = "Email addresses do Not match!"; $message2 = 1;
}else if (!checkPwd($_POST['password'],$_POST['password2'])) {
$message = "Passwords do not match!"; $message2 = 1;
}else{

mysql_query("INSERT INTO `vbusers`(email,login,IP,pass,country,date,fullname) values('{$_POST['email']}','{$_POST['user']}','$code','{$_POST['password']}','$x111022', NOW(), '{$_POST['fullname']}' )");

// To email address
// $email = $_POST['email'];
// $email_name = $_POST['user'];
$email = "zaidmarkabi@yahoo.com";
$email_name = "Admin";

// From email address
$from = "no-reply@vrsclass.com";
$from_name = "VRSClass.com";

// The message
$subject = "VRSClass.com - New Account CREATED.";


$message = "Hello ".$email_name."

VRSClass Account Created with success!

http://vrsclass.com/
";

$message_html = "<html><body><p> Hello ".$email_name."! </p>

VRSClass Account Created with success!

<p>
<br /> <a href='http://vrsclass.com/'> <b> VRS-Class Network.</b> </a> </p>
</body></html>";

/***********************************************/
/* No need to modify anything down here */
/* Note that these are needed to send the mail */
/***********************************************/
// Generate text + html version
$random_hash = md5(date_default_timezone_set("r"));
$mailmessage = "
--PHP-alt-".$random_hash."
Content-Type: text/plain; charset=\"iso-8859-1\"
Content-Transfer-Encoding: 7bit
$message
--PHP-alt-".$random_hash."
Content-Type: text/html; charset=\"iso-8859-1\"
Content-Transfer-Encoding: 7bit
$message_html
--PHP-alt-".$random_hash."--
";
// Headers
// To send HTML mail, the Content-type header must be set
$headers = "From: ".$from_name." <".$from.">" . "\r\n";
$headers .= "Reply-To: ".$from_name." <".$from.">" . "\r\n";
$headers .= "Date: ".date_default_timezone_set("r") . "\r\n";
// Additional headers
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-Type: multipart/alternative; boundary=\"PHP-alt-" . $random_hash . "\"\r\n";
$headers .= "Message-Id: <" . md5(uniqid(microtime())) . "@" . $_SERVER["SERVER_NAME"] . ">\r\n";
// Send the mail
mail($email, $subject, $mailmessage, $headers);


$message = "Account Created succesfully!</br>Please inform Surveyor that his account is ready."; $message2 = 2;
}
}
?>



<body id="tab1" style="background-color: transparent;"> 
<center>

<div style="color: #4299ED; font-size: 24px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma; font-weight: normal;">Admin Panel: Register a New Surveyor</div>
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

<form method="post" action="" style="margin-top: 20px; padding: 20px; border: 5px dotted #ccc;">
<table cellpadding="0" cellspacing="0" border="0" class="form" >
<tr><td><label for="fullname"><b>Full Name:</b></label></td><td width="20"></td><td><input type="text" style="border-radius: 10px;"  name="fullname" id="fullname" size="20" maxlength="40" style="margin-bottom: 10px;"/></td></tr>
<tr><td><label for="username">Username:</label></td><td width="20"></td><td><input type="text" style="border-radius: 10px;"  name="user" id="username" size="20" maxlength="25" style="margin-bottom: 10px;"/></td></tr>
<tr><td><label for="email"><b>Email:</b></label></td><td width="20"></td><td><input type="text" style="border-radius: 10px;"  name="email" id="email" size="20" maxlength="120" style="margin-bottom: 10px;"/></td></tr>
<tr><td><label for="email2">Repeat Email:</label></td><td width="20"></td><td><input type="text" style="border-radius: 10px;"  name="email2" id="email2" size="20" maxlength="120" style="margin-bottom: 10px;"/></td></tr>
<tr><td><label for="password"><b>Password:</b></label></td><td width="20"></td><td><input type="password" style="border-radius: 10px;"  name="password" id="password" size="20" maxlength="25" style="margin-bottom: 10px;"/></td></tr>
<tr><td><label for="password2">Repeat password:</label></td><td width="20"></td><td><input type="password" style="border-radius: 10px;"  name="password2" id="password2" size="20" maxlength="25"/></td></tr>
<tr><td>&nbsp;</td></tr>

<tr><td><label for="country">Reg Loc:</label></td><td width="20"></td><td> <img src="https://www.cia.gov/library/publications/the-world-factbook/graphics/flags/large/<? echo Strtolower($x111022oo[0]); ?>-lgflag.gif" border="0" title="My Country : <? echo $data->country; ?>" height="16" width="24" > <? echo $x111022; ?> </td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="register" value="Register." class="submit" style="width: 180px; height: 36px; font-size: 16" /></td></tr>
</table>
</form>

</br></br>
<a href="admin.php" > <font color='blue' size='4'> << <b>Back</b> to Admin Panel <<. </font> </a>

</center>


<? include('footeraddon.php');?>