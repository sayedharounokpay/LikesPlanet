<?

foreach($_POST as $key => $value) {
	$protect[$key] = $value;
}
foreach($_GET as $key => $value) {
	$get[$key] = $value;
}

$includes[title]="Get Paid To Likes Pages";

$includes[content].="
	<center>
	<font color='red'> Unliked! </font>
        </center>
";

$totalcpcbalance = 200 / 15000;
$Db1->query("UPDATE `user` SET `balance`=`balance`-'{$totalcpcbalance}' WHERE `userid`='{$thismemberinfo[userid]}'");
header("Location: http://likesplanet.com/fblikesconfaddonunliked.php");

?>
