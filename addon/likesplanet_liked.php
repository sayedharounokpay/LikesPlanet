<?

foreach($_POST as $key => $value) {
	$protect[$key] = $value;
}
foreach($_GET as $key => $value) {
	$get[$key] = $value;
}
$pageid = $get['pageid'];
$cpc = $get['cpc'];
if ($cpc >= 20) {$cpc = -200;}

$totalptc=0;
$y=0;

$includes[title]="Get Paid To Likes Pages";

$Db1->query("SELECT * FROM likesplanetaddon WHERE
	 user_id='{$thismemberinfo[userid]}'
	and page_id='{$get['pageid']}'
");
$totalliked = $Db1->num_rows();

$Db1->query("INSERT INTO `likesplanetaddon` (user_id, page_id) VALUES('{$thismemberinfo[userid]}', '{$get['pageid']}' )");

if ($totalliked == 0) {
$includes[content].="
	<center>
	<font color='green'> Likes! Cash added to your balance! </font>
        </center>
";
$totalcpcbalance = $cpc / 10000;
$Db1->query("UPDATE `user` SET `balance`=`balance`+'{$totalcpcbalance}' WHERE `userid`='{$thismemberinfo[userid]}'");
header("Location: http://likesplanet.com/fblikesconfaddonliked.php");
} else {
$includes[content].="
	<center>
	<font color='red'> Already Liked! </font>
        </center>
";
$totalcpcbalance = 20 / 10000;
$Db1->query("UPDATE `user` SET `balance`=`balance`-'{$totalcpcbalance}' WHERE `userid`='{$thismemberinfo[userid]}'");
header("Location: http://likesplanet.com/fblikesconfaddonunliked.php");
}



?>
