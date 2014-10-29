<?
include('config.php');

if(isset($_POST['data'])){
$x = explode('---', $_POST['data']);

$skippedbeofrenum = mysql_num_rows(mysql_query("SELECT * FROM `likesplanetaddonliked` WHERE (`site_id` = '{$x[0]}' AND `page_id` = '{$x[1]}' AND `user_id` = '{$x[2]}') ;"));

if($skippedbeofrenum == 0) {
mysql_query("INSERT INTO `likesplanetaddonliked` (site_id, page_id, user_id) VALUES('{$x[0]}', '{$x[1]}', '{$x[2]}')");
}

}

?>