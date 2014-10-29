<?php
$page_title = "Let People Do your Micro Jobs - LikesPlanet.com";
$meta_description = "Let People Do your Micro Jobs - LikesPlanet.com";
$meta_keywords = "Microjobs, Find, Workers, Social Media Exchanger, LikesPlanet.com";

include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='login.php'</script>"; exit;}
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$jid = $get['jid'];
$keycode = $get['keycode'];

$mystring11 = $_POST['workermsg'];
$findme11 = "cript";
$pos11 = strpos($mystring11, $findme11);
if ($pos11 === true) {
echo "<script>document.location.href='login.php'</script>"; exit;
}

$jobdata0 = mysql_query("SELECT * FROM `jobs` WHERE (`id`='{$jid}' AND `keycode`='{$keycode}' AND `user`!='{$data->id}') ");
$verificareB = mysql_num_rows($jobdata0);
if ($verificareB != 1) { echo "<script>document.location.href='index.php'</script>"; exit;}
$jobdata = mysql_fetch_object($jobdata0);

unset($siteliked4);
$siteliked4[] = -1;
  $siteliked2 = mysql_query("SELECT * FROM `jobsdone` WHERE (`worker`='{$data->id}') ");
  for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = $siteliked->job_id; }
  $site2 = mysql_query("SELECT * FROM `jobs` WHERE (`id`='{$jid}' AND `keycode`='{$keycode}' AND `user`!='{$data->id}') AND `id` in (".implode(',', $siteliked4).") LIMIT 0, 12;");
  $ext = mysql_num_rows($site2);
  if ($ext == 1) {$jobdonestatus = mysql_fetch_object(mysql_query("SELECT * FROM `jobsdone` WHERE (`worker`='{$data->id}' AND `job_id`='{$jid}'  AND `owner`='{$jobdata->user}') "));}

if ($_POST['startjob'] == 1 && $ext == 0) {
	if ($_POST['startleave'] == 0) {
	echo "<script>document.location.href='index.php'</script>"; exit;
	} else {
	if ($data->coins >= 25) {
		$jobdataA0 = mysql_fetch_object(mysql_query("SELECT * FROM `jobs` WHERE (`id`='{$jid}' AND `keycode`='{$keycode}' AND `user`!='{$data->id}' AND `points`>=`cpc`) "));
		if ($jobdataA0->id == $jid && $jobdataA0->points >= $jobdataA0->cpc) {
		mysql_query("INSERT INTO `jobsdone` (job_id, owner, worker, status) VALUES('{$jid}', '{$jobdata->user}', '{$data->id}', '1' )");
		mysql_query("UPDATE `users` SET `coins`=`coins`-25 WHERE `id`='{$data->id}'");
		mysql_query("UPDATE `jobs` SET `points`=`points`-`cpc`, `pending`=`pending`+1 WHERE (`id`='{$jid}' AND `keycode`='{$keycode}' ) ");
		
		$msgaddin = "Worker (" . $data->login . ") Paid <b>25</b> Points to Start This Job.";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$jobdata->user}', '{$data->id}', 'msg', '{$msgaddin}', '602020' )");
		
		$msgaddin = "LikesPlanet Reserved <b>" . $jobdata->cpc . "</b> Points from Job Credits to pay later for Worker.";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$jobdata->user}', '{$data->id}', 'msg', '{$msgaddin}', '009000' )");
		
		$userjobownername = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$jobdata->user}') "));
		$msgaddin = "Job Owner (" . $userjobownername->login . ") is Waiting for Needed job to be worked.";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$jobdata->user}', '{$data->id}', 'msg', '{$msgaddin}', '101060' )");
		
		$jobdonestatus = mysql_fetch_object(mysql_query("SELECT * FROM `jobsdone` WHERE (`worker`='{$data->id}' AND `job_id`='{$jid}'  AND `owner`='{$jobdata->user}') "));
		$notemsg = "Jobs: New Worker Started Your Job (" . $jobdata->title . "), Click to see.";
		$pagehigh = "job_order.php?oid=" . $jobdonestatus->id;
		mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$jobdata->user}', 'Job', '{$notemsg}', '{$pagehigh}' )");
		
		$pagehigh2 = 'http://likesplanet.com/job_order.php?oid=' . $jobdonestatus->id;
		$notemsg2 = 'Someone started your micro work (' . $jobdata->title . '). <br /><br /> Click on link below to see progress of work.';
		$userowner = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$jobdata->user}' ) "));
		mysql_query("INSERT INTO `notebyemail` (username, title, msg, link, email) VALUES('{$userowner->login}', 'LikesPlanet.com - Your Micro Works.', '{$notemsg2}', '{$pagehigh2}', '{$userowner->email}' )");
		
		}
	} else {
		$message = "Sorry, You do not have 25 Points in your Account Balance!</br>You can Not start any new job without having enough balance."; $message2 = 1;
	}
	}
}

