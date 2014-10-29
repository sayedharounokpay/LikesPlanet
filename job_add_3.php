<?php
$page_title = "Let People Do your Micro Jobs - LikesPlanet.com";
$meta_description = "Let People Do your Micro Jobs - LikesPlanet.com";
$meta_keywords = "Microjobs, Find, Workers, Social Media Exchanger, LikesPlanet.com";


include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='login.php'</script>"; exit;}

function blockedsites($text) {
    $bannedWords = array('socialbirth', 'addmefast', 'admf', 'youlikehits', 'shareyt', 'likerr', 'netlikes', 'get2gathers', 'freefblike', 'anhits', 'gimmehits', 'clicksocialexchange', 'growsociallikes', 'socialskive', 'hitger', 'wanafans', 'yaa1', 'likesniper', 'like-ex', 'fbtwister', 'seoclerks', 'fanslave', 'addm', 'googleglassessupplier', 'fan-likes', 'socialworld', 'youlikefan', 'atodoweb', 'todagalicia', 'youlikefans', 'likeyou', 'exchanger', 'fiverr', 'shorthit', 'followerslikehits', 'followlike', 'socialpromo', 'ewsaly', 'likesasap', 'hitserr', 'advertcash', 'addm.cc') ;
    foreach ($bannedWords as $bannedWord) {
        if (strpos($text, $bannedWord) !== false) {
            return false ;}}
    return true;
   }

if(isset($_POST['add'])){

	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
	$size = strlen( $chars );
	$str = "";
	for( $i = 0; $i < 10; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

$verificare1 = mysql_query("SELECT * FROM `jobs` WHERE `keycode`='{$str}'");
$verificareB = mysql_num_rows($verificare1);

$replacedText = blockedsites($protectie['url']);

if($verificareB > 0) {
$message = "Error: Please try again!"; $message2 = 1;
}
else if($_POST['cpc'] > 5000) {$message = "CPC Problem!"; $message2 = 1;}
else if($_POST['cpc'] > 2500 && $data->pr == 0) {$message = "CPC Problem!"; $message2 = 1;}

else if($replacedText === false) {$message = "Sorry, This job includes one of Blocked sites to be advertised here!"; $message2 = 1;}

else if($_POST['title'] == "") {$message = "Job title can Not be empty!"; $message2 = 1;}

else if($_POST['addpoints'] > $data->coins){$message = "You do Not have enough points to add job now!"; $message2 = 1;}

else{

mysql_query("INSERT INTO `jobs` (user, title, cpc, keycode, job) VALUES('{$data->id}', '{$protectie['title']}', '{$protectie['cpc']}', '{$str}', '{$protectie['url']}'   ) ");

// Add my coins to this page
if ($_POST['addpoints'] <= $data->coins  and  $_POST['addpoints']>-1){
mysql_query("UPDATE `jobs` SET `points`=`points`+'{$_POST['addpoints']}' WHERE `keycode`='{$str}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['addpoints']}' WHERE `id`='{$data->id}'");
mysql_query("UPDATE `users` SET `beforeref`=`coins` WHERE `id`='{$data->id}'");
}

$linktoattach = "<script>document.location.href='job_add_2.php?jkc=" . $str . "'</script>";
echo $linktoattach; exit;
$message = "Job Added with success!"; $message2 = 2;

}}
?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab2"><a href="job_do.php">Earn Points</a></li> 
	<li class="tab20"><a href="job_ido.php">Jobs I Do</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="job_add.php">Add New Job</a></li> 
	<li class="tab4"><a href="job_my.php">My Jobs</a></li> 
</ul>
</div>
<h1>Add New Job</h1>
<p>You can add Jobs needed, Workers will do your jobs based on Steps you provide.</p>

<? echo $msg; ?>
<? if ($message2 == 1) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>
<? if ($message2 == 2) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_done.jpg?a" border="0" title="LikesPlanet.com - Done"></td><td width="20"></td><td> <font color='green' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>

</br>
<center><img src="img/job_add.jpg" ></center>
</br>

<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 4px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="title">Job Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="44" maxlength="30" /></td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="url">Job Needed:</label></td><td width="20"></td><td><textarea name="url" style="width:450px;height:260px;"></textarea></td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="points">Points per Job (CPC):</label></td><td width="20"></td><td><select name="cpc" id="cpc"  onclick="RefBefore();" >
	<option value="250" style="background-color: #FF9999;">250</option>
	<option value="500" style="background-color: #FF9999;">500</option>
	<option value="750" style="background-color: #FF9999;">750</option>
	<option value="1000" style="background-color: #9999FF;" selected>1000</option>
	<option value="1250" style="background-color: #9999FF;">1250</option>
	<option value="1500" style="background-color: #9999FF;">1500</option>
	<option value="1750" style="background-color: #99FF99;">1750</option>
	<option value="2000" style="background-color: #99FF99;">2000</option>
	<option value="2500" style="background-color: #99FF99;">2500</option>
	<? if ($data->pr >0){ ?>
	<option value="2750" style="background-color: #FFFF00;">2750 [VIP]</option>
	<option value="3000" style="background-color: #FFFF00;">3000 [VIP]</option>
	<option value="3500" style="background-color: #FFFF00;">3500 [VIP]</option>
	<option value="4000" style="background-color: #FFFF00;">4000 [VIP]</option>
	<option value="5000" style="background-color: #FFFF00;">5000 [VIP]</option>
	<?}?>
</select></td></tr>

<? if ($data->pr == 0){ ?>
<p><a href="prem.php"><font color="green">Upgrade to a <b>"Premium Membership"</b> and unlock <b>5000 cpc</b>, get bigger jobs done!</font></a><p>
<? } ?>

<tr><td>&nbsp;</td></tr>

<tr><td><label for="times">I need job to be worked</label></td><td width="20"></td><td><select name="times" id="times" onclick="RefBefore();"  >
	<option value="1">for Once only</option>
	<option value="2">2 Times</option>
	<option value="3">3 Times</option>
	<option value="4">4 Times</option>
	<option value="5">5 Times</option>
	<option value="6">6 Times</option>
	<option value="7">7 Times</option>
	<option value="8">8 Times</option>
	<option value="9">9 Times</option>
	<option value="10">10 Times</option>
	<option value="15">15 Times</option>
	<option value="20">20 Times</option>
</select></td></tr>

	<tr><td>&nbsp;</td></tr>

<tr><td><label for="addpoints">Points to Add now:</label></td><td width="20"></td><td><input type="text" name="addpoints" id="addpoints" value="1000"  size="7" maxlength="6" /> (min = Job CPC)</td></tr>
<tr><td colspan="2"></td><td>Remember to add points from balance to your Job to be worked.</td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td colspan="2"></td><td>* You can attach files by next step.</td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td colspan="2"></td><td><input type="submit" name="add" value="Next Step" class="submit" style="width: 270px; height: 38px;" /></td></tr>
</table></center>
</form>

<script language=javascript>
function RefBefore() { 
document.getElementById("addpoints").value = document.getElementById("times").value * document.getElementById("cpc").value;
}
</script>

<? include('footer.php');?>