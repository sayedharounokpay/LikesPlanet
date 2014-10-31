<?php
global $baselocation;
$table = "users";
$cols = array('id'=>'User ID','login'=>'Username','email'=>'Email');
$limit = 50;
$pagenum = 1;
if(isset($_GET['pagenum'])) {
    $pagenum = $_GET['pagenum'];
}
$usertable = new dbTable($table, $cols, $limit, $pagenum, $user_options = 1, '<a href="'.$baselocation.'/users/base.php?action=uoptions&id=.id.">User Options</a>');
$usertable->display_table();
$usertable->pagination();