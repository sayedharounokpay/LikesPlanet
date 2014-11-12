<?php
ini_set ('allow_url_fopen', '1');
$url0   = 'https://graph.facebook.com/kingvamp2014'; 
$opts = array('http' => array('header' => "User-Agent:MyAgent/1.0\r\n"));
$context = stream_context_create($opts);

$mystring0 = file_get_contents($url0, FALSE, $context);

var_dump($mystring0);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

