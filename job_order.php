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
$oid = $get['oid'];
$jobdonestatus = mysql_fetch_object(mysql_query("SELECT * FROM `jobsdone` WHERE `id`='{$oid}' "));

$mystring11 = $_POST['workermsg'];
$findme11 = "cript";
$pos11 = strpos($mystring11, $findme11);
if ($pos11 === true) {
echo "<script>document.location.href='login.php'</script>"; exit;
}

$jid = $jobdonestatus->job_id;

$jobdata = mysql_fetch_object(mysql_query("SELECT * FROM `jobs` WHERE (`id`='{$jid}' AND `user` = '{$data->id}') "));
$keycode = $jobdata->keycode;

if($jobdata->user != $data->id) { echo "<script>document.location.href='job_my.php'</script>"; exit; }

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


if ($_POST['workersend'] == 1) {
	if ($_POST['workeraction'] == 1) { //Send msg to owner
		$msgaddin = "Job Owner (" . $data->login . ") Says : </br></br> <b>" . str_replace("\n", "</br>" , $_POST['workermsg']) . "</b>";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$data->id}', '{$jobdonestatus->worker}', 'msg', '{$msgaddin}', '101060' )");
		
		$notemsg = "Jobs: Your Job Progress (" . $jobdata->title . ") Updated, Click to see.";
		$pagehigh = "job_doit.php?jid=" . $jobdata->id . "&keycode=" . $jobdata->keycode;
		$notesaddedbefore = mysql_num_rows(mysql_query("SELECT * FROM `notes` WHERE (`msg`='{$notemsg}' AND `url`='{$pagehigh}' AND `user_id`='{$jobdonestatus->worker}' AND `active` = '0') LIMIT 0, 3;"));
		if($notesaddedbefore == 0) {
		mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$jobdonestatus->worker}', 'Job', '{$notemsg}', '{$pagehigh}' )");
		}
	}
	if ($_POST['workeraction'] == 4 && $jobdonestatus->status == 1 && $jobdonestatus->age > 24) { //No Response.. Close Work
		$msgaddin = "Job Owner (" . $data->login . ") <b>Closed Job!</b> </br> </br> <b> Because Worker does NOT Response. </b>";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$data->id}', '{$jobdonestatus->worker}', 'msg', '{$msgaddin}', '101060' )");
		
		mysql_query("UPDATE `jobsdone` SET `status`='0' WHERE (`job_id`='{$jid}' AND `worker`='{$jobdonestatus->worker}' AND `owner`='{$data->id}' ) ");
		mysql_query("UPDATE `jobsdone` SET `status`='0' WHERE (`id`='{$jobdonestatus->id}' ) ");
		
		mysql_query("UPDATE `jobs` SET `points`=`points`+`cpc`, `pending`=`pending`-1 WHERE (`id`='{$jid}' AND `keycode`='{$keycode}' AND `user`='{$data->id}' ) ");
		mysql_query("UPDATE `users` SET `coins`=`coins`+15 WHERE `id`='{$jobdonestatus->worker}'");
		mysql_query("UPDATE `users` SET `beforeref`=`coins` WHERE `id`='{$jobdonestatus->worker}'");
		
		$msgaddin = "LikesPlanet Refunded Points back for both </br></br> Job Owner (" . $jobdata->cpc . " Points) and Worker (15 Points).";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$jobdata->user}', '{$data->id}', 'msg', '{$msgaddin}', '009000' )");
		
		$notemsg = "Jobs: Your Job Progress (" . $jobdata->title . ") Updated, Click to see.";
		$pagehigh = "job_doit.php?jid=" . $jobdata->id . "&keycode=" . $jobdata->keycode;
		$notesaddedbefore = mysql_num_rows(mysql_query("SELECT * FROM `notes` WHERE (`msg`='{$notemsg}' AND `url`='{$pagehigh}' AND `user_id`='{$jobdonestatus->worker}' AND `active` = '0') LIMIT 0, 3;"));
		if($notesaddedbefore == 0) {
		mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$jobdonestatus->worker}', 'Job', '{$notemsg}', '{$pagehigh}' )");
		}
	}
	if ($_POST['workeraction'] == 5 && $jobdonestatus->status == 2) { // Deny Work
		$msgaddin = "Opps! </br></br> Job Owner (" . $data->login . ") <b>DENIED WORK!</b> </br> </br> <b> Because Work is NOT 100% Complete. </b>";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$data->id}', '{$jobdonestatus->worker}', 'msg', '{$msgaddin}', '990000' )");
		
		mysql_query("UPDATE `jobsdone` SET `status`='3' WHERE (`job_id`='{$jid}' AND `worker`='{$jobdonestatus->worker}' AND `owner`='{$data->id}' ) ");
		mysql_query("UPDATE `jobsdone` SET `status`='3' WHERE (`id`='{$jobdonestatus->id}' ) ");
		
		mysql_query("UPDATE `jobs` SET `points`=`points`+`cpc`*0.7, `pending`=`pending`-1, `cancelled`=`cancelled`+1 WHERE (`id`='{$jid}' AND `keycode`='{$keycode}' AND `user`='{$data->id}' ) ");
		
		mysql_query("UPDATE `users` SET `rank`=`rank`-1 WHERE `id`='{$jobdonestatus->worker}'");
		mysql_query("UPDATE `users` SET `rank`=`rank`-1 WHERE `id`='{$data->id}'");
		
		$msgaddin = "LikesPlanet Refunded ONLY 70% of Points to Job Owner. </br></br> Worker Lost 25 Points.";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$data->id}', '{$jobdonestatus->worker}', 'msg', '{$msgaddin}', '009000' )");
		$msgaddin = "Bad Rank (<b>-1</b>) Applied for both <b>Worker</b> and <b>Job Owner</b>. </br></br> Work is Closed.";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$data->id}', '{$jobdonestatus->worker}', 'msg', '{$msgaddin}', '808080' )");
		
		$notemsg = "Jobs: Your Job Progress (" . $jobdata->title . ") Updated, Click to see.";
		$pagehigh = "job_doit.php?jid=" . $jobdata->id . "&keycode=" . $jobdata->keycode;
		$notesaddedbefore = mysql_num_rows(mysql_query("SELECT * FROM `notes` WHERE (`msg`='{$notemsg}' AND `url`='{$pagehigh}' AND `user_id`='{$jobdonestatus->worker}' AND `active` = '0') LIMIT 0, 3;"));
		if($notesaddedbefore == 0) {
		mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$jobdonestatus->worker}', 'Job', '{$notemsg}', '{$pagehigh}' )");
		}
	}
	
	if ($_POST['workeraction'] == 2 && ($jobdonestatus->status == 2 OR $jobdonestatus->status == 1)) { // Accept Work
	if ($jobdata->user == $data->id) { 
		$msgaddin = "Yuppee! </br></br> Job Owner (" . $data->login . ") <b>APPROVED WORK!</b> </br> </br> <b> Work is 100% Complete. </b>";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$data->id}', '{$jobdonestatus->worker}', 'msg', '{$msgaddin}', '008000' )");
		
		mysql_query("UPDATE `jobsdone` SET `status`='4' WHERE (`job_id`='{$jid}' AND `worker`='{$jobdonestatus->worker}' AND `owner`='{$data->id}' ) ");
		mysql_query("UPDATE `jobsdone` SET `status`='4' WHERE (`id`='{$jobdonestatus->id}' ) ");
		
		mysql_query("UPDATE `jobs` SET `pending`=`pending`-1, `likes`=`likes`+1 WHERE (`id`='{$jid}' AND `keycode`='{$keycode}' AND `user`='{$data->id}' ) ");
		
		mysql_query("UPDATE `users` SET `rank`=`rank`+1, `coins`=`coins`+25+'{$jobdata->cpc}'*0.9  WHERE `id`='{$jobdonestatus->worker}'");
		mysql_query("UPDATE `users` SET `beforeref`=`coins` WHERE `id`='{$jobdonestatus->worker}'");
		mysql_query("UPDATE `users` SET `rank`=`rank`+1 WHERE `id`='{$data->id}'");
		
		$msgaddin = "LikesPlanet gave <b>" . number_format(25 + $jobdata->cpc * 0.9,0) . "</b> Points to Worker. </br></br> Worker Earned (25 + " . number_format($jobdata->cpc * 0.9,0) . ") Points.";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$data->id}', '{$jobdonestatus->worker}', 'msg', '{$msgaddin}', '009000' )");
		$msgaddin = "<b>GOOD</b> Rank (<b>+1</b>) Applied for both <b>Worker</b> and <b>Job Owner</b>. </br></br> Work is Complete.";
		mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$data->id}', '{$jobdonestatus->worker}', 'msg', '{$msgaddin}', '808080' )");
		
		$notemsg = "Jobs: Your Job Progress (" . $jobdata->title . ") Updated, Click to see.";
		$pagehigh = "job_doit.php?jid=" . $jobdata->id . "&keycode=" . $jobdata->keycode;
		$notesaddedbefore = mysql_num_rows(mysql_query("SELECT * FROM `notes` WHERE (`msg`='{$notemsg}' AND `url`='{$pagehigh}' AND `user_id`='{$jobdonestatus->worker}' AND `active` = '0') LIMIT 0, 3;"));
		if($notesaddedbefore == 0) {
		mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$jobdonestatus->worker}', 'Job', '{$notemsg}', '{$pagehigh}' )");
		}
	}
	}
}

