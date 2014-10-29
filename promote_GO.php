<?
include('config.php');

foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
	$code = VisitorIP();
	$refname = $get["refname"];
	$surfid = $get["surfid"];
	$gotkeygen = $get["keygen"];
	
		if($refname == "") {$refname = "admin";}
	$userreff = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE `login` = '{$refname}' "));
	$refid = $userreff->id;
	
	mysql_query("UPDATE `alexagoogle` SET `views`=`views`+'1' WHERE (`life` > '0') ");
	
	$promotekey = mysql_fetch_object(mysql_query("SELECT * FROM `stat` WHERE `id` = '26' "));
	$keygen = $promotekey->stat;
	
if ($refid > 1) {
$surffed1 = mysql_query("SELECT id FROM `ref_ip` WHERE (`IP` = '{$code}') LIMIT 0, 1");
	$extb = mysql_num_rows($surffed1);
	if($extb == 0){
	mysql_query("INSERT INTO `ref_ip` (ref2, IP) VALUES('{$refname}', '{$code}' )");
	}

$surffed1 = mysql_query("SELECT * FROM `surfed` WHERE (`user` = '{$refid}')");
	$extbtoday = mysql_num_rows($surffed1);
$surffed1 = mysql_query("SELECT * FROM `surfed` WHERE (`user` = '{$refid}' `ip` = '{$code}')");
	$extb = mysql_num_rows($surffed1);

mysql_query("UPDATE `surf` SET `total`=`total`+'1'  WHERE `id`='{$surfid}'");

if($extb == 0){
	mysql_query("UPDATE `stat` SET `stat`=`stat`+'1'  WHERE `id`='18'");
	mysql_query("UPDATE `surf` SET `likes`=`likes`+'1', `points`=`points`-'0.25', `hits_this_hour`=`hits_this_hour`+1 WHERE `id`='{$surfid}'");
	mysql_query("INSERT INTO `surfed` (user, ip) VALUES('{$refid}','{$code}')");
if ($extbtoday <= 1250) {
if ($gotkeygen == $keygen) {
	mysql_query("UPDATE `users` SET `coins`=`coins`+'0.1', `beforeref`=`coins`, `ptp`=`ptp`+'1' WHERE `id`='{$refid}'");
	if (rand(1,100) > 50) {
	$mmillesecc = microtime(true);
	mysql_query("INSERT INTO `last_hits` (user_name, site_name, site_type, time) VALUES('{$refname}', '{$surff->title}', 'p', '{$mmillesecc}' )");
	}
}
}
}

}
?>