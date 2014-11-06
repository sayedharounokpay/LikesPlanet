<?php
global $baselocation;
$table = "statistics";
$cols = array('id'=>'Stat ID','user_id'=>'User','date'=>'Date','coins_gained'=>'Points Earned');
$limit = 50;
$pagenum = 1;
if(isset($_GET['pagenum'])) {
    $pagenum = $_GET['pagenum'];
}
$usertable = new dbTable($table, $cols, $limit, $pagenum, $user_options = 1);
$usertable->display_search(array('user_id'=>'User ID','date'=>'Date'));
$usertable->display_table();
$usertable->pagination();