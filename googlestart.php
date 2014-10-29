<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

function get_plusones($url) {
 $ch = curl_init();   
 curl_setopt($ch, CURLOPT_URL, "https://clients6.google.com/rpc?key=AIzaSyCKSbrvQasunBoV16zDH9R33D88CeLr9gQ"); 
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));

 $curl_results = curl_exec ($ch);
 curl_close ($ch);

 $parsed_results = json_decode($curl_results, true);
 
return intval( $parsed_results[0]['result']['metadata']['globalCounts']['count'] );
}

if(!isset($data->login)){exit;}
$xdata = explode('---', $_GET['sitename1']);


$site = mysql_fetch_object(mysql_query("SELECT * FROM `google` WHERE (`id`='{$xdata[0]}' AND `user`='{$xdata[1]}') "));

$likesnumnum = get_plusones($site->google);

/*if ($likesnumnum < 1) {$likesnumnum = 32;}*/

mysql_query("UPDATE `users` SET `pagelikesnow`='{$likesnumnum}'  WHERE `id`='{$data->id}'");

echo $likesnumnum;

?>