if ($_POST['workersend'] == 1 && $ext == 1) {
	if ($_POST['workeraction'] == 1) { //Send msg to owner
		$msgaddin = "Worker (" . $data->login . ") Says : </br></br> <b>" . str_replace("\n", "</br>" , $_POST['workermsg']) . "</b>";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$jobdata->user}', '{$data->id}', 'msg', '{$msgaddin}', '602020' )");
		
		$notemsg = "Jobs: Your Job Progress (" . $jobdata->title . ") Updated, Click to see.";
		$pagehigh = "job_order.php?oid=" . $jobdonestatus->id;
		$notesaddedbefore = mysql_num_rows(mysql_query("SELECT * FROM `notes` WHERE (`msg`='{$notemsg}' AND `url`='{$pagehigh}' AND `user_id`='{$jobdata->user}' AND `active` = '0') LIMIT 0, 3;"));
		if($notesaddedbefore == 0) {
		mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$jobdata->user}', 'Job', '{$notemsg}', '{$pagehigh}' )");
		}
	}
	if ($_POST['workeraction'] == 2 && $jobdonestatus->status == 1) { //Cancel Job
		$msgaddin = "Worker (" . $data->login . ") Cancelled/Left this job, 15 Points only Refunded to his balance.";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$jobdata->user}', '{$data->id}', 'msg', '{$msgaddin}', '602020' )");
		$msgaddin = "LikesPlanet Refunded <b>" . $jobdata->cpc . "</b> Points back to Job Credits.";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$jobdata->user}', '{$data->id}', 'msg', '{$msgaddin}', '009000' )");
		
		mysql_query("UPDATE `jobsdone` SET `status`='0' WHERE (`job_id`='{$jid}' AND `worker`='{$data->id}' AND `owner`='{$jobdata->user}' ) ");
		mysql_query("UPDATE `jobsdone` SET `status`='0' WHERE (`id`='{$jobdonestatus->id}' ) ");
		
		mysql_query("UPDATE `jobs` SET `points`=`points`+`cpc`, `pending`=`pending`-1 WHERE (`id`='{$jid}' AND `keycode`='{$keycode}' ) ");
		mysql_query("UPDATE `users` SET `coins`=`coins`+15 WHERE `id`='{$data->id}'");
	}
	if ($_POST['workeraction'] == 4 && $jobdonestatus->status <= 2) { //Complete Work
		$msgaddin = "Worker (" . $data->login . ") <b>DELIVERED the WORK!</b> </br></br> <b>" . str_replace("\n", "</br>" , $_POST['workermsg']) . "</b>";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$jobdata->user}', '{$data->id}', 'msg', '{$msgaddin}', '602020' )");
		
		mysql_query("UPDATE `jobsdone` SET `status`='2' WHERE (`job_id`='{$jid}' AND `worker`='{$data->id}' AND `owner`='{$jobdata->user}' ) ");
		mysql_query("UPDATE `jobsdone` SET `status`='2' WHERE (`id`='{$jobdonestatus->id}' ) ");
		
		$notemsg = "Jobs: Your Job Progress (" . $jobdata->title . ") Updated, Click to see.";
		$pagehigh = "job_order.php?oid=" . $jobdonestatus->id;
		$notesaddedbefore = mysql_num_rows(mysql_query("SELECT * FROM `notes` WHERE (`msg`='{$notemsg}' AND `url`='{$pagehigh}' AND `user_id`='{$jobdata->user}' AND `active` = '0') LIMIT 0, 3;"));
		if($notesaddedbefore == 0) {
		mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$jobdata->user}', 'Job', '{$notemsg}', '{$pagehigh}' )");
		}
	}
}
if ($_POST['uploadfile'] == 1) { //Attach File
if ($_FILES['uploadedfile']['type'] == "image/jpg" || $_FILES['uploadedfile']['type'] == "image/jpeg" || $_FILES['uploadedfile']['type'] == "image/pjpeg" || $_FILES['uploadedfile']['type'] == "image/gif" || $_FILES['uploadedfile']['type'] == "image/png"  || $_FILES['uploadedfile']['type'] == "image/x-png" || $_FILES['uploadedfile']['type'] == "image/x-generic"  || $_FILES['uploadedfile']['type'] == "application/pdf" || $_FILES['uploadedfile']['type'] == "application/txt" || $_FILES['uploadedfile']['type'] == "application/doc" ) {
		if ($_FILES['uploadedfile']['size'] <= 500000) {
			$target_path = "jobs/";
			$target_path = $target_path . "attach_" . $jid . "_" . basename($_FILES['uploadedfile']['name']); 
			if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
			// $msgaddin = "Worker (" . $data->login . ") Attached File : </br></br> <a href='" . $target_path  . "' target='_blank'><b><font color='blue'>" . basename( $_FILES['uploadedfile']['name']) . "</font></b></a></b>";
			mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$jobdata->user}', '{$data->id}', 'file', '{$target_path}', '602020' )");
			
			$notemsg = "Jobs: Your Job Progress (" . $jobdata->title . ") Updated, Click to see.";
			$pagehigh = "job_order.php?oid=" . $jobdonestatus->id;
			$notesaddedbefore = mysql_num_rows(mysql_query("SELECT * FROM `notes` WHERE (`msg`='{$notemsg}' AND `url`='{$pagehigh}' AND `user_id`='{$jobdata->user}' AND `active` = '0') LIMIT 0, 3;"));
			if($notesaddedbefore == 0) {
			mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$jobdata->user}', 'Job', '{$notemsg}', '{$pagehigh}' )");
			}
			
			}
		} else {
		$uploadedfilesizenow = number_format($_FILES['uploadedfile']['size'] / 1000, 1);
		$message = "Sorry, Maximum File size allowed is <b>500</b> KB only!</br>Your uploaded file size is (<b>" . $uploadedfilesizenow . "</b>) KB."; $message2 = 1;
		}
		}
}