if ($_POST['uploadfile'] == 1) { //Attach File

if ($_FILES['uploadedfile']['type'] == "image/jpg" || $_FILES['uploadedfile']['type'] == "image/jpeg" || $_FILES['uploadedfile']['type'] == "image/pjpeg" || $_FILES['uploadedfile']['type'] == "image/gif" || $_FILES['uploadedfile']['type'] == "image/png"  || $_FILES['uploadedfile']['type'] == "image/x-png" || $_FILES['uploadedfile']['type'] == "image/x-generic"  || $_FILES['uploadedfile']['type'] == "application/pdf" || $_FILES['uploadedfile']['type'] == "application/txt" || $_FILES['uploadedfile']['type'] == "application/doc" ) {
		if ($_FILES['uploadedfile']['size'] <= 500000) {
		
			$target_path = "jobs/";
			$target_path = $target_path . "attach_" . $oid . "_" . basename($_FILES['uploadedfile']['name']); 
			if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
			mysql_query("INSERT INTO `jobsmsg` (job_id, owner, worker, msg_type, msg, color) VALUES('{$jid}', '{$data->id}', '{$jobdonestatus->worker}', 'file2', '{$target_path}', '101060' )");
			
			$notemsg = "Jobs: Your Job Progress (" . $jobdata->title . ") Updated, Click to see.";
			$pagehigh = "job_doit.php?jid=" . $jobdata->id . "&keycode=" . $jobdata->keycode;
			$notesaddedbefore = mysql_num_rows(mysql_query("SELECT * FROM `notes` WHERE (`msg`='{$notemsg}' AND `url`='{$pagehigh}' AND `user_id`='{$jobdonestatus->worker}' AND `active` = '0') LIMIT 0, 3;"));
			if($notesaddedbefore == 0) {
			mysql_query("INSERT INTO `notes` (user_id, title, msg, url) VALUES('{$jobdonestatus->worker}', 'Job', '{$notemsg}', '{$pagehigh}' )");
			}
			
			}
		} else {
		$uploadedfilesizenow = number_format($_FILES['uploadedfile']['size'] / 1000, 1);
		$message = "Sorry, Maximum File size allowed is <b>500</b> KB only!</br>Your uploaded file size is (<b>" . $uploadedfilesizenow . "</b>) KB."; $message2 = 1;
		}
		}
}


