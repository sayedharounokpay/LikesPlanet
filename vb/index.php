<?php
include('headeraddon.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
?>

<body id="tab1"> 

<center>
<p>Click on 'Like' button.</p>
<p><font color='darkgreen'><b>SKIP</b> Pages already liked.</font></p>
</center>

<div class="clearer">&nbsp;</div>

<? include('footeraddon.php');?>