unset($siteliked4);
$siteliked4[] = -1;
  $siteliked2 = mysql_query("SELECT * FROM `jobsdone` WHERE (`worker`='{$data->id}') ");
  for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = $siteliked->job_id; }
  $site2 = mysql_query("SELECT * FROM `jobs` WHERE (`id`='{$jid}' AND `keycode`='{$keycode}' AND `user`!='{$data->id}') AND `id` in (".implode(',', $siteliked4).") LIMIT 0, 12;");
  $ext = mysql_num_rows($site2);
  if ($ext == 1) {$jobdonestatus = mysql_fetch_object(mysql_query("SELECT * FROM `jobsdone` WHERE (`worker`='{$data->id}' AND `job_id`='{$jid}'  AND `owner`='{$jobdata->user}') "));}

$attachedfile = $jobdata->attachment;
if ($attachedfile == "") {
	$attachedfile = "<font color='grey'> No File. </font>";
	} else {
	$attachedfile = "<a href='jobs/" . $jobdata->keycode . "_" . $jobdata->attachment . "' target='_blank'> <font color='blue' size='5'>" . $attachedfile . "</font> </a>";
}

$attachedfilephoto = $jobdata->photo;
if ($attachedfilephoto == "") {
	$attachedfilephoto = "";
	} else {
	$attachedfilephoto = "<img src='" . $attachedfilephoto . "' border='0' height='200' width='300' style='border-radius: 24px;' /></br>";
}

$jobownerdata = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$jobdata->user}') "));

?>
<body id="tab5"> 
<div>
<ul id="tabnav"> 
	<li class="tab2"><a href="job_do.php">Earn Points</a></li> 
	<li class="tab5"><a href="job_ido.php">Jobs I Do</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="job_add.php">Add New Job</a></li> 
	<li class="tab4"><a href="job_my.php">My Jobs</a></li> 
