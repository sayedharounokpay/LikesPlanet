<?php
include('headeraddon.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

if($data->id != '1'){echo "<script>document.location.href='login.php?adminpanel=1'</script>"; exit;}

mysql_query("UPDATE `vbdata` SET `data`=`data`+1 WHERE `id`='1' ");
$vbdata = mysql_fetch_object(mysql_query("SELECT * FROM `vbdata` WHERE `id`='1'"));


$target_path = "uploads/";
$target_path = $target_path . "ship_" . $vbdata->data . ".jpg";

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	mysql_query("INSERT INTO `vbships`(fullname, profile) values('{$_POST['shipname']}','{$vbdata->data}' )");
	
	echo "<script>document.location.href='listships.php'</script>"; exit;
} else{
	echo "<script>document.location.href='register_ship.php?error=1'</script>"; exit;
}

include('footeraddon.php');?>