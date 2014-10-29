<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

if(isset($_GET['sitename1'])){
$x = explode('---', $_GET['sitename1']);

$skippedbeofrenum = 0;
$skippedbeofrenum = mysql_num_rows(mysql_query("SELECT * FROM `likesplanetaddon_start` WHERE (`site_id` = '{$x[0]}' AND `page_id` = '{$x[1]}' AND `user_id` = '{$x[3]}') ;"));


if ($skippedbeofrenum == 0) {

$site99 = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE `id`='{$x[1]}' AND `user`='{$x[2]}' ;"));

if(preg_match("/\bpages\b/i", $site99->facebook)){
$x110 = explode('/', $site99->facebook);
$name0 = $x110[5];}
else { $x110 = explode('/', $site99->facebook);
$name0 = $x110[3]; }
if(preg_match("/\bfref\b/i", $name0)){
$x110009 = explode('?', $name0);
$name0 = $x110009[0];
}

$likesnumnum = 0;

$url0   = 'https://graph.facebook.com/'. urlencode($name0); 
$mystring0 = file_get_contents($url0);
$x1103 = explode('likes"', $mystring0);
$x11103 = explode(':', $x1103[1]);
$x111033 = explode(',', $x11103[1]);
$x111033e = explode('}', $x111033[0]);
$likesnumnum = $x111033e[0];


if ($likesnumnum < 1) {$likesnumnum = 32;}


mysql_query("INSERT INTO `likesplanetaddon_start` (site_id, page_id, user_id, start) VALUES('{$x[0]}', '{$x[1]}', '{$x[3]}', '{$likesnumnum}')");

// if($skippedbeofrenum == 0) {
//
// else {
// mysql_query("UPDATE `likesplanetaddon_start` SET `start` = '{$likesnumnum}' WHERE (`site_id` = '{$x[0]}' AND `page_id` = '{$x[1]}'  AND `user_id` = '{$x[2]}' ) ");
//}

}

echo $likesnumnum;

}


?>