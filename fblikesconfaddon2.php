<?
include('config.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

$siteid = $get['siteid'];
$userid = $get['userid'];

$sitebasic = mysql_fetch_object(mysql_query("SELECT * FROM `likesplanetaddon` WHERE (`id`='{$get['siteid']}') "));

$newdirect = "<script>document.location.href='" . $sitebasic->url . "likesplanet_unliked&userid=" . $userid . "'</script>";
echo $newdirect;

?>