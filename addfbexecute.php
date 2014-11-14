<?php
error_reporting(0);
include('config.php');
if(isset($_POST['add'])){ // Start Of Page Add Function
 
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
	$size = strlen( $chars );
	$str = "";
	for( $i = 0; $i < 10; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

if(preg_match("/\bpages\b/i", $_POST['url'])){
$x110 = explode('/', $_POST['url']);
$name0 = $x110[5];}
else {
$x110 = explode('/', $_POST['url']);
$name0 = $x110[3];
}
if(preg_match("/\bfref\b/i", $name0)){
$x1100090 = explode('?', $name0);
$name0 = $x1100090[0];
}
if(preg_match("/\bref\b/i", $name0)){
$x1100090 = explode('?', $name0);
$name0 = $x1100090[0];
}
$url0   = 'https://graph.facebook.com/'. urlencode($name0); 
$mystring0 = file_get_contents($url0);
$x1103 = explode('likes"', $mystring0);
$x11103 = explode(':', $x1103[1]);
$x111033 = explode(',', $x11103[1]);
$likesnumnum = $x111033[0];

$x1104 = explode('id"', $mystring0);
$x11104 = explode('"', $x1104[1]);
$x111044 = explode('"', $x11104[1]);
$pageid = $x111044[0];

if ($likesnumnum < 1) {
$url0   = 'http://shareyt.com/plugins/fb/getcount.php?url='. $_POST['url']; 
$likesnumnum = file_get_contents($url0);
}
//if ($likesnumnum < 1) {
//$url0   = 'http://socialmediaexplode.com/plugins/fb2/getcount.php?url='. $name0; 
//$likesnumnum = file_get_contents($url0);
//}

$verificare = 0;
$verificare1 = mysql_query("SELECT * FROM `facebook` WHERE `facebook`='{$_POST['url']}'");
$verificareA = mysql_num_rows($verificare1);

$verificare1 = mysql_query("SELECT * FROM `facebook` WHERE `id`='{$str}'");
$verificareB = mysql_num_rows($verificare1);

$verificare1 = mysql_query("SELECT * FROM `facebook` WHERE `user`='{$data->id}'");
$verificareC = mysql_num_rows($verificare1);

if($verificareA > 0) {
$message = "Error: Page Added before by You or someone else!</br>Click on (My Pages) to see if you added before,</br>Add Points on your page to get more likes.</br>If page not added before by you, Contact us to add."; $message2 = 1;
$msg = "<script language=javascript>TINY.box.show({html:'Do you want to Add Page Anyway?</br></br>You can try <a href=addfb_safe.php><b><font color=white>Safe Mode</font></b></a> to add page.</br></br></br>We do not recommend using Safe Mode,</br>but it is the only way if page is important for you.',animate:true,close:true,mask:false,boxid:'success',left:4});</script>";
}

else if($verificareB > 0) {
$message = "Error: Please try again!"; $message2 = 1;
}

else if($verificareC > 500) {
$message = "Error: You can add 500 Pages only at one time!<br>Please Delete old pages to be able to add more!"; $message2 = 1;
}

else if(!preg_match("/http/i", $_POST['url'])){
$message = "Error: HTTP:// is Not included in your URL! Please try again."; $message2 = 1;
}
else if(preg_match("/\bphoto.php\b/i", $_POST['url'])){
$message = "Error: This is FB Photo! Please add it in PHOTOs section."; $message2 = 1;
}
else if(preg_match("/\bposts\b/i", $_POST['url'])){
$message = "Error: This is FB Photo! Please add it in PHOTOs section."; $message2 = 1;
}

else if($likesnumnum < 1) {
$message = "Error: Page should has +1 likes at least.</br>-or- Page URL is NOT Correct? Remove ?ref= ?sk= codes in URL!"; $message2 = 1;
$msg = "<script language=javascript>TINY.box.show({html:'Are you sure Page URL is Correct ?</br></br>You can try <a href=addfb_safe.php><b><font color=white>Safe Mode</font></b></a> to add page.</br></br></br>We do not recommend using Safe Mode,</br>but it is the only way if page is important for you.',animate:true,close:true,mask:false,boxid:'success',left:4});</script>";
}

else if($_POST['cpc'] < 2) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 15) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 10 && $data->pr == 0) {$message = "CPC Problem!"; $message2 = 1;}

else if($_POST['addpoints'] < 20) {$message = "You should add 20 Points at least for your new page!"; $message2 = 1;}
else if(!is_numeric($_POST['addpoints'])){$message = "Invalid number!"; $message2 = 1;}

else if($_POST['title'] == "") {$message = "Page title can Not be empty!"; $message2 = 1;}

else if($_POST['addpoints'] > $data->coins){$message = "You do Not have enough points to add page now!"; $message2 = 1;}

else{
mysql_query("INSERT INTO `facebook` (user, facebook, title, cpc, target, top, pageid, id) VALUES('{$data->id}', '{$protectie['url']}', '{$protectie['title']}', '{$protectie['cpc']}' , '{$protectie['setcountry11']}' , '{$protectie['smartstop']}', '{$pageid}', '{$str}'  ) ");

// Add my page to Liked
$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE `facebook`='{$protectie['url']}'"));
mysql_query("INSERT INTO `liked` (user_id, site_id) VALUES('{$data->id}','{$site->id}')");

// Add my coins to this page
if ($_POST['addpoints'] <= $data->coins  and  $_POST['addpoints']>-1){
mysql_query("UPDATE `facebook` SET `points`=`points`+'{$_POST['addpoints']}' WHERE `id`='{$site->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['addpoints']}' WHERE `id`='{$data->id}'");
mysql_query("INSERT INTO statistics (user_id,date,coins_deducted,fb_like,log,page) VALUES ({$data->id},NOW(),{$_POST['addpoints']},1,'Added Coins to Facebook page (Likes) Site ID: {$site->id}','addfb.php')");
}
$message = "Page Added with success!"; $message2 = 2;
echo "<script>document.location.href='fbpages.php'</script>"; exit;

}} // End of Facebook add Process
