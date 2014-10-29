<?php
include('headeraddon.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='login.php'</script>"; exit;}


$target_path = "uploads/";
$target_path = $target_path . $data->login . ".jpg"; 

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	mysql_query("UPDATE `vbusers` SET `profile`='1' WHERE ( `login`='{$data->login}' )");
	echo "<script>document.location.href='userpanel.php'</script>"; exit;
} else{
	echo "<script>document.location.href='usercomp1.php?error=1&id=" . $data->id . "'</script>"; exit;
}

include('footeraddon.php');?>