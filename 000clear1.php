<?php
include('config.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}

$siteliked4[] = -1;
$siteliked2 = mysql_query("SELECT * FROM `users` ");
for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = $siteliked->id; }

$numAdded = 0;
$numSkipped = 0;

//$missedusers = mysql_query("select * from `usersold` where (`online` >= '2014-1-1' AND `id` < '200000' AND `online` != '0000-00-00 00:00:00' AND `id` not in (".implode(',', $siteliked4).")) ");
//$missedusersNum = mysql_num_rows($missedusers);

$missedusers = mysql_query("select * from `usersold` where (`online` >= '2014-1-1' AND `id` < '200000' AND `online` != '0000-00-00 00:00:00' AND `id` not in (".implode(',', $siteliked4).")) LIMIT 0, 1000");

for($j=0; $ubdata = mysql_fetch_object($missedusers); $j++)
{
$confthisnotduplicated = mysql_num_rows(mysql_query("select 'id' from `users` where `login` = '{$ubdata->login}' LIMIT 0, 1"));

if ($confthisnotduplicated == 0) {
mysql_query("INSERT INTO `users` (backed_up, id, email, login, IP, pass, signup, online, banned, ref, likes, ref2, refgive, refgot, rate, votes, fbn, conf, ban, pr, age, bought, country, beforeref, ptp, coins, reason) VALUES('5', '{$ubdata->id}', '{$ubdata->email}', '{$ubdata->login}', '{$ubdata->IP}', '{$ubdata->pass}', '{$ubdata->signup}', '{$ubdata->online}', '{$ubdata->banned}', '{$ubdata->ref}', '{$ubdata->likes}', '{$ubdata->ref2}', '{$ubdata->refgive}', '{$ubdata->refgot}', '{$ubdata->rate}', '{$ubdata->votes}', '{$ubdata->fbn}', '{$ubdata->conf}', '{$ubdata->ban}', '{$ubdata->pr}', '{$ubdata->age}', '{$ubdata->bought}', '{$ubdata->country}', '{$ubdata->beforeref}' , '{$ubdata->ptp}', '50', '{$ubdata->reason}'   )");
$numAdded = $numAdded + 1;
} else {
$numSkipped = $numSkipped + 1;
echo "Duplicate: ";
echo $ubdata->login;
echo "</br>";

}
}
?>

</br>
<? echo $numAdded;?> Restored. </br>
<? echo $numSkipped ;?> Skipped. </br></br>
<? echo $missedusersNum;?> Members.

<div class="clearer">&nbsp;</div>