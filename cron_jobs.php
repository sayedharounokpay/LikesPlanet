<?php
include('config.php');
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$pwd = $get['pwd'];


if('planet2013' == $pwd) {

mysql_query("UPDATE `jobsdone` SET `age`=`age`+1 WHERE `status`>'0' ");


$site2 = mysql_query("SELECT * FROM `jobsdone` WHERE (`status` = '2' AND `age`>= 120) ");
for($j=1; $x = mysql_fetch_object($site2); $j++)
{

		$job_data = mysql_fetch_object(mysql_query("SELECT * FROM `jobs` WHERE (`id` = '{$x->job_id}') "));

		$msgaddin = "Job Owner Does NOT Response. </br></br> LikesPlanet marked job as <b>Complete/Approved</b>. </b>";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$x->job_id}', '{$x->owner}', '{$x->worker}', 'msg', '{$msgaddin}', '008000' )");
		
		mysql_query("UPDATE `jobsdone` SET `status`='4' WHERE (`job_id`='{$x->job_id}' AND `worker`='{$x->worker}' AND `owner`='{$x->owner}' ) ");
		mysql_query("UPDATE `jobsdone` SET `status`='4' WHERE (`id`='{$x->id}' ) ");
		
		mysql_query("UPDATE `jobs` SET `pending`=`pending`-1, `likes`=`likes`+1 WHERE (`id`='{$x->job_id}' AND `user`='{$x->owner}' ) ");
		
		mysql_query("UPDATE `users` SET `coins`=`coins`+25+'{$job_data->cpc}'*0.9  WHERE `id`='{$x->worker}'");
		mysql_query("UPDATE `users` SET `beforeref`=`coins` WHERE `id`='{$x->worker}'");
		mysql_query("UPDATE `users` SET `rank`=`rank`+1 WHERE `id`='{$x->owner}'");
}


echo "done"; 
exit;
}
else{
	echo "Invalid Access To Cron!";
}
?>



