<?php
include('headeraddon.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

if($data->id != '1'){echo "<script>document.location.href='login.php?adminpanel=1'</script>"; exit;}

mysql_query("UPDATE `vbdata` SET `data`=`data`+1 WHERE `id`='2' ");
$vbdata = mysql_fetch_object(mysql_query("SELECT * FROM `vbdata` WHERE `id`='2'"));

$ship_id_get = $get['id'];
$target_path = "uploads/";
$target_path = $target_path . "file_" . $vbdata->data . "_" . basename( $_FILES['uploadedfile']['name']);
$fileprofile = "file_" . $vbdata->data . "_" . basename( $_FILES['uploadedfile']['name']);
$fileprofilename = basename( $_FILES['uploadedfile']['name']);

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	mysql_query("INSERT INTO `vbdocs`(ship_id, profile, file_name) values('{$ship_id_get}' ,'{$fileprofile}' ,'{$fileprofilename}' )");
	
	echo "<script>document.location.href='listships.php?id=" . "$ship_id_get" . "&done=1'</script>"; exit;
} else{
	echo "<script>document.location.href='ships_addfile.php?id=" . "$ship_id_get" . "&error=1'</script>"; exit;
}

include('footeraddon.php');?>