<?php
include('config.php');

foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

$x = mysql_fetch_object(mysql_query("SELECT * FROM `adsb` WHERE (`id`='{$_GET['bid']}')"));

mysql_query("UPDATE `adsb` SET `hits`=`hits`+1 WHERE `id`='{$_GET['bid']}'");
if ( $x->clx > 0 ) {
mysql_query("UPDATE `adsb` SET `clx`=`clx`-1 WHERE `id`='{$_GET['bid']}'");
}

?>
<script>
var mywindow;
window.location = '<? echo $x->url; ?>';
</script>