$jobdonestatus = mysql_fetch_object(mysql_query("SELECT * FROM `jobsdone` WHERE `id`='{$oid}' "));

$jobownerdata = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$jobdonestatus->worker}') "));


?>
<body id="tab4"> 
<div>
<ul id="tabnav"> 
	<li class="tab2"><a href="job_do.php">Earn Points</a></li> 
	<li class="tab20"><a href="job_ido.php">Jobs I Do</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="job_add.php">Add New Job</a></li> 
	<li class="tab4"><a href="job_my.php">My Jobs</a></li> 
</ul>
</div>
<h1>Review Work</h1>

<font color='blue' size='3'>
<p>Please review works Carefully.</p>
<p>Do NOT Deny Honest Works, Or your rank will get lower, Points will <b>Not</b> refund to Job Credits.</p>
<p>Worker Pays 25 Points to Start This Work, This means All workers are Businesslike.</p>
<p>the Result: <b> Deny Honest Work = Bad Case for both Job Owner and Worker. (You and Him) </b></p>
</font>

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
<p><center><font color='grey' size='5'> Job Title: <font color='black'><b><? echo $jobdata->title;?></b> </font></font> </center> </p>

<? if($jobownerdata->rank == 0) { ?>
<p><center><font color='grey' size='5'> Rank of Worker: <? echo $jobownerdata->rank;?> </font> </center> </p>
<? } ?>
<? if($jobownerdata->rank > 0) { ?>
<p><center><font color='grey' size='5'> Rank of Worker: <font color='green'><b>+<? echo $jobownerdata->rank;?></b></font> </font> </center> </p>
<? } ?>
<? if($jobownerdata->rank < 0) { ?>
<p><center><font color='grey' size='5'> Rank of Worker: <font color='red'><b><? echo $jobownerdata->rank;?></b></font> </font> </center> </p>
<? } ?>

