<?php 
$ch = curl_init("http://graph.facebook.com/daily.developer.online2");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$raw = curl_exec($ch);
curl_close($ch);

$data = json_decode($raw);
var_dump($data);
echo $data->likes . " people like Coca-Cola";
?>