</ul>
</div>
<h1>Do Job to Earn Points/Money</h1>
<? if($ext == 0) { ?>
<font color='blue' size='3'>
<p>Please do your job Exactly as needed step by step.</p>
<p>Job Owner will review your work to Approve of Deny.</p>
<p>When Job owner approves your work, You will get paid <? echo number_format($jobdata->cpc * 0.9,0); ?> Points = $<? echo number_format($jobdata->cpc * 0.9 / 5000,3); ?>.</p>
<p>If job owner <font color='red'>Denied</font> your work, You will lose -25 Points.</p>
<p>Job owner does Not deny honest works, because Points will Not restore to him if he denies your work.</p>
<p>the Result: <b> Bad Work = Bad Case for both Worker and Job Owner. (You and Him) </b></p>
</font>
<? } ?>

</br>

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
<p><center><font color='grey' size='5'> Job Title: <font color='black'><b><? echo $jobdata->title;?></b> </font></font> - <font color='green' size='5'><b><? echo number_format($jobdata->cpc*0.9,0);?></b> Points</font> </center> </p>

<? if($jobownerdata->rank == 0) { ?>
<p><center><font color='grey' size='5'> Rank of Job Owner: <? echo $jobownerdata->rank;?> </font> </center> </p>
<? } ?>
<? if($jobownerdata->rank > 0) { ?>
<p><center><font color='grey' size='5'> Rank of Job Owner: <font color='green'><b>+<? echo $jobownerdata->rank;?></b></font> </font> </center> </p>
<? } ?>
<? if($jobownerdata->rank < 0) { ?>
<p><center><font color='grey' size='5'> Rank of Job Owner: <font color='red'><b><? echo $jobownerdata->rank;?></b></font> </font> </center> </p>
<? } ?>

<center><? echo $attachedfilephoto;?></center>
</br>
<center><textarea readonly name="url" style="width:450px;height:300px; color: #906060; background: cyan; border: 1; border-color: #906060; border-radius: 4px;"><? echo $jobdata->job;?></textarea></center>
</br>

<center>

<p><font color='grey' size='4'> Attachment: <b><? echo $attachedfile;?></b> </font></p>

</br></br></br></br><font color='grey' size='3'>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </font></br></br></br>

