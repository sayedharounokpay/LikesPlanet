<?php
include('config.php');
if(isset($_POST['ii'])){
$x = mysql_fetch_object(mysql_query("SELECT * FROM `cashout` WHERE (`i`='{$_POST['ii']}' AND id={$data->id}) "));
if($x->pending == '0'){
mysql_query("UPDATE `users` SET `coins`=`coins`+'{$x->cash}'*$coinsdollar WHERE `id`='{$x->id}'");
mysql_query("UPDATE `users` SET `beforeref`=`coins` WHERE `id`='{$x->id}'");
mysql_query("UPDATE `cashout` SET `pending`='2' WHERE `i`='{$x->i}'");

echo 'Your Cashout has Cancelled!';
}
else{ echo 'Your Cashout already Cancelled!';}

}

?>