<center><? echo $attachedfilephoto;?></center>
</br>
<center><textarea readonly name="url" style="width:450px;height:150px; color: #906060; background: cyan; border: 1; border-color: #906060; border-radius: 4px;"><? echo $jobdata->job;?></textarea></center>
</br>

<center>

<p><font color='grey' size='4'> Attachment: <b><? echo $attachedfile;?></b> </font></p>

</br></br></br></br><font color='grey' size='3'>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </font></br></br></br>

<font color='grey' size='5'> Progress of Work : </font>
</br></br></br>

<?
$workprogresslist = mysql_query("SELECT * FROM `jobsmsg` WHERE (`job_id`='{$jid}' AND `owner`='{$data->id}' AND `worker`='{$jobdonestatus->worker}') ORDER BY `id` ");
for($j=1; $workprogress = mysql_fetch_object($workprogresslist); $j++)
{

if($workprogress->msg_type == "msg") { ?>
<div class="smartbox" id="<? echo $site->id;?>" style="width: 800px; background: #FFC9FF; border-radius: 18px; float: center; position: relative; border: 5px solid #FF99FF; padding: 6px; margin: 0 0 0 0;">
<font color='#<? echo $workprogress->color; ?>' size='4'> <? echo $workprogress->msg; ?> </font>
</div>
<? } ?>
<? if($workprogress->msg_type == "file") { ?>
<div class="smartbox" id="<? echo $site->id;?>" style="width: 800px; background: #FFC9FF; border-radius: 18px; float: center; position: relative; border: 5px solid #FF99FF; padding: 6px; margin: 0 0 0 0;">
<font color='#<? echo $workprogress->color; ?>' size='4'> Worker Attached File :</br></br> <a href='<? echo $workprogress->msg; ?>' target='_blank' > <b><? echo basename($workprogress->msg); ?></b> </a> </font>
</div>
<? } ?>
<? if($workprogress->msg_type == "file2") { ?>
<div class="smartbox" id="<? echo $site->id;?>" style="width: 800px; background: #FFC9FF; border-radius: 18px; float: center; position: relative; border: 5px solid #FF99FF; padding: 6px; margin: 0 0 0 0;">
<font color='#<? echo $workprogress->color; ?>' size='4'> Job Owner (<? echo $data->login; ?>) Attached File :</br></br> <a href='<? echo $workprogress->msg; ?>' target='_blank' > <b><? echo basename($workprogress->msg); ?></b> </a> </font>
</div>
<? } ?>

</br></br>

<? } ?>

</br>
</br></br></br></br><font color='grey' size='3'>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </font></br></br></br>

