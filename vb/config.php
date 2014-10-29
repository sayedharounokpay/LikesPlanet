<?php
session_start();
  include("settings.php");
  if(!(@mysql_connect("$host","$user","$pass") && @mysql_select_db("$tablename"))) {
?>
MySQL Error
<?
    exit;
  }
  include("functions.php");
  
if(isset($_SESSION['login'])){
    $dbres= mysql_query("SELECT * FROM `vbusers` WHERE `login`='{$_SESSION['login']}'");
    $data= mysql_fetch_object($dbres);
  }

$coinsdollar=5000;

?>