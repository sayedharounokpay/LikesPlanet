<?
include('config.php');

$name = $_POST['details'];
$x11 = explode('fbid=', $name);
$x111 = explode('&set=', $x11[1]);
$url   = 'https://graph.facebook.com/'. urlencode($x111[0]). '/likes'; 
$mystring = file_get_contents($url); 

$findme = $_POST['fbname'];
$pos = strpos($mystring, $findme);
if ($pos === false) {
    echo $findme ;
} else {


$site21 = mysql_query("SELECT * FROM `photos2` WHERE `id`='{$_POST['id']}'");
$site11 = mysql_fetch_object($site21);

mysql_query("INSERT INTO `photosdone2` (user_id, site_id, ok, wait, cpc, title, user_owner, reply) VALUES('{$_POST['uid']}', '{$_POST['id']}', '1', '0', '{$site11->cpc}', '', '{$site11->user}',  ''  ) ");

mysql_query("UPDATE `photos2` SET `points`=`points`-'{$site11->cpc}', `likes`=`likes`+1   WHERE `id`='{$_POST['id']}'");

mysql_query("UPDATE `users` SET `coins`=`coins`+'{$site11->cpc}'-1 WHERE `id`='{$_POST['uid']}'");

    echo 'yes' ;
}

?>