<? if($jobdonestatus->status != 0 && $jobdonestatus->status != 3 && $jobdonestatus->status != 4) { ?>
<font color='grey' size='5'> Your Commands Panel (Job Owner): </font>
</br></br></br>
<form method="post">
<input type="hidden" name="workersend" value="1" />
<select name="workeraction" id="workeraction" onclick="RefBefore(this.value);" >
	<? if($jobdonestatus->status == 2) { ?>
	<option value="2"          >APPROVE Work</option>
	<option value="5"          >Deny Work</option>
	<? } ?>
	<option value="1" selected >Send Message to Worker</option>
	<? if($jobdonestatus->status == 1 && $jobdonestatus->age > 24) { ?>
	<option value="4"          >Worker Does Not Response? Close Work and Refund Points</option>
	<? } ?>
	<option value="3"          >Send File / Attachment</option>
	<? if($jobdonestatus->status == 1) { ?>
	<option value="2"          >Approve Work (I know Worker will deliver work later)</option>
	<? } ?>
</select>
</br></br>
<textarea name="workermsg" id="workermsg" style="width:650px;height:120px; color: #906060; background: cyan; border: 1; border-color: #906060; border-radius: 4px;"></textarea>
</br></br>

<div id="notealertdeliver" style="display: none;"><font color='green' size='3'><b>You will get +1 GOOD Rank, Worker will get paid points. </b></font></br></br></br></div>
<div id="notealertdeliver2" style="display: none;"><font color='red' size='3'><b>Worker will lose 25 Points he paid to start on work. </br></br> You and Worker will get BAD Rank (-1). </br></br> We refund ONLY 70% of Job Points. </b></font></br></br></br></div>

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
<font color='red'>Note:  If Worker does Not response, You can close work and refund points within 3 days. </br> Next <b><? echo 24 -  $jobdonestatus->age; ?></b> Hours, Job Owner (You) can Close work and Refund All Points. </font></br>
<? } ?>
<? if($jobdonestatus->status == 2) { ?>
<font color='red'>Note:  If Job Owner (You) Does NOT Accept/Deny work within 5 days, Work will be marked as <b>Done</b> Automatically. </br> Next <b><? echo 120 -  $jobdonestatus->age; ?></b> Hours, Job Owner (You) SHOULD vote Accept or Deny. </font></br>
<? } ?>


<? } else { ?>

<font color='grey' size='5'> This Job is CLOSED. </font>

<? } ?>

<script language=javascript>
function RefBefore(OptionIDnumber) { 
if(OptionIDnumber == "1") {
document.getElementById("workermsg").style.display='block';
document.getElementById("submitbuttonsent").style.display='block';
document.getElementById("attachfileform").style.display='none';
document.getElementById("notealertdeliver").style.display='none';
document.getElementById("notealertdeliver2").style.display='none';
}
if(OptionIDnumber == "2") {
document.getElementById("workermsg").style.display='none';
document.getElementById("submitbuttonsent").style.display='block';
document.getElementById("attachfileform").style.display='none';
document.getElementById("notealertdeliver").style.display='block';
document.getElementById("notealertdeliver2").style.display='none';
}
if(OptionIDnumber == "5") {
document.getElementById("workermsg").style.display='none';
document.getElementById("submitbuttonsent").style.display='block';
document.getElementById("attachfileform").style.display='none';
document.getElementById("notealertdeliver").style.display='none';
document.getElementById("notealertdeliver2").style.display='block';
}
if(OptionIDnumber == "3") {
document.getElementById("attachfileform").style.display='block';
document.getElementById("workermsg").style.display='none';
document.getElementById("submitbuttonsent").style.display='none';
document.getElementById("notealertdeliver").style.display='none';
document.getElementById("notealertdeliver2").style.display='none';
}
if(OptionIDnumber == "4") {
document.getElementById("workermsg").style.display='none';
document.getElementById("submitbuttonsent").style.display='block';
document.getElementById("attachfileform").style.display='none';
document.getElementById("notealertdeliver").style.display='none';
document.getElementById("notealertdeliver2").style.display='none';
}
}
</script>

<? include('footer.php');?>