<? if($ext == 0) { ?>

<font color='green' size='3'><center><b>
Before you Start in Job, You should Pay 25 Points. </br></br>
When your Job is Complete, We will refund this 25 Points + Earn <? echo number_format($jobdata->cpc * 0.9,0); ?> Points for doing this job. </br></br>
If Job Owner Rejected your work, 25 Points will be lost, but Job Owner will lose his points also. </br></br>
This Protocol helps to make both the Worker (You) and Job Owner (him) are Honest. </br></br>
</br>
<form method="post">
<input type="hidden" name="startjob" value="1" />
<select name="startleave" id="startleave">
	<option value="0" <?if($jobdata->active == 0){?>selected<?}?>>No, I Do Not Accept. Leave now.</option>
	<option value="1" <?if($jobdata->active == 1){?>selected<?}?>>Yes, I can do it, Pay 25 Points and Start.</option>
</select>
</br></br>
<input type="submit" value="OK" class="submit" style="width: 200; height: 34;" />
</form>

</b></center></font>


<? } else { ?> 

<font color='grey' size='5'> Progress of Work : </font>
</br></br></br>

<?
$workprogresslist = mysql_query("SELECT * FROM `jobsmsg` WHERE (`job_id`='{$jid}' AND `worker`='{$data->id}' AND `owner`='{$jobdonestatus->owner}') ORDER BY `id` ");
for($j=1; $workprogress = mysql_fetch_object($workprogresslist); $j++)
{

if($workprogress->msg_type == "msg") { ?>
<div class="smartbox" id="<? echo $site->id;?>" style="width: 800px; background: #FFC9FF; border-radius: 18px; float: center; position: relative; border: 5px solid #FF99FF; padding: 6px; margin: 0 0 0 0;">
<font color='#<? echo $workprogress->color; ?>' size='4'> <? echo $workprogress->msg; ?> </font>
</div>
<? } ?>
<? if($workprogress->msg_type == "file") { ?>
<div class="smartbox" id="<? echo $site->id;?>" style="width: 800px; background: #FFC9FF; border-radius: 18px; float: center; position: relative; border: 5px solid #FF99FF; padding: 6px; margin: 0 0 0 0;">
<font color='#<? echo $workprogress->color; ?>' size='4'> Worker (<? echo $data->login; ?>) Attached File :</br></br> <a href='<? echo $workprogress->msg; ?>' target='_blank' > <b><? echo basename($workprogress->msg); ?></b> </a> </font>
</div>
<? } ?>
<? if($workprogress->msg_type == "file2") { ?>
<div class="smartbox" id="<? echo $site->id;?>" style="width: 800px; background: #FFC9FF; border-radius: 18px; float: center; position: relative; border: 5px solid #FF99FF; padding: 6px; margin: 0 0 0 0;">
<font color='#<? echo $workprogress->color; ?>' size='4'> Job Owner Attached File :</br></br> <a href='<? echo $workprogress->msg; ?>' target='_blank' > <b><? echo basename($workprogress->msg); ?></b> </a> </font>
</div>
<? } ?>

</br></br>

<? } ?>

</br>
</br></br></br></br><font color='grey' size='3'>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </font></br></br></br>

<? if($jobdonestatus->status != 0 && $jobdonestatus->status != 3 && $jobdonestatus->status != 4) { ?>
<font color='grey' size='5'> Your Commands Panel (Worker): </font>
</br></br></br>
<form method="post">
<input type="hidden" name="workersend" value="1" />
<select name="workeraction" id="workeraction" onclick="RefBefore(this.value);" >
	<option value="4" selected >Deliver/Complete Work</option>
	<option value="1"          >Send Message ONLY</option>
	<option value="3"          >Send File / Attachment</option>
	<? if($jobdonestatus->status == 1) { ?>
	<option value="2"          >Cancel/Leave This Job, I can Not do it.</option>
	<? } ?>
</select>
</br></br>
<textarea name="workermsg" id="workermsg" style="width:650px;height:120px; color: #906060; background: cyan; border: 1; border-color: #906060; border-radius: 4px;"></textarea>
</br></br>

<div id="notealertdeliver" style="display: block;"><font color='red'><b>Note:  If you want to Attach Files, Please attach files FIRST , Then mark job as Complete. </br> Do NOT mark job as Complete only when it is 100% Done. Or Job Owner may Reject your work! </b></font></br></br></div>

<div id="submitbuttonsent"><input type="submit" value="Send" class="submit" style="width: 200; height: 34;" /></div>
</form>

</br>

<form id="attachfileform" enctype="multipart/form-data" method="POST" style="display: none;">
<input type="hidden" name="uploadfile" value="1" />
<font size='3' color='green'>Attach File: <input name="uploadedfile" type="file" /> </font> (Max file size = 500 Kb) <br /> <br /></br>
<input type="submit" value="Upload File" class="submit" style="width: 200; height: 34;"  />
</form>

</br></br>
<? if($jobdonestatus->status == 1 && $jobdonestatus->age < 24) { ?>
<font color='red'>Note:  If Worker (You) does Not deliver work within 3 days, Job Owner can close work and refund points. </br> Next <b><? echo 24-  $jobdonestatus->age; ?></b> Hours, It is Better to Deliver work. </font></br>
<? } ?>
<? if($jobdonestatus->status == 2) { ?>
<font color='red'>Note:  If Job Owner Does Not Accept/Deny your work, It will be marked <d>Done</b> Automatically within 5 days. </br> Next <b><? echo 120 -  $jobdonestatus->age; ?></b> Hours, Work will be marked Done if Job Owner does not response. </font></br>
<? } ?>


<? } else { ?>

<font color='grey' size='5'> This Job is CLOSED. </font>

<? } } ?>

<script language=javascript>
function RefBefore(OptionIDnumber) { 
if(OptionIDnumber == "1") {
document.getElementById("workermsg").style.display='block';
document.getElementById("submitbuttonsent").style.display='block';
document.getElementById("attachfileform").style.display='none';
document.getElementById("notealertdeliver").style.display='none';
}
if(OptionIDnumber == "2") {
document.getElementById("workermsg").style.display='none';
document.getElementById("submitbuttonsent").style.display='block';
document.getElementById("attachfileform").style.display='none';
document.getElementById("notealertdeliver").style.display='none';
}
if(OptionIDnumber == "3") {
document.getElementById("attachfileform").style.display='block';
document.getElementById("workermsg").style.display='none';
document.getElementById("submitbuttonsent").style.display='none';
document.getElementById("notealertdeliver").style.display='none';
}
if(OptionIDnumber == "4") {
document.getElementById("workermsg").style.display='block';
document.getElementById("submitbuttonsent").style.display='block';
document.getElementById("attachfileform").style.display='none';
document.getElementById("notealertdeliver").style.display='block';
}
}
</script>

<? include('footer.php');?>