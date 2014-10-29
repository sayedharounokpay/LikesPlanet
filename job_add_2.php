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

$jkc = $get['jkc'];

if ($_POST['uploadfile'] == 1) {
if ($_FILES['uploadedfile']['type'] == "image/jpg" || $_FILES['uploadedfile']['type'] == "image/jpeg" || $_FILES['uploadedfile']['type'] == "image/pjpeg" || $_FILES['uploadedfile']['type'] == "image/gif" || $_FILES['uploadedfile']['type'] == "image/png"  || $_FILES['uploadedfile']['type'] == "image/x-png" || $_FILES['uploadedfile']['type'] == "image/x-generic"  || $_FILES['uploadedfile']['type'] == "application/pdf" || $_FILES['uploadedfile']['type'] == "application/txt" || $_FILES['uploadedfile']['type'] == "application/doc" ) {
if ($_FILES['uploadedfile']['size'] <= 500000) {
$target_path = "jobs/";
/* Add the original filename to our target path.  
Result is "uploads/filename.extension" */
$target_path = $target_path . $jkc . "_" . basename( $_FILES['uploadedfile']['name']); 

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	$message = "The file (" . basename( $_FILES['uploadedfile']['name']) . ") has been uploaded!"; $message2 = 2;
	$fileattachnamefile = basename( $_FILES['uploadedfile']['name']);
	mysql_query("UPDATE `jobs` SET `attachment`='{$fileattachnamefile}' WHERE `keycode`='{$jkc}'");

} else{
	$message = "There was an error uploading the file, please try again!"; $message2 = 1;
}
} else {
	$uploadedfilesizenow = number_format($_FILES['uploadedfile']['size'] / 1000, 1);
	$message = "Sorry, Maximum File size allowed is <b>500</b> KB only!</br>Your uploaded file size is (<b>" . $uploadedfilesizenow . "</b>) KB."; $message2 = 1;
}
} else {
	$message = "File Type is Not allowed!</br> Formats allowed : (JPG - PNG - GIF - DOC - TXT - PDF)"; $message2 = 1;
}
}

if ($_POST['editjob'] == 1) {
mysql_query("UPDATE `jobs` SET `job`='{$_POST['url']}', `active`='{$_POST['active']}' WHERE `keycode`='{$jkc}'");
}

if ($_POST['uploadfile2'] == 1) {
if ($data->coins >= 25) {
if ($_FILES['uploadedfile']['type'] == "image/jpg" || $_FILES['uploadedfile']['type'] == "image/jpeg" || $_FILES['uploadedfile']['type'] == "image/pjpeg" || $_FILES['uploadedfile']['type'] == "image/gif" || $_FILES['uploadedfile']['type'] == "image/png"  || $_FILES['uploadedfile']['type'] == "image/x-png" || $_FILES['uploadedfile']['type'] == "image/x-generic" ) {
if ($_FILES['uploadedfile2']['size'] <= 200000) {
$target_path = "jobs/";
$target_path = $target_path . $jkc . "_Thumb.jpg"; 

if(move_uploaded_file($_FILES['uploadedfile2']['tmp_name'], $target_path)) {
	$message = "The file has been uploaded!"; $message2 = 2;
	mysql_query("UPDATE `jobs` SET `photo`='{$target_path}' WHERE `keycode`='{$jkc}'");
	mysql_query("UPDATE `users` SET `coins`=`coins`-25 WHERE `id`='{$data->id}'");
} else{
	$message = "There was an error uploading the Photo, please try again!"; $message2 = 1;
}
} else {
	$uploadedfilesizenow = number_format($_FILES['uploadedfile2']['size'] / 1000, 1);
	$message = "Sorry, Maximum Photo File size allowed is <b>200</b> KB only!</br>Your uploaded file size is (<b>" . $uploadedfilesizenow . "</b>) KB."; $message2 = 1;
}
} else {
	$message = "File Type is Not allowed!</br> Formats allowed : (JPG - PNG - GIF)"; $message2 = 1;
}
} else {
	$message = "You do not have 25 Points in Account Balance to use for Featured Photo Job!"; $message2 = 1;
}
}

$jobdata = mysql_fetch_object(mysql_query("SELECT * FROM `jobs` WHERE `keycode`='{$jkc}' AND `user`='{$data->id}'"));

$attachedfile = $jobdata->attachment;
if ($attachedfile == "") {
	$attachedfile = "<font color='red'> No File. </font>";
	} else {
	$attachedfile = "<font color='blue'>" . $attachedfile . "</font>";
}

$attachedfilephoto = $jobdata->photo;
if ($attachedfilephoto == "") {
	$attachedfilephoto = "<font color='grey' size='4'> Photo: <font color='red'> No Photo. </font> </font>";
	} else {
	$attachedfilephoto = "<img src='" . $attachedfilephoto . "?ref=" . rand(1,100) . "' border='0' height='200' width='300' style='border-radius: 24px;' />";
}

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
<h1>Job Options</h1>
<p>Here you can Attach files needed for your Job.</p>
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
<p><font color='grey' size='5'> Job Title: <font color='black'><b><? echo $jobdata->title;?></b> </font></font> </p>
</br></br>

<p><font color='grey' size='4'> Attached File: <b><? echo $attachedfile;?></b> </font></p>
</br>
You can attach file Worker may need it to do your job perfectly.
</br></br>
<form enctype="multipart/form-data" method="POST">
<input type="hidden" name="uploadfile" value="1" />
<font size='3' color='green'>Attach File: <input name="uploadedfile" type="file" /> </font> (Max file size = 500 Kb , JPG-PNG-DOC-TXT-PDF) <br /> <br />
<input type="submit" value="Upload File" class="submit" style="width: 200; height: 34;"  />
</form>

</br></br></br></br><font color='grey' size='3'>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </font></br></br></br></br>


<p><font color='grey' size='4'> Featured Job: (optional) </font></p>
</br>
<p><? echo $attachedfilephoto;?></p>
</br>
This option <b>Costs 25 points</b>, You choose a Photo to be placed under your Job Title.
</br>
Workers love to do jobs with a photo, as it will be Remarkable, You can upload any photo includes Money, Dollars, or Job logo.
</br>
Upload photo scale (300x200) pixels, or it will be Resized. Maximum file size is 200 KB.
</br></br>
<form enctype="multipart/form-data" method="POST">
<input type="hidden" name="uploadfile2" value="1" />
<font size='3' color='green'>Set Photo: <input name="uploadedfile2" type="file" /> </font> (JPG - 300x200 pxl) <br /> <br />
<input type="submit" value="Upload Photo" class="submit" style="width: 200; height: 34;"  />
</form>

</br></br></br></br><font color='grey' size='3'>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </font></br></br></br></br>

<p><font color='grey' size='4'> Edit Job: </font></p>
<form method="post">
<input type="hidden" name="editjob" value="1" />
<center><textarea name="url" style="width:450px;height:260px;"><? echo $jobdata->job;?></textarea></center>
</br></br>
<font color='grey' size='3'> Status: </font> <select name="active" id="active">
	<option value="0" <?if($jobdata->active == 0){?>selected<?}?>>Active ON</option>
	<option value="1" <?if($jobdata->active == 1){?>selected<?}?>>Disable OFF</option>
</select>
</br></br>
<center><input type="submit" value="Edit Job" class="submit" style="width: 200; height: 34;" /></center>
</form>

</br></br></br></br><font color='grey' size='3'>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </font></br></br></br></br>

* You can Not edit CPC.
</br>


<? include('footer.php');?>