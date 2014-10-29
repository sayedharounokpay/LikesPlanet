<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$id = $get['id'];
$page = mysql_fetch_object(mysql_query("SELECT * FROM `likesplanetaddon` WHERE `id`='{$id}' AND `userid`='{$data->id}'"));
$myerrnn = $page->hits * 5 / 6;

if ($page->hits >= 2) {
mysql_query("INSERT INTO `likesplanetaddon_paid` (site_id, paid) VALUES('{$page->id}', '{$myerrnn}')");
mysql_query("UPDATE `likesplanetaddon` SET `hits`='0' WHERE `id`='{$page->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$myerrnn}' WHERE `id`='{$page->userid}'");
mysql_query("UPDATE `users` SET `beforeref`=`coins` WHERE `id`='{$page->userid}'");
}


?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="siteownersadd.php">Add My New PTC Website to Earn More</a></li> 
	<li class="tab2"><a href="siteownersmy.php">Install Plugin on My Sites</a></li> 
</ul>
</div>
<h1>Move Earnings to My LikesPlanet Balance</h1>
</br></br>

<center>
<font color='green' size='4'>
(<b><? echo $myerrnn; ?></b> Points) moved from Site-Earnings to Your LikesPlanet balance.
</br></br>
Now You can make Cashout request to get paid next days.
</font>
</center>

<? include('footer.php');?>