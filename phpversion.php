<?php
function facebook_count($url){
 
    // Query in FQL
    $fql  = "SELECT share_count, like_count, comment_count ";
    $fql .= " FROM link_stat WHERE url = '$url'";
 
    $fqlURL = "https://api.facebook.com/method/fql.query?format=json&query=" . urlencode($fql);
 
    // Facebook Response is in JSON
    $response = file_get_contents($fqlURL);
    return json_decode($response);
 
}
$fbxzxc123 = facebook_count('https://www.facebook.com/dailydeveloper');
$likesnumnum = $fbxzxc123[0]->like_count;
echo 'test: ';
echo $likesnumnum;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

