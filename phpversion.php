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
 
$fb = facebook_count('https://www.facebook.com/daily.developer.online2');
 
// facebook share count
echo $fb[0]->share_count;
 
// facebook like count
echo $fb[0]->like_count;
 
// facebook comment count
echo $fb[0]->comment_count;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

