<?php
include('header.php');

if($data->id != 1){echo "<script>document.location.href='index.php'</script>"; exit;}

mysql_query("UPDATE `cashout` SET `pending`='1' WHERE `pending`='5'");

echo "Paid."; 

?>



