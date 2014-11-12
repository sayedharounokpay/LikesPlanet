<?php
$string = "http://www.facebook.com/testsite";
$newstring = "";
if(strpos($string,'http') == TRUE) {
    $newstring = str_replace('http://www.facebook.com/','',$string);
}
else {
}
echo $newstring;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

