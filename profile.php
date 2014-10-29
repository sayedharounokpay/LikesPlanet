<?
$page_title = "My Profile - LikesPlanet.com";

include('header.php');
foreach($_POST as $key => $value) {
	$sec[$key] = filter($value);
}
if(isset($_POST['change'])){
if (!checkPwd($_POST['password'],$_POST['password2'])) {
$mesaj = "<div class=\"msg_error\">ERROR: Passwords are wrong or do not match!</div>";
}else{
$pass = $_POST['password'];
mysql_query("UPDATE `users` SET `pass`='{$pass}' WHERE `id`='{$data->id}'");
$mesaj = "<div class=\"msg_success\">Password successfully changed!</div>";
}}

$siteref2 = mysql_query("SELECT * FROM `users` WHERE `ref2`='{$data->id}' AND NOT `ref2`='0' ");
$referralsnum = mysql_num_rows($siteref2);
$siteref20 = mysql_query("SELECT * FROM `users` WHERE (`ref2`='{$data->id}' AND NOT `ref2`='0' AND `likes` >= 6) ");
$referralsnum2 = mysql_num_rows($siteref20);

?>
<h2>Profile</h2>
<? echo $mesaj;?>
<form method="post">
<table class="infobox">
<tr><td><label for="username">Username</label></td><td width="20"></td><td><? echo $data->login;?></td></tr>
<tr><td><label for="email">Email</label></td><td width="20"></td><td><? echo $data->email;?></td></tr>
<tr><td><label for="email">Country</label></td><td width="20"></td><td><? echo $data->country;?></td></tr>
<tr><td><label for="email">Points</label></td><td width="20"></td><td><? echo $data->coins;?></td></tr>
<br/>
<tr><td><label for="email">Referrals</label></td><td width="20"></td><td><? echo $referralsnum;?> / <? echo $referralsnum2;?> Active. </td></tr>
<tr><td><label for="email">Hits Today</label></td><td width="20"></td><td><? echo $data->hitstoday;?></td></tr>
<tr><td><label for="email">Hits Made</label></td><td width="20"></td><td><? echo $data->likes;?></td></tr>
<tr><td><label for="email">Unlikes/Reports</label></td><td width="20"></td><td><? echo $data->unlikes;?></td></tr>
<br/>
<tr><td><label for="email">Register IP</label></td><td width="20"></td><td><? echo $data->IP;?></td></tr>
<tr><td><label for="email">Last Login IP</label></td><td width="20"></td><td><? echo $data->lastip;?></td></tr>
<tr><td><label for="email">Signup Date</label></td><td width="20"></td><td><? echo $data->signup;?></td></tr>

</table><br/>

<table class="infobox" cellpadding="0" cellspacing="0" border="0" class="form">

<tr><td><label for="password">Password</label></td><td width="20"></td><td><input type="password" name="password" id="password" size="20" maxlength="25" /></td></tr>
<tr><td><label for="password2">Repeat password</label></td><td width="20"></td><td><input type="password" name="password2" id="password2" size="20" maxlength="25" /></td></tr><br/>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="change" value="Reset" class="submit" /></td></tr>
</table>
<input type="hidden" name="r" value="" />
<input type="hidden" name="ref" value="" />
<br/>
</form>

<?include('footer.php');?>